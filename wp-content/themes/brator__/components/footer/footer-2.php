<?php
$footer_copyright     = brator_get_options( 'footer_copyright' );
?>
<footer class="brator-footer-area gray-bg design-two design-three">
	<div class="container-xxxl container-xxl container">
		<div class="row">
		  <div class="col-12">
			<div class="brator-copyright-area">
			  <p>					
				<?php
				if ( $footer_copyright != '' ) :
					echo wp_kses( $footer_copyright, 'code_contxt' );
				else :
					esc_html_e( '&copy; 2021 Copyrights by Brator Inc. All Rights Reserved.', 'brator' );
				endif;
				?>
				</p>
			</div>
		  </div>
		</div>
	</div>
</footer>