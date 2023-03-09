<?php
$count = get_post_meta( get_the_id(), 'views', true );
$count = ( $count == null ? '0' : $count );
$view  = ( $count > 1 ? esc_html__( ' Views', 'brator' ) : esc_html__( ' View', 'brator' ) );
?>
<div class="brator-blog-listing-single-item-area list-type-one">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="type-post">
			<div class="brator-blog-listing-single-item-content">
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
			</div>
		</div>
	</div>
</div>
