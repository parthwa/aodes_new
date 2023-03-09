<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Banner_Slider extends Widget_Base {

	public function get_name() {
		return 'brator_banner_slider';
	}

	public function get_title() {
		return esc_html__( 'Brator Banner Slider', 'brator-core' );
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
				'label' => esc_html__( 'General', 'brator-core' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'item_subtitle',
			array(
				'label'   => esc_html__( 'Tagline', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Season Sale', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_offer_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'GoPro MaxWaterproof 360', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_content',
			array(
				'label'   => esc_html__( 'Content', 'brator-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 6,
				'default' => __( 'Bigest season sale in the year for all products. Limited time offer', 'brator-core' ),
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
		$repeater->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Shop Now', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'button_url',
			array(
				'label' => esc_html__( 'Button URL', 'brator-core' ),
				'type'  => Controls_Manager::URL,
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
			'caption_repater',
			array(
				'label' => esc_html__( 'Caption Repater', 'brator-core' ),
			)
		);
		$repeater2 = new Repeater();
		$repeater2->add_control(
			'cap_item_image',
			array(
				'label'   => esc_html__( 'Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater2->add_control(
			'cap_item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'GoPro Hero 4', 'brator-core' ),
			)
		);
		$this->add_control(
			'cap_items',
			array(
				'label'   => esc_html__( 'Repeater List', 'brator-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater2->get_controls(),
				'default' => array(
					array(
						'list_title'   => esc_html__( 'Title #1', 'brator-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'brator-core' ),
					),
				),
			)
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		?> 
		<div class="brator-megasell-slide-active arrow-design-one splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":"1","perMove":"1","gap":20}'>
			<div class="splide__arrows style-one">
				<button class="splide__arrow splide__arrow--prev">
					<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
					</svg>
					</button>
					<button class="splide__arrow splide__arrow--next">
					<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
					</svg>
				</button>
			</div>
			<div class="splide__track">
				<div class="splide__list">
					<?php
					foreach ( $settings['items'] as $item ) {
						$item_subtitle       = $item['item_subtitle'];
						$item_offer_title    = $item['item_offer_title'];
						$item_content        = $item['item_content'];
						$button_text         = $item['button_text'];
						$button_url          = $item['button_url']['url'];
						$button_url_external = $item['button_url']['is_external'] ? 'target="_blank"' : '';
						$button_url_nofollow = $item['button_url']['nofollow'] ? 'rel="nofollow"' : '';
						$item_image          = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
						?>
						<div class="brator-megasell-box design-two splide__slide">
							<div class="brator-megasell-slide" style="background-image:url(<?php echo $item_image; ?>)">
								<div class="brator-megasell-slide-content">
									<span class="sub-title"><?php echo $item_subtitle; ?></span>
									<h1 class="title"><?php echo $item_offer_title; ?></h1>
									<p><?php echo $item_content; ?></p>
									<a class="banner-btn" href="<?php echo esc_url( $button_url ); ?>" <?php echo $button_url_external; ?> <?php echo $button_url_nofollow; ?>><?php echo $button_text; ?></a>
								</div>
								<?php if ( ! empty( $settings['cap_items'] ) ) { ?>
								<div class="slider-caption-wrap">
									<?php
									foreach ( $settings['cap_items'] as $capitem ) {
										$cap_item_title     = $capitem['cap_item_title'];
										$cap_item_image     = ( $capitem['cap_item_image']['id'] != '' ) ? wp_get_attachment_image( $capitem['cap_item_image']['id'], 'full' ) : $capitem['cap_item_image']['url'];
										$cap_item_image_alt = get_post_meta( $capitem['cap_item_image']['id'], '_wp_attachment_image_alt', true );
										?>
										<div class="slider-caption-item">
											<?php
											if ( wp_http_validate_url( $cap_item_image ) ) {
												?>
													<img src="<?php echo esc_url( $cap_item_image ); ?>" alt="<?php esc_url( $cap_item_image_alt ); ?>">
												<?php
											} else {
												echo $cap_item_image;
											}
											?>
											<h6><?php echo $cap_item_title; ?></h6>
										</div>
										<?php
									}
									?>
								</div>
								<?php } ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
			<?php
	}
}
