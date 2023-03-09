<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class Brator_Footer_About_Two extends Widget_Base {

	public function get_name() {
		return 'brator_footer_about_two';
	}

	public function get_title() {
		return esc_html__( 'Brator Footer About Two', 'brator-core' );
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
				'default' => esc_html__( 'Contact Us', 'brator-core' ),
			)
		);
		$this->add_control(
			'about_text',
			array(
				'label'       => esc_html__( 'About Text', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),
			)
		);
		$this->add_control(
			'badge_image',
			array(
				'label'   => esc_html__( 'Badge Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
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
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'plugin-name' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-top-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'plugin-name' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-footer-top-content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .brator-footer-top-address .brator-footer-top-content .e-mail-to' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'phone_color',
			[
				'label' => esc_html__( 'Phone Color', 'plugin-name' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-address .brator-footer-top-content .call-top-p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

	}
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$badge_image = ( $settings['badge_image']['id'] != '' ) ? wp_get_attachment_image( $settings['badge_image']['id'], '', 'full', array( 'class' => 'title-img' ) ) : $settings['badge_image']['url'];
		$badge_alt   = get_post_meta( $settings['badge_image']['id'], '_wp_attachment_image_alt', true );
		$title       = $settings['title'];
		$about_text  = $settings['about_text'];
		?>
			<div class="brator-footer-top-element brator-footer-top-address">
			  <h6 class="footer-top-title"><?php echo $title; ?></h6>
			  <div class="brator-footer-top-content">
				<?php echo $about_text; ?>
				<?php if ( $badge_image ) { ?>
					<?php
					if ( wp_http_validate_url( $badge_image ) ) {
						?>
					<img class="title-img" src="<?php echo esc_url( $badge_image ); ?>" alt="<?php esc_url( $badge_alt ); ?>">
						<?php
					} else {
						echo $badge_image;
					}
					?>
			<?php } ?>
			  </div>
			</div>
		<?php
	}
}
