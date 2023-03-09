<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Main_Slider extends Widget_Base {


	public function get_name() {
		return 'brator_main_slider';
	}

	public function get_title() {
		return esc_html__( 'Brator Main Slider', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__( 'general', 'brator-core' ),
			)
		);

		$this->add_control(
			'background_image',
			array(
				'label'   => esc_html__( 'Background Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$this->add_control(
			'search_form_title',
			array(
				'label'   => esc_html__( 'Search Form Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Search by Vehicle', 'brator-core' ),
			)
		);
		$this->add_control(
			'search_form_subtitle',
			array(
				'label'   => esc_html__( 'Search Form Subtitle', 'brator-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Filter your results by entering your Vehicle to <br>ensure you find the parts that fit.', 'brator-core' ),
			)
		);
		$this->add_control(
			'search_form_shortcode',
			array(
				'label'   => esc_html__( 'Search Form Shortcode', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '[brator_auto_parts_search]', 'brator-core' ),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'slide_list',
			array(
				'label' => esc_html__( 'Slide Items', 'brator-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_slider_image',
			array(
				'label'   => esc_html__( 'Slider Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$repeater->add_control(
			'item_tagline',
			array(
				'label'   => esc_html__( 'Tagline', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'mega sale', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_offer_text',
			array(
				'label'   => esc_html__( 'Offer Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '<p>30</p><span>%<strong>off</strong></span>', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '<span>Dunlon</span> Tires &wheels', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_desc',
			array(
				'label'   => esc_html__( 'Description', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Use code: <span>SALE30</span>', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Shop Now', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_button_url',
			array(
				'label'         => esc_html__( 'Button URL', 'brator-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'brator-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
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

		$this->start_controls_section(
			'features_item',
			array(
				'label' => esc_html__( 'Features Items', 'brator-core' ),
			)
		);
		$repeater2 = new Repeater();
		$repeater2->add_control(
			'item_icon_image',
			array(
				'label'   => esc_html__( 'Icon Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater2->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Original Products', 'brator-core' ),
			)
		);

		$repeater2->add_control(
			'item_title_url',
			array(
				'label'         => esc_html__( 'Title URL', 'brator-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'brator-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),

			)
		);
		$this->add_control(
			'items2',
			array(
				'label'   => esc_html__( 'Repeater List', 'brator-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater2->get_controls(),
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
				'name'     => 'search_form_title_typography',
				'label'    => __( 'Search Form Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'search_form_subtitle_typography',
				'label'    => __( 'Search Form Subtitle', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-header p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tagline_typography',
				'label'    => __( 'Tagline', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-sell span',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'offer_text_typography',
				'label'    => __( 'Offer Text', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-off p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-title h5',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-code h5',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_text_typography',
				'label'    => __( 'Button Text', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-action a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_items_typography',
				'label'    => __( 'Features Item Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button',
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
			'search_form_title_color',
			array(
				'label'     => __( 'Search Form Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_form_subtitle_color',
			array(
				'label'     => __( 'Search Form Subtitle Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-header p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'brator-core' ),
			)
		);
		$this->add_control(
			'search_button_title_color',
			array(
				'label'     => __( 'Search Button Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_bg_color',
			array(
				'label'     => __( 'Search Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_border_color',
			array(
				'label'     => __( 'Search Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'brator-core' ),
			)
		);
		$this->add_control(
			'search_button_title_hover_color',
			array(
				'label'     => __( 'Search Button Title Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_bg_hover_color',
			array(
				'label'     => __( 'Search Button BG Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_border_hover_color',
			array(
				'label'     => __( 'Search Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Slide Items Color Section
		$this->start_controls_section(
			'color_item_color_section',
			array(
				'label' => __( 'Slide Items Color Section', 'brator-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'tagline_color',
			array(
				'label'     => __( 'Tagline Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-sell span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'offer_text_color',
			array(
				'label'     => __( 'Offer Text Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-off p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-title h5' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-code h5' => 'color: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style2' );
		$this->start_controls_tab(
			'tab_button_normal2',
			array(
				'label' => __( 'Normal', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Button Text Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-action a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_bg_color',
			array(
				'label'     => __( 'Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-action a' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-action a' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover2',
			array(
				'label' => __( 'Hover', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_text_hover_color',
			array(
				'label'     => __( 'Button Text Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-action a:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_bg_hover_color',
			array(
				'label'     => __( 'Button BG Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-two .brator-banner-content .brator-banner-content-action a:hover' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => __( 'Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-one .brator-parts-search-box-form button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render() {
		$settings              = $this->get_settings_for_display();
		$search_form_title     = $settings['search_form_title'];
		$search_form_subtitle  = $settings['search_form_subtitle'];
		$search_form_shortcode = $settings['search_form_shortcode'];
		$background_image_url  = ( $settings['background_image']['id'] != '' ) ? wp_get_attachment_image_url( $settings['background_image']['id'], 'full' ) : $settings['background_image']['url'];
		?>
		<div class="brator-brand-slider design-one" style="background-image:url(<?php echo $background_image_url; ?>)">
			<div class="container-lg-c container">
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<div class="brator-parts-search-box-area design-one">
							<div class="brator-parts-search-box-header">
								<h2><?php echo $search_form_title; ?></h2>
								<p><?php echo $search_form_subtitle; ?></p>
							</div>
							<?php echo do_shortcode( $search_form_shortcode ); ?>
						</div>
					</div>
					<div class="col-lg-8 col-md-12">
						<div class="brator-banner-slider design-two splide js-splide p-splide" data-splide='{"autoplay":true, "arrows":false,"pagination":true,"type":"slide","perPage":1,"perMove":"1"}'>
							<div class="splide__track">
								<div class="splide__list">
									<?php
									foreach ( $settings['items'] as $item ) {
										$item_slider_image_url    = ( $item['item_slider_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_slider_image']['id'], 'full' ) : $item['item_slider_image']['url'];
										$item_tagline             = $item['item_tagline'];
										$item_offer_text          = $item['item_offer_text'];
										$item_title               = $item['item_title'];
										$item_desc                = $item['item_desc'];
										$item_button_text         = $item['item_button_text'];
										$item_button_url          = $item['item_button_url']['url'];
										$item_button_url_external = $item['item_button_url']['is_external'] ? 'target="_blank"' : '';
										$item_button_url_nofollow = $item['item_button_url']['nofollow'] ? 'rel="nofollow"' : '';
										?>
										<div class="brator-banner-area design-two splide__slide lazyload" data-bg="<?php echo $item_slider_image_url; ?>">
											<div class="brator-banner-content">
												<?php if ( ! empty( $item_tagline ) ) { ?>
													<div class="brator-banner-content-sell"><span><?php echo $item_tagline; ?></span></div>
												<?php } ?>
												<?php if ( ! empty( $item_offer_text ) ) { ?>
													<div class="brator-banner-content-off">
														<?php echo $item_offer_text; ?>
													</div>
												<?php } ?>
												<?php if ( ! empty( $item_title ) ) { ?>
													<div class="brator-banner-content-title">
														<h5><?php echo $item_title; ?></h5>
													</div>
												<?php } ?>
												<?php if ( ! empty( $item_desc ) ) { ?>
													<div class="brator-banner-content-code">
														<h5> <?php echo $item_desc; ?></h5>
													</div>
												<?php } ?>
												<?php if ( ! empty( $item_button_url ) && ! empty( $item_button_text ) ) { ?>
													<div class="brator-banner-content-action"><a href="<?php echo esc_url( $item_button_url ); ?>" <?php echo $item_button_url_external; ?> <?php echo $item_button_url_nofollow; ?>><?php echo $item_button_text; ?></a></div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12">
						<div class="brator-features-area design-one">
							<?php
							foreach ( $settings['items2'] as $item ) {
								$item_icon_image         = ( $item['item_icon_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_icon_image']['id'], 'full' ) : $item['item_slider_image']['url'];
								$item_icon_image_alt     = get_post_meta( $item['item_icon_image']['id'], '_wp_attachment_image_alt', true );
								$item_title              = $item['item_title'];
								$item_title_url          = $item['item_title_url']['url'];
								$item_title_url_external = $item['item_title_url']['is_external'] ? 'target="_blank"' : '';
								$item_title_url_nofollow = $item['item_title_url']['nofollow'] ? 'rel="nofollow"' : '';
								?>
								<a class="brator-features-single" href="<?php echo esc_url( $item_title_url ); ?>" <?php echo $item_title_url_external; ?> <?php echo $item_title_url_nofollow; ?>>
									<?php
									if ( wp_http_validate_url( $item_icon_image ) ) {
										?>
										<img src="<?php echo esc_url( $item_icon_image ); ?>" alt="<?php esc_url( $item_icon_image_alt ); ?>">
										<?php
									} else {
										echo $item_icon_image;
									}
									?>
									<p><?php echo $item_title; ?></p>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
