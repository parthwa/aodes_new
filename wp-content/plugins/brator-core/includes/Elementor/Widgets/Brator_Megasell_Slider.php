<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Megasell_Slider extends Widget_Base {



	public function get_name() {
		return 'brator_megasell_slider';
	}

	public function get_title() {
		return esc_html__( 'Brator Megasell Slider', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'General', 'brator-core' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'item_subtitle',
			array(
				'label'   => esc_html__( 'Tagline', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Mega Sale', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_offer_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '50 %', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_offer_subtitle',
			array(
				'label'   => esc_html__( 'Subtitle', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Father Day <span>Saving!</span>', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Bigest season sale in the year for all products. Hurry Up! <br> Limited time offer', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater->add_control(
			'item_shape_image',
			array(
				'label'   => esc_html__( 'Shape Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$this->add_control(
			'items',
			array(
				'label'   => esc_html__( 'Repeater List', 'brator-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'list_title'   => esc_html__( 'Title #1', 'brator-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'brator-core' ),
					),
					array(
						'list_title'   => esc_html__( 'Title #2', 'brator-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'brator-core' ),
					),
				),
			)
		);

		$this->end_controls_section();

		// Typography Section
		$this->start_controls_section(
			'typography_section',
			array(
				'label' => __( 'Typography Section', 'brator-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tagline_typography',
				'label'    => __( 'Tagline', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box .sub-title',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box h1',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => __( 'Subtitle', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box h4',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box p',
			)
		);

		$this->end_controls_section();

		// Color Section
		$this->start_controls_section(
			'color_section',
			array(
				'label' => __( 'Color Section', 'brator-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'tagline_color',
			array(
				'label'     => __( 'Tagline Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box .sub-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box h1' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box h4' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Content Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-megasell-box .brator-megasell-content-box p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="brator-megasell-area">
			<div class="container container-xxxl container-xxl">
				<div class="row">
					<div class="col-md-12">
						<div class="brator-megasell-slide-active arrow-design-one splide js-splide p-splide">
							<div class="splide__arrows">
								<button class="splide__arrow splide__arrow--prev"><span></span><img src="<?php echo BRATOR_CORE_THEME_IMG; ?>/arow-left.png" alt="alt" /></button>
								<button class="splide__arrow splide__arrow--next"><span></span><img src="<?php echo BRATOR_CORE_THEME_IMG; ?>/arow-right.png" alt="alt" /></button>
							</div>
							<div class="splide__track">
								<div class="splide__list">
									<?php
									foreach ( $settings['items'] as $item ) {
										$item_subtitle        = $item['item_subtitle'];
										$item_offer_title     = $item['item_offer_title'];
										$item_offer_subtitle  = $item['item_offer_subtitle'];
										$item_content         = $item['item_content'];
										$item_image           = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
										$item_image_alt       = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
										$item_shape_image     = ( $item['item_shape_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_shape_image']['id'], 'full' ) : $item['item_shape_image']['url'];
										$item_shape_image_alt = get_post_meta( $item['item_shape_image']['id'], '_wp_attachment_image_alt', true );
										?>
										<div class="brator-megasell-box  design-one splide__slide">
											<div class="brator-megasell-content-box">
												<span class="sub-title"><?php echo $item_subtitle; ?></span>
												<h1 class="title"><?php echo $item_offer_title; ?></h1>
												<h4 class="title"><?php echo $item_offer_subtitle; ?></h4>
												<p><?php echo $item_content; ?></p>
											</div>
											<div class="brator-megasell-thumb">
												<?php
												if ( wp_http_validate_url( $item_image ) ) {
													?>
													<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
													<?php
												} else {
													echo $item_image;
												}
												?>
											</div>
											<div class="thumb-shape">
												<?php
												if ( wp_http_validate_url( $item_shape_image ) ) {
													?>
													<img src="<?php echo esc_url( $item_shape_image ); ?>" alt="<?php esc_url( $item_shape_image_alt ); ?>">
													<?php
												} else {
													echo $item_shape_image;
												}
												?>
											</div>
										</div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
