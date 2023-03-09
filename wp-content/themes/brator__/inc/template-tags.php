<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package brator
 */

if ( ! function_exists( 'brator_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function brator_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'brator' ),
			'' . $time_string . ''
		);

		echo '' . $posted_on . '';

	}
endif;

if ( ! function_exists( 'brator_category_list' ) ) :
	function brator_category_list() {
		if ( 'post' === get_post_type() ) {
			$category_list = get_the_category_list( esc_html__( ', ', 'brator' ) );
			if ( $category_list ) {
				printf( $category_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'brator_category_only' ) ) :
	function brator_category_only() {
		if ( 'post' === get_post_type() ) {
			$category = get_the_category();
			if ( $category ) {
				if ( $category[0] ) {
					echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
				}
			}
		}
	}
endif;

if ( ! function_exists( 'brator_tag_list' ) ) :
	function brator_tag_list() {
		if ( 'post' === get_post_type() ) {
			$tag_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'brator' ) );
			if ( $tag_list ) {
				printf( $tag_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'brator_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function brator_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'brator' ),
			'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);
		echo '' . $byline . '';

	}
endif;

if ( ! function_exists( 'brator_posted_by_auth' ) ) :
	/**
	 * Prints HTML with meta information for the current author by.
	 */
	function brator_posted_by_auth() {
		global $post;
		$author_id = $post->post_author;
		$byline    = sprintf(
			/* translators: %s: post author. */
			esc_html( get_the_author_meta( 'display_name', $author_id ) )
		);
		echo esc_html__( 'By', 'brator' ) . '<span>' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'brator_comments_count' ) ) :
	function brator_comments_count() {
		if ( get_comments_number( get_the_ID() ) == 0 ) {
			$comments_count = get_comments_number( get_the_ID() ) . esc_html__( ' Comments', 'brator' );
		} elseif ( get_comments_number( get_the_ID() ) > 1 ) {
			$comments_count = get_comments_number( get_the_ID() ) . esc_html__( ' Comments', 'brator' );
		} else {
			$comments_count = get_comments_number( get_the_ID() ) . esc_html__( ' Comment', 'brator' );
		}
		echo sprintf( esc_html( '%s' ), $comments_count );
	}
endif;

if ( ! function_exists( 'brator_comments' ) ) {
	function brator_comments( $comment, $args, $depth ) {
		extract( $args, EXTR_SKIP );

		$class = '';
		if ( $depth > 1 ) {
			$class = '';
		}
		if ( $depth == 1 ) {
			$child_html_el     = '<ul><li>';
			$child_html_end_el = '</li></ul>';
		}

		if ( $depth >= 2 ) {
			$child_html_el     = '<li>';
			$child_html_end_el = '</li>';
		}
		$comment_class_ping = 'yes-ping';
		if ( $comment->comment_type != 'trackback' && $comment->comment_type != 'pingback' ) :
			$comment_class_ping = '';
		endif;
		?>
			<div class="comment single-comment <?php echo esc_attr( $comment_class_ping ); ?>" id="comment-<?php comment_ID(); ?>">
			<div class="blog-comment-single-item">
				<?php if ( $comment->comment_type != 'trackback' && $comment->comment_type != 'pingback' ) { ?>
				<div class="blog-comment-single-item-img"><?php print get_avatar( $comment, 70, null, null, array( 'class' => array() ) ); ?></div>
				<?php } ?>
				<div class="blog-comment-single-item-content">
					<div class="blog-comment-single-item-autor">
						<h6><?php echo get_comment_author_link(); ?></h6><span><?php echo get_the_date(); ?></span>
						<?php comment_text(); ?>
						<?php
							$replyBtn = 'replay-btn';
							echo preg_replace(
								'/comment-reply-link/',
								'comment-reply-link ' . $replyBtn,
								get_comment_reply_link(
									array_merge(
										$args,
										array(
											'reply_text' => esc_html__( 'Reply', 'brator' ),
											'depth'      => $depth,
											'max_depth'  => $args['max_depth'],
										)
									)
								),
								1
							);
						?>
					</div>
				</div>
			</div>
		<?php
	}
}

if ( ! function_exists( 'brator_product_category_list' ) ) :
	function brator_product_category_list() {
		echo '<ul class="menu-cat-list-item">';
		  $taxonomy     = 'product_cat';
		  $orderby      = 'name';
		  $show_count   = 0;      // 1 for yes, 0 for no
		  $pad_counts   = 0;      // 1 for yes, 0 for no
		  $hierarchical = 1;      // 1 for yes, 0 for no
		  $title        = '';
		  $empty        = true;

		  $args           = array(
			  'taxonomy'     => $taxonomy,
			  'orderby'      => $orderby,
			  'show_count'   => $show_count,
			  'pad_counts'   => $pad_counts,
			  'hierarchical' => $hierarchical,
			  'title_li'     => $title,
			  'hide_empty'   => $empty,
		  );
		  $all_categories = get_categories( $args );

		  foreach ( $all_categories as $cat ) {
			  if ( $cat->category_parent == 0 ) {
				  $category_id = $cat->term_id;
				  $args2       = array(
					  'taxonomy'     => $taxonomy,
					  'child_of'     => 0,
					  'parent'       => $category_id,
					  'orderby'      => $orderby,
					  'show_count'   => $show_count,
					  'pad_counts'   => $pad_counts,
					  'hierarchical' => $hierarchical,
					  'title_li'     => $title,
					  'hide_empty'   => $empty,
				  );
				  $sub_cats    = get_categories( $args2 );
				  if ( $sub_cats ) {
					  echo '<li class="has-sub-cat"><a href="' . get_term_link( $cat->slug, 'product_cat' ) . '">' . $cat->name . '</a>';
				  } else {
					  if ( $cat->slug != 'uncategorized' ) {
						  echo '<li><a href="' . get_term_link( $cat->slug, 'product_cat' ) . '">' . $cat->name . '</a></li>';
					  }
				  }
				  if ( $sub_cats ) {
					  echo '<ul>';
					  foreach ( $sub_cats as $sub_category ) {
						  echo '<li><a href="' . get_term_link( $sub_category->slug, 'product_cat' ) . '">' . $sub_category->name . '</a></li>';
					  }
					  echo '</ul></li>';
				  }
			  }
		  }
		  echo '</ul>';
	}
endif;


function brator_exclude_terms_uncategorized( $terms ) {
	$exclude_terms = array( 1 ); // Exclude `Uncategorized` category
	if ( ! empty( $terms ) && is_array( $terms ) ) {
		foreach ( $terms as $key => $term ) {
			if ( in_array( $term->term_id, $exclude_terms ) ) {
				unset( $terms[ $key ] );
			}
		}
	}
	return $terms;
}
add_filter( 'get_the_terms', 'brator_exclude_terms_uncategorized' );
