<?php
$count = get_post_meta( get_the_id(), 'views', true );
$count = ( $count == null ? '0' : $count );
$view  = ( $count > 1 ? esc_html__( ' Views', 'brator' ) : esc_html__( ' View', 'brator' ) );
?>
<div class="brator-blog-listing-single-item-area list-type-one">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="type-post">
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="brator-blog-listing-single-item-thumbnail">
				<a class="blog-listing-single-item-thumbnail-link" href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail( 'brator-blog-list' ); ?></a>
			</div>
			<?php endif; ?>
			<div class="brator-blog-listing-single-item-content">
				<?php
				if ( is_sticky() ) {
					echo '<div class="sticky_post_icon " title="' . esc_attr__( 'Sticky Post', 'brator' ) . '"><span class="dashicons dashicons-admin-post"></span></div>';
				}
				?>
				<div class="brator-blog-listing-single-item-info">
					<?php brator_category_only(); ?>
					<?php brator_posted_on(); ?>
				</div>
				<h3 class="brator-blog-listing-single-item-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>
				<div class="brator-blog-listing-single-item-excerpt">
				<?php
				if ( ! empty( get_the_excerpt() ) ) {
					if ( get_option( 'rss_use_excerpt' ) ) {
						the_excerpt();
					} else {
						the_excerpt();
					}
				}
				?>
				</div>
				<div class="brator-blog-listing-single-item-info-2">
					<a class="post-by" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
						<path class="st0" d="M-9.5,69.7"></path><g><path d="M32,36.3c8.5,0,15.4-6.9,15.4-15.4S40.5,5.6,32,5.6c-8.5,0-15.4,6.9-15.4,15.4S23.5,36.3,32,36.3z M32,8.6c6.8,0,12.4,5.5,12.4,12.4S38.8,33.3,32,33.3c-6.8,0-12.4-5.5-12.4-12.4S25.2,8.6,32,8.6z"></path><path d="M63.5,55.8C54.8,48.4,43.6,44.4,32,44.4S9.2,48.4,0.5,55.8c-0.6,0.5-0.7,1.5-0.2,2.1s1.5,0.7,2.1,0.2c8.2-6.9,18.6-10.7,29.5-10.7c10.9,0,21.4,3.8,29.5,10.7c0.3,0.2,0.6,0.4,1,0.4c0.4,0,0.8-0.2,1.1-0.5    C64.2,57.3,64.1,56.3,63.5,55.8z"></path></g></svg>
						<?php brator_posted_by_auth(); ?>
					</a>
					<?php if ( $count > 0 ) { ?>
					<a class="post-view-count" href="<?php esc_url( the_permalink() ); ?>">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
						<g><path d="M63.6,31C63,30.4,49.3,15,32,15S1,30.4,0.4,31c-0.5,0.6-0.5,1.4,0,2C1,33.6,14.7,49,32,49s31-15.4,31.6-16C64.1,32.4,64.1,31.6,63.6,31z M32,46C18.5,46,6.9,35.3,3.6,32C6.9,28.6,18.5,18,32,18c13.5,0,25.1,10.7,28.4,14C57.1,35.4,45.5,46,32,46z"></path><path d="M32,24.9c-3.9,0-7.1,3.2-7.1,7.1c0,3.9,3.2,7.1,7.1,7.1c3.9,0,7.1-3.2,7.1-7.1C39.1,28.1,35.9,24.9,32,24.9z M32,36.1c-2.3,0-4.1-1.8-4.1-4.1s1.8-4.1,4.1-4.1s4.1,1.8,4.1,4.1S34.3,36.1,32,36.1z"></path></g>
						</svg><?php echo esc_html( $count . $view ); ?>
					</a>
					<?php } ?>
					<a class="post-comments-count" href="<?php esc_url( the_permalink() ); ?>">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
						<g><path d="M62.5,5.6h-61C0.7,5.6,0,6.2,0,7.1v49.9c0,0.5,0.3,1,0.7,1.3c0.2,0.1,0.5,0.2,0.8,0.2c0.3,0,0.5-0.1,0.7-0.2l19.1-10.9h41.2c0.8,0,1.5-0.7,1.5-1.5V7.1C64,6.2,63.3,5.6,62.5,5.6z M61,44.4H20.9c-0.3,0-0.5,0.1-0.7,0.2L3,54.4V8.6h58V44.4z"></path><path d="M15.4,32.5c3.3,0,6-2.7,6-6s-2.7-6-6-6s-6,2.7-6,6S12.1,32.5,15.4,32.5z M15.4,23.5c1.7,0,3,1.3,3,3s-1.3,3-3,3s-3-1.3-3-3S13.7,23.5,15.4,23.5z"></path><path d="M32,32.5c3.3,0,6-2.7,6-6s-2.7-6-6-6s-6,2.7-6,6S28.7,32.5,32,32.5z M32,23.5c1.7,0,3,1.3,3,3s-1.3,3-3,3s-3-1.3-3-3S30.3,23.5,32,23.5z"></path><path d="M48.6,32.5c3.3,0,6-2.7,6-6s-2.7-6-6-6s-6,2.7-6,6S45.3,32.5,48.6,32.5z M48.6,23.5c1.7,0,3,1.3,3,3s-1.3,3-3,3c-1.7,0-3-1.3-3-3S47,23.5,48.6,23.5z"></path></g></svg>
						<span><?php brator_comments_count(); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
