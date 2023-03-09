<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Banner extends Widget_Base {


	public function get_name() {
		return 'brator_banner';
	}

	public function get_title() {
		return esc_html__( 'Brator Banner', 'brator-core' );
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
			'subtitle',
			array(
				'label'   => esc_html__( 'Subtitle', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '#1 Online Marketplace', 'brator-core' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Car Spares OEM & Atermarkets', 'brator-core' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image', 'brator-core' ),
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
				'name'      => 'subtitle_typography',
				'label'     => __( 'Subtitle', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-main-banner-content p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'label'     => __( 'Title', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-main-banner-content h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'search_title_typography',
				'label'     => __( 'Search Form Title', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-parts-search-box-area.search-box-with-banner.design-two .brator-parts-search-box-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'search_subtitle_typography',
				'label'     => __( 'Search Form Subtitle', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-parts-search-box-area.search-box-with-banner.design-two .brator-parts-search-box-header p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'search_button_title_typography',
				'label'     => __( 'Search Button Title', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button',
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
			'subtitle_color',
			array(
				'label'     => __( 'Subtitle Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-main-banner-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-main-banner-content h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_title_color',
			array(
				'label'     => __( 'Search Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.search-box-with-banner.design-two .brator-parts-search-box-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_subtitle_color',
			array(
				'label'     => __( 'Search Sub Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.search-box-with-banner.design-two .brator-parts-search-box-header p' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_bg_color',
			array(
				'label'     => __( 'Search Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_border_color',
			array(
				'label'     => __( 'Search Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();

		// Hover Color
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'brator-core' ),
			)
		);
		$this->add_control(
			'search_button_title_hover_color',
			array(
				'label'     => __( 'Search Button Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_button_bg_hover_color',
			array(
				'label'     => __( 'Search Button BG Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-form button:hover' => 'background-color: {{VALUE}}',
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
	}
	protected function render() {
		$settings              = $this->get_settings_for_display();
		$subtitle              = $settings['subtitle'];
		$title                 = $settings['title'];
		$image_url             = ( $settings['image']['id'] != '' ) ? wp_get_attachment_image_url( $settings['image']['id'], 'full' ) : $settings['image']['url'];
		$search_form_title     = $settings['search_form_title'];
		$search_form_subtitle  = $settings['search_form_subtitle'];
		$search_form_shortcode = $settings['search_form_shortcode'];
		?>
		<div class="brator-main-banner-area banner-style-two" style="background-image:url(<?php echo $image_url; ?>)">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
						<div class="brator-main-banner-content">
							<p><?php echo $subtitle; ?></p>
							<h2><?php echo $title; ?></h2>
						</div>
						<!-- Search by Vehicle -->
						<div class="brator-parts-search-box-area search-box-with-banner design-two">
							<div class="brator-parts-search-box-header">
								<h2><?php echo $search_form_title; ?></h2>
								<p><?php echo $search_form_subtitle; ?></p>
							</div>
							<?php echo do_shortcode( $search_form_shortcode ); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
