<?php
class Brator_Int {

	/**
	 * preloader compatibility.
	 */
	public static function brator_preloader() {
		$preloader_on_off = brator_get_options( 'preloader_on_off' );
		if ( $preloader_on_off ) : ?>
			 <div class="preloader-area">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
					<img src="<?php echo esc_url( BRATOR_IMG_URL . 'logo.png' ); ?>" alt="<?php esc_attr_e( 'Logo', 'brator' ); ?>">
					<?php } ?>
			 </div>
				<?php
			endif;
	}
	/**
	 * back to top compatibility.
	 */
	public static function brator_back_to_top() {
		$back_to_top_on_off = brator_get_options( 'back_to_top_on_off' );
		if ( $back_to_top_on_off == '1' ) :
			?>
			<button class="scroll-top scroll-to-target" data-target="html">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path>
			</svg><span><?php esc_html_e( 'top', 'brator' ); ?></span>
			</button>
			<?php
			endif;
	}
	/**
	 * header logo compatibility.
	 */
	public static function brator_header_logo() {
		if ( has_custom_logo() ) {
			the_custom_logo();
		} elseif ( ! has_custom_logo() ) {
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( BRATOR_IMG_URL . 'logo.svg' ); ?>" alt="<?php esc_attr_e( 'Logo', 'brator' ); ?>">
			</a> 
			<?php
		}
	}

	public static function brator_header_logo_white() {
		if ( has_custom_logo() ) {
			the_custom_logo();
		} elseif ( ! has_custom_logo() ) {
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( BRATOR_IMG_URL . 'logo-white.svg' ); ?>" alt="<?php esc_attr_e( 'Logo', 'brator' ); ?>">
			</a> 
			<?php
		}
	}

	/**
	 * header menu compatibility.
	 */
	public static function brator_header_menu() {

		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'walker'         => new Brator_Bootstrap_Navwalker(),
					'depth'          => 3, // 1 = no dropdowns, 2 = with dropdowns.
					'container'      => 'ul',
					'menu_class'     => 'list-style-outside-none hover-menu-enable',
				)
			);
		} else {
			wp_nav_menu(
				array(
					'depth'      => 3, // 1 = no dropdowns, 2 = with dropdowns.
					'container'  => 'ul',
					'menu_class' => 'list-style-outside-none hover-menu-enable',
				)
			);
		}
	}

	public static function brator_breadcrumb() {
		$breadcrumb_title = 'brator';
		$breadcrumb_class = 'breadcrumb_no_bg';
		if ( is_front_page() && is_home() ) :
			$breadcrumb_title = ''; // deafult blog
			$breadcrumb_class = 'deafult-home-breadcrumb';
			elseif ( is_front_page() && ! is_home() ) :
				$breadcrumb_title = ''; // custom home or deafult
				$breadcrumb_class = 'custom-home-breadcrumb';
			elseif ( is_home() ) :
				$blog_breadcrumb_switch = brator_get_options( 'blog_breadcrumb_switch' );
				if ( $blog_breadcrumb_switch == '1' ) :
					$blog_breadcrumb_content = get_the_title( get_option( 'page_for_posts', true ) );
					$breadcrumb_title        = $blog_breadcrumb_content;
				else :
					$breadcrumb_title = '';
				endif;
				$breadcrumb_class = 'blog-breadcrumb';
			elseif ( is_archive() ) :
				$breadcrumb_title = '';
			elseif ( is_single() ) :
				if ( get_post_type( get_the_ID() ) == 'post' ) :
					// redux
					$breadcrumb_class               = 'blog-breadcrumb';
					$blog_single_breadcrumb_content = brator_get_options( 'blog_single_breadcrumb_content' );
					if ( $blog_single_breadcrumb_content ) :
						$breadcrumb_title = $breadcrumb_title;
					else :
						$breadcrumb_title = '';
					endif;
				else :

					if ( is_singular( 'product' ) ) {
						$breadcrumb_title = '';
					} else {
						$breadcrumb_title = get_the_title();
						$breadcrumb_class = 'blog-breadcrumb';
					}
					$breadcrumb_class = get_post_type() . '-single-breadcrumb';
				endif;

			elseif ( is_404() ) :
				$breadcrumb_title = esc_html__( 'Error Page', 'brator' );
				$breadcrumb_class = 'blog-breadcrumb';
			elseif ( is_search() ) :
				if ( have_posts() ) :
					$breadcrumb_title = esc_html__( 'Search Results for: ', 'brator' ) . get_search_query();
					$breadcrumb_class = 'blog-breadcrumb';
				else :
					$breadcrumb_title = esc_html__( 'Nothing Found', 'brator' );
					$breadcrumb_class = 'blog-breadcrumb';
				endif;
			elseif ( ! is_home() && ! is_front_page() && ! is_search() && ! is_404() ) :
				$breadcrumb_title = get_the_title();
				$breadcrumb_class = 'page-breadcrumb';
			endif;
			$breadcrumb_active_class = 'breadcrumb-not-active';
			if ( function_exists( 'bcn_display' ) ) :
				$breadcrumb_active_class = '';
			endif;
			$brator_show_breadcrumb = get_post_meta( get_the_ID(), 'brator_core_show_breadcrumb', true );

			$breadcrumb_bg = brator_get_options( 'breadcrumb_bg' );

			if ( is_page() ) {
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				if ( empty( $image_url ) ) {
					$image_url = $breadcrumb_bg;
				}
			} else {
				$image_url = $breadcrumb_bg;
			}
			?>
			<?php
			if ( $brator_show_breadcrumb != 'off' ) :
				if ( isset( $breadcrumb_title ) && ! empty( $breadcrumb_title ) ) :
					?>
				<div class="brator-banner-slider-area">
					<div class="container-xxxl container-xxl container">
						<div class="row">
							<div class="col-md-12">
								<div class="brator-banner-area design-four shop-bg">
									<?php if ( ! empty( $image_url ) ) { ?>
									<picture class="tt-pagetitle__img">
										<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Page Title BG', 'brator' ); ?>">
									</picture>
									<?php } ?>
									<div class="brator-banner-content">
										<h2><?php echo wp_kses( $breadcrumb_title, 'code_contxt' ); ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					<?php if ( function_exists( 'bcn_display' ) ) : ?>
				<section class="brator-breadcrumb-area">
					<div class="">
						<div class="row">
							<div class="col-lg-12">
								<div class="brator-breadcrumb">
									<ul>
									<?php bcn_display(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php endif; ?>
					<?php
				endif;
				?>
				<?php
			 endif;
			?>
			<?php
	}

	/**
	 * autor box compatibility.
	 */
	public static function brator_authore_box() {
		$blog_authore_switch = brator_get_options( 'blog_authore_switch' );
		if ( $blog_authore_switch == 1 ) :
			global $post;
			$display_name     = get_the_author_meta( 'display_name', $post->post_author );
			$user_description = get_the_author_meta( 'user_description', $post->post_author );
			$designation      = get_the_author_meta( 'designation', $post->post_author );
			$facebook         = get_the_author_meta( 'facebook', $post->post_author );
			$twitter          = get_the_author_meta( 'twitter', $post->post_author );
			$youtube          = get_the_author_meta( 'youtube', $post->post_author );
			$instagram        = get_the_author_meta( 'instagram', $post->post_author );

			$user_avatar = get_avatar( $post->post_author, 80 );
			if ( isset( $user_description ) && ! empty( $user_description ) ) {
				?>
				<div class="brator-post-single-author-area">
					<div class="brator-post-single-author-img"><?php echo wp_kses( $user_avatar, 'code_img' ); ?></div>
					<div class="brator-post-single-author-content">
					<div class="brator-post-single-author-name">
						<h6><?php echo wp_kses_post( ucfirst( $display_name ) ); ?></h6>
						<h5><?php echo esc_html( $designation ); ?></h5>
						<p><?php echo wp_kses_post( $user_description ); ?></p>
					</div>
					<div class="brator-post-single-author-social">
					<?php if ( ! empty( $twitter ) ) { ?>
						<a href="<?php echo esc_url( $twitter ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
							<path d="M56.9,14.8l3.9-4.9C62,8.6,62.3,7.6,62.4,7c-3,1.9-5.9,2.5-7.9,2.5h-0.8L53.2,9c-2.5-2.2-5.5-3.4-8.9-3.4c-7.2,0-13,5.9-13,13c0,0.5,0,1,0.1,1.5l0.3,2.1l-2.2-0.1C16.3,21.8,5.5,10.5,3.7,8.5c-2.9,5.3-1.3,10.2,0.5,13.3l3.5,5.8l-5.5-3                    c0.1,4.3,1.8,7.7,4.9,10.2l2.7,2L7,37.9c1.8,5.3,5.6,7.4,8.6,8.3l3.8,1l-3.3,2.3c-5.7,4-13,3.8-16.1,3.5c6.6,4.5,14.2,5.5,19.7,5.5                    c4,0,7-0.5,7.7-0.7c29-6.8,30.3-32.6,30.2-37.8v-0.8l0.6-0.5c3.5-3.3,5-5.1,5.8-6.1c-0.3,0.2-0.7,0.3-1.2,0.4L56.9,14.8z"></path>
						</svg></a>
						<?php } ?>
					<?php if ( ! empty( $facebook ) ) { ?>
						<a href="<?php echo esc_url( $facebook ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
							<path d="M47.9,25.6L47.9,25.6h-5.8H40v-2.1v-6.4v-2.1h2.1h4.4c1.1,0,2-0.9,2-2V2c0-1.1-0.9-2-2-2h-7.6c-8.2,0-13.9,5.9-13.9,14.4 v9.1v2.1h-2.1H16c-1.5,0-2.7,1.2-2.7,2.8v7.4c0,1.5,1.2,2.7,2.7,2.7h6.9h2.1v2.1v20.8c0,1.5,1.2,2.7,2.7,2.7h9.8                    c0.6,0,1.2-0.3,1.6-0.7c0.5-0.5,0.7-1.2,0.7-1.8l0,0v0V40.5v-2.1H42h4.6c1.3,0,2.4-0.9,2.6-2.1l0-0.1l0-0.1l1.4-7.1                    c0.2-0.8,0-1.6-0.6-2.4C49.6,26.1,48.8,25.7,47.9,25.6z"></path>
						</svg></a>
						<?php } ?>
					<?php if ( ! empty( $youtube ) ) { ?>
						<a href="<?php echo esc_url( $youtube ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
							<path d="M62.7,16.6c-0.7-2.8-2.9-4.9-5.7-5.7c-5-1.3-25-1.3-25-1.3s-20,0-25,1.3c-2.8,0.7-4.9,2.9-5.7,5.7C0,21.6,0,32,0,32  s0,10.4,1.3,15.4c0.7,2.8,2.9,4.9,5.7,5.7c5,1.3,25,1.3,25,1.3s20,0,25-1.3c2.8-0.7,4.9-2.9,5.7-5.7C64,42.4,64,32,64,32  S64,21.6,62.7,16.6z M25.6,41.6V22.4L42.2,32L25.6,41.6z"></path>
						</svg></a>
						<?php } ?>
					<?php if ( ! empty( $instagram ) ) { ?>
						<a href="<?php echo esc_url( $instagram ); ?>"><svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M62.9,19.2c-0.1-3.2-0.7-5.5-1.4-7.6S59.7,7.8,58,6.1s-3.4-2.7-5.4-3.5c-2-0.8-4.2-1.3-7.6-1.4C41.5,1,40.5,1,32,1s-9.4,0-12.8,0.1s-5.5,0.7-7.6,1.4S7.8,4.4,6.1,6.1s-2.8,3.4-3.5,5.5c-0.8,2-1.3,4.2-1.4,7.6S1,23.5,1,32s0,9.4,0.1,12.8c0.1,3.4,0.7,5.5,1.4,7.6c0.7,2.1,1.8,3.8,3.5,5.5s3.5,2.8,5.5,3.5c2,0.7,4.2,1.3,7.6,1.4C22.5,63,23.4,63,31.9,63s9.4,0,12.8-0.1s5.5-0.7,7.6-1.4c2.1-0.7,3.8-1.8,5.5-3.5s2.8-3.5,3.5-5.5c0.7-2,1.3-4.2,1.4-7.6c0.1-3.2,0.1-4.2,0.1-12.7S63,22.6,62.9,19.2zM57.3,44.5c-0.1,3-0.7,4.6-1.1,5.8c-0.6,1.4-1.3,2.5-2.4,3.5c-1.1,1.1-2.1,1.7-3.5,2.4c-1.1,0.4-2.7,1-5.8,1.1c-3.2,0-4.2,0-12.4,0s-9.3,0-12.5-0.1c-3-0.1-4.6-0.7-5.8-1.1c-1.4-0.6-2.5-1.3-3.5-2.4c-1.1-1.1-1.7-2.1-2.4-3.5c-0.4-1.1-1-2.7-1.1-5.8c0-3.1,0-4.1,0-12.4s0-9.3,0.1-12.5c0.1-3,0.7-4.6,1.1-5.8c0.6-1.4,1.3-2.5,2.3-3.5c1.1-1.1,2.1-1.7,3.5-2.3c1.1-0.4,2.7-1,5.8-1.1c3.2-0.1,4.2-0.1,12.5-0.1s9.3,0,12.5,0.1c3,0.1,4.6,0.7,5.8,1.1c1.4,0.6,2.5,1.3,3.5,2.3c1.1,1.1,1.7,2.1,2.4,3.5c0.4,1.1,1,2.7,1.1,5.8c0.1,3.2,0.1,4.2,0.1,12.5S57.4,41.3,57.3,44.5z"/><path d="M32,16.1c-8.9,0-15.9,7.2-15.9,15.9c0,8.9,7.2,15.9,15.9,15.9S48,40.9,48,32S40.9,16.1,32,16.1z M32,42.4c-5.8,0-10.4-4.7-10.4-10.4S26.3,21.6,32,21.6c5.8,0,10.4,4.6,10.4,10.4S37.8,42.4,32,42.4z"/><ellipse cx="48.7" cy="15.4" rx="3.7" ry="3.7"/></g></svg></a>
						<?php } ?>
					</div>
					</div>
				</div>
				<?php
			}
			endif;
	}

	/**
	 * brator compatibility.
	 */
	public static function brator_kses_allowed_html( $tags, $context ) {
		switch ( $context ) {
			case 'code_contxt':
				$tags = array(
					'iframe' => array(
						'allowfullscreen' => array(),
						'frameborder'     => array(),
						'height'          => array(),
						'width'           => array(),
						'src'             => array(),
						'class'           => array(),
					),
					'li'     => array(
						'class' => array(),
					),
					'h5'     => array(
						'class' => array(),
					),
					'span'   => array(
						'class' => array(),
					),
					'a'      => array(
						'href' => array(),
					),
					'i'      => array(
						'class' => array(),
					),
					'br'     => array(
						'class' => array(),
					),
					'select' => array(),
					'option' => array(),
					'p'      => array(),
					'b'      => array(),
					'em'     => array(),
					'strong' => array(),
					'del'    => array(),
					'ins'    => array(),
					'bdi'    => array(),
					'path'   => array(),
					'svg'    => array(
						'xmlns'   => array(),
						'viewBox' => array(),
					),
				);
				return $tags;
			case 'code_img':
				$tags = array(
					'img' => array(
						'class'  => array(),
						'height' => array(),
						'width'  => array(),
						'src'    => array(),
						'alt'    => array(),
					),
				);
				return $tags;
			default:
				return $tags;
		}
	}

	public static function brator_posts_nav() {
		$blog_authore_switch = brator_get_options( 'blog_post_nav_switch' );
		if ( $blog_authore_switch == 1 ) {
			$total = wp_count_posts()->publish;
			if ( $total > 1 ) {
				?>
			<div class="blog-single-pagination-area">
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<div class="blog-single-pagination-content left-side">
						<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
						</svg><span><b>previous</b><i>' . esc_html( '%title' ) . '</i></span>
						</div>',
						'next_text' => '<div class="blog-single-pagination-content right-side"><span><b>next</b><i>' . esc_html( '%title' ) . '</i></span>
						<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
						</div>',
					)
				);
				?>
			</div>
				<?php
			}
		}
	}


	public static function brator_related_posts() {

		$blog_related_post_switch = brator_get_options( 'blog_related_post_switch' );
		if ( $blog_related_post_switch == 1 ) {

			$catterms = get_the_terms( get_the_ID(), 'category' );
			if ( ! empty( $catterms ) && ! is_wp_error( $catterms ) ) {
				$catterm_list = wp_list_pluck( $catterms, 'slug' );
			} else {
				$catterm_list = '';
			}

			$tagterms = get_the_terms( get_the_ID(), 'post_tag' );
			if ( ! empty( $tagterms ) && ! is_wp_error( $tagterms ) ) {
				$tagterm_list = wp_list_pluck( $tagterms, 'slug' );
			} else {
				$tagterm_list = '';
			}

			if ( $catterms || $tagterm_list ) {

				$get_posts = array();

				$rp_args = array(
					'post_type'      => array( 'post' ),
					'post_status'    => array( 'publish' ),
					'posts_per_page' => -1,
					'post__not_in'   => array( get_the_ID() ),
					'tax_query'      => array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $catterm_list,
							'operator' => 'NOT IN',
						),
						array(
							'taxonomy' => 'post_tag',
							'fields'   => 'slug',
							'terms'    => $tagterm_list,
							'operator' => 'NOT IN',
						),
					),
				);

				$related_posts_temp = new WP_Query( $rp_args );

				if ( $related_posts_temp->have_posts() ) {
					$get_posts = $related_posts_temp;
				}

				if ( $get_posts ) {
					?>
		<div class="brator-post-list-slider">
			  <div class="brator-section-header">
				<div class="brator-section-header-title">
				  <h2><?php esc_html_e( 'Related Posts', 'brator' ); ?></h2>
				</div>
			  </div>
			  <div class="brator-blog-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":3,"perMove":"1","gap":30}'>
				<div class="splide__arrows style-one">
				  <button class="splide__arrow splide__arrow--prev">
					<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
					</svg>
				  </button>
				  <button class="splide__arrow splide__arrow--next">
					<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
					</svg>
				  </button>
				</div>
				<div class="splide__track">
				  <div class="splide__list">
					<?php
					while ( $get_posts->have_posts() ) {
						$get_posts->the_post();
						global $post;
						?>
						<div class="brator-blog-slider-single-item splide__slide">
							<div class="brator-blog-listing-single-item-area list-type-two">
							<div class="type-post">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="brator-blog-listing-single-item-thumbnail">
									<a class="blog-listing-single-item-thumbnail-link" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail( 'brator-blog-list' ); ?>
									</a>
								</div>
								<?php } ?>
								<div class="brator-blog-listing-single-item-content">
								<div class="brator-blog-listing-single-item-info">
							<?php brator_category_list(); ?>
							<?php brator_posted_on(); ?>
								</div>
								<h3 class="brator-blog-listing-single-item-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>
								<div class="brator-blog-listing-single-item-excerpt"></div>
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
					<?php } ?>  
				  </div>
				</div>
			  </div>
			</div>
					<?php
				}
				wp_reset_postdata();
			}
		}
	}
	public static function brator_related_products() {
		$blog_related_product_switch = brator_get_options( 'blog_related_product_switch' );
		if ( $blog_related_product_switch == 1 ) {

			$catterms = get_the_terms( get_the_ID(), 'category' );
			if ( ! empty( $catterms ) && ! is_wp_error( $catterms ) ) {
				$catterm_list = wp_list_pluck( $catterms, 'slug' );
			} else {
				$catterm_list = '';
			}

			$tagterms = get_the_terms( get_the_ID(), 'post_tag' );
			if ( ! empty( $tagterms ) && ! is_wp_error( $tagterms ) ) {
				$tagterm_list = wp_list_pluck( $tagterms, 'slug' );
			} else {
				$tagterm_list = '';
			}

			if ( $catterms || $tagterm_list ) {

				$get_posts = array();

				$not___in   = array();
				$not___in[] = get_the_ID();

				$rp_args = array(
					'post_type'      => array( 'product' ),
					'post_status'    => array( 'publish' ),
					'posts_per_page' => -1,
					'exclude'        => get_the_ID(),
					'tax_query'      => array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $catterm_list,
							'operator' => 'NOT IN',
						),
						array(
							'taxonomy' => 'post_tag',
							'fields'   => 'slug',
							'terms'    => $tagterm_list,
							'operator' => 'NOT IN',
						),
					),
				);

				$related_posts_temp = new WP_Query( $rp_args );

				if ( $related_posts_temp->have_posts() ) {
					$get_posts = $related_posts_temp;
				}

				if ( $get_posts ) {
					?>
			<div class="brator-related-product-slider-singlle woocommerce">
				<div class="brator-section-header">
					<div class="brator-section-header-title">
						<h2><?php esc_html_e( 'Related Products', 'brator' ); ?></h2>
					</div>
				</div>
				<div class="brator-product-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":4,"perMove":"1","gap":30, "breakpoints":{ "620" :{ "perPage": "1" },"991" :{ "perPage": "2" }, "1030" :{ "perPage" : "3" }, "1199":{ "perPage" : "4" }, "1500":{ "perPage" : "3" }, "1600":{ "perPage" : "4" }, "1599":{ "perPage" : "3" }, "1920":{ "perPage" : "4" }}}'>
					<div class="splide__arrows style-one">
					<button class="splide__arrow splide__arrow--prev">
						<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
					</button>
					<button class="splide__arrow splide__arrow--next">
						<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
					</button>
					</div>
					<div class="splide__track">
						<div class="splide__list">
					<?php
					while ( $get_posts->have_posts() ) {
						$get_posts->the_post();
						global $post;
						wc_get_template_part( 'content', 'product-slidetwo' );
					}
					?>
						</div>
					</div>
				</div>
			</div>
					<?php
				}
				wp_reset_postdata();
			}
		}
	}
	public static function brator_product_page_posts() {

		$rp_args = array(
			'post_type'      => array( 'post' ),
			'post_status'    => array( 'publish' ),
			'posts_per_page' => 4,
		);

		$get_posts = new WP_Query( $rp_args );
		?>
		<div class="brator-product-single-posts">
			<h2><?php esc_html_e( 'Guide & Blog', 'brator' ); ?></h2>
			<div class="brator-blog-post-sidebar-items">
			<?php
			if ( $get_posts->have_posts() ) {
				while ( $get_posts->have_posts() ) {
					$get_posts->the_post();
					global $post;
					?>
					<div class="brator-blog-listing-single-item-area list-type-one">
						<div class="type-post">
							<div class="brator-blog-listing-single-item-thumbnail">
								<a class="blog-listing-single-item-thumbnail-link" href="<?php esc_url( the_permalink() ); ?>">
								<?php the_post_thumbnail( 'brator-sidebar-post-size' ); ?>
								</a>
								</div>
							<div class="brator-blog-listing-single-item-content">
								<h3 class="brator-blog-listing-single-item-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>
								<div class="brator-blog-listing-single-item-excerpt">
									<p>
									<?php
										$content = substr( get_the_excerpt(), 0, 50 );
										echo esc_html( $content . ' [...]' );
									?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}

}
$brator_int = new Brator_Int();
