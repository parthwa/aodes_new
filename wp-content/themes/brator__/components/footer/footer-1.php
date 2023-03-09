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
<footer class="brator-footer-area">
	<div class="container-xxxl container-xxl container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12">
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
			<?php
			if ( $footer_payment_icons ) {
				?>
			<div class="col-lg-4 col-md-6 col-12">
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
			<?php if ( ! empty( $footer_twitter_url ) || ! empty( $footer_facebook_url ) || ! empty( $footer_youtube_url ) || ! empty( $footer_instagram_url ) ) { ?>
			<div class="col-lg-4 col-12">
				<div class="brator-social-link svg-link">
					<h6 class="brator-social-link"><?php echo esc_html( $footer_social_title ); ?></h6>
					<?php if ( ! empty( $footer_twitter_url ) ) { ?>
					<a href="<?php echo esc_url( $footer_twitter_url ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><path d="M56.9,14.8l3.9-4.9C62,8.6,62.3,7.6,62.4,7c-3,1.9-5.9,2.5-7.9,2.5h-0.8L53.2,9c-2.5-2.2-5.5-3.4-8.9-3.4c-7.2,0-13,5.9-13,13c0,0.5,0,1,0.1,1.5l0.3,2.1l-2.2-0.1C16.3,21.8,5.5,10.5,3.7,8.5c-2.9,5.3-1.3,10.2,0.5,13.3l3.5,5.8l-5.5-3c0.1,4.3,1.8,7.7,4.9,10.2l2.7,2L7,37.9c1.8,5.3,5.6,7.4,8.6,8.3l3.8,1l-3.3,2.3c-5.7,4-13,3.8-16.1,3.5c6.6,4.5,14.2,5.5,19.7,5.5c4,0,7-0.5,7.7-0.7c29-6.8,30.3-32.6,30.2-37.8v-0.8l0.6-0.5c3.5-3.3,5-5.1,5.8-6.1c-0.3,0.2-0.7,0.3-1.2,0.4L56.9,14.8z"></path>
					</svg></a>
					<?php } ?>
					<?php if ( ! empty( $footer_facebook_url ) ) { ?>
					<a href="<?php echo esc_url( $footer_facebook_url ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><path d="M47.9,25.6L47.9,25.6h-5.8H40v-2.1v-6.4v-2.1h2.1h4.4c1.1,0,2-0.9,2-2V2c0-1.1-0.9-2-2-2h-7.6c-8.2,0-13.9,5.9-13.9,14.4v9.1v2.1h-2.1H16c-1.5,0-2.7,1.2-2.7,2.8v7.4c0,1.5,1.2,2.7,2.7,2.7h6.9h2.1v2.1v20.8c0,1.5,1.2,2.7,2.7,2.7h9.8c0.6,0,1.2-0.3,1.6-0.7c0.5-0.5,0.7-1.2,0.7-1.8l0,0v0V40.5v-2.1H42h4.6c1.3,0,2.4-0.9,2.6-2.1l0-0.1l0-0.1l1.4-7.1c0.2-0.8,0-1.6-0.6-2.4C49.6,26.1,48.8,25.7,47.9,25.6z"></path>
					</svg></a>
					<?php } ?>
					<?php if ( ! empty( $footer_youtube_url ) ) { ?>
					<a href="<?php echo esc_url( $footer_youtube_url ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><path d="M62.7,16.6c-0.7-2.8-2.9-4.9-5.7-5.7c-5-1.3-25-1.3-25-1.3s-20,0-25,1.3c-2.8,0.7-4.9,2.9-5.7,5.7C0,21.6,0,32,0,32  s0,10.4,1.3,15.4c0.7,2.8,2.9,4.9,5.7,5.7c5,1.3,25,1.3,25,1.3s20,0,25-1.3c2.8-0.7,4.9-2.9,5.7-5.7C64,42.4,64,32,64,32  S64,21.6,62.7,16.6z M25.6,41.6V22.4L42.2,32L25.6,41.6z"></path>
					</svg></a>
					<?php } ?>
					<?php if ( ! empty( $footer_instagram_url ) ) { ?>
					<a href="<?php echo esc_url( $footer_instagram_url ); ?>"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M62.9,19.2c-0.1-3.2-0.7-5.5-1.4-7.6S59.7,7.8,58,6.1s-3.4-2.7-5.4-3.5c-2-0.8-4.2-1.3-7.6-1.4C41.5,1,40.5,1,32,1s-9.4,0-12.8,0.1s-5.5,0.7-7.6,1.4S7.8,4.4,6.1,6.1s-2.8,3.4-3.5,5.5c-0.8,2-1.3,4.2-1.4,7.6S1,23.5,1,32s0,9.4,0.1,12.8c0.1,3.4,0.7,5.5,1.4,7.6c0.7,2.1,1.8,3.8,3.5,5.5s3.5,2.8,5.5,3.5c2,0.7,4.2,1.3,7.6,1.4C22.5,63,23.4,63,31.9,63s9.4,0,12.8-0.1s5.5-0.7,7.6-1.4c2.1-0.7,3.8-1.8,5.5-3.5s2.8-3.5,3.5-5.5c0.7-2,1.3-4.2,1.4-7.6c0.1-3.2,0.1-4.2,0.1-12.7S63,22.6,62.9,19.2zM57.3,44.5c-0.1,3-0.7,4.6-1.1,5.8c-0.6,1.4-1.3,2.5-2.4,3.5c-1.1,1.1-2.1,1.7-3.5,2.4c-1.1,0.4-2.7,1-5.8,1.1c-3.2,0-4.2,0-12.4,0s-9.3,0-12.5-0.1c-3-0.1-4.6-0.7-5.8-1.1c-1.4-0.6-2.5-1.3-3.5-2.4c-1.1-1.1-1.7-2.1-2.4-3.5c-0.4-1.1-1-2.7-1.1-5.8c0-3.1,0-4.1,0-12.4s0-9.3,0.1-12.5c0.1-3,0.7-4.6,1.1-5.8c0.6-1.4,1.3-2.5,2.3-3.5c1.1-1.1,2.1-1.7,3.5-2.3c1.1-0.4,2.7-1,5.8-1.1c3.2-0.1,4.2-0.1,12.5-0.1s9.3,0,12.5,0.1c3,0.1,4.6,0.7,5.8,1.1c1.4,0.6,2.5,1.3,3.5,2.3c1.1,1.1,1.7,2.1,2.4,3.5c0.4,1.1,1,2.7,1.1,5.8c0.1,3.2,0.1,4.2,0.1,12.5S57.4,41.3,57.3,44.5z"/><path d="M32,16.1c-8.9,0-15.9,7.2-15.9,15.9c0,8.9,7.2,15.9,15.9,15.9S48,40.9,48,32S40.9,16.1,32,16.1z M32,42.4c-5.8,0-10.4-4.7-10.4-10.4S26.3,21.6,32,21.6c5.8,0,10.4,4.6,10.4,10.4S37.8,42.4,32,42.4z"/><ellipse cx="48.7" cy="15.4" rx="3.7" ry="3.7"/></g></svg></a>
					<?php } ?>
				</div>
			</div>
		  <?php } ?>
		</div>
	</div>
</footer>
