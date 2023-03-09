
	<div class="brator-blog-listing-single-item-area splide__slide">
	<div class="type-post">
		<div class="brator-blog-listing-single-item-thumbnail">
			<a class="blog-listing-single-item-thumbnail-link" href="<?php esc_url( the_permalink() );?>">
			<?php the_post_thumbnail('brator-blog-grid-2');?>
			</a>
		</div>
		<div class="brator-blog-listing-single-item-content">
			<h3 class="brator-blog-listing-single-item-title"><a href="<?php esc_url( the_permalink() );?>"><?php the_title();?></a></h3>
			<div class="brator-blog-listing-single-item-excerpt">
				<p>
				<?php
				$content = substr( get_the_excerpt(), 0, 90 );
				echo esc_html($content . ' [...]');
				?>
				</p>
			</div>
			<div class="brator-blog-listing-single-item-info-2">
				<a class="post-by" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
						<path class="st0" d="M-9.5,69.7"></path><g><path d="M32,36.3c8.5,0,15.4-6.9,15.4-15.4S40.5,5.6,32,5.6c-8.5,0-15.4,6.9-15.4,15.4S23.5,36.3,32,36.3z M32,8.6c6.8,0,12.4,5.5,12.4,12.4S38.8,33.3,32,33.3c-6.8,0-12.4-5.5-12.4-12.4S25.2,8.6,32,8.6z"></path><path d="M63.5,55.8C54.8,48.4,43.6,44.4,32,44.4S9.2,48.4,0.5,55.8c-0.6,0.5-0.7,1.5-0.2,2.1s1.5,0.7,2.1,0.2c8.2-6.9,18.6-10.7,29.5-10.7c10.9,0,21.4,3.8,29.5,10.7c0.3,0.2,0.6,0.4,1,0.4c0.4,0,0.8-0.2,1.1-0.5    C64.2,57.3,64.1,56.3,63.5,55.8z"></path></g></svg>
						<?php brator_posted_by_auth();?>
				</a>
				<a href="<?php esc_url( the_permalink() );?>">
				<svg class="bi bi-calendar3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
					<path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"></path>
					<path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
				</svg><span><?php brator_posted_on(); ?></span>
				</a>
			</div>
		</div>
	</div>
</div>