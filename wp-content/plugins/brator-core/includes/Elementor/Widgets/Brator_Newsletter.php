<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;


class Brator_Newsletter extends Widget_Base {



	public function get_name() {
		return 'brator_newsletter';
	}

	public function get_title() {
		return esc_html__( 'Brator Newsletter', 'brator-core' );
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
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Subscribe To Our Newsletter', 'brator-core' ),
			)
		);

		$this->add_control(
			'desc',
			array(
				'label'       => esc_html__( 'Description', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Register now to get latest updates on promotions & coupons. Don’t worry, we not spam!', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$this->add_control(
			'form_shortcode',
			array(
				'label' => esc_html__( 'Form Shortcode', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'form_desc',
			array(
				'label'   => esc_html__( 'Form Description', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'By subscribing, you accepted the our<a href="#_">Policy</a>', 'brator-core' ),
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
				'selector' => '{{WRAPPER}} .brator-newsletter-content h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-newsletter-content p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'from_description_typography',
				'label'    => __( 'Form Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-newsletter-form.design-one p',
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
					'{{WRAPPER}}  .brator-newsletter-content h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'form_description_color',
			array(
				'label'     => __( 'Form Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one p' => 'color: {{VALUE}}',
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
			'button_title_color',
			array(
				'label'     => __( 'Button Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one .news-letter-form button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_bg_color',
			array(
				'label'     => __( 'Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one .news-letter-form button' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one .news-letter-form button' => 'border-color: {{VALUE}}',
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
			'button_title_hover_color',
			array(
				'label'     => __( 'Button Title Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one .news-letter-form button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_bg_hover_color',
			array(
				'label'     => __( 'Button BG Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one .news-letter-form button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => __( 'Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-newsletter-form.design-one .news-letter-form button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$layout_style   = $settings['layout_style'];
		$title          = $settings['title'];
		$desc           = $settings['desc'];
		$form_shortcode = $settings['form_shortcode'];
		$form_desc      = $settings['form_desc'];
		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
			<div class="brator-newsletter-area design-one gray-bg border-top-1px-dark-shallow">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-lg-5">
							<div class="brator-newsletter-content">
								<h2><?php echo $title; ?></h2>
								<p><?php echo $desc; ?></p>
							</div>
						</div>
						<div class="col-lg-1"></div>
						<div class="col-lg-6">
							<div class="brator-newsletter-form design-one">
								<div class="news-letter-form">
									<?php echo do_shortcode( $form_shortcode ); ?>
								</div>
								<p><?php echo $form_desc; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="brator-plan-pixel-area">
				<div class="row">
					<div class="container-lg-c container">
						<div class="col-12">
							<div class="plan-pixel-area"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="brator-newsletter-area design-one border-top-1px-dark-shallow">
				<div class="container-lg-c container">
					<div class="row">
						<div class="col-lg-5">
							<div class="brator-newsletter-content">
								<h2><?php echo $title; ?></h2>
								<p><?php echo $desc; ?></p>
							</div>
						</div>
						<div class="col-lg-1"></div>
						<div class="col-lg-6">
							<div class="brator-newsletter-form design-one">
								<div class="news-letter-form">
									<?php echo do_shortcode( $form_shortcode ); ?>
								</div>
								<p><?php echo $form_desc; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
