<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Feature_Box extends Widget_Base {


	public function get_name() {
		return 'brator_feature_box';
	}

	public function get_title() {
		return esc_html__( 'Brator Feature Box', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Style Layouts', 'brator-core' ),
			)
		);
		$this->add_control(
			'layout_style',
			array(
				'label'   => esc_html__( 'Layout Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style_1' => esc_html__( 'Style One', 'brator-core' ),
					'style_2' => esc_html__( 'Style Two', 'brator-core' ),
				),
				'default' => 'style_1',
			)
		);
		$this->add_control(
			'extra_class',
			array(
				'label' => esc_html__( 'Extra Class', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'features_item',
			array(
				'label' => esc_html__( 'Features Items', 'brator-core' ),
			)
		);
		$repeater2 = new Repeater();
		$repeater2->add_control(
			'item_icon_image',
			array(
				'label'   => esc_html__( 'Icon Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater2->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Original Products', 'brator-core' ),
			)
		);
		$repeater2->add_control(
			'item_content',
			array(
				'label'   => esc_html__( 'Content', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Only parts from trusted brands', 'brator-core' ),
			)
		);
		$repeater2->add_control(
			'item_title_url',
			array(
				'label'         => esc_html__( 'Title URL', 'brator-core' ),
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
			'items2',
			array(
				'label'   => esc_html__( 'Repeater List', 'brator-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater2->get_controls(),
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
				'selector' => '{{WRAPPER}} .brator-service-area .brator-single-service-item h4',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-service-area .brator-single-service-item p',
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
					'{{WRAPPER}} .brator-service-area .brator-single-service-item p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Content Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .banner-section .swiper-slide-active .content-box h1' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$layout_style = $settings['layout_style'];
		$extra_class  = $settings['extra_class'];
		?>
		<?php
		if ( $layout_style == 'style_1' ) {
			?>
			<section class="brator-service-area <?php echo esc_attr( $extra_class ); ?>">
				<div class="container container-xxxl container-xxl">
					<div class="row">
						<?php
						$i = 0;
						foreach ( $settings['items2'] as $item ) {
							$item_icon_image     = ( $item['item_icon_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_icon_image']['id'], 'full' ) : $item['item_slider_image']['url'];
							$item_icon_image_alt = get_post_meta( $item['item_icon_image']['id'], '_wp_attachment_image_alt', true );
							$item_title          = $item['item_title'];
							$item_content        = $item['item_content'];
							$i++;
							if ( $i == 4 ) {
								$class = 'last-item';
							} else {
								$class = '';
							}
							?>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="brator-single-service-item <?php echo $class; ?>">
									<div class="iocn">
										<?php
										if ( wp_http_validate_url( $item_icon_image ) ) {
											?>
											<img src="<?php echo esc_url( $item_icon_image ); ?>" alt="<?php esc_url( $item_icon_image_alt ); ?>">
											<?php
										} else {
											echo $item_icon_image;
										}
										?>
									</div>
									<h4 class="title"><?php echo $item_title; ?></h4>
									<p><?php echo $item_content; ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		<?php } ?>
		<?php
		if ( $layout_style == 'style_2' ) {
			?>
			<section class="brator-service-area style-two <?php echo esc_attr( $extra_class ); ?>">
				<div class="container container-xxxl container-xxl">
					<div class="row">
						<?php
						$i = 0;
						foreach ( $settings['items2'] as $item ) {
							$item_icon_image     = ( $item['item_icon_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_icon_image']['id'], 'full' ) : $item['item_icon_image']['url'];
							$item_icon_image_alt = get_post_meta( $item['item_icon_image']['id'], '_wp_attachment_image_alt', true );
							$item_title          = $item['item_title'];
							$item_content        = $item['item_content'];
							$i++;
							if ( $i == 4 ) {
								$class = 'last-item';
							} else {
								$class = '';
							}
							?>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="brator-single-service-item <?php echo $class; ?>">
									<div class="iocn">
										<?php
										if ( wp_http_validate_url( $item_icon_image ) ) {
											?>
											<img src="<?php echo esc_url( $item_icon_image ); ?>" alt="<?php esc_url( $item_icon_image_alt ); ?>">
											<?php
										} else {
											echo $item_icon_image;
										}
										?>
									</div>
									<h4 class="title"><?php echo $item_title; ?></h4>
									<p><?php echo $item_content; ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		<?php } ?>


		<?php
	}
}
