<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

class Brator_List_Products extends Widget_Base {

	public function get_name() {
		return 'brator_list_products';
	}

	public function get_title() {
		return esc_html__( 'List Products', 'brator-core' );
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
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'See All Products', 'brator-core' ),
			)
		);
		$this->add_control(
			'button_url',
			array(
				'label'         => esc_html__( 'Button URL', 'brator-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'brator-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
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
				'type'      => Controls_Manager::SELECT2,
				'label'     => esc_html__( 'Category', 'brator-core' ),
				'options'   => $this->grid_get_all_post_type_categories(),
				'multiple'  => true,
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
		$button_text       = $settings['button_text'];
		$button_url        = $settings['button_url']['url'];
		$product_grid_type = $settings['product_grid_type'];
		$product_per_page  = $settings['product_per_page'];
		$catagory_name     = $settings['catagory_name'];
		$product_order_by  = $settings['product_order_by'];
		$product_order     = $settings['product_order'];
		$extra_class       = $settings['extra_class'];

		if ( is_array( $catagory_name ) && ! empty( $catagory_name ) ) {
			$category_arr = array();
			$category_arr = implode( ', ', $catagory_name );
		} else {
			$category_arr = $catagory_name;
		}

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
				'product_cat'    => $category_arr,
				'orderby'        => $product_order_by,
				'order'          => $product_order,
			);
		}

		$loop = new \WP_Query( $args );

		?>
		<div class="brator-list-products <?php echo $extra_class; ?> woocommerce">
			<div class="brator-section-header">
				<div class="brator-section-header-title">
					<h2><?php echo $title; ?></h2>
				</div>
				<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) { ?>
				<a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
					</svg>
				</a>
				<?php } ?>
			</div>
			<?php
			if ( $loop->have_posts() ) {
				?>
				<div class="brator-list-product-content">
					<?php
					while ( $loop->have_posts() ) :
						$loop->the_post();
						global $product;
						if ( class_exists( 'WooCommerce' ) ) {
							wc_get_template_part( 'content', 'product-listview' );
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
