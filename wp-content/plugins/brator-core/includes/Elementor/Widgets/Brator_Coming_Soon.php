<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Icons_Manager;
use Elementor\Repeater;

class Brator_Coming_Soon extends Widget_Base {


	public function get_name() {
		return 'brator_coming_soon';
	}

	public function get_title() {
		return esc_html__( 'Brator Coming Soon', 'brator-core' );
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
				'label' => esc_html__( 'Logo', 'brator-core' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Coming soon', 'brator-core' ),
			)
		);

		$this->add_control(
			'desc',
			array(
				'label'       => esc_html__( 'Desc', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => __( 'Condimentum ipsum a adipiscing hac dolor set consectetur urna commodout nisl partu convallier ullamcorpe.', 'brator-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),

			)
		);

		$this->add_control(
			'count_down_date',
			array(
				'label'       => esc_html__( 'Count Down Date', 'brator-core' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => __( '29 April 2022 9:56', 'brator-core' ),
				'placeholder' => esc_html__( '29 April 2022 9:56', 'brator-core' ),
			)
		);

		$this->add_control(
			'right_image',
			array(
				'label'   => esc_html__( 'Right Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);

		$this->add_control(
			'subscribe_form_shortcode',
			array(
				'label' => esc_html__( 'Subscribe Form Shortcode', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'subscribe_form_title',
			array(
				'label'   => esc_html__( 'Subscribe Form Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Get notify when website launch. Don’t worry! we not spam', 'brator-core' ),
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
		$settings                 = $this->get_settings_for_display();
		$logo                     = ( $settings['logo']['id'] != '' ) ? wp_get_attachment_image( $settings['logo']['id'], 'full' ) : $settings['logo']['url'];
		$logo_alt                 = get_post_meta( $settings['logo']['id'], '_wp_attachment_image_alt', true );
		$title                    = $settings['title'];
		$desc                     = $settings['desc'];
		$count_down_date          = $settings['count_down_date'];
		$right_image              = ( $settings['right_image']['id'] != '' ) ? wp_get_attachment_image( $settings['right_image']['id'], 'full' ) : $settings['right_image']['url'];
		$image_alt                = get_post_meta( $settings['right_image']['id'], '_wp_attachment_image_alt', true );
		$subscribe_form_shortcode = $settings['subscribe_form_shortcode'];
		$subscribe_form_title     = $settings['subscribe_form_title'];
		?> 
		<div class="brator-header-area header-one comming-sson-pag-header">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-8">
						<div class="brator-logo-area">
							<div class="brator-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								if ( $logo ) {
									if ( wp_http_validate_url( $logo ) ) {
										?>
										<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_url( $logo_alt ); ?>">
										<?php
									} else {
										echo $logo;
									}
								} else {
									?>
									<img src="<?php echo esc_url( BRATOR_IMG_URL . 'logo.svg' ); ?>" alt="<?php esc_attr_e( 'Logo', 'brator-core' ); ?>">
								<?php } ?>
								</a>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="brator-info-right">
							<div class="brator-social-link svg-link">
								<?php
								foreach ( $settings['items'] as $item ) {
									$item_social_icon          = $item['item_social_icon'];
									$item_social_link          = $item['item_social_link']['url'];
									$item_social_link_external = $item['item_social_link']['is_external'] ? 'target="_blank"' : '';
									$item_social_link_nofollow = $item['item_social_link']['nofollow'] ? 'rel="nofollow"' : '';
									?>
									<a href="<?php echo esc_url( $item_social_link ); ?>" <?php echo $item_social_link_external; ?> <?php echo $item_social_link_nofollow; ?>><?php Icons_Manager::render_icon( ( $item_social_icon ), array( 'aria-hidden' => 'true' ) ); ?></a>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="brator-coming-soon-area">
			<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-xl-6 col-sm-12">
						<div class="brator-coming-soon-content">
							<h6><?php echo $title; ?></h6>
							<p><?php echo $desc; ?></p>
						</div>
						<div class="brator-coming-soon-counter" data-attr="<?php echo esc_attr( $count_down_date ); ?>">
							<div id="countdown">
								<ul>
									<li><span id="days"></span><?php esc_html_e( 'days', 'brator-core' ); ?></li>
									<li><span id="hours"></span><?php esc_html_e( 'Hours', 'brator-core' ); ?></li>
									<li><span id="minutes"></span><?php esc_html_e( 'Minutes', 'brator-core' ); ?></li>
									<li><span id="seconds"></span><?php esc_html_e( 'Seconds', 'brator-core' ); ?></li>
								</ul>
							</div>
						</div>
						<div class="brator-coming-soon-subs-area">
							<p><?php echo $subscribe_form_title; ?></p>
							<div class="brator-sub-form">
								<div class="news-letter-form">
									<?php echo do_shortcode( $subscribe_form_shortcode ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-sm-12">
						<div class="brator-coming-soon-img">
						<?php
						if ( wp_http_validate_url( $right_image ) ) {
							?>
							<img src="<?php echo esc_url( $right_image ); ?>" alt="<?php esc_url( $image_alt ); ?>">
							<?php
						} else {
							echo $right_image;
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div> 
		<?php
	}
}
