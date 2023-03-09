<?php
$footer_copyright     = brator_get_options( 'footer_copyright' );
$footer_payment_title = brator_get_options( 'footer_payment_title' );
$footer_social_title  = brator_get_options( 'footer_social_title' );
$footer_payment_icons = brator_get_options( 'footer_payment_icons' );
$footer_twitter_url   = brator_get_options( 'footer_twitter_url' );
$footer_facebook_url  = brator_get_options( 'footer_facebook_url' );
$footer_youtube_url   = brator_get_options( 'footer_youtube_url' );
$footer_instagram_url = brator_get_options( 'footer_instagram_url' );
?>
<footer class="brator-footer-area home-three-footer brator-footer-three-area">
	<div class="container-lg-c container">
		
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="brator-copyright-area">
					<p>					
					<?php
					if ( $footer_copyright != '' ) :
						echo wp_kses( $footer_copyright, 'code_contxt' );
					else :
						esc_html_e( '&copy; 2022 Copyrights by Brator Inc. All Rights Reserved.', 'brator' );
					endif;
					?>
					</p>
				</div>
			</div>
			<?php if ( $footer_payment_icons ) { ?>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="brator-payment-area svg-link">
				<h6 class="brator-payment-title"><?php echo esc_html( $footer_payment_title ); ?></h6>
					<?php
					foreach ( $footer_payment_icons as $item ) {
						$icon_image = $item['icon_image'];
						$icon_url   = $item['icon_url'];
						?>
						<a href="<?php echo esc_url( $icon_url ); ?>"><img src="<?php echo esc_url( $icon_image ); ?>"/></a>
						<?php
					}
					?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</footer>
