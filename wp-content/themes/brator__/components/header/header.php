<?php
$header_style_meta = get_post_meta( get_the_ID(), 'brator_core_header_style', true );
if ( $header_style_meta ) {
	$header_style = $header_style_meta;
} else {
	// $header_style = brator_get_options( 'header_style' );
	$header_style = '3';
}
if ( $header_style == '5' ) :
	get_template_part( 'components/header/header-style/header-style-elementor' );
elseif ( $header_style == '4' ) :
	get_template_part( 'components/header/header-style/header-style-4' );
elseif ( $header_style == '3' ) :
	get_template_part( 'components/header/header-style/header-style-3' );
elseif ( $header_style == '2' ) :
	get_template_part( 'components/header/header-style/header-style-2' );
elseif ( $header_style == '1' ) :
	get_template_part( 'components/header/header-style/header-style-1' );
else :
	get_template_part( 'components/header/header-style/header-style-default' );
endif;

