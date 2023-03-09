<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Footer_Links extends Widget_Base {

	public function get_name() {
		return 'brator_footer_links';
	}

	public function get_title() {
		return esc_html__( 'Brator Footer Links', 'brator-core' );
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
				'default' => __( 'Brator’s Catalog', 'brator-core' ),
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
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Auto Parts', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_link',
			array(
				'label'         => esc_html__( 'Link', 'brator-core' ),
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
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-top-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .brator-footer-top-element .brator-link-list-one a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = $settings['title'];
		?> 
		<div class="brator-footer-top-element">
			<h6 class="footer-top-title"><?php echo $title; ?></h6>
			<div class="brator-footer-top-content brator-link-list-one">
				<ul>
					<?php
						foreach ( $settings['items'] as $item ) {
							$item_title         = $item['item_title'];
							$item_link          = $item['item_link']['url'];
							$item_link_external = $item['item_link']['is_external'] ? 'target="_blank"' : '';
							$item_link_nofollow = $item['item_link']['nofollow'] ? 'rel="nofollow"' : '';
							?>
							<li><a href="<?php echo esc_url( $item_link ); ?>" <?php echo $item_link_external; ?>  <?php echo $item_link_nofollow; ?>><?php echo $item_title; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php
	}
}
