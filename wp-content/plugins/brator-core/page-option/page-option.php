<?php
function brator_sidebar_list() {
	 $sidebars_list  = array();
	$get_all_sidebar = $GLOBALS['wp_registered_sidebars'];
	if ( ! empty( $get_all_sidebar ) ) {
		foreach ( $get_all_sidebar as $sidebar ) {
			$sidebars_list[ $sidebar['id'] ] = $sidebar['name'];
		}
	}
	return $sidebars_list;
}

add_filter( 'rwmb_meta_boxes', 'brator_core_page_meta_box' );
function brator_core_page_meta_box( $meta_boxes ) {

	$prefix     = 'brator_core';
	$posts_page = get_option( 'page_for_posts' );
	if ( ! isset( $_GET['post'] ) || intval( $_GET['post'] ) != $posts_page ) {
		$meta_boxes[] = array(
			'id'       => $prefix . '_posts_meta_box',
			'title'    => esc_html__( 'Posts Settings', 'brator-core' ),
			'pages'    => array(
				'post',
			),
			'context'  => 'normal',
			'priority' => 'core',
			'fields'   => array(
				array(
					'name' => 'Featured',
					'id'   => "{$prefix}_post_featured",
					'type' => 'checkbox',
					'std'  => 0,
				),
			),
		);
		$meta_boxes[] = array(
			'id'       => $prefix . '_page_wiget_meta_box',
			'title'    => esc_html__( 'Post Widget Settings', 'brator-core' ),
			'pages'    => array(
				'page',
			),
			'context'  => 'normal',
			'priority' => 'core',
			'fields'   => array(
				array(
					'id'      => "{$prefix}_header_style",
					'name'    => esc_html__( 'Header Style', 'brator-core' ),
					'type'    => 'select',
					'options' => array(
						'0' => 'Header Select',
						'1' => 'Header Style 01',
						'2' => 'Header Style 02',
						'3' => 'Header Style 03',
						'4' => 'Header Style 04',
					),
				),
				array(
					'id'      => "{$prefix}_footer_style",
					'name'    => esc_html__( 'Footer Style', 'brator-core' ),
					'type'    => 'select',
					'options' => array(
						'0' => 'Footer Select',
						'1' => 'Footer Style 01',
						'2' => 'Footer Style 02',
						'3' => 'Footer Style 03',
					),
				),
				array(
					'id'   => "{$prefix}_footer_background",
					'name' => esc_html__( 'Footer background', 'brator-core' ),
					'type' => 'color',
				),
				array(
					'id'   => "{$prefix}_footer_background_bottom",
					'name' => esc_html__( 'Footer background bottom', 'brator-core' ),
					'type' => 'color',
				),
				array(
					'id'      => "{$prefix}_footer_template",
					'name'    => esc_html__( 'Footer Elementor Template', 'brator-core' ),
					'type'    => 'select',
					'std'     => 'Footer Widgets',
					'options' => brator_core_elementor_library(),
				),
				array(
					'id'      => "{$prefix}_show_breadcrumb",
					'name'    => esc_html__( 'Show Breadcrumb', 'arcix' ),
					'desc'    => '',
					'type'    => 'radio',
					'std'     => 'on',
					'options' => array(
						'on'  => 'On',
						'off' => 'Off',
					),
				),
				array(
					'id'              => "{$prefix}_sidebar_list",
					'name'            => 'Sidebar Select for page',
					'type'            => 'select',
					'options'         => brator_sidebar_list(),
					'multiple'        => false,
					'placeholder'     => 'Select an Item',
					'select_all_none' => false,
				),
				array(
					'id'      => "{$prefix}_framework_page_style",
					'name'    => esc_html__( 'Sidebar Position', 'brator-core' ),
					'desc'    => '',
					'type'    => 'radio',
					'std'     => 'left',
					'options' => array(
						'left'  => 'Left',
						'right' => 'right',
					),
				),
			),
		);

	}
	return $meta_boxes;
}
add_action( 'sidebar_left', 'sidebar_left_fun', 99 );
function sidebar_left_fun() {
	$framework_page_style = get_post_meta( get_the_ID(), 'brator_core_framework_page_style', true );
	if ( $framework_page_style == 'left' ) :
		$brator_core_sidebar_list = get_post_meta( get_the_ID(), 'brator_core_sidebar_list', true );
		if ( $brator_core_sidebar_list != '' ) {
			if ( is_active_sidebar( $brator_core_sidebar_list ) ) { ?>
				<div class="col-lg-4 col-sm-12">
					<div class="blog-sidebar">
						<?php dynamic_sidebar( $brator_core_sidebar_list ); ?>
					</div>
				</div>
				<?php
			}
		}
	endif;
}

add_action( 'sidebar_right', 'sidebar_right_fun', 99 );
function sidebar_right_fun() {
	$framework_page_style = get_post_meta( get_the_ID(), 'brator_core_framework_page_style', true );
	if ( $framework_page_style == 'right' ) :
		$brator_core_sidebar_list = get_post_meta( get_the_ID(), 'brator_core_sidebar_list', true );
		if ( $brator_core_sidebar_list != '' ) {
			?>
			<?php if ( is_active_sidebar( $brator_core_sidebar_list ) ) { ?>
				<div class="col-lg-4 col-sm-12">
					<div class="blog-sidebar">
						<?php dynamic_sidebar( $brator_core_sidebar_list ); ?>
					</div>
				</div>
				<?php
			}
		}
	endif;
}
