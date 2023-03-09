<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

class Brator_Sidebar_Blog extends Widget_Base {


	public function get_name() {
		return 'brator_sidebar_blog';
	}

	public function get_title() {
		return esc_html__( 'Sidebar Blog', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	private function get_blog_categories() {
		$options  = array();
		$taxonomy = 'category';
		if ( ! empty( $taxonomy ) ) {
			$terms = get_terms(
				array(
					'parent'     => 0,
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						$options[''] = 'Select';
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
			'section_blogs',
			array(
				'label' => esc_html__( 'Blog Posts', 'brator-core' ),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Latest Posts', 'brator-core' ),
			)
		);
		$this->add_control(
			'category_id',
			array(
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Category', 'brator-core' ),
				'options' => $this->get_blog_categories(),
			)
		);
		$this->add_control(
			'featured_posts',
			array(
				'type'  => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Featured Posts', 'brator-core' ),
			)
		);
		$this->add_control(
			'number',
			array(
				'label'   => esc_html__( 'Number of Post', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
			)
		);
		$this->add_control(
			'order_by',
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
			'order',
			array(
				'label'   => esc_html__( 'Order', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => array(
					'desc' => esc_html__( 'DESC', 'brator-core' ),
					'asc'  => esc_html__( 'ASC', 'brator-core' ),
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
		$settings = $this->get_settings();

		$posts_per_page = $settings['number'];
		$title          = $settings['title'];
		$extra_class    = $settings['extra_class'];

		$order_by = $settings['order_by'];
		$order    = $settings['order'];

		$pg_num = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		if ( is_array( $settings['category_id'] ) && ! empty( $settings['category_id'] ) ) {
			$category_arr = array();
			$category_arr = implode( ', ', $settings['category_id'] );
		} else {
			$category_arr = $settings['category_id'];
		}

		$featured_posts = $settings['featured_posts'];

		if ( $featured_posts == 'yes' ) {
			$args = array(
				'post_type'      => array( 'post' ),
				'post_status'    => array( 'publish' ),
				'nopaging'       => false,
				'paged'          => $pg_num,
				'posts_per_page' => $posts_per_page,
				'category_name'  => $category_arr,
				'orderby'        => $order_by,
				'order'          => $order,
				'meta_key'       => 'brator_core_post_featured',
				'meta_value'     => '1',
			);
		} else {
			$args = array(
				'post_type'      => array( 'post' ),
				'post_status'    => array( 'publish' ),
				'nopaging'       => false,
				'paged'          => $pg_num,
				'posts_per_page' => $posts_per_page,
				'category_name'  => $category_arr,
				'orderby'        => $order_by,
				'order'          => $order,
			);
		}

		$query = new \WP_Query( $args );
		?>
		<div class="brator-home-sidebar-area <?php echo $extra_class; ?>">
			<div class="brator-home-sidebar-title"><?php echo $title; ?></div>
			<div class="brator-sidebar-slider dots-design-one splide js-splide p-splide" data-splide='{"pagination":true,"arrows":false,"type":"slide","perPage":1,"perMove":"1"}'>
				<div class="splide__track">
					<div class="splide__list">
					<?php
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							global $post;
							?>
							<div class="sidebar-post-item splide__slide">
								<?php the_post_thumbnail( 'full' ); ?>
								<div class="sidebar-post-content">
									<h6><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h6>
									<div class="sidebar-meta-post">
										<span><?php brator_category_only(); ?></span>
										<span>/ <?php echo get_the_date(); ?></span>
									</div>
									<p>
									<?php
									$content = substr( get_the_excerpt(), 0, 130 );
									echo $content . ' [...]';
									?>
									</p>
								</div>
							</div>
							<?php
						}
							wp_reset_postdata();
					}
					?>
					</div>
				</div>
			</div>

		</div>
		<?php
	}
}
