<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Tabs extends Widget_Base {



	public function get_name() {
		return 'brator_tabs';
	}

	public function get_title() {
		return esc_html__( 'Brator Tabs', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', 'brator-core' ),
			)
		);
		$this->add_control(
			'tab_text_align',
			array(
				'label'   => __( 'Tab Alignment', 'brator-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'   => array(
						'title' => __( 'Left', 'brator-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'brator-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'brator-core' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default' => 'center',
				'toggle'  => true,
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'tab_title',
			array(
				'label'   => esc_html__( 'Tab Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Featured Makes', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'tab_content',
			array(
				'label'   => esc_html__( 'Tab Content', 'brator-core' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => brator_core_elementor_library(),
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
				'name'     => 'tab_title_typography',
				'label'    => __( 'Tab Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-makes-list-area.design-two .brator-makes-list-tab-header ul li a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'items_name_typography',
				'label'    => __( 'Item Name', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-makes-list-single a',
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
			'tab_title_color',
			array(
				'label'     => __( 'Tab Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-makes-list-area.design-two .brator-makes-list-tab-header ul li a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'iteam_name_color',
			array(
				'label'     => __( 'Item Name Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-makes-list-single a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$tab_text_align = $settings['tab_text_align'];
		if ( $tab_text_align == 'left' ) {
			$class = 'brator-makes-list-align-left';
		} else {
			$class = '';
		}
		?>
		<div class="brator-makes-list-area design-two <?php echo $class; ?>">
			<div class="container-xxxl container-xxl container">
				<div class="brator-brator-makes-list-tab-list js-tabs" id="tabs-product-content">
					<div class="brator-makes-list-tab-header js-tabs__header">
						<ul style="justify-content:<?php echo $tab_text_align; ?>">
							<?php
							$i = 0;
							foreach ( $settings['items'] as $item ) {
								$tab_title = $item['tab_title'];
								$i++;
								if ( $i == 1 ) {
									$active = 'js-tabs__title-active';
								} else {
									$active = '';
								}
								?>
								<li><a class="js-tabs__title" href="#"><?php echo $tab_title; ?></a></li>
							<?php } ?>
						</ul>
					</div>
					<?php
					foreach ( $settings['items'] as $item ) {
						$tab_content            = $item['tab_content'];
						$brator_pluginElementor = \Elementor\Plugin::instance();
						?>
						<div class="row js-tabs__content">
							<?php
							echo $brator_pluginElementor->frontend->get_builder_content( $tab_content );
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
}
