<?php
namespace Dgm\UspsSimple;


class Plugin {

    public const WOO_ID = 'usps_simple';

    public static function init(string $pluginFile): void {

        if (isset(self::$instance)) {
            if (self::$instance->pluginFile !== $pluginFile) {
                throw new \LogicException('plugin initialized more than one with different parameters');
            }
            return;
        }

        self::$instance = new self($pluginFile);
    }

    public static function instance(): self {
        if (!isset(self::$instance)) {
            throw new \LogicException('plugin is not initialized yet');
        }
        return self::$instance;
    }

    public function createDebug(): Debug
    {
        return Debug::default($this->pluginFile);
    }


    /** @var string */
    private $pluginFile;

    private function __construct(string $pluginFile) {
        $this->pluginFile = $pluginFile;
        self::registerShippingMethod();
        ShippingMethod::handleStorePostcodeChange();
        $this->registerPluginActionLink();
    }

    private function registerPluginActionLink(): void {
        add_filter('plugin_action_links_' . plugin_basename($this->pluginFile), function(array $links) {
            return self::prependPluginActions($links, [
                self::shippingUrl(Plugin::WOO_ID) => __('Settings', 'woo-usps-simple-shipping')
            ]);
        });
    }

    /**
     * @var Plugin
     */
    private static $instance;

    private static function shippingUrl($section = null): string
    {
        $query = array(
            "page" => "wc-settings",
            "tab" => "shipping",
        );

        if (isset($section)) {
            $query['section'] = $section;
        }

        $query = http_build_query($query, '', '&');

        return admin_url("admin.php?{$query}");
    }

    private static function prependPluginActions(array $current, array $new): array {

        foreach ($new as $url => &$label) {
            $label = '<a href="'.esc_html($url).'">'.esc_html($label).'</a>';
        }
        unset($label);

        array_splice($current, 0, 0, $new);

        return $current;
    }

    private static function registerShippingMethod(): void {
        add_filter('woocommerce_shipping_methods', static function(array $methods) {
            $methods[] = ShippingMethod::class;
            return $methods;
        });
    }
}