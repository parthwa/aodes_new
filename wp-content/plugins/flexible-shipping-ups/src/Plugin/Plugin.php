<?php
/**
 * Plugin main class.
 *
 * @package WPDesk\FlexibleShippingUps
 */

namespace WPDesk\FlexibleShippingUps;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use UpsFreeVendor\Octolize\Tracker\OptInNotice\ShouldDisplayAlways;
use UpsFreeVendor\Octolize\Tracker\TrackerInitializer;
use UpsFreeVendor\WPDesk\AbstractShipping\Settings\SettingsValuesAsArray;
use UpsFreeVendor\WPDesk\Logger\WPDeskLoggerFactory;
use UpsFreeVendor\WPDesk\Notice\AjaxHandler;
use UpsFreeVendor\WPDesk\Persistence\Adapter\WooCommerce\WooCommerceSessionContainer;
use UpsFreeVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use UpsFreeVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use UpsFreeVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use UpsFreeVendor\WPDesk\PluginBuilder\Plugin\TemplateLoad;
use UpsFreeVendor\WPDesk\RepositoryRating\RatingPetitionNotice;
use UpsFreeVendor\WPDesk\RepositoryRating\TimeWatcher\ShippingMethodInstanceWatcher;
use UpsFreeVendor\WPDesk\UpsShippingService\UpsApi\UpsAccessPoints;
use UpsFreeVendor\WPDesk\UpsShippingService\UpsServices;
use UpsFreeVendor\WPDesk\UpsShippingService\UpsSettingsDefinition;
use UpsFreeVendor\WPDesk\UpsShippingService\UpsSurepostShippingService;
use UpsFreeVendor\WPDesk\View\Renderer\Renderer;
use UpsFreeVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use UpsFreeVendor\WPDesk\View\Resolver\ChainResolver;
use UpsFreeVendor\WPDesk\View\Resolver\DirResolver;
use UpsFreeVendor\WPDesk\View\Resolver\WPThemeResolver;
use UpsFreeVendor\WPDesk\WooCommerceShipping\ActivePayments;
use UpsFreeVendor\WPDesk\WooCommerceShipping\Assets;
use UpsFreeVendor\WPDesk\WooCommerceShipping\CollectionPoints\CachedCollectionPointsProvider;
use UpsFreeVendor\WPDesk\WooCommerceShipping\CollectionPoints\CheckoutHandler;
use UpsFreeVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatusAjax;
use UpsFreeVendor\WPDesk\WooCommerceShipping\PluginShippingDecisions;
use UpsFreeVendor\WPDesk\WooCommerceShipping\ShippingMethod\RateMethod\CollectionPoint\CollectionPointRateMethod;
use UpsFreeVendor\WPDesk\WooCommerceShipping\ShopSettings;
use UpsFreeVendor\WPDesk\WooCommerceShipping\Ups\Tracker;
use UpsFreeVendor\WPDesk\WooCommerceShipping\Ups\UpsAdminOrderMetaDataDisplay;
use UpsFreeVendor\WPDesk\WooCommerceShipping\Ups\UpsFrontOrderMetaDataDisplay;
use UpsFreeVendor\WPDesk\WooCommerceShipping\Ups\UpsShippingMethod;
use UpsFreeVendor\WPDesk\WooCommerceShipping\Ups\UpsSurepostShippingMethod;
use UpsFreeVendor\WPDesk_Plugin_Info;
use UpsFreeVendor\WPDesk\UpsShippingService\UpsShippingService;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @package WPDesk\FlexibleShippingUps
 */
class Plugin extends AbstractPlugin implements LoggerAwareInterface, HookableCollection {

	use LoggerAwareTrait;
	use HookableParent;
	use TemplateLoad;

	const PRIORITY_BEFORE_SHARED_HELPER = -35;

	const SHIPPING_METHOD_PRIORITY = 30;

	/**
	 * Scripts version.
	 *
	 * @var string
	 */
	private $scripts_version = '1';

	/**
	 * Renderer.
	 *
	 * @var Renderer
	 */
	private $renderer;

	/**
	 * @var UpsShippingService|null
	 */
	private $ups_shipping_service;

	/**
	 * Plugin constructor.
	 *
	 * @param WPDesk_Plugin_Info $plugin_info Plugin info.
	 */
	public function __construct( WPDesk_Plugin_Info $plugin_info ) {
		$this->plugin_info = $plugin_info;
		$this->scripts_version = FLEXIBLE_SHIPPING_UPS_VERSION . '-' . $this->scripts_version;
		parent::__construct( $this->plugin_info );
	}

	/**
	 * Returns true when debug mode is on.
	 *
	 * @return bool
	 */
	private function is_debug_mode() {
		return 'yes' === get_option( 'debug_mode', 'no' );
	}

	/**
	 * Init base variables for plugin
	 */
	public function init_base_variables() {
		$this->plugin_url       = $this->plugin_info->get_plugin_url();
		$this->plugin_path      = $this->plugin_info->get_plugin_dir();
		$this->template_path    = $this->plugin_info->get_text_domain();
		$this->plugin_namespace = $this->plugin_info->get_text_domain();
	}

	/**
	 * Init plugin
	 */
	public function init() {
		parent::init();

		$this->init_renderer();

		$this->init_ups_services();

		$this->add_hookable( new ActivationDate() );

		$this->add_hookable( new OrderCounter() );

		$this->add_hookable( new RateNotice() );

		$this->add_hookable( new OldProVersionMessage() );

		$this->init_repository_rating();

		$this->add_hookable( new SettingsSidebar() );

		$this->add_hookable( new AjaxHandler( trailingslashit( $this->get_plugin()->get_plugin_url() ) . 'vendor_prefixed/wpdesk/wp-notice/assets' ) );

		$admin_meta_data_interpreter = new UpsAdminOrderMetaDataDisplay();
		$admin_meta_data_interpreter->init_interpreters();
		$this->add_hookable( $admin_meta_data_interpreter );

		$meta_data_interpreter = new UpsFrontOrderMetaDataDisplay( $this->renderer );
		$meta_data_interpreter->init_interpreters();
		$this->add_hookable( $meta_data_interpreter );

		$this->add_hookable( new ActivePayments\Integration( UpsShippingService::UNIQUE_ID ) );

		$global_ups_woocommerce_options  = $this->get_global_ups_settings();
		$origin_country = $this->get_origin_country_code( $global_ups_woocommerce_options );
		$this->add_hookable(
			new Onboarding(
				$this->get_ups_shipping_service( $origin_country  ),
				$global_ups_woocommerce_options,
				$this->plugin_info->get_plugin_file_name(),
				$this->logger /** @phpstan-ignore-line */
			)
		);

		$this->init_tracker();

		$this->hooks();
	}

	/**
	 * Init repository rating.
	 */
	private function init_repository_rating(): void {
		$time_tracker = new ShippingMethodInstanceWatcher(
			UpsShippingService::UNIQUE_ID,
			'plugin_activation_flexible-shipping-ups/flexible-shipping-ups.php',
			'28-11-2019',
			UpsShippingMethod::class
		);
		$this->add_hookable( $time_tracker );
		$this->add_hookable(
			new RatingPetitionNotice(
				$time_tracker,
				UpsShippingService::UNIQUE_ID,
				$this->plugin_info->get_plugin_name(),
				'https://octol.io/fs-ups-rate'
			)
		);
	}

	/**
	 * Init renderer.
	 */
	private function init_renderer(): void {
		$resolver = new ChainResolver();
		$resolver->appendResolver( new WPThemeResolver( $this->get_template_path() ) );
		$resolver->appendResolver( new DirResolver( trailingslashit( $this->plugin_path ) . 'templates' ) );
		$resolver->appendResolver( new DirResolver( trailingslashit( $this->plugin_path ) . 'vendor_prefixed/wpdesk/wp-woocommerce-shipping/templates' ) );
		$resolver->appendResolver( new DirResolver( trailingslashit( $this->plugin_path ) . 'vendor_prefixed/wpdesk/wp-ups-shipping-method/templates' ) );
		$this->renderer = new SimplePhpRenderer( $resolver );
	}

	/**
	 * Init hooks.
	 */
	public function hooks() {
		parent::hooks();
		add_filter( 'woocommerce_shipping_methods', array( $this, 'woocommerce_shipping_methods_filter' ), self::SHIPPING_METHOD_PRIORITY, 1 );
		add_action( 'woocommerce_init', array( $this, 'init_ups_countries' ) );
		add_action( 'woocommerce_init', array( $this, 'create_legacy_shipping_method_class' ) );
		add_action( 'woocommerce_init', array( $this, 'init_ups_access_points' ) );
		$this->hooks_on_hookable_objects();
	}

	/**
	 * @internal
	 * @return void
	 */
	public function init_tracker() {
		$this->add_hookable( TrackerInitializer::create_from_plugin_info_for_shipping_method( $this->plugin_info, UpsShippingService::UNIQUE_ID ) );
		$this->add_hookable( new Tracker() );
	}

	/**
	 * Init UPS services.
	 */
	private function init_ups_services(): void {

		$global_ups_woocommerce_options  = $this->get_global_ups_settings();
		$global_ups_woocommerce_settings = new SettingsValuesAsArray( $global_ups_woocommerce_options );

		$this->setLogger( $this->is_debug_mode() ? ( new WPDeskLoggerFactory() )->createWPDeskLogger() : new NullLogger() );

		$origin_country = $this->get_origin_country_code( $global_ups_woocommerce_options );

		$ups_service = $this->get_ups_shipping_service( $origin_country );

		$api_ajax_status_handler = new FieldApiStatusAjax(
			$ups_service,
			$global_ups_woocommerce_settings,
			$this->logger /** @phpstan-ignore-line */
		);
		$api_ajax_status_handler->hooks();

		$plugin_shipping_decisions = new PluginShippingDecisions( $ups_service, $this->logger ); /** @phpstan-ignore-line */
		$plugin_shipping_decisions->set_field_api_status_ajax( $api_ajax_status_handler );

		UpsShippingMethod::set_plugin_shipping_decisions( $plugin_shipping_decisions );

		$ups_surepost_service = apply_filters(
			'flexible_shipping_ups_surepost_shipping_service',
			new UpsSurepostShippingService(
				$this->logger, /** @phpstan-ignore-line */
				new ShopSettings( UpsSurepostShippingService::UNIQUE_ID ),
				$origin_country
			)
		);

		$plugin_surepost_shipping_decisions = new PluginShippingDecisions( $ups_surepost_service, $this->logger ); /** @phpstan-ignore-line */

		UpsSurepostShippingMethod::set_plugin_shipping_decisions( $plugin_surepost_shipping_decisions );
	}

	/**
	 * @param string $origin_country
	 *
	 * @return UpsShippingService
	 */
	private function get_ups_shipping_service( string $origin_country ): UpsShippingService {
		if ( ! $this->ups_shipping_service ) {
			$this->ups_shipping_service = apply_filters(
				'flexible_shipping_ups_shipping_service',
				new UpsShippingService(
					$this->logger, /** @phpstan-ignore-line */
					new ShopSettings( UpsShippingService::UNIQUE_ID ),
					$origin_country
				)
			);
		}

		return $this->ups_shipping_service;
	}

	/**
	 * @internal
	 */
	public function init_ups_access_points(): void {
		$global_ups_woocommerce_options  = $this->get_global_ups_settings();

		$access_points_provider = new UpsAccessPoints(
			$global_ups_woocommerce_options[ UpsSettingsDefinition::ACCESS_KEY ],
			$global_ups_woocommerce_options[ UpsSettingsDefinition::USER_ID ],
			$global_ups_woocommerce_options[ UpsSettingsDefinition::PASSWORD ],
			$this->logger /** @phpstan-ignore-line */
		);

		if ( function_exists( 'wc_empty_cart' ) ) {
			WC()->initialize_session();
			$access_points_provider = new CachedCollectionPointsProvider(
				$access_points_provider,
				new WooCommerceSessionContainer( WC()->session ),
				self::class . $this->scripts_version
			);
		}

		$collection_points_checkout_handler = new CheckoutHandler(
			$access_points_provider,
			UpsShippingService::UNIQUE_ID,
			$this->renderer,
			__( 'UPS Access Point', 'flexible-shipping-ups' ),
			__( 'Access point unavailable for selected shipping address!', 'flexible-shipping-ups' ),
			__( 'The closest point based on the billing address or shipping address.', 'flexible-shipping-ups' ),
			false
		);
		$collection_points_checkout_handler->hooks();

		CollectionPointRateMethod::set_collection_points_checkout_handler( $collection_points_checkout_handler );

		$assets = new Assets( $this->get_plugin_url() . 'vendor_prefixed/wpdesk/wp-woocommerce-shipping/assets', 'ups' );
		$assets->hooks();
	}

	/**
	 * Init UPS countries.
	 */
	public function init_ups_countries(): void {
		UpsServices::set_eu_countries( WC()->countries->get_european_union_countries() );
	}

	/**
	 * Get global UPS settings.
	 *
	 * @return array
	 */
	private function get_global_ups_settings() {
		return get_option( 'woocommerce_' . UpsShippingService::UNIQUE_ID . '_settings', array( /** @phpstan-ignore-line */
			UpsSettingsDefinition::ACCESS_KEY    => '',
			UpsSettingsDefinition::PASSWORD      => '',
			UpsSettingsDefinition::USER_ID       => '',
			UpsSettingsDefinition::CUSTOM_ORIGIN => 'no',
		) );
	}

	/**
	 * Get origin country code.
	 *
	 * @param array<string, string> $global_ups_woocommerce_options .
	 *
	 * @return string
	 */
	private function get_origin_country_code( array $global_ups_woocommerce_options ): string {

		$origin_country_code = '';
		if ( isset( $global_ups_woocommerce_options[ UpsSettingsDefinition::CUSTOM_ORIGIN ] ) && 'yes' === $global_ups_woocommerce_options[ UpsSettingsDefinition::CUSTOM_ORIGIN ] ) {
			$country_state_code  = explode( ':', $global_ups_woocommerce_options[ UpsSettingsDefinition::ORIGIN_COUNTRY ] );
			$origin_country_code = $country_state_code[0];
		} else {
			$woocommerce_default_country = explode( ':', get_option( 'woocommerce_default_country', '' ) ); /** @phpstan-ignore-line */
			if ( ! empty( $woocommerce_default_country[0] ) ) {
				$origin_country_code = $woocommerce_default_country[0];
			}
		}
		return $origin_country_code;
	}

	/**
	 * Adds shipping method to Woocommerce.
	 *
	 * @param array<string, \WC_Shipping_Method|string> $methods Methods.
	 *
	 * @return array<string, \WC_Shipping_Method|string>
	 */
	public function woocommerce_shipping_methods_filter( $methods ) {
		$methods['flexible_shipping_ups'] = UpsShippingMethod::class;
		$methods['flexible_shipping_ups_surepost'] = UpsSurepostShippingMethod::class;

		return $methods;
	}

	/**
	 * Create legacy shipping method class.
	 */
	public function create_legacy_shipping_method_class(): void {
		if ( ! class_exists( 'Flexible_Shipping_UPS_Shipping_Method' ) ) {
			require __DIR__ . '/../Legacy/class-flexible-shipping-ups-shipping-method.php';
		}
	}

	/**
	 * Quick links on plugins page.
	 *
	 * @param string[] $links .
	 *
	 * @return string[]
	 */
	public function links_filter( $links ) {
		$is_pl        = 'pl_PL' === get_locale();
		$docs_link    = $is_pl ? 'https://octol.io/ups-docs-pl' : 'https://octol.io/ups-docs';
		$support_link = $is_pl ? 'https://octol.io/ups-support-pl' : 'https://octol.io/ups-support';
		$settings_url = admin_url( 'admin.php?page=wc-settings&tab=shipping&section=flexible_shipping_ups' );

		$plugin_links = array(
			'<a href="' . $settings_url . '">' . __( 'Settings', 'flexible-shipping-ups' ) . '</a>',
			'<a href="' . $docs_link . '" target="_blank">' . __( 'Docs', 'flexible-shipping-ups' ) . '</a>',
			'<a href="' . $support_link . '" target="_blank">' . __( 'Support', 'flexible-shipping-ups' ) . '</a>',
		);

		if ( ! defined( 'FLEXIBLE_SHIPPING_UPS_PRO_VERSION' ) ) {
			$upgrade_link   = $is_pl ? 'https://octol.io/ups-upgrade-pl' : 'https://octol.io/ups-upgrade';
			$plugin_links[] = '<a target="_blank" href="' . $upgrade_link . '" style="color:#d64e07;font-weight:bold;">' . __( 'Upgrade', 'flexible-shipping-ups' ) . '</a>';
		}

		return array_merge( $plugin_links, $links );
	}

}
