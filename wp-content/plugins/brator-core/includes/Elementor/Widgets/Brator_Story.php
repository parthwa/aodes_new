<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Story extends Widget_Base {


	public function get_name() {
		return 'brator_story';
	}

	public function get_title() {
		return esc_html__( 'Brator Story', 'brator-core' );
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
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Our Story', 'brator-core' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'brator-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Default description', 'brator-core' ),
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
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Stock Keeping Unitson Worldwide', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_count_number',
			array(
				'label'   => esc_html__( 'Count Number', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '1.7', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_count_symble',
			array(
				'label'   => esc_html__( 'Count Symbol', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'M+', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
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
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-our-story-area .brator-our-story h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-our-story-area .brator-our-story-type-single .brator-our-story-content .brator-our-story-count-text p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'count_number_typography',
				'label'    => __( 'Count Number', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-our-story-count p span',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'count_symbol_typography',
				'label'    => __( 'Count Symbol', 'brator-core' ),
				'selector' => '{{WRAPPER}} b, strong',
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
					'{{WRAPPER}} .brator-our-story-area .brator-our-story h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-our-story-area .brator-our-story-type-single .brator-our-story-content .brator-our-story-count-text p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'count_number_color',
			array(
				'label'     => __( 'Count Number Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-our-story-area .brator-our-story-type-single .brator-our-story-content .brator-our-story-count p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'count_symbol_color',
			array(
				'label'     => __( 'Count Symbol Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} b, strong' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$heading     = $settings['heading'];
		$description = $settings['description'];
		?>
		<div class="brator-our-story-area">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
						<div class="brator-our-story">
							<h2><?php echo $heading; ?></h2>
						</div>
					</div>
					<div class="col-md-12 col-xl-6">
						<div class="brator-our-story">
							<?php echo $description; ?>
						</div>
					</div>
					<div class="col-md-12 col-xl-6">
						<div class="brator-our-story-type">
							<?php
							foreach ( $settings['items'] as $item ) {
								$item_title        = $item['item_title'];
								$item_count_number = $item['item_count_number'];
								$item_count_symble = $item['item_count_symble'];
								$item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
								$item_image_alt    = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
								?>
								<div class="brator-our-story-type-single">
									<div class="brator-our-story-icon">
										<?php
										if ( wp_http_validate_url( $item_image ) ) {
											?>
											<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
											<?php
										} else {
											echo $item_image;
										}
										?>
									</div>
									<div class="brator-our-story-content">
										<div class="brator-our-story-count">
											<p> <span><?php echo $item_count_number; ?></span><strong><?php echo $item_count_symble; ?></strong></p>
										</div>
										<div class="brator-our-story-count-text">
											<p><?php echo $item_title; ?></p>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="brator-plan-pixel-area">
			<div class="container-xxxl container-xxl container">
				<div class="col-12">
					<div class="plan-pixel-area"></div>
				</div>
			</div>
		</div>
		<?php
	}
}
