<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_App_Banner extends Widget_Base {

	public function get_name() {
		return 'brator_app_banner';
	}

	public function get_title() {
		return esc_html__( 'Brator App Banner', 'brator-core' );
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
			'bg_image',
			array(
				'label'   => esc_html__( 'BG Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Shopping Faster with<br/>Brator App', 'brator-core' ),
			)
		);

		$this->add_control(
			'desc',
			array(
				'label'   => esc_html__( 'Desc', 'brator-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Download and experience our app today', 'brator-core' ),
			)
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'item_icon_img',
			array(
				'label'   => esc_html__( 'Icon Image', 'brator-core' ),
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
				'selector' => '{{WRAPPER}} .brator-app-content-area .brator-app-content h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-app-content p',
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
					'{{WRAPPER}} .brator-app-content-area .brator-app-content h2' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-app-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$bg_image = ( $settings['bg_image']['id'] != '' ) ? wp_get_attachment_image_url( $settings['bg_image']['id'], 'full' ) : $settings['bg_image']['url'];
		$title    = $settings['title'];
		$desc     = $settings['desc'];
		?>
		<div class="brator-app-content-area lazyload" data-bg="<?php echo esc_url( $bg_image ); ?>">
			<div class="brator-app-content">
				<h2><?php echo $title; ?></h2>
				<p><?php echo $desc; ?></p>
			</div>
			<div class="brator-app-btn">
				<?php
				foreach ( $settings['items'] as $item ) {
					$item_url          = $item['item_url']['url'];
					$item_url_external = $item['item_url']['is_external'] ? 'target="_blank"' : '';
					$item_url_nofollow = $item['item_url']['nofollow'] ? 'rel="nofollow"' : '';
					$item_icon_img     = ( $item['item_icon_img']['id'] != '' ) ? wp_get_attachment_image( $item['item_icon_img']['id'], 'full' ) : $item['item_icon_img']['url'];
					$item_icon_img_alt = get_post_meta( $item['item_icon_img']['id'], '_wp_attachment_image_alt', true );
					?>
					<a href="<?php echo esc_url( $item_url ); ?>" <?php echo $item_url_external; ?> <?php echo $item_url_nofollow; ?>>
						<?php
						if ( wp_http_validate_url( $item_icon_img ) ) {
							?>
							<img src="<?php echo esc_url( $item_icon_img ); ?>" alt="<?php esc_url( $item_icon_img_alt ); ?>">
							<?php
						} else {
							echo $item_icon_img;
						}
						?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
