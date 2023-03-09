<?php
/*
Plugin Name: Brator Core
Plugin URI: http://smartdatasoft.com/
Description: Helping for the Brator theme.
Author: SmartDataSoft
Version: 2.2
Author URI: http://smartdatasoft.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/breadcrumb-navxt/breadcrumb-navxt.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/mb-term-meta/mb-term-meta.php';
require_once __DIR__ . '/page-option/page-option.php';

/**
* Theme option compatibility.
*/
if ( ! function_exists( 'brator_core_get_options' ) ) :
	function brator_core_get_options( $key ) {
		$opt_pref = 'brator_theme_option';
		if ( class_exists( 'Kirki' ) ) {
			$brator_options = Kirki::get_option( $opt_pref, $key );
		} else {
			$brator_options = null;
		}
		return $brator_options;
	}
endif;

/**
 * The main plugin class
 */
final class Brator_Helper {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const version = '1.0';


	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var   string The plugin version.
	 */
	const VERSION = '1.2.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var   string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var   string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 * @access public
	 */

	/**
	 * Class construcotr
	 */
	private function __construct() {
		$this->define_constants();
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'brator_core_assets_scripts' ) );
	}

	/**
	 * Initializes a singleton instance
	 *
	 * @return \Brator
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}
	public function brator_core_assets_scripts() {

		// wp_enqueue_style( 'select2', plugins_url() . '/brator-core/assets/elementor/css/select2.min.css', false, time() );
		wp_enqueue_style( 'brator-core-custom', plugins_url() . '/brator-core/assets/elementor/css/custom.css', false, time() );
		// wp_enqueue_script( 'select2', plugins_url() . '/brator-core/assets/elementor/js/select2.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'brator-core-script', plugins_url() . '/brator-core/assets/elementor/js/brator-core.js', array( 'jquery' ), time(), true );
		$models_show_from   = brator_core_get_options( 'models_show_from' );
		$engines_show_from  = brator_core_get_options( 'engines_show_from' );
		$fueltype_show_from = brator_core_get_options( 'fueltype_show_from' );
		wp_localize_script(
			'brator-core-script',
			'brator_ajax_localize',
			array(
				'ajax_url'           => admin_url( 'admin-ajax.php' ),
				'models_show_from'   => $models_show_from,
				'engines_show_from'  => $engines_show_from,
				'fueltype_show_from' => $fueltype_show_from,
			)
		);

	}

	/**
	 * Define the required plugin constants
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'BRATOR_CORE_VERSION', self::version );
		define( 'BRATOR_CORE_FILE', __FILE__ );
		define( 'BRATOR_CORE_PATH', __DIR__ );
		define( 'BRATOR_CORE_URL', plugin_dir_url( __FILE__ ) );
		define( 'BRATOR_CORE_ASSETS_DEPENDENCY_CSS', BRATOR_CORE_URL . '/assets/elementor/css/' );
		define( 'BRATOR_CORE_ASSETS', BRATOR_CORE_URL . 'assets' );
		defined( 'BRATOR_CORE_THEME_IMG' ) or define( 'BRATOR_CORE_THEME_IMG', get_template_directory_uri() . '/assets/images/' );
		$theme = wp_get_theme();
		define( 'THEME_VERSION_CORE', $theme->Version );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init_plugin() {
		$this->checkElementor();
		load_plugin_textdomain( 'brator-core', false, basename( dirname( __FILE__ ) ) . '/languages' );

		// sidebar generator
		new \Brator\Helper\Sidebar_Generator();

		new \Brator\Helper\Widgets();
		if ( did_action( 'elementor/loaded' ) ) {
			new \Brator\Helper\Elementor();
		}

		new \Brator\Helper\Posttype();

		if ( is_admin() ) {
			new \Brator\Helper\Admin();
		}

	}

	public function checkElementor() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = '<p>If you want to use Elementor Version of "<strong>brator</strong>" Theme, Its requires "<strong>Elementor</strong>" to be installed and activated.</p>';

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-hello-world' ),
			'<strong>' . esc_html__( 'Elementor Brator', 'elementor-hello-world' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-hello-world' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'brator-core' ),
			'<strong>' . esc_html__( 'Elementor Brator', 'brator-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'brator-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {
		$installer = new Brator\Helper\Installer();
		$installer->run();
	}
}

/**
 * Initializes the main plugin
 *
 * @return \Brator
 */
function Brator() {
	return Brator_Helper::init();
}

// kick-off the plugin
Brator();


// Get The Menu List
function brator_core_get_menu_list() {
	$menulist = array();
	$menus    = get_terms( 'nav_menu' );
	foreach ( $menus as $menu ) {
		$menulist[ $menu->name ] = $menu->name;
	}
	return $menulist;
}


/**
 * Passing Classes to Menu
 */
add_action(
	'wp_nav_menu_item_custom_fields',
	function ( $item_id, $item ) {
		if ( $item->menu_item_parent == '0' ) {
			$show_as_megamenu = get_post_meta( $item_id, '_show-as-megamenu', true );
			$badge_item       = get_post_meta( $item_id, '_badge_item', true );
			?>
		<p class="description-wide">
			<label class="description"><?php esc_html_e( 'Badge', 'brator-core' ); ?>
			<input type="text" id="badge_item" name="badge_item[<?php echo $item_id; ?>]" value="<?php echo $badge_item; ?>" placeholder="<?php esc_attr_e( 'HOT', 'sds' ); ?>" />
			</label>
		</p>
		<p class="description-wide">
			<label for="megamenu-item-<?php echo $item_id; ?>"> <input type="checkbox" id="megamenu-item-<?php echo $item_id; ?>" name="megamenu-item[<?php echo $item_id; ?>]" <?php checked( $show_as_megamenu, true ); ?> /><?php _e( 'Mega menu', 'sds' ); ?>
			</label>
		</p>
			<?php
		}
	},
	10,
	2
);

add_action(
	'wp_update_nav_menu_item',
	function ( $menu_id, $menu_item_db_id ) {
		if ( isset( $_POST['badge_item'][ $menu_item_db_id ] ) && ! empty( $_POST['badge_item'][ $menu_item_db_id ] ) ) {
			update_post_meta( $menu_item_db_id, '_badge_item', $_POST['badge_item'][ $menu_item_db_id ] );
		} else {
			delete_post_meta( $menu_item_db_id, '_badge_item' );
		}

		$button_value = ( isset( $_POST['megamenu-item'][ $menu_item_db_id ] ) && $_POST['megamenu-item'][ $menu_item_db_id ] == 'on' ) ? true : false;
		update_post_meta( $menu_item_db_id, '_show-as-megamenu', $button_value );
	},
	10,
	2
);

add_filter(
	'nav_menu_css_class',
	function ( $classes, $menu_item ) {
		if ( $menu_item->menu_item_parent == '0' ) {
			$show_as_megamenu = get_post_meta( $menu_item->ID, '_show-as-megamenu', true );
			if ( $show_as_megamenu ) {
				$classes[] = 'mega-menu-li';
			}
		}
		return $classes;
	},
	10,
	2
);

function brator_megamenu_item( $item_id, $item ) {
	$megamenu_select = get_post_meta( $item_id, '_megamenu_select', true );
	if ( $item->menu_item_parent == '0' ) {
		?>
	<p class="description-wide">
		<label class="description"><?php esc_html_e( 'Megamenu Select', 'brator-core' ); ?>
		<?php
			$pageslist = get_posts(
				array(
					'post_type'      => 'elementor_library',
					'posts_per_page' => -1,
				)
			);
		?>
		<select name="megamenu_select[<?php echo esc_attr( $item_id ); ?>]" id="megamenu-select">
		<?php
		$megamenu_selected = get_post_meta( $item->ID, '_megamenu_select', true );
		?>
			<option value=""><?php esc_html_e( 'Select Template', 'brator-core' ); ?></option>
			<?php
			if ( ! empty( $pageslist ) ) {
				foreach ( $pageslist as $page ) {
					if ( ! empty( $megamenu_selected ) && $megamenu_selected == $page->ID ) {
						echo '<option selected value="' . $page->ID . '">' . $page->post_title . '</option>';
					} else {
						echo '<option value="' . $page->ID . '">' . $page->post_title . '</option>';
					}
				}
			}
			?>
		</select>
		</label>
		</p>
		<?php
	}
}
add_action( 'wp_nav_menu_item_custom_fields', 'brator_megamenu_item', 10, 2 );

function brator_save_megamenu_item( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST['megamenu_select'][ $menu_item_db_id ] ) && $_POST['megamenu_select'][ $menu_item_db_id ] != '' ) {
		$sanitized_data = $_POST['megamenu_select'][ $menu_item_db_id ];
		update_post_meta( $menu_item_db_id, '_megamenu_select', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_megamenu_select' );
	}
}
add_action( 'wp_update_nav_menu_item', 'brator_save_megamenu_item', 10, 2 );

// Custom Author Fields
function brator_user_social_links( $user_contact ) {
	$user_contact['designation'] = __( 'Designation', 'brator-core' );
	$user_contact['facebook']    = __( 'Facebook', 'brator-core' );
	$user_contact['twitter']     = __( 'Twitter', 'brator-core' );
	$user_contact['youtube']     = __( 'Youtube', 'brator-core' );
	$user_contact['instagram']   = __( 'Instagram', 'brator-core' );

	return $user_contact;
}
add_filter( 'user_contactmethods', 'brator_user_social_links' );

// Enqueue Style During Editing
add_action(
	'elementor/editor/before_enqueue_styles',
	function () {
		wp_enqueue_style( 'elementor-stylesheet', plugins_url() . '/brator-core/assets/elementor/stylesheets.css', true, time() );
		// wp_enqueue_script( 'brator-core-script', plugins_url() . '/brator-core/assets/elementor/js/addons-script.js', array( 'jquery' ), time(), true );
	}
);

function brator_core_elementor_library() {
	$pageslist = get_posts(
		array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
		)
	);
	$pagearray = array();
	if ( ! empty( $pageslist ) ) {
		$i = 0;
		foreach ( $pageslist as $page ) {
			$i++;
			if ( $i == 1 ) {
				$pagearray['0'] = esc_html__( 'Select', 'brator-core' );
			}
			$pagearray[ $page->ID ] = $page->post_title;
		}
	}
	return $pagearray;
}

function brator_blog_social_func() {
	?>
		<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>-<?php echo esc_url( get_permalink() ); ?>" target="_blank">
		<svg class="bi bi-twitter" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
		<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
		</svg></a>
		<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><path d="M47.9,25.6L47.9,25.6h-5.8H40v-2.1v-6.4v-2.1h2.1h4.4c1.1,0,2-0.9,2-2V2c0-1.1-0.9-2-2-2h-7.6c-8.2,0-13.9,5.9-13.9,14.4v9.1v2.1h-2.1H16c-1.5,0-2.7,1.2-2.7,2.8v7.4c0,1.5,1.2,2.7,2.7,2.7h6.9h2.1v2.1v20.8c0,1.5,1.2,2.7,2.7,2.7h9.8c0.6,0,1.2-0.3,1.6-0.7c0.5-0.5,0.7-1.2,0.7-1.8l0,0v0V40.5v-2.1H42h4.6c1.3,0,2.4-0.9,2.6-2.1l0-0.1l0-0.1l1.4-7.1c0.2-0.8,0-1.6-0.6-2.4C49.6,26.1,48.8,25.7,47.9,25.6z"></path></svg></a>
		<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://instagram.com/share?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><svg fill="#000000" version="1.1" id="lni_lni-instagram-original" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><g><path d="M62.9,19.2c-0.1-3.2-0.7-5.5-1.4-7.6S59.7,7.8,58,6.1s-3.4-2.7-5.4-3.5c-2-0.8-4.2-1.3-7.6-1.4C41.5,1,40.5,1,32,1s-9.4,0-12.8,0.1s-5.5,0.7-7.6,1.4S7.8,4.4,6.1,6.1s-2.8,3.4-3.5,5.5c-0.8,2-1.3,4.2-1.4,7.6S1,23.5,1,32s0,9.4,0.1,12.8c0.1,3.4,0.7,5.5,1.4,7.6c0.7,2.1,1.8,3.8,3.5,5.5s3.5,2.8,5.5,3.5c2,0.7,4.2,1.3,7.6,1.4C22.5,63,23.4,63,31.9,63s9.4,0,12.8-0.1s5.5-0.7,7.6-1.4c2.1-0.7,3.8-1.8,5.5-3.5s2.8-3.5,3.5-5.5c0.7-2,1.3-4.2,1.4-7.6c0.1-3.2,0.1-4.2,0.1-12.7S63,22.6,62.9,19.2zM57.3,44.5c-0.1,3-0.7,4.6-1.1,5.8c-0.6,1.4-1.3,2.5-2.4,3.5c-1.1,1.1-2.1,1.7-3.5,2.4c-1.1,0.4-2.7,1-5.8,1.1c-3.2,0-4.2,0-12.4,0s-9.3,0-12.5-0.1c-3-0.1-4.6-0.7-5.8-1.1c-1.4-0.6-2.5-1.3-3.5-2.4c-1.1-1.1-1.7-2.1-2.4-3.5c-0.4-1.1-1-2.7-1.1-5.8c0-3.1,0-4.1,0-12.4s0-9.3,0.1-12.5c0.1-3,0.7-4.6,1.1-5.8c0.6-1.4,1.3-2.5,2.3-3.5c1.1-1.1,2.1-1.7,3.5-2.3c1.1-0.4,2.7-1,5.8-1.1c3.2-0.1,4.2-0.1,12.5-0.1s9.3,0,12.5,0.1c3,0.1,4.6,0.7,5.8,1.1c1.4,0.6,2.5,1.3,3.5,2.3c1.1,1.1,1.7,2.1,2.4,3.5c0.4,1.1,1,2.7,1.1,5.8c0.1,3.2,0.1,4.2,0.1,12.5S57.4,41.3,57.3,44.5z"/><path d="M32,16.1c-8.9,0-15.9,7.2-15.9,15.9c0,8.9,7.2,15.9,15.9,15.9S48,40.9,48,32S40.9,16.1,32,16.1z M32,42.4c-5.8,0-10.4-4.7-10.4-10.4S26.3,21.6,32,21.6c5.8,0,10.4,4.6,10.4,10.4S37.8,42.4,32,42.4z"/><ellipse cx="48.7" cy="15.4" rx="3.7" ry="3.7"/></g></svg></a>
		<a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://rss.com/podcasts/<?php echo urlencode( get_the_title() ); ?>" target="_blank"><svg fill="#000000" version="1.1" id="lni_lni-rss-feed" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><g><path d="M5,1.3C4,1.3,3.2,2,3.2,3S4,4.8,5,4.8c29.9,0,54.3,24.1,54.3,53.6c0,1,0.8,1.8,1.8,1.8s1.8-0.8,1.8-1.8C62.8,26.9,36.8,1.3,5,1.3z"/><path d="M5,15.1c-1,0-1.8,0.8-1.8,1.8S4,18.6,5,18.6c22.4,0,40.7,17.8,40.7,39.7c0,1,0.8,1.8,1.8,1.8s1.8-0.8,1.8-1.8C49.2,34.5,29.4,15.1,5,15.1z"/><path d="M5,27.4c-1,0-1.8,0.8-1.8,1.8S4,30.9,5,30.9c15.5,0,28,12.3,28,27.5c0,1,0.8,1.8,1.8,1.8s1.8-0.8,1.8-1.8C36.5,41.3,22.4,27.4,5,27.4z"/><path d="M5,40c-1,0-1.8,0.8-1.8,1.8S4,43.5,5,43.5c8.3,0,15,6.7,15,14.9c0,1,0.8,1.8,1.8,1.8s1.8-0.8,1.8-1.8C23.5,48.2,15.2,40,5,40z"/><path d="M7.5,50.3c-3.4,0-6.2,2.8-6.2,6.2s2.8,6.2,6.2,6.2c3.4,0,6.2-2.8,6.2-6.2S10.9,50.3,7.5,50.3z M7.5,59.3c-1.5,0-2.7-1.2-2.7-2.7s1.2-2.7,2.7-2.7s2.7,1.2,2.7,2.7S9,59.3,7.5,59.3z"/>
</g></svg></a>
		<?php
}
add_action( 'brator_blog_social', 'brator_blog_social_func' );


/**
 * brator_woocommerce_template load woocommerce temnplate
 *
 * @param mixed $template      default template.
 * @param mixed $template_name name of the template.
 * @param mixed $template_path path of the template.
 */
// function brator_woocommerce_template( $template, $template_name, $template_path ) {
// global $woocommerce;

// $_template = $template;

// if ( ! $template_path ) {
// $template_path = $woocommerce->template_url;
// }

// $plugin_path = BRATOR_CORE_PATH . '/woocommerce/';

// $template = locate_template(
// array(
// $template_path . $template_name,
// $template_name,
// )
// );

// if ( ! $template && file_exists( $plugin_path . $template_name ) ) {
// $template = $plugin_path . $template_name;
// }

// if ( ! $template ) {
// $template = $_template;
// }
// return $template;
// }
// add_filter( 'woocommerce_locate_template', 'brator_woocommerce_template', 10, 3 );




function brator_get_layered_nav_chosen_taxonomy() {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended

	$array = array();
	if ( ! empty( $_GET ) ) {
		foreach ( $_GET as $key => $value ) {

			if ( 0 === strpos( $key, 'filter_' ) ) {

				$attribute = wc_sanitize_taxonomy_name( str_replace( 'filter_', '', $key ) );

				$taxonomy = $attribute;

				$filter_terms = ! empty( $value ) ? explode( ',', wc_clean( wp_unslash( $value ) ) ) : array();

				if ( empty( $filter_terms ) || ! taxonomy_exists( $taxonomy ) ) {
					continue;
				}

				$query_type = ! empty( $_GET[ 'query_type_' . $attribute ] ) && in_array( $_GET[ 'query_type_' . $attribute ], array( 'and', 'or' ), true ) ? wc_clean( wp_unslash( $_GET[ 'query_type_' . $attribute ] ) ) : '';

				$array[ $taxonomy ]['terms']      = array_map( 'sanitize_title', $filter_terms ); // Ensures correct encoding.
				$array[ $taxonomy ]['query_type'] = $query_type ? $query_type : apply_filters( 'woocommerce_layered_nav_default_query_type', 'and' );
			}
		}
	}

	 return $array;

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
}

add_action( 'woocommerce_product_query', 'brator_shop_term_pre_get_posts', 1 );
function brator_shop_term_pre_get_posts( $query ) {
		// $query->set( 'post_type', 'product' );
	if ( ! is_admin() && $query->is_main_query() ) {
		$varxa = brator_get_layered_nav_chosen_taxonomy();

		if ( ! empty( $_GET ) ) {
			foreach ( $_GET as $key => $value ) {
				if ( 0 === strpos( $key, 'filter_' ) ) {
					$attribute = wc_sanitize_taxonomy_name( str_replace( 'filter_', '', $key ) );

					$taxonomy     = $attribute;
					$filter_terms = ! empty( $value ) ? explode( ',', wc_clean( wp_unslash( $value ) ) ) : array();

					if ( empty( $filter_terms ) || ! taxonomy_exists( $taxonomy ) ) {
						continue;
					}

					// $query_type = ! empty( $_GET[ 'query_type_' . $attribute ] ) && in_array( $_GET[ 'query_type_' . $attribute ], array( 'and', 'or' ), true ) ? wc_clean( wp_unslash( $_GET[ 'query_type_' . $attribute ] ) ) : '';

					foreach ( $varxa as $taxonomy => $data ) {
						$tax_query[] = array(
							'taxonomy'         => $taxonomy,
							'field'            => 'slug',
							'terms'            => $data['terms'],
							'operator'         => 'and' === $data['query_type'] ? 'IN' : 'IN',
							'include_children' => false,
						);
					}

					$query->set( 'tax_query', $tax_query );

				}
			}
		}
	}
	// remove_filter( 'woocommerce_product_query', 'brator_shop_term_pre_get_posts' );
}



function brator_tab_filter_products() {
	$catSlug           = $_POST['category'];
	$product_grid_type = $_POST['product_grid_type'];
	$product_per_page  = $_POST['product_per_page'];
	$product_order_by  = $_POST['product_order_by'];
	$product_order     = $_POST['product_order'];
	$catagory_name     = $_POST['catagory_name'];
	$product_style     = $_POST['product_style'];

	if ( $catSlug != 'all' ) {

		if ( $product_grid_type == 'sale_products' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'product_cat'    => $catSlug,
				'meta_query'     => array(
					'relation' => 'OR',
					array(// Simple products type
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
					array(// Variable products type
						'key'     => '_min_variation_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
				),
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}
		if ( $product_grid_type == 'best_selling_products' ) {
			$args = array(
				'post_type'      => 'product',
				'product_cat'    => $catSlug,
				'meta_key'       => 'total_sales',
				'orderby'        => 'meta_value_num',
				'posts_per_page' => $product_per_page,
				'order'          => $product_order,
			);
		}
		if ( $product_grid_type == 'recent_products' ) {
			$args = array(
				'post_type'      => 'product',
				'product_cat'    => $catSlug,
				'posts_per_page' => $product_per_page,
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}
		if ( $product_grid_type == 'featured_products' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'product_cat'    => $catSlug,
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				),
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);

		}
		if ( $product_grid_type == 'top_rated_products' ) {
			$args = array(
				'posts_per_page' => $product_per_page,
				'no_found_rows'  => 1,
				'post_status'    => 'publish',
				'post_type'      => 'product',
				'product_cat'    => $catSlug,
				'meta_key'       => '_wc_average_rating',
				'orderby'        => $product_order_by,
				'order'          => $product_order,
				'meta_query'     => WC()->query->get_meta_query(),
				'tax_query'      => WC()->query->get_tax_query(),
			);
		}

		if ( $product_grid_type == 'product_category' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'product_cat'    => $catSlug,
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}
	} else {

		if ( $product_grid_type == 'sale_products' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'meta_query'     => array(
					'relation' => 'OR',
					array(// Simple products type
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
					array(// Variable products type
						'key'     => '_min_variation_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
				),
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}
		if ( $product_grid_type == 'best_selling_products' ) {
			$args = array(
				'post_type'      => 'product',
				'meta_key'       => 'total_sales',
				'orderby'        => 'meta_value_num',
				'posts_per_page' => $product_per_page,
				'order'          => $product_order,
			);
		}
		if ( $product_grid_type == 'recent_products' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}
		if ( $product_grid_type == 'featured_products' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				),
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);

		}
		if ( $product_grid_type == 'top_rated_products' ) {
			$args = array(
				'posts_per_page' => $product_per_page,
				'no_found_rows'  => 1,
				'post_status'    => 'publish',
				'post_type'      => 'product',
				'meta_key'       => '_wc_average_rating',
				'orderby'        => $product_order_by,
				'order'          => $product_order,
				'meta_query'     => WC()->query->get_meta_query(),
				'tax_query'      => WC()->query->get_tax_query(),
			);
		}

		if ( $product_grid_type == 'product_category' ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $product_per_page,
				'product_cat'    => $catagory_name,
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}
	}
	$ajaxposts = new WP_Query( $args );

	if ( $ajaxposts->have_posts() ) {
		while ( $ajaxposts->have_posts() ) :
			$ajaxposts->the_post();
			if ( $product_style == 'style_2' ) {
				wc_get_template_part( 'content', 'product-slide' );
			} else {
				wc_get_template_part( 'content', 'product-slidetwo' );
			}
		endwhile;
	} else {
		echo esc_html__( 'Not found products', 'brator-core' );
	}
	exit;
}
add_action( 'wp_ajax_brator_tab_filter_products', 'brator_tab_filter_products' );
add_action( 'wp_ajax_nopriv_brator_tab_filter_products', 'brator_tab_filter_products' );


add_action( 'brator_search_result_banner', 'brator_search_result_banner_func' );
function brator_search_result_banner_func() {
	$year     = '';
	$brand    = '';
	$model    = '';
	$engine   = '';
	$fueltype = '';

	if ( isset( $_GET['makeyear'] ) && ! empty( $_GET['makeyear'] ) ) {
		$year = $_GET['makeyear'];
		$year = str_replace( '-', ' ', $year );
	}

	if ( isset( $_GET['brand'] ) && ! empty( $_GET['brand'] ) ) {
		$brand = $_GET['brand'];
		$brand = str_replace( '-', ' ', $brand );
	}

	if ( isset( $_GET['model'] ) && ! empty( $_GET['model'] ) ) {
		$model = $_GET['model'];
		$model = str_replace( '-', ' ', $model );
	}

	if ( isset( $_GET['engine'] ) && ! empty( $_GET['engine'] ) ) {
		$engine = $_GET['engine'];
		$engine = str_replace( '-', ' ', $engine );
	}

	if ( isset( $_GET['fueltype'] ) && ! empty( $_GET['fueltype'] ) ) {
		$fueltype = $_GET['fueltype'];
		$fueltype = str_replace( '-', '.', $fueltype );
	}

	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	if ( isset( $_REQUEST['search'] ) == 'advanced' && ! is_admin() ) {
		?>
	<div class="brator-current-vehicle-area">
		<div class="container-xxxl container-xxl container">
			<div class="row">
				<div class="col-12">
					<div class="brator-current-vehicle">
						<div class="brator-current-vehicle-content">
							<p><?php esc_html_e( 'Your current vehicle', 'brator-core' ); ?></p>
							<h4><?php esc_html_e( 'Auto Parts for', 'brator-core' ); ?> <span> <?php echo esc_html( $year . ' ' . $brand . ' ' . $model . ' ' . $engine . ' ' . $fueltype ); ?> </span></h4>
						</div>
						<div class="brator-current-vehicle-content"><a href="<?php echo esc_url( $shop_page_url ); ?>"><?php esc_html_e( 'Reset', 'brator-core' ); ?></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php
	}
}
