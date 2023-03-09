<?php
$footer_widget_elementor_meta = get_post_meta( get_the_ID(), 'brator_core_footer_template', true );

if ( $footer_widget_elementor_meta ) {
	$footer_widget_elementor = $footer_widget_elementor_meta;
} else {
	// $footer_widget_elementor = brator_get_options( 'footer_template' );
	$footer_widget_elementor = 1921;
}

$footer_style = get_post_meta( get_the_ID(), 'brator_core_footer_style', true );
if($footer_style == ""){
	$footer_style = "3";
}
if ( $footer_style == '2' || $footer_style == '3' ) {
	$footer_class = 'brator-footer-top-area gray-bg design-two design-three';

} else {
	$footer_class = 'brator-footer-top-area';
}
if ( $footer_style == '3' ) {
	$footer_class_container = 'container-lg-c container';
} else {
	$footer_class_container = 'container-xxxl container-xxl container';
}

if ( $footer_style == '2' ) { ?>
<div class="brator-plan-pixel-area gray-bg footer-line">
	<div class="row">
		<div class="container-xxxl container-xxl container">
		  <div class="col-12">
			<div class="plan-pixel-area"></div>
		  </div>
		</div>
	</div>
</div>
	<?php
}
if ( $footer_widget_elementor ) {
	?>
		<div class="<?php echo esc_attr( $footer_class ); ?>">
			<div class="<?php echo esc_attr( $footer_class_container ); ?>">
				<section class="footer">

					<div class="footer-icon">
						<div class="footer-icon-tag">
							<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/footer-icon.png" alt="image" class="img-fluid">
						</div>
						<div class="footer-icon-tag">
							<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/footer-icon-2.png" alt="image" class="img-fluid">
							</div>
						<div class="footer-icon-tag">
							<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/footer-icon-3.png" alt="image" class="img-fluid">
						</div>
						</div>
						<div class="under-line">
						<img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/horizontal-line.png" alt="image" class="img-fluid">
					</div>
				</section>
				<?php
				if ( class_exists( '\\Elementor\\Plugin' ) ) :
					$pluginElementor         = \Elementor\Plugin::instance();
					$footer_widget_elementor = $pluginElementor->frontend->get_builder_content( $footer_widget_elementor );
					echo do_shortcode( $footer_widget_elementor );
				endif;
				?>
			</div>
		</div>
	<?php
}
