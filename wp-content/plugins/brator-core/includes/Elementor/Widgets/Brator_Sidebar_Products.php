<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

class Brator_Sidebar_Products extends Widget_Base {

	public function get_name() {
		return 'brator_sidebar_products';
	}

	public function get_title() {
		return esc_html__( 'Sidebar Products', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	private function grid_get_all_post_type_categories() {
		$options  = array();
		$taxonomy = 'product_cat';
		if ( ! empty( $taxonomy ) ) {
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => true,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}

		return $options;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general_setting',
			array(
				'label' => esc_html__( 'General Settings', 'brator-core' ),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Featured Products', 'brator-core' ),
			)
		);

		$this->add_control(
			'product_grid_type',
			array(
				'label'   => esc_html__( 'Product Type', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'recent_products',
				'options' => array(
					'featured_products'     => esc_html__( 'Featured Products', 'brator-core' ),
					'sale_products'         => esc_html__( 'Sale Products', 'brator-core' ),
					'best_selling_products' => esc_html__( 'Best Selling Products', 'brator-core' ),
					'recent_products'       => esc_html__( 'Recent Products', 'brator-core' ),
					'top_rated_products'    => esc_html__( 'Top Rated Products', 'brator-core' ),
					'product_category'      => esc_html__( 'Product Category', 'brator-core' ),
				),
			)
		);

		// Product categories.
		$this->add_control(
			'catagory_name',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Category', 'brator-core' ),
				'options'   => $this->grid_get_all_post_type_categories(),
				'condition' => array(
					'product_grid_type' => 'product_category',
				),
			)
		);

		$this->add_control(
			'product_per_page',
			array(
				'label'   => esc_html__( 'Number of Products', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => esc_html__( 8, 'brator-core' ),
			)
		);

		$this->add_control(
			'product_order_by',
			array(
				'label'   => esc_html__( 'Order By', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => esc_html__( 'Date', 'brator-core' ),
					'ID'            => esc_html__( 'ID', 'brator-core' ),
					'author'        => esc_html__( 'Author', 'brator-core' ),
					'title'         => esc_html__( 'Title', 'brator-core' ),
					'modified'      => esc_html__( 'Modified', 'brator-core' ),
					'rand'          => esc_html__( 'Random', 'brator-core' ),
					'comment_count' => esc_html__( 'Comment count', 'brator-core' ),
					'menu_order'    => esc_html__( 'Menu order', 'brator-core' ),
				),
			)
		);

		$this->add_control(
			'product_order',
			array(
				'label'   => esc_html__( 'Product Order', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'DESC', 'brator-core' ),
					'ASC'  => esc_html__( 'ASC', 'brator-core' ),
				),
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
	}

	protected function render() {
		$settings          = $this->get_settings();
		$title             = $settings['title'];
		$product_grid_type = $settings['product_grid_type'];
		$product_per_page  = $settings['product_per_page'];
		$catagory_name     = $settings['catagory_name'];
		$product_order_by  = $settings['product_order_by'];
		$product_order     = $settings['product_order'];
		$extra_class       = $settings['extra_class'];

		?>
		<div class="brator-home-sidebar-area brator-products-sidebar <?php echo $extra_class; ?> woocommerce">
			<div class="brator-home-sidebar-title"><?php echo $title; ?></div>
			<?php
			if ( $product_grid_type == 'sale_products' ) {
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $product_per_page,
					'meta_query'     => array(
						'relation' => 'OR',
						array(
							'key'     => '_sale_price',
							'value'   => 0,
							'compare' => '>',
							'type'    => 'numeric',
						),
						array(// Variable products type
							'key'     => '_min_variation_sale_price',
							'value'   => 0,
							'compare' => '>',
							'type'    => 'numeric',
						),
					),
					'orderby'        => $product_order_by,
					'order'          => $product_order,
				);
			}
			if ( $product_grid_type == 'best_selling_products' ) {
				$args = array(
					'post_type'      => 'product',
					'meta_key'       => 'total_sales',
					'orderby'        => 'meta_value_num',
					'posts_per_page' => $product_per_page,
					'order'          => $product_order,
				);
			}
			if ( $product_grid_type == 'recent_products' ) {
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $product_per_page,
					'orderby'        => $product_order_by,
					'order'          => $product_order,
				);
			}
			if ( $product_grid_type == 'featured_products' ) {
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $product_per_page,
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
						),
					),
					'orderby'        => $product_order_by,
					'order'          => $product_order,
				);

			}
			if ( $product_grid_type == 'top_rated_products' ) {
				$args = array(
					'posts_per_page' => $product_per_page,
					'no_found_rows'  => 1,
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'meta_key'       => '_wc_average_rating',
					'orderby'        => $product_order_by,
					'order'          => $product_order,
					'meta_query'     => WC()->query->get_meta_query(),
					'tax_query'      => WC()->query->get_tax_query(),
				);
			}

			if ( $product_grid_type == 'product_category' ) {
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $product_per_page,
					'product_cat'    => $catagory_name,
					'orderby'        => $product_order_by,
					'order'          => $product_order,
				);
			}

			$loop = new \WP_Query( $args );

			if ( $loop->have_posts() ) {
				?>
				<div class="brator-product-sidebar-content">
					<?php
					while ( $loop->have_posts() ) :
						$loop->the_post();
						global $product;
						if ( class_exists( 'WooCommerce' ) ) {
							?>
							<div class="product-sidebar-item">
								<div class="product-sidebar-item-img">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</div>
								<div class="product-sidebar-item-text">
									<?php if ( $price_html = $product->get_price_html() ) : ?>
										<div class="price"><?php echo wp_kses( $price_html, 'code_contxt' ); ?></div>
									<?php endif; ?>
									<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
									<?php if ( $product->get_average_rating() ) : ?>
										<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
									<?php endif; ?>
								</div>
							</div>
							<?php
						} else {
							echo '<p class="text-center">' . esc_html__( 'WooCommerce Not Active.', 'brator-core' ) . '</p>';
						}
					endwhile;
					?>
				</div>
				<?php
			} else {
				echo '<p class="text-center">' . esc_html__( 'No Products found.', 'brator-core' ) . '</p>';
			}
			wp_reset_postdata();
			?>
		</div>
		<?php
	}
}
