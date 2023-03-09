<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

class Brator_Contact_US extends Widget_Base {



	public function get_name() {
		return 'brator_contact_us';
	}

	public function get_title() {
		return esc_html__( 'Brator Contact US', 'brator-core' );
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
				'default' => __( 'Contact', 'brator-core' ),
			)
		);
		$this->add_control(
			'desc',
			array(
				'label'       => esc_html__( 'Desc', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Hi, we are always open for cooperation and suggestions, contact us in one of the ways below', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);
		$this->add_control(
			'contact_title',
			array(
				'label'   => esc_html__( 'Contact Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Drop Us A Line', 'brator-core' ),
			)
		);
		$this->add_control(
			'contact_subtitle',
			array(
				'label'   => esc_html__( 'Contact Subtitle', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Required fields are marked *', 'brator-core' ),
			)
		);
		$this->add_control(
			'form_shortcode',
			array(
				'label' => esc_html__( 'Form Shortcode', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'Contact List', 'brator-core' ),
			)
		);
		$this->add_control(
			'info_title',
			array(
				'label'   => esc_html__( 'Info Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Information', 'brator-core' ),
			)
		);
		$this->add_control(
			'sub_title',
			array(
				'label'   => esc_html__( 'Sub Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Location', 'brator-core' ),
			)
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'store', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),
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
			'socila_items',
			array(
				'label' => esc_html__( 'Social items', 'brator-core' ),
			)
		);
		$this->add_control(
			'social_title',
			array(
				'label'   => esc_html__( 'Social Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Social', 'brator-core' ),
			)
		);
		$repeater2 = new Repeater();
		$repeater2->add_control(
			'item_social_icon',
			array(
				'label' => esc_html__( 'Social Icon', 'brator-core' ),
				'type'  => Controls_Manager::ICONS,
			)
		);
		$repeater2->add_control(
			'item_social_url',
			array(
				'label'         => esc_html__( 'Social URL', 'brator-core' ),
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
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-contact-header-area .contact-header h4',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-contact-header-area .contact-header p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'contact_title_typography',
				'label'    => __( 'Contact Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-contact-form-area .brator-contact-form-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'contact_subtitle_typography',
				'label'    => __( 'Contact Subtitle', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-contact-list-area .brator-contact-list-header h2',
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
					'{{WRAPPER}}  .brator-contact-header-area .contact-header h4' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-header-area .contact-header p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'contact_title_color',
			array(
				'label'     => __( 'Contact Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-area .brator-contact-form-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'contact_subtitle_color',
			array(
				'label'     => __( 'Contact Subtitle Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-list-area .brator-contact-list-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_title_color',
			array(
				'label'     => __( 'Button Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-fields .brator-contact-form-field button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_bg_color',
			array(
				'label'     => __( 'Button BG Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-fields .brator-contact-form-field button' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-fields .brator-contact-form-field button' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_title_hover_color',
			array(
				'label'     => __( 'Button Title Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-fields .brator-contact-form-field button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_bg_hover_color',
			array(
				'label'     => __( 'Button BG Hover Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-fields .brator-contact-form-field button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => __( 'Button Border Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-contact-form-fields .brator-contact-form-field button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render() {
		$settings         = $this->get_settings_for_display();
		$heading          = $settings['heading'];
		$desc             = $settings['desc'];
		$contact_title    = $settings['contact_title'];
		$contact_subtitle = $settings['contact_subtitle'];
		$form_shortcode   = $settings['form_shortcode'];
		$info_title       = $settings['info_title'];
		$sub_title        = $settings['sub_title'];
		$social_title     = $settings['social_title'];
		?>
		<div class="brator-contact-header-area design-one">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
						<div class="contact-header">
							<h4><?php echo $heading; ?></h4>
							<p><?php echo $desc; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="brator-contact-area design-one">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-lg-5 col-12">
						<div class="brator-contact-list-area">
							<div class="brator-contact-list-header">
								<h2><?php echo $info_title; ?></h2>
							</div>
							<div class="brator-contact-sub-header">
								<h3><?php echo $sub_title; ?></h3>
							</div>
							<?php
							foreach ( $settings['items'] as $item ) {
								$item_title   = $item['item_title'];
								$item_content = $item['item_content'];
								?>
								<div class="brator-contact-list-items"><span><?php echo $item_title; ?></span>
									<?php echo $item_content; ?>
								</div>
								<?php
							}
							?>
							<div class="brator-contact-list-social">
								<div class="brator-contact-sub-header">
									<h3><?php echo $social_title; ?></h3>
								</div>
								<div class="brator-contact-list-social-items">
									<?php
									foreach ( $settings['items2'] as $item ) {
										$item_social_icon         = $item['item_social_icon'];
										$item_social_url          = $item['item_social_url']['url'];
										$item_social_url_external = $item['item_social_url']['is_external'] ? 'target="_blank"' : '';
										$item_social_url_nofollow = $item['item_social_url']['nofollow'] ? 'rel="nofollow"' : '';
										?>

										<a href="<?php echo esc_url( $item_social_url ); ?>" <?php echo $item_social_url_external; ?> <?php echo $item_social_url_nofollow; ?>>
											<?php Icons_Manager::render_icon( ( $item_social_icon ), array( 'aria-hidden' => 'true' ) ); ?>
										</a>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-12">
						<div class="brator-contact-form-area">
							<div class="brator-contact-form-header">
								<h2><?php echo $contact_title; ?></h2>
							</div>
							<div class="brator-contact-form"><span class="info-text"><?php echo $contact_subtitle; ?></span></div>
						</div>
						<div class="brator-contact-form-fields">
							<?php echo do_shortcode( $form_shortcode ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
