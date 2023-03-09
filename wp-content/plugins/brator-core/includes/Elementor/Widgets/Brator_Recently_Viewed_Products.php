<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

class Brator_Recently_Viewed_Products extends Widget_Base {

	public function get_name() {
		return 'brator_recently_viewed_products';
	}

	public function get_title() {
		return esc_html__( 'Brator Recently Viewed Products', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general_setting',
			array(
				'label' => esc_html__( 'General Settings', 'brator-core' ),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Recent Viewed Product', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'See All Products', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_url',
			array(
				'label'         => esc_html__( 'Button URL', 'brator-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'brator-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),

			)
		);
		$this->add_control(
			'heading_alignment',
			array(
				'label'   => __( 'Heading Alignment', 'brator-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array(
						'title' => __( 'Left', 'brator-core' ),
						'icon'  => 'fa fa-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'brator-core' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default' => 'right',
				'toggle'  => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_settings',
			array(
				'label' => esc_html__( 'Content Settings', 'brator-core' ),
			)
		);
		$this->add_control(
			'product_style',
			array(
				'label'   => esc_html__( 'Product Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style_1' => esc_html__( 'Style One', 'brator-core' ),
					'style_2' => esc_html__( 'Style Two', 'brator-core' ),
					'style_3' => esc_html__( 'Style Three', 'brator-core' ),
				),
				'default' => 'style_1',
			)
		);

		$this->add_control(
			'product_per_page',
			array(
				'label'   => esc_html__( 'Number of Products', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
			)
		);

		$this->add_control(
			'product_order',
			array(
				'label'   => esc_html__( 'Product Order', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'DESC', 'brator-core' ),
					'ASC'  => esc_html__( 'ASC', 'brator-core' ),
				),
			)
		);

		$this->add_control(
			'extra_class',
			array(
				'label' => esc_html__( 'Extra Class', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			array(
				'label' => esc_html__( 'Slider Settings', 'brator-core' ),
			)
		);

		$this->add_control(
			'arrows',
			array(
				'label'   => esc_html__( 'Enable Arrows', 'brator-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'slidesToShow',
			array(
				'label'              => esc_html__( 'Slides To Show', 'brator-core' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 4,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'slidesToScroll',
			array(
				'label'              => esc_html__( 'Slides To Scroll', 'brator-core' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'frontend_available' => true,
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		// $settings         = $this->get_settings();
		$settings         = $this->get_settings_for_display();
		$title            = $settings['title'];
		$button_text      = $settings['button_text'];
		$button_url       = $settings['button_url']['url'];
		$product_style    = $settings['product_style'];
		$product_per_page = $settings['product_per_page'];
		$product_order    = $settings['product_order'];
		$extra_class      = $settings['extra_class'];

		if ( $settings['arrows'] == 'yes' ) {
			$arrows = true;
		} else {
			$arrows = false;
		}

		$slidesToShow   = $settings['slidesToShow'];
		$slidesToScroll = $settings['slidesToScroll'];

		$heading_alignment = $settings['heading_alignment'];
		if ( $heading_alignment == 'left' ) {
			$heading_class = 'all-item-left';
		} else {
			$heading_class = '';
		}
		$viewed_products = ! empty( $_COOKIE['brator_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['brator_recently_viewed'] ) ) : array();
		$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

		if ( $product_style == 'style_3' ) {
			$nav_class = 'style-one';
		} else {
			$nav_class = 'style-two';
		}

		if ( ! empty( $viewed_products ) ) {
			?>
		<div class="brator-deal-product-slider recently-view <?php echo $extra_class; ?> woocommerce">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-12">
						<div class="brator-best-seller-section-header-area">
							<div class="brator-section-header <?php echo $heading_class; ?>">
								<div class="brator-section-header-title">
									<h2><?php echo $title; ?></h2>
								</div>
								<?php if ( ! empty( $button_text ) ) { ?>
								<a href="<?php echo $button_url; ?>"><?php echo $button_text; ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
									</svg>
								</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="brator-product-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":<?php echo $slidesToShow; ?>,"perMove":"1","gap":20, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "2" }, "1090":{ "perPage" : "3" }, "1366":{ "perPage" : "4" }, "1500":{ "perPage" : "4" }, "1920":{ "perPage" : "<?php echo $slidesToShow; ?>" }}}'>
							<div class="splide__arrows <?php echo $nav_class; ?>">
								<button class="splide__arrow splide__arrow--prev">
								<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
								</svg>
								</button>
								<button class="splide__arrow splide__arrow--next">
								<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
								</svg>
								</button>
							</div>
							<div class="splide__track">
								<div class="splide__list">
								<?php
									$args = array(
										'post_status'    => array( 'publish' ),
										'post_type'      => 'product',
										'posts_per_page' => $product_per_page,
										'order'          => $product_order,
										'post__in'       => $viewed_products,
										'orderby'        => 'post__in',
									);

									$query = new \WP_Query( $args );

									if ( $query->have_posts() ) :
										while ( $query->have_posts() ) :
											$query->the_post();
											if ( $product_style == 'style_2' ) {
												wc_get_template_part( 'content', 'product-slidetwo' );
											} elseif ( $product_style == 'style_3' ) {
												wc_get_template_part( 'content', 'product-listview-slide' );
											} else {
												wc_get_template_part( 'content', 'product-slide' );
											}
										endwhile;
									endif;
									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php
		}
	}
}
