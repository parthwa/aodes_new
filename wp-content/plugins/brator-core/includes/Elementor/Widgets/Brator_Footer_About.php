<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class Brator_Footer_About extends Widget_Base {

	public function get_name() {
		return 'brator_footer_about';
	}

	public function get_title() {
		return esc_html__( 'Brator Footer About', 'brator-core' );
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
			'logo',
			array(
				'label'   => esc_html__( 'Logo', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$this->add_control(
			'about_subtitle',
			array(
				'label'   => esc_html__( 'About Subtitle', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( "#1 US's biggest online marketplace for car spare OEM & Aftermarkets.", 'brator-core' ),
			)
		);
		$this->add_control(
			'about_text',
			array(
				'label'       => esc_html__( 'About Text', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor in cididunt ut labore dolore magna aliqua enim ad minim venitam', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),
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
			'item_social_icon',
			array(
				'label' => esc_html__( 'Social Icon', 'brator-core' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'item_social_link',
			array(
				'label'         => esc_html__( 'Social Link', 'brator-core' ),
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

	}
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$logo           = ( $settings['logo']['id'] != '' ) ? wp_get_attachment_image( $settings['logo']['id'], '', 'full', array( 'class' => 'title-img' ) ) : $settings['logo']['url'];
		$logo_alt       = get_post_meta( $settings['logo']['id'], '_wp_attachment_image_alt', true );
		$about_subtitle = $settings['about_subtitle'];
		$about_text     = $settings['about_text'];
		?>
		<div class="brator-footer-top-element brator-footer-top-address">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( $logo ) { ?>
				<?php
				if ( wp_http_validate_url( $logo ) ) {
					?>
					<img class="title-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_url( $logo_alt ); ?>">
					<?php
				} else {
					echo $logo;
				}
				?>
			<?php } else { ?>
				<img class="title-img" src="<?php echo BRATOR_IMG_URL . 'logo.svg'; ?>" alt="<?php esc_attr_e( 'Footer Logo', 'brator-core' ); ?>">
			<?php } ?>
			</a>
			<div class="brator-footer-top-content">
				<h6><?php echo $about_subtitle; ?></h6>
				<p><?php echo $about_text; ?></p>
				<div class="brator-social-link svg-link">
				<?php
				foreach ( $settings['items'] as $item ) {
					$item_social_icon          = $item['item_social_icon'];
					$item_social_link          = $item['item_social_link']['url'];
					$item_social_link_external = $item['item_social_link']['is_external'] ? 'target="_blank"' : '';
					$item_social_link_nofollow = $item['item_social_link']['nofollow'] ? 'rel="nofollow"' : '';
					?>
					<a href="<?php echo esc_url( $item_social_link ); ?>" <?php echo $item_social_link_external; ?> <?php echo $item_social_link_nofollow; ?>>
					<?php Icons_Manager::render_icon( ( $item_social_icon ), array( 'aria-hidden' => 'true' ) ); ?>
					</a>
					<?php } ?> 
				</div>
			</div>
		</div>
		<?php
	}
}
