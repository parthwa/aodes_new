<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Mega_Menu extends Widget_Base {

	public function get_name() {
		return 'brator_mega_menu';
	}

	public function get_title() {
		return esc_html__( 'Brator Mega Menu', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}
	private function get_listing_categories() {
		$options  = array();
		$taxonomy = 'product_cat';
		if ( ! empty( $taxonomy ) ) {
				$terms = get_terms(
					array(
						'taxonomy'   => $taxonomy,
						'hide_empty' => false,
					)
				);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						$options[''] = 'Select';
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							if ( $term->count != 0 ) {
								$options[ $term->slug ] = $term->name;
							}
						}
					}
				}
			}
		}
				return $options;
	}
	protected function register_controls() {
		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__( 'general', 'brator-core' ),
			)
		);
		$this->add_control(
			'item_style',
			array(
				'label'   => esc_html__( 'Promo Banner Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( 'One', 'brator-core' ),
					'2' => esc_html__( 'Two', 'brator-core' ),
				),
				'default' => '1',
			)
		);
			$this->add_control(
				'item_image',
				array(
					'label'   => esc_html__( 'Image', 'clasifico-core' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => array(
						'url' => Utils::get_placeholder_image_src(),
					),
				)
			);
		$this->add_control(
			'item_offer_top_text',
			array(
				'label'   => esc_html__( 'Offer Top Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'sale up to', 'brator-core' ),
			)
		);

		$this->add_control(
			'item_offer_text',
			array(
				'label'   => esc_html__( 'Offer Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '20% OFF', 'brator-core' ),
			)
		);

		$this->add_control(
			'item_content',
			array(
				'label'       => esc_html__( 'Content', 'brator-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'placeholder' => esc_html__( 'Type your description here', 'brator-core' ),
			)
		);

		$this->add_control(
			'item_button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Shop Now', 'brator-core' ),
			)
		);
		$this->add_control(
			'item_button_link',
			array(
				'label'         => esc_html__( 'Button Link', 'brator-core' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'Item', 'brator-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'taxonomy_slug',
			array(
				'label'     => __( 'Select Category', 'brator-core' ),
				'separator' => 'before',
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_listing_categories(),
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
				'label'  => esc_html__( 'Repeater List', 'brator-core' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings                  = $this->get_settings_for_display();
		$item_style                = $settings['item_style'];
		$item_offer_top_text       = $settings['item_offer_top_text'];
		$item_offer_text           = $settings['item_offer_text'];
		$item_content              = $settings['item_content'];
		$item_button_text          = $settings['item_button_text'];
		$item_button_link          = $settings['item_button_link']['url'];
		$item_button_link_external = $settings['item_button_link']['is_external'] ? 'target="_blank"' : '';
		$item_button_link_nofollow = $settings['item_button_link']['nofollow'] ? 'rel="nofollow"' : '';
		$item_image_url            = ( $settings['item_image']['id'] != '' ) ? wp_get_attachment_image_url( $settings['item_image']['id'], 'full' ) : $settings['item_image']['url'];
		?> 

		<div class="mega-menu-area-items">
			<div class="mega-menu-cat-list">
				<div class="mega-menu-cat-list-left mega-menu-cat-list-single-area">
					<?php
					$total      = count( $settings['items'] );
					$total_half = ceil( $total / 3 );
					$i          = 0;
					foreach ( $settings['items'] as $item ) {
						$i++;
						$taxonomy_slug  = $item['taxonomy_slug'];
						$get_conetnt    = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
						$listingurl     = get_term_link( $taxonomy_slug, 'product_cat' );
						$item_image     = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
						$item_image_alt = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
						if ( $listingurl && $get_conetnt ) {
							?>
								<a href="<?php echo esc_url( $listingurl ); ?>">
								<?php
								if ( wp_http_validate_url( $item_image ) ) {
									?>
										<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
										<?php
								} else {
									echo $item_image;
								}
								?>
									<span><?php echo $get_conetnt->name; ?></span>
								</a>
							<?php
						}
						if ( $i == $total_half ) {
							break;
						}
					}
					?>
				</div>
				<div class="mega-menu-cat-list-mdl mega-menu-cat-list-single-area">
				<?php
				$i = 0;
				foreach ( $settings['items'] as $item ) {
					$i++;
					$taxonomy_slug  = $item['taxonomy_slug'];
					$get_conetnt    = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
					$listingurl     = get_term_link( $taxonomy_slug, 'product_cat' );
					$item_image     = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
					$item_image_alt = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
					$list           = $total_half + $total_half;
					if ( $i > $total_half && $i <= $list ) {
						if ( $listingurl && $get_conetnt ) {
							?>
						<a href="<?php echo esc_url( $listingurl ); ?>">
							<?php
							if ( wp_http_validate_url( $item_image ) ) {
								?>
								<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
								<?php
							} else {
								echo $item_image;
							}
							?>
							<span><?php echo $get_conetnt->name; ?></span>
						</a>
							<?php
						}
					}
				}
				?>
				</div>
				<div class="mega-menu-cat-list-end mega-menu-cat-list-single-area">
				<?php
				$i = 0;
				foreach ( $settings['items'] as $item ) {
					$i++;
					$taxonomy_slug  = $item['taxonomy_slug'];
					$get_conetnt    = get_term_by( 'slug', $taxonomy_slug, 'product_cat' );
					$listingurl     = get_term_link( $taxonomy_slug, 'product_cat' );
					$item_image     = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
					$item_image_alt = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );
					$list           = $total_half + $total_half;
					if ( $i > $list ) {
						if ( $listingurl && $get_conetnt ) {
							?>
							<a href="<?php echo esc_url( $listingurl ); ?>">
								<?php
								if ( wp_http_validate_url( $item_image ) ) {
									?>
									<img src="<?php echo esc_url( $item_image ); ?>" alt="<?php esc_url( $item_image_alt ); ?>">
									<?php
								} else {
									echo $item_image;
								}
								?>
								<span><?php echo $get_conetnt->name; ?></span>
							</a>
							<?php
						}
					}
				}
				?>
				</div>
			</div>
			<div class="mega-menu-offer">
			<?php if ( $item_style == '1' ) { ?>
					<div class="brator-offer-box-one lazyload" data-bg="<?php echo $item_image_url; ?>">
						<p><?php echo $item_offer_top_text; ?></p>
						<h6><?php echo $item_offer_text; ?></h6>
						<?php echo $item_content; ?>
						<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
					</div>
				<?php } elseif ( $item_style == '2' ) { ?>
					<div class="brator-offer-box-two lazyload" data-bg="<?php echo $item_image_url; ?>">
						<div class="budget-area"><span><?php echo $item_offer_top_text; ?></span></div>
						<h2><?php echo $item_offer_text; ?></h2>
						<?php echo $item_content; ?>
						<a href="<?php echo esc_url( $item_button_link ); ?>" <?php echo $item_button_link_external; ?> <?php echo $item_button_link_nofollow; ?>><?php echo $item_button_text; ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
