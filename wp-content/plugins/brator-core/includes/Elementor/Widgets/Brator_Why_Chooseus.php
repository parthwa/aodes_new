<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

class Brator_Why_Chooseus extends Widget_Base {


	public function get_name() {
		return 'brator_why_chooseus';
	}

	public function get_title() {
		return esc_html__( 'Brator Why Chooseus', 'brator-core' );
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
				'label' => esc_html__( 'General', 'brator-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Why Customers Choose Brator', 'brator-core' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'Item', 'brator-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Affordable Prices &Promotions', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_description',
			array(
				'label'       => esc_html__( 'Description', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'We aim to provide the highest quality products at the lowest prices possibleand much prmotions', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$repeater->add_control(
			'item_icon',
			array(
				'label' => esc_html__( 'Icon', 'brator-core' ),
				'type'  => Controls_Manager::ICONS,
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
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-features-area.design-two a.brator-features-single h5',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-features-area.design-two a.brator-features-single p',
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
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-features-area.design-two a.brator-features-single h5' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-features-area.design-two a.brator-features-single p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$heading  = $settings['heading'];
		?>
		<div class="brator-features-area design-two">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
						<div class="brator-section-header">
							<h2><?php echo $heading; ?></h2>
						</div>
					</div>
					<?php
					foreach ( $settings['items'] as $item ) {
						$item_title       = $item['item_title'];
						$item_description = $item['item_description'];
						$item_icon        = $item['item_icon'];
						?>
						<div class="col-xl-3 col-lg-6">
							<a class="brator-features-single" href="#_">
								<div class="brator-features-single-img">
									<?php Icons_Manager::render_icon( ( $item_icon ), array( 'aria-hidden' => 'true' ) ); ?>
								</div>
								<h5><?php echo $item_title; ?></h5>
								<p><?php echo $item_description; ?></p>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
}
