<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Hot_Offer_Slider extends Widget_Base {


	public function get_name() {
		return 'brator_hot_offer_slider';
	}

	public function get_title() {
		return esc_html__( 'Brator Hot Offer Slider', 'brator-core' );
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
				'label' => esc_html__( 'item', 'brator-core' ),
			)
		);
		$this->add_control(
			'layout_style',
			array(
				'label'   => esc_html__( 'Layout Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style_1' => esc_html__( 'Style One', 'brator-core' ),
					'style_2' => esc_html__( 'Style Two', 'brator-core' ),
				),
				'default' => 'style_1',
			)
		);
		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( "What's Hot", 'brator-core' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'clasifico-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater->add_control(
			'item_offer_top_text',
			array(
				'label'   => esc_html__( 'Offer Subtitle', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'sale up to', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_offer_text',
			array(
				'label'   => esc_html__( 'Offer Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '20% OFF', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),
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
			'item_button_link',
			array(
				'label'         => esc_html__( 'Button Link', 'brator-core' ),
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

		$repeater->add_control(
			'item_style',
			array(
				'label'   => esc_html__( 'Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( 'One', 'brator-core' ),
					'2' => esc_html__( 'Two', 'brator-core' ),
					'3' => esc_html__( 'Three', 'brator-core' ),
					'4' => esc_html__( 'Four', 'brator-core' ),
				),
				'default' => '1',
			)
		);
		$repeater->add_control(
			'dark',
			array(
				'label' => esc_html__( 'Dark', 'brator-core' ),
				'type'  => Controls_Manager::SWITCHER,
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
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'offer_subtitle_typography',
				'label'    => __( 'Offer Subtitle', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-hot-box-design-one .brator-hot-box-content .brator-hot-box-text p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'offer_title_typography',
				'label'    => __( 'Offer Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-hot-box-design-one .brator-hot-box-content .brator-hot-box-text h2',
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
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'offer_subtitle_color',
			array(
				'label'     => __( 'Offer Subtitle Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-hot-box-design-one .brator-hot-box-content .brator-hot-box-text p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'offer_title_color',
			array(
				'label'     => __( 'Offer Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-hot-box-design-one .brator-hot-box-content .brator-hot-box-text h2' => 'color: {{VALUE}}',
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
			'search_button_bg_color',
			array(
				'label'     => __( 'Search Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-hot-single-box .brator-hot-box-content .brator-hot-box-button a' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_border_color',
			array(
				'label'     => __( 'Search Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-hot-single-box .brator-hot-box-content .brator-hot-box-button a' => 'border-color: {{VALUE}}',
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
			'search_button_bg_hover_color',
			array(
				'label'     => __( 'Search Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-hot-single-box .brator-hot-box-content .brator-hot-box-button a:hover' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_border__hover_color',
			array(
				'label'     => __( 'Search Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-hot-single-box .brator-hot-box-content .brator-hot-box-button a:hover' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$heading      = $settings['heading'];
		$layout_style = $settings['layout_style'];
		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
			<div class="brator-offer-slider-area brator-whats-hot-area">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-lg-12">
							<div class="brator-section-header">
								<h2><?php echo $heading; ?></h2>
							</div>
							<div class="brator-offer-slider brator-whats-hot-slider splide js-splide p-splide" data-splide='{"autoplay":false, "arrows":true,"pagination":false,"type":"slide","perPage":4,"perMove":"1","gap":15, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "1" }, "991" :{ "perPage" : "1" }, "1090":{ "perPage" : "2" }, "1366":{ "perPage" : "3" }, "1500":{ "perPage" : "4" }, "1920":{ "perPage" : "4" }}}'>
								<div class="splide__arrows style-two">
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
										$i = 1;
										foreach ( $settings['items'] as $item ) {
											$item_offer_top_text       = $item['item_offer_top_text'];
											$item_offer_text           = $item['item_offer_text'];
											$item_content              = $item['item_content'];
											$item_button_text          = $item['item_button_text'];
											$item_button_link          = $item['item_button_link']['url'];
											$item_button_link_external = $item['item_button_link']['is_external'] ? 'target="_blank"' : '';
											$item_button_link_nofollow = $item['item_button_link']['nofollow'] ? 'rel="nofollow"' : '';
											$item_style                = $item['item_style'];
											$item_image_url            = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
											?>
											<?php if ( $item_style == '1' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-one lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<p><?php echo $item_offer_top_text; ?></p>
																<h2><?php echo $item_offer_text; ?></h2>
																<?php echo $item_content; ?>
															</div>
															<div class="brator-hot-box-button">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } elseif ( $item_style == '2' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-two lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<h2><?php echo $item_offer_text; ?></h2>
																<div class="best-choise-batch">
																	<span><?php echo $item_offer_top_text; ?></span>
																</div>
																<?php echo $item_content; ?>
															</div>
															<div class="brator-hot-box-button">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } elseif ( $item_style == '3' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-three lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<p><?php echo $item_offer_top_text; ?></p>
																<h6><?php echo $item_offer_text; ?></h6>
																<h2><?php echo $item_content; ?></h2>
															</div>
															<div class="brator-hot-box-button">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } elseif ( $item_style == '4' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-four lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<h2><?php echo $item_offer_top_text; ?></h2>
																<p><?php echo $item_offer_text; ?></p>
																<div class="best-choise-batch best-use-code-batch">
																	<div class="use-code-off">
																		<?php echo $item_content; ?>
																	</div>
																</div>
															</div>
															<div class="brator-hot-box-button">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
											<?php
											$i++;
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="brator-plan-pixel-area">
				<div class="row">
					<div class="container-xxxl container-xxl container">
						<div class="col-12">
							<div class="plan-pixel-area"></div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="brator-offer-slider-area brator-whats-hot-area design-two">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-lg-12">
							<div class="brator-section-header">
								<h2><?php echo $heading; ?></h2>
							</div>
							<div class="brator-offer-slider brator-whats-hot-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"loop","perPage":3,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "1" }, "992" :{ "perPage" : "1" }, "1199":{ "perPage" : "2" }, "1366":{ "perPage" : "3" }, "1500":{ "perPage" : "3" }, "1920":{ "perPage" : "3" }}}'>
								<div class="splide__arrows style-one">
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
										$i = 1;
										foreach ( $settings['items'] as $item ) {
											$item_offer_top_text       = $item['item_offer_top_text'];
											$item_offer_text           = $item['item_offer_text'];
											$item_content              = $item['item_content'];
											$item_button_text          = $item['item_button_text'];
											$item_button_link          = $item['item_button_link']['url'];
											$item_button_link_external = $item['item_button_link']['is_external'] ? 'target="_blank"' : '';
											$item_button_link_nofollow = $item['item_button_link']['nofollow'] ? 'rel="nofollow"' : '';
											$item_style                = $item['item_style'];
											$item_image_url            = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
											?>
											<?php if ( $item_style == '1' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-one lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<h5><?php echo $item_offer_top_text; ?></h5>
																<h2><?php echo $item_offer_text; ?></h2>
															</div>
															<div class="brator-hot-box-button hot-shop-btn-design-two">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } elseif ( $item_style == '2' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-two lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<div class="best-choise-batch">
																	<span><?php echo $item_offer_top_text; ?></span>
																</div>
																<h2><?php echo $item_offer_text; ?></h2>
															</div>
															<div class="brator-hot-box-button hot-shop-btn-design-two">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } elseif ( $item_style == '3' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-three lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<p><?php echo $item_offer_top_text; ?></p>
																<h6><?php echo $item_offer_text; ?></h6>
															</div>
															<div class="brator-hot-box-button hot-shop-btn-design-two">
																<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
															</div>
														</div>
													</div>
												</div>
											<?php } elseif ( $item_style == '4' ) { ?>
												<div class="splide__slide">
													<div class="brator-hot-single-box brator-hot-box-design-four lazyload" data-bg="<?php echo $item_image_url; ?>">
														<div class="brator-hot-box-content">
															<div class="brator-hot-box-text">
																<p><?php echo $item_offer_top_text; ?></p>
															</div>
															<div class="brator-hot-box-button hot-shop-btn-design-two">
																<h2><?php echo $item_offer_text; ?></h2>
																<?php if ( ! empty( $item_button_link ) ) { ?>
																	<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
																<?php } ?>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
											<?php
											$i++;
										}
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
