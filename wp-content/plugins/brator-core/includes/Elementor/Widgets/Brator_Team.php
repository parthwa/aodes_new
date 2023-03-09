<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Team extends Widget_Base {



	public function get_name() {
		return 'brator_team';
	}

	public function get_title() {
		return esc_html__( 'Brator Team', 'brator-core' );
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
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Our Leadership', 'brator-core' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'See All Member', 'brator-core' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', 'brator-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Name', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Bobby Mathew', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_designation',
			array(
				'label'   => esc_html__( 'Designation', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'CEO founder', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_desc',
			array(
				'label'       => esc_html__( 'Desc', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Angel Investor of Envato, Top 5 Fobes Businessman 2005', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$repeater->add_control(
			'item_author',
			array(
				'label'   => esc_html__( 'Author', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$repeater->add_control(
			'item_twitter_url',
			array(
				'label'         => esc_html__( 'Twitter URL', 'brator-core' ),
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
			'item_linkedin_url',
			array(
				'label'         => esc_html__( 'Linkedin URl', 'brator-core' ),
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
			'item_instagram_url',
			array(
				'label'         => esc_html__( 'Instagram URL', 'brator-core' ),
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
			'item_youtube_url',
			array(
				'label'         => esc_html__( 'Youtube URL', 'brator-core' ),
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
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_text_typography',
				'label'    => __( 'Button Text', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __( 'Name', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-team-single-item .brator-team-single-item-title h4',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-team-single-item .brator-team-single-item-content p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => __( 'Designation', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-team-single-item .brator-team-single-item-position h6',
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
			'button_text_color',
			array(
				'label'     => __( 'Button Text Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Name Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-team-single-item .brator-team-single-item-title h4' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-team-single-item .brator-team-single-item-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'designation_color',
			array(
				'label'     => __( 'Designation Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-team-single-item .brator-team-single-item-position h6' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings            = $this->get_settings_for_display();
		$heading             = $settings['heading'];
		$button_text         = $settings['button_text'];
		$button_url          = $settings['button_url']['url'];
		$button_url_external = $settings['button_url']['is_external'] ? 'target="_blank"' : '';
		$button_url_nofollow = $settings['button_url']['nofollow'] ? 'rel="nofollow"' : '';
		?>
		<div class="brator-team-slider-area">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
						<div class="brator-section-header all-item-left">
							<div class="brator-section-header-title">
								<h2><?php echo $heading; ?></h2>
							</div><a href="<?php echo esc_url( $button_url ); ?>" <?php echo $button_url_external; ?> <?php echo $button_url_nofollow; ?>><?php echo $button_text; ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
								</svg></a>
						</div>
						<div class="brator-team-slider splide js-splide" data-splide="{&quot;pagination&quot;:false,&quot;type&quot;:&quot;loop&quot;,&quot;perPage&quot;:5,&quot;perMove&quot;:&quot;1&quot;,&quot;gap&quot;:30, &quot;breakpoints&quot;:{ &quot;500&quot; :{ &quot;perPage&quot;: &quot;1&quot; },&quot;746&quot; :{ &quot;perPage&quot;: &quot;2&quot; }, &quot;991&quot; :{ &quot;perPage&quot; : &quot;2&quot; }, &quot;1199&quot;:{ &quot;perPage&quot; : &quot;3&quot; }, &quot;1366&quot;:{ &quot;perPage&quot; : &quot;4&quot; }, &quot;1500&quot;:{ &quot;perPage&quot; : &quot;4&quot; }, &quot;1920&quot;:{ &quot;perPage&quot; : &quot;5&quot; }}}">
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
										$item_title                  = $item['item_title'];
										$item_designation            = $item['item_designation'];
										$item_desc                   = $item['item_desc'];
										$item_author                 = ( $item['item_author']['id'] != '' ) ? wp_get_attachment_image( $item['item_author']['id'], 'full' ) : $item['item_author']['url'];
										$item_author_alt             = get_post_meta( $item['item_author']['id'], '_wp_attachment_image_alt', true );
										$item_twitter_url            = $item['item_twitter_url']['url'];
										$item_twitter_url_external   = $item['item_twitter_url']['is_external'] ? 'target="_blank"' : '';
										$item_twitter_url_nofollow   = $item['item_twitter_url']['nofollow'] ? 'rel="nofollow"' : '';
										$item_linkedin_url           = $item['item_linkedin_url']['url'];
										$item_linkedin_url_external  = $item['item_linkedin_url']['is_external'] ? 'target="_blank"' : '';
										$item_linkedin_url_nofollow  = $item['item_linkedin_url']['nofollow'] ? 'rel="nofollow"' : '';
										$item_instagram_url          = $item['item_instagram_url']['url'];
										$item_instagram_url_external = $item['item_instagram_url']['is_external'] ? 'target="_blank"' : '';
										$item_instagram_url_nofollow = $item['item_instagram_url']['nofollow'] ? 'rel="nofollow"' : '';
										$item_youtube_url            = $item['item_youtube_url']['url'];
										$item_youtube_url_external   = $item['item_youtube_url']['is_external'] ? 'target="_blank"' : '';
										$item_youtube_url_nofollow   = $item['item_youtube_url']['nofollow'] ? 'rel="nofollow"' : '';
										?>
										<div class="brator-team-single-item design-one splide__slide">
											<div class="brator-team-single-item-img">
												<?php
												if ( wp_http_validate_url( $item_author ) ) {
													?>
													<img src="<?php echo esc_url( $item_author ); ?>" alt="<?php esc_url( $item_author_alt ); ?>">
													<?php
												} else {
													echo $item_author;
												}
												?>
											</div>
											<div class="brator-team-single-item-position">
												<h6><?php echo $item_designation; ?></h6>
											</div>
											<div class="brator-team-single-item-title">
												<h4><?php echo $item_title; ?></h4>
											</div>
											<div class="brator-team-single-item-content">
												<p><?php echo $item_desc; ?></p>
											</div>
											<div class="brator-team-single-item-social">
												<a href="<?php echo esc_url( $item_twitter_url ); ?>" <?php echo $item_twitter_url_external; ?> <?php echo $item_twitter_url_nofollow; ?>>
													<svg class="bi bi-twitter" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
														<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
													</svg></a>
												<a href="<?php echo esc_url( $item_linkedin_url ); ?>" <?php echo $item_linkedin_url_external; ?> <?php echo $item_linkedin_url_nofollow; ?>>
													<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve">
														<g>
															<g></g>
															<path d="M14.6,63H5.7C2.6,63,0,60.5,0,57.5V28c0-3.1,2.5-5.5,5.7-5.5h8.9c3.1,0,5.7,2.5,5.7,5.5v29.5C20.4,60.5,17.8,63,14.6,63z                                                    M5.7,27.4c-0.3,0-0.6,0.1-0.6,0.4v29.5c0,0.1,0.1,0.4,0.6,0.4h8.9c0.3,0,0.6-0.1,0.6-0.4V28c0-0.1-0.3-0.4-0.6-0.4H5.7V27.4z"></path>
															<g></g>
															<path d="M58.8,63h-9c-3.1,0-5.7-2.5-5.7-5.5V45.3c0-0.6-0.4-1-1.2-1c-0.6,0-1.2,0.4-1.2,1v12.1c0,3.1-2.5,5.5-5.7,5.5h-8.9                                                    c-3.1,0-5.7-2.5-5.7-5.5V28c0-3.1,2.5-5.5,5.7-5.5H36c1.9,0,3.5,0.9,4.5,2.3c0.4-0.1,0.9-0.4,1.2-0.6c3.1-1.5,6.6-1.9,9.8-1.5l0,0                                                    c7,0.9,12.4,6.7,12.5,13.7v21.3C64.3,60.5,61.8,63,58.8,63z M43,39.4c3.4,0,6.1,2.8,6.1,6v12.1c0,0.1,0.1,0.4,0.6,0.4h8.9                                                    c0.3,0,0.6-0.1,0.6-0.4V36.3c-0.1-4.4-3.6-8.2-8.2-8.6c-2.3-0.3-5,0.1-7.3,1.2c-1.2,0.4-2.2,1.2-3.2,1.8l-3.9,2.8V28                                                    c0-0.1-0.1-0.4-0.6-0.4h-8.9c-0.3,0-0.6,0.1-0.6,0.4v29.5c0,0.1,0.1,0.4,0.6,0.4h9c0.3,0,0.6-0.1,0.6-0.4V45.3                                                    C36.9,42,39.5,39.4,43,39.4z"></path>
															<g></g>
															<path d="M10.8,21.9c-5.8,0-10.6-4.7-10.6-10.5S4.8,1,10.8,1s10.6,4.7,10.6,10.5S16.6,21.9,10.8,21.9z M10.8,6.1                                                    c-3.1,0-5.7,2.5-5.7,5.4c0,3.1,2.5,5.4,5.7,5.4s5.7-2.5,5.7-5.4C16.5,8.4,14,6.1,10.8,6.1z"></path>
														</g>
													</svg></a>
												<a href="<?php echo esc_url( $item_instagram_url ); ?>" <?php echo $item_instagram_url_external; ?> <?php echo $item_instagram_url_nofollow; ?>>
													<svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
														<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
													</svg></a>
												<a href="<?php echo esc_url( $item_youtube_url ); ?>" <?php echo $item_youtube_url_external; ?> <?php echo $item_youtube_url_nofollow; ?>>
													<svg class="bi bi-youtube" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
														<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"></path>
													</svg></a>
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
		<?php
	}
}
