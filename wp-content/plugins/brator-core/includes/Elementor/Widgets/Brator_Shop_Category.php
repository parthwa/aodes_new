<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;

class Brator_Shop_Category extends Widget_Base {


	public function get_name() {
		return 'brator_shop_category';
	}

	public function get_title() {
		return esc_html__( 'Brator Shop Category', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}


	private function get_listing_categories() {
		 $options = array();
		$taxonomy = 'product_cat';
		if ( ! empty( $taxonomy ) ) {
			$terms = get_terms(
				array(
					'parent'     => 0,
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						$options[''] = 'Select';
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							// if ( $term->count != 0 ) {
							$options[ $term->slug ] = $term->name;
							// }
						}
					}
				}
			}
		}
		return $options;
	}
	protected function register_controls() {
		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__( 'General', 'brator-core' ),
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
					'style_3' => esc_html__( 'Style Three', 'brator-core' ),
				),
				'default' => 'style_1',
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( ' Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'slider' => esc_html__( 'Slider', 'brator-core' ),
					'grid'   => esc_html__( 'Grid', 'brator-core' ),
				),
				'default' => 'slider',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Explore by Category', 'brator-core' ),
			)
		);
		$this->add_control(
			'heading_text_align',
			array(
				'label'   => __( 'Heading Alignment', 'brator-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'   => array(
						'title' => __( 'Left', 'brator-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'brator-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'brator-core' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default' => 'center',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Load More', 'brator-core' ),
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
			'item',
			array(
				'label' => esc_html__( 'Item', 'brator-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'taxonomy_slug',
			array(
				'label'     => __( 'Select Category', 'brator-core' ),
				'separator' => 'before',
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->get_listing_categories(),
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
			'sub_category_list',
			array(
				'label' => esc_html__( 'Sub Category List', 'brator-core' ),
				'type'  => Controls_Manager::TEXTAREA,
			)
		);
		$this->add_control(
			'items',
			array(
				'label'  => esc_html__( 'Repeater List', 'brator-core' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
				'name'     => 'category_typography',
				'label'    => __( 'Category', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-categories-single .brator-categories-single-title p a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_category_typography',
				'label'    => __( 'Sub Category', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-categories-single .brator-categories-single-sub',
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
			'category_color',
			array(
				'label'     => __( 'Category Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-categories-single .brator-categories-single-title p a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_category_color',
			array(
				'label'     => __( 'Sub Category Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-categories-single .brator-categories-single-sub' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$layout_style = $settings['layout_style'];
		$style        = $settings['style'];
		$heading      = $settings['heading'];
		$btn_text     = $settings['btn_text'];
		$extra_class  = $settings['extra_class'];
		?>
		<?php
		if ( $layout_style == 'style_1' ) {
			?>
			<div class="brator-categories-slider-area design-one <?php echo $extra_class; ?>">
				<div class="container-lg-c container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header" style="justify-content:<?php echo $settings['heading_text_align']; ?>">
								<div class="brator-section-header-title">
									<h2><?php echo $heading; ?></h2>
								</div>
							</div>
							<?php if ( $style == 'slider' ) { ?>
								<div class="brator-categories-slider design-one splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":6,"perMove":"1","gap":20, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "2" }, "991" :{ "perPage" : "3" }, "1090":{ "perPage" : "4" }, "1200":{ "perPage" : "4" }, "1366":{ "perPage" : "5" }, "1500":{ "perPage" : "5" }, "1920":{ "perPage" : "6" }}}'>
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
											foreach ( $settings['items'] as $item ) {
												$sub_category_list = $item['sub_category_list'];
												$taxonomy_slug     = $item['taxonomy_slug'];
												$get_conetnt       = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
												$listingurl        = get_term_link( $taxonomy_slug, 'product_cat' );
												$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
												$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
												if ( $listingurl && $get_conetnt ) {
													?>
													<div class="brator-categories-single splide__slide">
														<div class="brator-categories-single-img">
															<a href="<?php echo esc_url( $listingurl ); ?>">
																<?php
																if ( wp_http_validate_url( $item_image ) ) {
																	?>
																	<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
																	<?php
																} else {
																	echo $item_image;
																}
																?>
															</a>
														</div>
														<div class="brator-categories-single-title">
															<p><a href="<?php echo esc_url( $listingurl ); ?>"><?php echo $get_conetnt->name; ?></a></p>
														</div>
														<div class="brator-categories-single-sub">
															<?php echo $sub_category_list; ?>
														</div>
													</div>
													<?php
												}
											}
											?>
										</div>
									</div>
								</div>
							<?php } elseif ( $style == 'grid' ) { ?>
								<div class="brator-categories-grid">
									<?php
									foreach ( $settings['items'] as $item ) {
										$sub_category_list = $item['sub_category_list'];
										$taxonomy_slug     = $item['taxonomy_slug'];
										$get_conetnt       = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
										$listingurl        = get_term_link( $taxonomy_slug, 'product_cat' );
										$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
										$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
										if ( $listingurl && $get_conetnt ) {
											?>
											<div class="brator-categories-single">
												<div class="brator-categories-single-img">
													<a href="<?php echo esc_url( $listingurl ); ?>">
														<?php
														if ( wp_http_validate_url( $item_image ) ) {
															?>
															<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
															<?php
														} else {
															echo $item_image;
														}
														?>
													</a>
												</div>
												<div class="brator-categories-single-title">
													<p><a href="<?php echo esc_url( $listingurl ); ?>"><?php echo $get_conetnt->name; ?></a></p>
												</div>
												<div class="brator-categories-single-sub">
													<?php echo $sub_category_list; ?>
												</div>
											</div>
											<?php
										}
									}
									?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="brator-categories-list-area design-two <?php echo $extra_class; ?>">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header" style="justify-content:<?php echo $settings['heading_text_align']; ?>">
								<div class="brator-section-header-title">
									<h2><?php echo $heading; ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<?php if ( $style == 'slider' ) { ?>
								<div class="brator-categories-slider style-three splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":6,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "2" }, "991" :{ "perPage" : "3" }, "1090":{ "perPage" : "4" }, "1200":{ "perPage" : "4" }, "1366":{ "perPage" : "5" }, "1500":{ "perPage" : "5" }, "1920":{ "perPage" : "7" }}}'>
									<div class="splide__arrows style-three">
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
											foreach ( $settings['items'] as $item ) {
												$sub_category_list = $item['sub_category_list'];
												$taxonomy_slug     = $item['taxonomy_slug'];
												$get_conetnt       = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
												$listingurl        = get_term_link( $taxonomy_slug, 'product_cat' );
												$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
												$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
												if ( $listingurl && $get_conetnt ) {
													?>
													<div class="brator-categories-single splide__slide">
														<div class="brator-categories-single-img">
															<a href="<?php echo esc_url( $listingurl ); ?>">
																<?php
																if ( wp_http_validate_url( $item_image ) ) {
																	?>
																	<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
																	<?php
																} else {
																	echo $item_image;
																}
																?>
															</a>
														</div>
														<div class="brator-categories-single-title">
															<p><a href="<?php echo esc_url( $listingurl ); ?>"><?php echo $get_conetnt->name; ?></a></p>
														</div>
														<div class="brator-categories-single-sub">
															<?php echo $sub_category_list; ?>
														</div>
													</div>
													<?php
												}
											}
											?>
										</div>
									</div>
								</div>
							<?php } elseif ( $style == 'grid' ) { ?>
								<div class="brator-categories-list">
									<?php
									foreach ( $settings['items'] as $item ) {
										$sub_category_list = $item['sub_category_list'];
										$taxonomy_slug     = $item['taxonomy_slug'];
										$get_conetnt       = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
										$listingurl        = get_term_link( $taxonomy_slug, 'product_cat' );
										$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
										$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
										if ( $listingurl && $get_conetnt ) {
											?>
											<div class="brator-categories-single">
												<div class="brator-categories-single-img">
													<a href="<?php echo esc_url( $listingurl ); ?>">
														<?php
														if ( wp_http_validate_url( $item_image ) ) {
															?>
															<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
															<?php
														} else {
															echo $item_image;
														}
														?>
													</a>
												</div>
												<div class="brator-categories-single-title">
													<p><a href="<?php echo esc_url( $listingurl ); ?>"><?php echo $get_conetnt->name; ?></a></p>
												</div>
												<div class="brator-categories-single-sub">
													<?php echo $sub_category_list; ?>
												</div>
											</div>
											<?php
										}
									}
									?>
								</div>
								<?php if ( ! empty( $btn_text ) ) { ?>
									<div class="brator-categories-list-load-more">
										<button class="brator-categories-more-button"><?php echo esc_html( $btn_text ); ?></button>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_3' ) { ?>
			<div class="brator-categories-list-area design-two design-four <?php echo $extra_class; ?>">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header" style="justify-content:<?php echo $settings['heading_text_align']; ?>">
								<div class="brator-section-header-title">
									<h2><?php echo $heading; ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<?php if ( $style == 'slider' ) { ?>
								<div class="brator-categories-slider style-three splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":6,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "2" }, "991" :{ "perPage" : "3" }, "1090":{ "perPage" : "4" }, "1200":{ "perPage" : "4" }, "1366":{ "perPage" : "5" }, "1500":{ "perPage" : "5" }, "1920":{ "perPage" : "7" }}}'>
									<div class="splide__arrows style-three">
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
											foreach ( $settings['items'] as $item ) {
												$taxonomy_slug  = $item['taxonomy_slug'];
												$get_conetnt    = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
												$listingurl     = get_term_link( $taxonomy_slug, 'product_cat' );
												$item_image     = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
												$item_image_alt = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
												if ( $listingurl && $get_conetnt ) {
													?>
													<div class="brator-categories-single splide__slide">
														<div class="brator-categories-single-img">
															<a href="<?php echo esc_url( $listingurl ); ?>">
																<?php
																if ( wp_http_validate_url( $item_image ) ) {
																	?>
																	<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
																	<?php
																} else {
																	echo $item_image;
																}
																?>
															</a>
														</div>
														<div class="brator-categories-single-title">
															<p><a href="<?php echo esc_url( $listingurl ); ?>"><?php echo $get_conetnt->name; ?></a></p>
														</div>
														<span><?php echo $get_conetnt->count . ' ' . esc_html__( 'items', 'brator-core' ); ?></span>
													</div>
													<?php
												}
											}
											?>
										</div>
									</div>
								</div>
							<?php } elseif ( $style == 'grid' ) { ?>
								<div class="brator-categories-list">
									<?php
									foreach ( $settings['items'] as $item ) {
										$sub_category_list = $item['sub_category_list'];
										$taxonomy_slug     = $item['taxonomy_slug'];
										$get_conetnt       = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
										$listingurl        = get_term_link( $taxonomy_slug, 'product_cat' );
										$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
										$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
										if ( $listingurl && $get_conetnt ) {
											?>
											<div class="brator-categories-single">
												<div class="brator-categories-single-img">
													<a href="<?php echo esc_url( $listingurl ); ?>">
														<?php
														if ( wp_http_validate_url( $item_image ) ) {
															?>
															<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
															<?php
														} else {
															echo $item_image;
														}
														?>
													</a>
												</div>
												<div class="brator-categories-single-title">
													<p><a href="<?php echo esc_url( $listingurl ); ?>"><?php echo $get_conetnt->name; ?></a></p>
												</div>
												<div class="brator-categories-single-sub">
													<?php echo $sub_category_list; ?>
												</div>
											</div>
											<?php
										}
									}
									?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
