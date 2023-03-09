<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Footer_Newsletter extends Widget_Base {


	public function get_name() {
		return 'brator_footer_newsletter';
	}

	public function get_title() {
		return esc_html__( 'Brator Footer Newsletter', 'brator-core' );
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
				'label'       => esc_html__( 'Desc', 'brator-core' ),
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
				'label'   => esc_html__( 'Form Desc', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'By subscribing, you accepted the our<a href="#_">Policy</a>', 'brator-core' ),
			)
		);

		$this->end_controls_section();

				
		$this->start_controls_section(
			'style',
			array(
				'label' => esc_html__( 'style', 'brator-core' ),
			)
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-footer-top-content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .brator-footer-top-element .brator-footer-top-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-top-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Button Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-sub-form button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_color_bg',
			[
				'label' => esc_html__( 'Button Bg Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-sub-form button' => 'background-color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'btn_color_border',
			[
				'label' => esc_html__( 'Button Border Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-sub-form button' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'input_field_border',
			[
				'label' => esc_html__( 'Input border Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-sub-form input[name="your-email"]' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'input_field_bg',
			[
				'label' => esc_html__( 'Input Bg Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-sub-form input[name="your-email"]' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		
	}
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$title          = $settings['title'];
		$desc           = $settings['desc'];
		$form_shortcode = $settings['form_shortcode'];
		$form_desc      = $settings['form_desc'];
		?>
		<div class="brator-footer-top-element">
			<h6 class="footer-top-title"><?php echo $title; ?></h6>
			<div class="brator-footer-top-content">
			<p><?php echo $desc; ?></p>
			<div class="brator-sub-form">
				<div class="news-letter-form">
				<?php echo do_shortcode( $form_shortcode ); ?>
				</div>
			</div>
			<p><?php echo $form_desc; ?></p>
			</div>
		</div>
		<?php
	}
}
