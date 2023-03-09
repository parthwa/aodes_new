<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Testimonial extends Widget_Base {



	public function get_name() {
		return 'brator_testimonial';
	}

	public function get_title() {
		return esc_html__( 'Brator Testimonial', 'brator-core' );
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
				'default' => __( '9K+ Customers Love Brator', 'brator-core' ),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', 'brator-core' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'item_author_image',
			array(
				'label'   => esc_html__( 'Author Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$repeater->add_control(
			'item_author_name',
			array(
				'label'   => esc_html__( 'Author Name', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Eddie Bower 1', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_designation',
			array(
				'label'   => esc_html__( 'Designation', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Senior Martketer', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_review_title',
			array(
				'label'   => esc_html__( 'Review Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '2 Wolrd of car spares, i found  it!', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_description',
			array(
				'label'       => esc_html__( 'Review Text', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Great company. They did everything right. I was not happy with a product, so they were very flexible about the return of the item and the refund.', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'review',
			array(
				'label'   => esc_html__( 'Review', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '5',
				'max'     => '5',
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
				'name'     => 'review_title_typography',
				'label'    => __( 'Review Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-client-review-item .brator-client-review-content-area .brator-client-review-title h3',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_text_typography',
				'label'    => __( 'Review Text', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-client-review-item .brator-client-review-content-area .brator-client-review-content p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_name_typography',
				'label'    => __( 'Author Name', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-client-review-item .brator-client-review-autho .brator-client-review-autho-content p ',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => __( 'Designation', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-client-review-item .brator-client-review-autho .brator-client-review-autho-content p',
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
			'review_title_color',
			array(
				'label'     => __( 'Review Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-client-review-item .brator-client-review-content-area .brator-client-review-title h3' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'review_text_color',
			array(
				'label'     => __( 'Review Text Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-client-review-item .brator-client-review-content-area .brator-client-review-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'author_name_color',
			array(
				'label'     => __( 'Author Name Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-client-review-item .brator-client-review-autho .brator-client-review-autho-content span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'designation_color',
			array(
				'label'     => __( 'Designation Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-client-review-item .brator-client-review-autho .brator-client-review-autho-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$layout_style = $settings['layout_style'];
		$heading      = $settings['heading'];
		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
			<div class="brator-client-review-area">
				<div class="container-lg-c container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header">
								<h2><?php echo $heading; ?></h2>
							</div>
							<div class="brator-client-review splide" id="reviewSliderCount">
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
											$item_review_title = $item['item_review_title'];
											$item_description  = $item['item_description'];
											$review            = $item['review'];
											?>
											<div class="brator-client-review-item design-one splide__slide">
												<div class="brator-client-review-content-area">
													<div class="brator-client-review-title">
														<h3><?php echo $item_review_title; ?></h3>
													</div>
													<div class="brator-review brator-client-review-star">
														<svg class="active" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
															<path d="M59.7,23.9l-18.1-2.8L33.4,3.9c-0.6-1.2-2.2-1.2-2.8,0l-8.2,17.3L4.4,23.9c-1.3,0.2-1.8,1.9-0.8,2.8l13.1,13.5l-3.1,18.9  c-0.2,1.3,1.1,2.4,2.3,1.6l16.3-8.9l16.2,8.9c1.1,0.6,2.5-0.4,2.2-1.6l-3.1-18.9l13.1-13.5C61.4,25.8,61,24.1,59.7,23.9z"></path>
														</svg>
														<?php
														$allrating = array( 1, 2, 3, 4, 5 );
														foreach ( $allrating as $rating ) {
															?>
															<svg class="active" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
																<path d="M59.7,23.9l-18.1-2.8L33.4,3.9c-0.6-1.2-2.2-1.2-2.8,0l-8.2,17.3L4.4,23.9c-1.3,0.2-1.8,1.9-0.8,2.8l13.1,13.5l-3.1,18.9  c-0.2,1.3,1.1,2.4,2.3,1.6l16.3-8.9l16.2,8.9c1.1,0.6,2.5-0.4,2.2-1.6l-3.1-18.9l13.1-13.5C61.4,25.8,61,24.1,59.7,23.9z"></path>
															</svg>
															<?php
															if ( $rating == $review ) {
																break;
															}
														}
														?>
													</div>
													<div class="brator-client-review-content">
														<p><?php echo $item_description; ?></p>
													</div>
												</div>
											</div>
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
			<div class="brator-client-review-author-slider thub-also">
				<div class="container-lg-c container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-client-review-author splide">
								<div class="splide__track">
									<div class="splide__list">
										<?php
										foreach ( $settings['items'] as $item ) {
											$item_author_image     = ( $item['item_author_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_author_image']['id'], 'full' ) : $item['item_author_image']['url'];
											$item_author_image_alt = get_post_meta( $item['item_author_image']['id'], '_wp_attachment_image_alt', true );
											$item_author_name      = $item['item_author_name'];
											$item_designation      = $item['item_designation'];
											?>
											<div class="brator-client-review-item design-one splide__slide">
												<div class="brator-client-review-autho">
													<div class="brator-client-review-autho-img">
														<?php
														if ( wp_http_validate_url( $item_author_image ) ) {
															?>
															<img src="<?php echo esc_url( $item_author_image ); ?>" alt="<?php esc_url( $item_author_image_alt ); ?>">
															<?php
														} else {
															echo $item_author_image;
														}
														?>
													</div>
													<div class="brator-client-review-autho-content"><span><?php echo $item_author_name; ?></span>
														<p><?php echo $item_designation; ?></p>
													</div>
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
			</div>
			<div class="brator-plan-pixel-area">
				<div class="row">
					<div class="container-lg-c container">
						<div class="col-12">
							<div class="plan-pixel-area"></div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="brator-client-review-area">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header">
								<h2><?php echo $heading; ?></h2>
							</div>
							<div class="brator-client-review splide js-splide" data-splide="{&quot;pagination&quot;:false,&quot;type&quot;:&quot;loop&quot;,&quot;perPage&quot;:2,&quot;perMove&quot;:&quot;1&quot;,&quot;gap&quot;:75, &quot;breakpoints&quot;: { &quot;1199&quot; :{ &quot;perPage&quot;: &quot;1&quot; }}}">
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
										foreach ( $settings['items'] as $item ) {
											$item_author_image     = ( $item['item_author_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_author_image']['id'], 'full' ) : $item['item_author_image']['url'];
											$item_author_image_alt = get_post_meta( $item['item_author_image']['id'], '_wp_attachment_image_alt', true );
											$item_author_name      = $item['item_author_name'];
											$item_designation      = $item['item_designation'];
											$item_author_name      = $item['item_author_name'];
											$item_designation      = $item['item_designation'];
											$item_review_title     = $item['item_review_title'];
											$item_description      = $item['item_description'];
											$review                = $item['review'];
											?>
											<div class="brator-client-review-item design-one splide__slide">
												<div class="brator-client-review-content-area design-two">
													<div class="brator-client-review-title">
														<h3><?php echo $item_review_title; ?></h3>
													</div>
													<div class="brator-review brator-client-review-star">
														<svg class="active" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
															<path d="M59.7,23.9l-18.1-2.8L33.4,3.9c-0.6-1.2-2.2-1.2-2.8,0l-8.2,17.3L4.4,23.9c-1.3,0.2-1.8,1.9-0.8,2.8l13.1,13.5l-3.1,18.9  c-0.2,1.3,1.1,2.4,2.3,1.6l16.3-8.9l16.2,8.9c1.1,0.6,2.5-0.4,2.2-1.6l-3.1-18.9l13.1-13.5C61.4,25.8,61,24.1,59.7,23.9z"></path>
														</svg>
														<?php
														$allrating = array( 1, 2, 3, 4, 5 );
														foreach ( $allrating as $rating ) {
															?>
															<svg class="active" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
																<path d="M59.7,23.9l-18.1-2.8L33.4,3.9c-0.6-1.2-2.2-1.2-2.8,0l-8.2,17.3L4.4,23.9c-1.3,0.2-1.8,1.9-0.8,2.8l13.1,13.5l-3.1,18.9  c-0.2,1.3,1.1,2.4,2.3,1.6l16.3-8.9l16.2,8.9c1.1,0.6,2.5-0.4,2.2-1.6l-3.1-18.9l13.1-13.5C61.4,25.8,61,24.1,59.7,23.9z"></path>
															</svg>
															<?php
															if ( $rating == $review ) {
																break;
															}
														}
														?>
													</div>
													<div class="brator-client-review-content">
														<p><?php echo $item_description; ?></p>
													</div>
												</div>
												<div class="brator-client-review-autho">
													<div class="brator-client-review-autho-img">
														<?php
														if ( wp_http_validate_url( $item_author_image ) ) {
															?>
															<img src="<?php echo esc_url( $item_author_image ); ?>" alt="<?php esc_url( $item_author_image_alt ); ?>">
															<?php
														} else {
															echo $item_author_image;
														}
														?>
													</div>
													<div class="brator-client-review-autho-content"><span><?php echo $item_author_name; ?></span>
														<p><?php echo $item_designation; ?></p>
													</div>
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
			</div>
			<?php
		}
	}
}
