<?php
/** @noinspection PhpMultipleClassesDeclarationsInOneFile */
/** @noinspection MissingOrEmptyGroupStatementInspection */
declare(strict_types=1);
namespace Dgm\UspsSimple;

use Dgm\UspsSimple\Calc\Pair;
use Dgm\UspsSimple\Calc\Request;
use Dgm\UspsSimple\Debug\XmlPrettyPrinter;
use WC_Product;
use WP_Error;


class Debug
{
    public static function noop(): self
    {
        return new self(null);
    }

    public static function default(string $pluginFile): self
    {
        return new self($pluginFile);
    }

    private function __construct(string $pluginFile = null)
    {
        if ($pluginFile === null) {
            return;
        }

        $this->pluginFile = $pluginFile;
        $this->data = new DebugData();
        $this->enabled = 'yes' === get_option('woocommerce_shipping_debug_mode', 'no');
        if ($this->enabled) {
            add_action('woocommerce_before_checkout_form', [$this, '_show']);
            add_action('woocommerce_before_cart', [$this, '_show']);
        }
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function recordSettings(array $props, array $settings): void
    {
        if (!$this->enabled) return;

        $data = [];

        unset($props['settings'], $props['form_fields']);
        $data['props'] = $props;

        $data['settings'] = $settings;

        $this->data->settings = $data;
    }

    public function recordPackage($package): void
    {
        if (!$this->enabled) return;

        if (is_array($package) && isset($package['contents']) && is_array($package['contents'])) {
            foreach ($package['contents'] as &$line) {
                $productData = null;
                $productObj = $line['data'];
                if ($productObj instanceof WC_Product) {
                    $productData = [
                        'name' => $productObj->get_name(),
                        'slug' => $productObj->get_slug(),
                        'price' => $productObj->get_price(),
                        'regular_price' => $productObj->get_regular_price(),
                        'sale_price' => $productObj->get_sale_price(),
                        'weight' => $productObj->get_weight() . ' ' . get_option('woocommerce_weight_unit'),
                        'weight_lbs' => wc_get_weight($productObj->get_weight(), 'lbs'),
                        'dimensions' =>
                            join(' x ', $ds = [$productObj->get_length(), $productObj->get_width(), $productObj->get_height()]) .
                            ' ' . get_option('woocommerce_dimension_unit'),
                        'dimensions_in' => join(' x ', array_map(static function($v) {
                            return wc_get_dimension($v, 'in');
                        }, $ds)),
                    ];
                }
                $line['product'] = $productData;
                unset($line['data']);
            }
            unset($line);
        }

        $this->data->package = $package;
    }

    /**
     * @param Pair<string> $requests
     */
    public function recordRequests(Pair $requests): void
    {
        if (!$this->enabled) return;
        $this->data->requests = $requests;
    }

    public function recordTheRequest(Request $request): void
    {
        if (!$this->enabled) return;
        $this->data->request = $request;
    }

    /**
     * @param Pair<WP_Error|array|string> $responses
     */
    public function recordResponses(Pair $responses): void
    {
        if (!$this->enabled) return;

        $this->data->responses = $responses->map(function($r) {
            if ($r instanceof WP_Error) {
                return ['errors' => $r->get_error_messages()];
            }
            if (is_array($r)) {
                unset($r['http_response']);
            }
            return $r;
        });
    }

    public function recordCombinedResponse(string $response): void
    {
        if (!$this->enabled) return;
        $this->data->combinedResponse = $response;
    }

    public function recordRates(array $shown): void
    {
        if (!$this->enabled) return;
        $this->data->rates = $shown;
    }

    public function recordError(string $msg): void
    {
        if (!$this->enabled) return;
        $this->data->error = $msg;
    }

    public function _show(): void
    {
        wp_enqueue_style('uspss-debug-css', plugins_url('public/debug/style.css', $this->pluginFile));
        wp_enqueue_script('uspss-debug-js-clipboard', plugins_url('public/debug/clipboard.min.js', $this->pluginFile));
        wp_enqueue_script('uspss-debug-js-main', plugins_url('public/debug/main.js', $this->pluginFile), ['jquery', 'uspss-debug-js-clipboard']);

        $props = get_object_vars($this);
        unset($props['enabled']);
        $rates = count($this->data->rates ?? []);
        $notice =
            "Found {$rates} USPS rates 
            <a class='uspss-debug-details'>details</a> 
            <a class='uspss-debug-copy'>copy</a>".
            '<div class="uspss-debug-inner">
                <pre>'.htmlspecialchars($this->data->format()).'</pre>
            </div>';

        ?>
            <div class="woocommerce-notices-wrapper">
                <div class="woocommerce-message uspss-debug">
                    <?php echo $notice; ?>
                </div>
            </div>
        <?php
    }

    public function format(): string
    {
        return $this->data->format();
    }

    /** @var bool */
    private $enabled = false;

    /** @var string */
    private $pluginFile;

    /** @var DebugData */
    private $data;
}

class DebugData
{
    /** @var string|null */
    public $error;

    /** @var array|null */
    public $rates;

    /** @var array */
    public $settings;

    /** @var mixed */
    public $package;

    /** @var Pair<string>|null */
    public $requests;

    /** @var Request|null */
    public $request;

    /** @var Pair<string|array>|null */
    public $responses;

    /** @var string */
    public $combinedResponse;


    /** @return string */
    public function format(): string
    {
        $prettify = function(&$x): void {
            $x = XmlPrettyPrinter::tryPettyPrint($x);
        };

        $map = function($p, callable $f) {
            if ($p instanceof Pair) {
                return $p->map($f);
            }
            return $p;
        };


        $copy = clone($this);

        $copy->requests = $map($copy->requests, $prettify);

        $copy->responses = $map($copy->responses, function($r) use($prettify) {

            if (is_array($r)) {
                if (isset($r['body'])) {
                    $prettify($r['body']);
                }
            }
            else if (is_string($r)) {
                $prettify($r);
            }

            return $r;
        });


        $prettify($copy->combinedResponse);

        return '`' . var_export(get_object_vars($copy), true) . '`';
    }
}