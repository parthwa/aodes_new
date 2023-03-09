<?php
namespace Brator\Helper\Widgets;

/*
==============================
custom Recent Tour Type Widget
==============================
*/

class Recent_Posts extends \WP_Widget {


	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		 $widget_ops = array(
			 'classname'                   => 'post-widget',
			 'description'                 => __( 'A Brator Posts Widget' ),
			 'customize_selective_refresh' => true,
		 );
		 parent::__construct( 'recent_posts', __( 'Brator Recent Posts' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'brator_recent_blog_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			printf( $cache[ $args['widget_id'] ] );
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/**
		 * This filter is documented in wp-includes/default-widgets.php
		 */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$r = new \WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page' => $number,
					'no_found_rows'  => true,
					'post_status'    => 'publish',
					'post_type'      => array(
						'Post',
						'ignore_sticky_posts' => true,
					),
				)
			)
		);

		if ( $r->have_posts() ) :
			printf( $args['before_widget'] );
			if ( $title ) {
				printf( $args['before_title'] . $title . $args['after_title'] );
			}

			echo '<div class="brator-blog-post-sidebar-items">';
			while ( $r->have_posts() ) :
				$r->the_post();
				?>
				<div class="brator-blog-listing-single-item-area list-type-one">
					<div class="type-post">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="brator-blog-listing-single-item-thumbnail">
							<a class="blog-listing-single-item-thumbnail-link" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'brator-sidebar-post-size' ); ?>
							</a>
						</div>
						<?php endif; ?>
						<div class="brator-blog-listing-single-item-content">
							<h3 class="brator-blog-listing-single-item-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>
							<div class="brator-blog-listing-single-item-excerpt">
								<p>
								<?php
								$content = substr( get_the_excerpt(), 0, 50 );
								echo $content . '...';
								?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<?php
		endwhile;
			echo '</div>';
			printf( $args['after_widget'] );
			wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'brator_recent_blog_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete( 'brator_recent_blog_posts', 'widget' );
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php printf( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php printf( $this->get_field_id( 'title' ) ); ?>" name="<?php printf( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php printf( $title ); ?>" />
		</p>
		<p><label for="<?php printf( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input id="<?php printf( $this->get_field_id( 'number' ) ); ?>" name="<?php printf( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php printf( $number ); ?>" size="3" />
		</p>
		<?php
	}
}
