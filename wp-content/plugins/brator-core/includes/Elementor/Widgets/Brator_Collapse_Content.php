<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Collapse_Content extends Widget_Base {


	public function get_name() {
		return 'brator_collapse_content';
	}

	public function get_title() {
		return esc_html__( 'Brator Collapse Content', 'brator-core' );
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
			'display_content',
			array(
				'label'       => esc_html__( 'Display Content', 'brator-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Default description', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$this->add_control(
			'hidden_content',
			array(
				'label'       => esc_html__( 'Hidden Content', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Default description', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'view more', 'brator-core' ),
			)
		);

		$this->end_controls_section();
	}
	protected function render() {
		$settings        = $this->get_settings_for_display();
		$display_content = $settings['display_content'];
		$hidden_content  = $settings['hidden_content'];
		$button_text     = $settings['button_text'];
		?> 
		<div class="brator-more-text-area design-one">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-lg-12">
						<div class="brator-more-text-content">
							<?php echo $display_content; ?>
							<p class="disable"><?php echo $hidden_content; ?></p>
						</div>
						<div class="brator-more-text-view-more">
							<button> <span><?php echo $button_text; ?></span>
								<svg class="bi bi-chevron-down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path>
								</svg>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div> 
		<?php
	}
}
