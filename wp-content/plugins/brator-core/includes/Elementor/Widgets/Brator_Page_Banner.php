<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

class Brator_Page_Banner extends Widget_Base {


	public function get_name() {
		return 'brator_page_banner';
	}

	public function get_title() {
		return esc_html__( 'Brator Page Banner', 'brator-core' );
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
				'default' => __( 'About Brator', 'brator-core' ),
			)
		);

		$this->add_control(
			'desc',
			array(
				'label'       => esc_html__( 'Desc', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'They say money can’t buy happines. But it can buy car parts. And car parts make me happy', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

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
				'selector' => '{{WRAPPER}} .brator-banner-area.design-four .brator-banner-content h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-banner-area.design-four .brator-banner-content p',
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
					'{{WRAPPER}} .brator-banner-area.design-four .brator-banner-content h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-banner-area.design-four .brator-banner-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$title        = $settings['title'];
		$desc         = $settings['desc'];
		$bg_image_url = ( $settings['bg_image']['id'] != '' ) ? wp_get_attachment_image_url( $settings['bg_image']['id'], 'full' ) : $settings['bg_image']['url'];
		?>
		<div class="brator-banner-slider-area">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
						<div class="brator-banner-area design-four">
							<?php if ( isset( $bg_image_url ) && ! empty( $bg_image_url ) ) { ?>
								<picture class="tt-pagetitle__img">
									<img src="<?php echo esc_url( $bg_image_url ); ?>" alt="<?php esc_attr_e( 'Page Title BG', 'plumbio' ); ?>">
								</picture>
							<?php } ?>
							<div class="brator-banner-content">
								<h2><?php echo $title; ?></h2>
								<p><?php echo $desc; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
