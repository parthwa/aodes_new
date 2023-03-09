<?php
function brator_daynamic_styles() {
	ob_start();
	$brator_daynamic_styles_array = array();
	if ( is_page() ) {
		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		if ( $featured_img_url ) {
			$page_breadcrumb_bg             = '
                .page-breadcrumb {
                    background-image: url(' . esc_url( $featured_img_url ) . ');
                }
                ';
			$brator_daynamic_styles_array[] = $page_breadcrumb_bg;
		}
	}
	if ( is_single() ) :
		if ( get_post_type( get_the_ID() ) == 'post' ) :
			$blog_featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			if ( $blog_featured_img_url ) {
				$pblog_age_breadcrumb_bg        = '
                    .blog-single-breadcrumb {
                        background-image: url(' . esc_url( $blog_featured_img_url ) . ');
                    }
                    ';
				$brator_daynamic_styles_array[] = $pblog_age_breadcrumb_bg;
			}
		endif;
	endif;

	$brator_daynamic_styles_array_expolord = implode( ' ', $brator_daynamic_styles_array );
	$brator_custom_css                     = ob_get_clean();
	return $brator_daynamic_styles_array_expolord;
}

function brator_get_custom_color() {
	$primary_color = brator_get_options( 'primary_color' );
	$menu_bg_color = brator_get_options( 'menu_bg_color' );

	$footer_bg                = brator_get_options( 'footer_bg' );
	$footer_bg_bottom         = brator_get_options( 'footer_bg_bottom' );
	$footer_bottom_text_color = brator_get_options( 'footer_bottom_text_color' );
	$footer_bottom_link_color = brator_get_options( 'footer_bottom_link_color' );

	$brator_core_footer_background        = get_post_meta( get_the_ID(), 'brator_core_footer_background', true );
	$brator_core_footer_background_bottom = get_post_meta( get_the_ID(), 'brator_core_footer_background_bottom', true );

	ob_start();

	if ( isset( $brator_core_footer_background ) && ! empty( $brator_core_footer_background ) ) {
		?>
			.brator-footer-top-area {
				background: <?php echo esc_attr( $brator_core_footer_background ); ?>;
			}
		<?php
	} elseif ( isset( $footer_bg ) && ! empty( $footer_bg ) ) {
		?>
			.brator-footer-top-area {
				background: <?php echo esc_attr( $footer_bg ); ?>;
			}
		<?php
	}

	if ( ( isset( $brator_core_footer_background_bottom ) ) && ( ! empty( $brator_core_footer_background_bottom ) ) ) {
		?>
			.brator-footer-area {
				background: <?php echo esc_attr( $brator_core_footer_background_bottom ); ?>;
			}
		<?php
	} elseif ( ( isset( $footer_bg_bottom ) ) && ( ! empty( $footer_bg_bottom ) ) ) {
		?>
			.brator-footer-area {
				background: <?php echo esc_attr( $footer_bg_bottom ); ?>;
			}
		<?php
	}

	if ( ( isset( $footer_bottom_text_color ) ) && ( ! empty( $footer_bottom_text_color ) ) ) {
		?>
			.brator-social-link h6,
			.brator-payment-area h6.brator-payment-title,
			.brator-copyright-area p{
				color: <?php echo esc_attr( $footer_bottom_text_color ); ?>;
			}
		<?php
	}

	if ( ( isset( $footer_bottom_link_color ) ) && ( ! empty( $footer_bottom_link_color ) ) ) {
		?>
			.brator-copyright-area p a,
			.brator-social-link a{
				color: <?php echo esc_attr( $footer_bottom_link_color ); ?>;
				fill: <?php echo esc_attr( $footer_bottom_link_color ); ?>;
			}
		<?php
	}

	if ( ( isset( $primary_color ) ) && ( ! empty( $primary_color ) ) ) {
		?>
		:root {
			--color-high-dark: <?php echo esc_attr( $primary_color ); ?>;
		}
		<?php
	}
	if ( ( isset( $menu_bg_color ) ) && ( ! empty( $menu_bg_color ) ) ) {
		?>
		.brator-header-menu-area.red-variant {
			background: <?php echo esc_attr( $menu_bg_color ); ?> !important;
		}
		<?php
	}

	$brator_custom_css = ob_get_clean();
	return $brator_custom_css;
}
