<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Clients extends Widget_Base {


	public function get_name() {
		return 'brator_clients';
	}

	public function get_title() {
		return esc_html__( 'Brator Clients', 'brator-core' );
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
					'style_3' => esc_html__( 'Style Three', 'brator-core' ),
				),
				'default' => 'style_1',
			)
		);
		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Featured Brands', 'brator-core' ),
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
				'default' => 'left',
				'toggle'  => true,
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'See All Brands', 'brator-core' ),
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
					'is_external' => false,
					'nofollow'    => false,
				),

			)
		);

		$repeater = new Repeater();

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
			'item_url',
			array(
				'label'         => esc_html__( 'URL', 'brator-core' ),
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
				'name'     => 'title_typography',
				'label'    => __( 'Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header h2',
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
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$heading             = $settings['heading'];
		$layout_style        = $settings['layout_style'];
		$button_text         = $settings['button_text'];
		$button_url          = $settings['button_url']['url'];
		$button_url_external = $settings['button_url']['is_external'] ? 'target="_blank"' : '';
		$button_url_nofollow = $settings['button_url']['nofollow'] ? 'rel="nofollow"' : '';

		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
			<div class="brator-brand-slider design-one gray-img">
				<div class="container-lg-c container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header" style="justify-content:<?php echo $settings['heading_text_align']; ?>">
								<h2><?php echo $heading; ?></h2>
							</div>
							<div class="brator-brand design-one splide js-splide p-splide" data-splide="{&quot;autoplay&quot;:true, &quot;pagination&quot;:false,&quot;type&quot;:&quot;loop&quot;,&quot;perPage&quot;:6,&quot;perMove&quot;:&quot;1&quot;,&quot;gap&quot;:90, &quot;breakpoints&quot;:{ &quot;525&quot; :{ &quot;perPage&quot;: &quot;2&quot; },&quot;767&quot; :{ &quot;perPage&quot;: &quot;3&quot; }, &quot;991&quot; :{ &quot;perPage&quot; : &quot;4&quot; }, &quot;1090&quot;:{ &quot;perPage&quot; : &quot;6&quot; }, &quot;1366&quot;:{ &quot;perPage&quot; : &quot;6&quot; }, &quot;1500&quot;:{ &quot;perPage&quot; : &quot;6&quot; }, &quot;1920&quot;:{ &quot;perPage&quot; : &quot;6&quot; }}}">
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
											$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
											$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
											$item_url          = $item['item_url']['url'];
											$item_url_external = $item['item_url']['is_external'] ? 'target="_blank"' : '';
											$item_url_nofollow = $item['item_url']['nofollow'] ? 'rel="nofollow"' : '';
											?>
											<div class="brator-brand-img splide__slide">
												<a href="<?php echo esc_url( $item_url ); ?>" <?php echo $item_url_external; ?> <?php echo $item_url_nofollow; ?>>
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
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="brator-brand-item-area design-two">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header" style="justify-content:<?php echo $settings['heading_text_align']; ?>">
								<div class="brator-section-header-title">
									<h2><?php echo $heading; ?></h2>
								</div>
								<?php if ( ! empty( $button_url ) ) { ?>
									<a href="<?php echo esc_url( $button_url ); ?>" <?php echo $button_url_external; ?> <?php echo $button_url_nofollow; ?>><?php echo $button_text; ?>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
										</svg>
									</a>
								<?php } ?>
							</div>
						</div>
						<?php
						foreach ( $settings['items'] as $item ) {
							$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
							$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
							$item_url          = $item['item_url']['url'];
							$item_url_external = $item['item_url']['is_external'] ? 'target="_blank"' : '';
							$item_url_nofollow = $item['item_url']['nofollow'] ? 'rel="nofollow"' : '';
							?>
							<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
								<div class="brator-brand-img">
									<a href="<?php echo esc_url( $item_url ); ?>" <?php echo $item_url_external; ?> <?php echo $item_url_nofollow; ?>>
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
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_3' ) { ?>
			<section class="braton-sponser-area">
				<div class="container container-xxl container-xxxl">
					<div class="row">
						<div class="col-lg-12">
							<div class="brator-section-header" style="justify-content:<?php echo $settings['heading_text_align']; ?>">
								<div class="brator-section-header-title">
									<h2><?php echo $heading; ?></h2>
								</div>
								<?php if ( ! empty( $button_url ) ) { ?>
									<a href="<?php echo esc_url( $button_url ); ?>" <?php echo $button_url_external; ?> <?php echo $button_url_nofollow; ?>><?php echo $button_text; ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
										</svg>
									</a>
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row sponser-row">
								<?php
								foreach ( $settings['items'] as $item ) {
									$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
									$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
									$item_url          = $item['item_url']['url'];
									$item_url_external = $item['item_url']['is_external'] ? 'target="_blank"' : '';
									$item_url_nofollow = $item['item_url']['nofollow'] ? 'rel="nofollow"' : '';
									?>
									<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
										<div class="brator-brand-img">
											<a href="<?php echo esc_url( $item_url ); ?>" <?php echo $item_url_external; ?> <?php echo $item_url_nofollow; ?>>
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
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
	}
}
