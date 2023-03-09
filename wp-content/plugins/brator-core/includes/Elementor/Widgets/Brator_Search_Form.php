<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Search_Form extends Widget_Base {


	public function get_name() {
		return 'brator_search_form';
	}

	public function get_title() {
		return esc_html__( 'Brator Search Form', 'brator-core' );
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
				'name'      => 'search_title_typography',
				'label'     => __( 'Search Form Title', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'search_subtitle_typography',
				'label'     => __( 'Search Form Subtitle', 'brator-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-header p',
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
			'search_title_color',
			array(
				'label'     => __( 'Search Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_subtitle_color',
			array(
				'label'     => __( 'Search Sub Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-parts-search-box-area.design-two .brator-parts-search-box-header p' => 'color: {{VALUE}}',
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
		$layout_style          = $settings['layout_style'];
		$search_form_title     = $settings['search_form_title'];
		$search_form_subtitle  = $settings['search_form_subtitle'];
		$search_form_shortcode = $settings['search_form_shortcode'];
		if ( $layout_style == 'style_1' ) {
			$class_style = 'design-one';
		} elseif ( $layout_style == 'style_2' ) {
			$class_style = 'design-two';
		}
		?>
		<div class="brator-parts-search-box-area <?php echo $class_style; ?>">
			<div class="brator-parts-search-box-header">
				<h2><?php echo $search_form_title; ?></h2>
				<p><?php echo $search_form_subtitle; ?></p>
			</div>
			<?php echo do_shortcode( $search_form_shortcode ); ?>
		</div>
		<?php
	}
}
