<?php
$opt_pref = 'brator_theme_option';

new \Kirki\Panel(
	$opt_pref,
	array(
		'priority' => 10,
		'title'    => esc_html__( 'Brator Option', 'brator' ),
	)
);

new \Kirki\Section(
	'demo_manage',
	array(
		'title' => esc_html__( 'Demo Manage', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'demo_select',
		'label'    => esc_html__( 'Demo Select', 'brator' ),
		'section'  => 'demo_manage',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'parts'   => esc_html__( 'Parts Demo', 'brator' ),
			'electro' => esc_html__( 'Electro Demo', 'brator' ),
		),
		'default'  => 'parts',
	)
);
new \Kirki\Section(
	'theme_base',
	array(
		'title' => esc_html__( 'Theme Base Option', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'preloader_on_off',
		'label'    => esc_html__( 'Preloader On/Off', 'brator' ),
		'section'  => 'theme_base',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'sticky_header_on_off',
		'label'    => esc_html__( 'Sticky Header On/Off', 'brator' ),
		'section'  => 'theme_base',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'back_to_top_on_off',
		'label'    => esc_html__( 'Back To Top On/Off', 'brator' ),
		'section'  => 'theme_base',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'theme_base_css',
		'label'    => esc_html__( 'Theme base css On/Off', 'brator' ),
		'section'  => 'theme_base',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);



// Header Top Section Area

new \Kirki\Section(
	'header_section',
	array(
		'title' => esc_html__( 'Header Section', 'brator' ),
		'panel' => $opt_pref,

	)
);

new \Kirki\Field\Select(
	array(
		'settings' => 'header_style',
		'label'    => esc_html__( 'Header Style', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'1' => esc_html__( 'Style One', 'brator' ),
			'2' => esc_html__( 'Style Two', 'brator' ),
			'3' => esc_html__( 'Style Three', 'brator' ),
			'4' => esc_html__( 'Style Four', 'brator' ),
			'5' => esc_html__( 'Style Five', 'brator' ),
		),
		'default'  => '1',
	)
);
new \Kirki\Field\Select(
	array(
		'settings'        => 'header_elementor',
		'label'           => esc_html__( 'Header Elementor Template', 'brator' ),
		'section'         => 'header_section',
		'placeholder'     => esc_html__( 'Select an Template', 'brator' ),
		'priority'        => 10,
		'multiple'        => 1,
		'choices'         => brator_elementor_library(),
		'active_callback' => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => '5',
			),
		),
	)
);
new \Kirki\Field\Textarea(
	array(
		'settings' => 'welcome_text',
		'label'    => esc_html__( 'Welcome Text Top', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
	)
);
new \Kirki\Field\Code(
	array(
		'settings' => 'right_content_top',
		'label'    => esc_html__( 'Right Content Top', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
		'choices'  => array(
			'language' => 'html',
		),
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_phone_title',
		'label'    => esc_html__( 'Phone Title', 'brator' ),
		'section'  => 'header_section',
		'default'  => esc_html__( '24 / 7 Support:', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_phone',
		'label'    => esc_html__( 'Phone', 'brator' ),
		'section'  => 'header_section',
		'default'  => esc_html__( '1800 500 1234', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_order_track',
		'label'    => esc_html__( 'Header Order Track', 'brator' ),
		'section'  => 'header_section',
		'default'  => esc_html__( 'Track Order', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'header_order_track_url',
		'label'    => esc_html__( 'Header Order Track URL', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_recently_viewed',
		'label'    => esc_html__( 'Header Recently Viewed', 'brator' ),
		'section'  => 'header_section',
		'default'  => esc_html__( 'Recently Viewed', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'header_recently_viewed_url',
		'label'    => esc_html__( 'Header Recently Viewed URL', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'header_sidebar',
		'label'    => esc_html__( 'Header Sidebar', 'brator' ),
		'section'  => 'header_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'header_search',
		'label'    => esc_html__( 'Header Search', 'brator' ),
		'section'  => 'header_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_quick_search_title',
		'label'    => esc_html__( 'Header Quick Search Title', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
		'default'  => esc_html__( 'QUICK SEARCH', 'brator' ),
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'header_quick_search',
		'label'    => esc_html__( 'Header Quick Search', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
		'multiple' => 999,
		'choices'  => brator_get_all_product_categories(),
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'header_search_by',
		'label'    => esc_html__( 'Header Search By', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
		'choices'  => array(
			'1' => esc_html__( 'Search by Product Name', 'brator' ),
			'2' => esc_html__( 'Search by Product Sku', 'brator' ),
			'3' => esc_html__( 'Search by Brand, Model, Year, Engine', 'brator' ),
		),
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_search_placeholder',
		'label'    => esc_html__( 'Header Search Placeholder', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
		'default'  => esc_html__( 'Search by Part Name ...', 'brator' ),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'header_vehicle_onoff',
		'label'    => esc_html__( 'Header Vehicle On / Off', 'brator' ),
		'section'  => 'header_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_vehicle_text',
		'label'    => esc_html__( 'Header Vehicle Text', 'brator' ),
		'section'  => 'header_section',
		'default'  => esc_html__( 'Add Vehicle', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'header_wishlist_url',
		'label'    => esc_html__( 'Header Wishlist URL', 'brator' ),
		'section'  => 'header_section',
		'priority' => 10,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'header_user',
		'label'    => esc_html__( 'Header User On / Off', 'brator' ),
		'section'  => 'header_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'header_user_text',
		'label'    => esc_html__( 'Header User Text', 'brator' ),
		'section'  => 'header_section',
		'default'  => esc_html__( 'Sign In', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'header_cart',
		'label'    => esc_html__( 'Header Cart On / Off', 'brator' ),
		'section'  => 'header_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Section(
	'brator_breadcrumb',
	array(
		'title' => esc_html__( 'Breadcrumb Section', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Image(
	array(
		'settings' => 'breadcrumb_bg',
		'label'    => esc_html__( 'Breadcrumb BG', 'brator' ),
		'section'  => 'brator_breadcrumb',
	)
);

// Header Menu Section Area
new \Kirki\Section(
	'blog_section',
	array(
		'title' => esc_html__( 'Blog Section', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Select(
	array(
		'settings'    => 'blog_style',
		'label'       => esc_html__( 'Blog Style', 'brator' ),
		'section'     => 'blog_section',
		'placeholder' => esc_html__( 'Select an style', 'brator' ),
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => array(
			'1' => esc_html__( 'Style One', 'brator' ),
			'2' => esc_html__( 'Style Two', 'brator' ),
		),
		'default'     => '1',
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'blog_breadcrumb_switch',
		'label'    => esc_html__( 'Breadcrumb On / Off', 'brator' ),
		'section'  => 'blog_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'blog_list_top',
		'label'    => esc_html__( 'Blog list Top', 'brator' ),
		'section'  => 'blog_section',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => brator_elementor_library(),
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'blog_heading',
		'label'    => esc_html__( 'Blog Grid Heading', 'brator' ),
		'section'  => 'blog_section',
		'default'  => esc_html__( 'Guides & Articles', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\Textarea(
	array(
		'settings' => 'blog_subheading',
		'label'    => esc_html__( 'Blog Subheading', 'brator' ),
		'section'  => 'blog_section',
		'default'  => esc_html__( 'A Gara for you to find more about all guides related to car, read, discuss & share with community tips & exerpeice about vehicle', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'blog_single_breadcrumb_content',
		'label'    => esc_html__( 'Blog Single Title', 'brator' ),
		'section'  => 'blog_section',
		'priority' => 10,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'blog_authore_switch',
		'label'    => esc_html__( 'Author Box On / Off', 'brator' ),
		'section'  => 'blog_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'blog_post_nav_switch',
		'label'    => esc_html__( 'Post Navigation On / Off', 'brator' ),
		'section'  => 'blog_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'blog_related_post_switch',
		'label'    => esc_html__( 'Related Post On / Off', 'brator' ),
		'section'  => 'blog_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'blog_related_product_switch',
		'label'    => esc_html__( 'Related Product On / Off', 'brator' ),
		'section'  => 'blog_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'blog_single_social',
		'label'    => esc_html__( 'Post Social Share On / Off', 'brator' ),
		'section'  => 'blog_section',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
// Footer Section Area
new \Kirki\Section(
	'brator_footer',
	array(
		'title' => esc_html__( 'Footer Section', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Select(
	array(
		'settings'    => 'footer_style',
		'label'       => esc_html__( 'Footer Style', 'brator' ),
		'section'     => 'brator_footer',
		'placeholder' => esc_html__( 'Select an style', 'brator' ),
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => array(
			'1' => esc_html__( 'Style One', 'brator' ),
			'2' => esc_html__( 'Style Two', 'brator' ),
			'3' => esc_html__( 'Style Three', 'brator' ),
		),
		'default'     => '1',
	)
);
new \Kirki\Field\Select(
	array(
		'settings'    => 'footer_template',
		'label'       => esc_html__( 'Footer Template', 'brator' ),
		'section'     => 'brator_footer',
		'placeholder' => esc_html__( 'Select an Elementor Template', 'brator' ),
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => brator_elementor_library(),
	)
);
new \Kirki\Field\Textarea(
	array(
		'settings' => 'footer_copyright',
		'label'    => esc_html__( 'Footer', 'brator' ),
		'section'  => 'brator_footer',
		'priority' => 10,
	)
);
new \Kirki\Field\Text(
	array(
		'settings' => 'footer_payment_title',
		'label'    => esc_html__( 'Payment Title', 'brator' ),
		'section'  => 'brator_footer',
		'default'  => esc_html__( 'Payment Methods', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\Repeater(
	array(
		'label'        => esc_html__( 'Payment Icons', 'brator' ),
		'section'      => 'brator_footer',
		'priority'     => 10,
		'row_label'    => array(
			'type'  => 'text',
			'value' => esc_html__( 'Icon', 'brator' ),
		),
		'button_label' => esc_html__( '"Add new"(optional) ', 'brator' ),
		'settings'     => 'footer_payment_icons',
		'fields'       => array(
			'icon_image' => array(
				'type'    => 'image',
				'label'   => esc_html__( 'Image', 'brator' ),
				'default' => '',
			),
			'icon_url'   => array(
				'type'    => 'text',
				'label'   => esc_html__( 'URL', 'brator' ),
				'default' => '',
			),
		),
	)
);

new \Kirki\Field\Text(
	array(
		'settings' => 'footer_social_title',
		'label'    => esc_html__( 'Social Title', 'brator' ),
		'section'  => 'brator_footer',
		'default'  => esc_html__( 'Follow Us', 'brator' ),
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'footer_twitter_url',
		'label'    => esc_html__( 'Twitter URL', 'brator' ),
		'section'  => 'brator_footer',
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'footer_facebook_url',
		'label'    => esc_html__( 'Facebook URL', 'brator' ),
		'section'  => 'brator_footer',
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'footer_youtube_url',
		'label'    => esc_html__( 'Youtube URL', 'brator' ),
		'section'  => 'brator_footer',
		'priority' => 10,
	)
);
new \Kirki\Field\URL(
	array(
		'settings' => 'footer_instagram_url',
		'label'    => esc_html__( 'Instagram URL', 'brator' ),
		'section'  => 'brator_footer',
		'priority' => 10,
	)
);

new \Kirki\Section(
	'brator_woocommerce',
	array(
		'title' => esc_html__( 'Woocommerce Section', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'shop_layout',
		'label'    => esc_html__( 'Shop Grid / list Layout', 'brator' ),
		'section'  => 'brator_woocommerce',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'grid' => esc_html__( 'Grid Layout', 'brator' ),
			'list' => esc_html__( 'list Layout', 'brator' ),
		),
		'default'  => 'grid',
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'cart_page_template',
		'label'    => esc_html__( 'Cart Page Template', 'brator' ),
		'section'  => 'brator_woocommerce',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => brator_elementor_library(),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'best_seller_porducts',
		'label'    => esc_html__( 'Best Seller Products in Shop Page', 'brator' ),
		'section'  => 'brator_woocommerce',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Number(
	array(
		'settings' => 'best_seller_porducts_show',
		'label'    => esc_html__( 'Best Seller Products Show', 'brator' ),
		'section'  => 'brator_woocommerce',
		'default'  => 10,
		'priority' => 10,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'recently_viewed_porducts',
		'label'    => esc_html__( 'Recently Viewed Products in Shop', 'brator' ),
		'section'  => 'brator_woocommerce',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Number(
	array(
		'settings' => 'recently_viewed_porducts_slide_items',
		'label'    => esc_html__( 'Recently Viewed Products Slide Items in Shop', 'brator' ),
		'section'  => 'brator_woocommerce',
		'default'  => 5,
		'priority' => 10,
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'product_layout',
		'label'    => esc_html__( 'Product Layout', 'brator' ),
		'section'  => 'brator_woocommerce',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'1' => esc_html__( 'Layout One', 'brator' ),
			'2' => esc_html__( 'Layout Two', 'brator' ),
		),
		'default'  => '1',
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'recently_viewed_porducts_product_page',
		'label'    => esc_html__( 'Recently Viewed Products in Product Page', 'brator' ),
		'section'  => 'brator_woocommerce',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Section(
	'advanced_search_form',
	array(
		'title' => esc_html__( 'Advanced Search Form', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'engine_onof_switch',
		'label'    => esc_html__( 'Engine', 'brator' ),
		'section'  => 'advanced_search_form',
		'default'  => 'on',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'fuel_type_onoff_switch',
		'label'    => esc_html__( 'Fuel Type', 'brator' ),
		'section'  => 'advanced_search_form',
		'default'  => 'on',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'models_show_from',
		'label'    => esc_html__( 'Models show in search from', 'brator' ),
		'section'  => 'advanced_search_form',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'1' => esc_html__( 'All models', 'brator' ),
			'2' => esc_html__( 'From Selected in Brand', 'brator' ),
		),
		'default'  => '1',
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'engines_show_from',
		'label'    => esc_html__( 'Engines show in search from', 'brator' ),
		'section'  => 'advanced_search_form',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'1' => esc_html__( 'All Engines', 'brator' ),
			'2' => esc_html__( 'From Selected in Model', 'brator' ),
		),
		'default'  => '1',
	)
);
new \Kirki\Field\Select(
	array(
		'settings' => 'fueltype_show_from',
		'label'    => esc_html__( 'Fueltype show in search from', 'brator' ),
		'section'  => 'advanced_search_form',
		'priority' => 10,
		'multiple' => 1,
		'choices'  => array(
			'1' => esc_html__( 'All Fueltype', 'brator' ),
			'2' => esc_html__( 'From Selected in Engine', 'brator' ),
		),
		'default'  => '1',
	)
);
// typography
new \Kirki\Section(
	'brator_typography_option',
	array(
		'title' => esc_html__( 'Typography', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Checkbox_Switch(
	array(
		'settings' => 'enable_typography',
		'label'    => esc_html__( 'Enable or Disable Typography', 'brator' ),
		'section'  => 'brator_typography_option',
		'priority' => 10,
		'choices'  => array(
			'on'  => esc_html__( 'Enable', 'brator' ),
			'off' => esc_html__( 'Disable', 'brator' ),
		),
	)
);
new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator_typography_setting',
		'label'     => esc_html__( 'Body Typography', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'body', 'p', 'ul', 'li', 'button', ' . theme - btn', ' . button', ' . input - text', 'a' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => '==',
				'value'    => '1',
			),
		),
	)
);
new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator-heading-1-typograph',
		'label'     => esc_html__( 'H1 Font', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'h1' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => '==',
				'value'    => '1',
			),
		),
	)
);

new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator-heading-2-typograph',
		'label'     => esc_html__( 'H2 Font', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'h2' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => '==',
				'value'    => '1',
			),
		),
	)
);

new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator-heading-3-typograph',
		'label'     => esc_html__( 'H3 Font', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'h3' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => '==',
				'value'    => '1',
			),
		),
	)
);

new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator-heading-4-typograph',
		'label'     => esc_html__( 'H4 Font', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'h4' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => '==',
				'value'    => '1',
			),
		),
	)
);

new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator-heading-5-typograph',
		'label'     => esc_html__( 'H5 Font', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'h5' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => '==',
				'value'    => '1',
			),
		),
	)
);

new \Kirki\Field\Typography(
	array(
		'settings'  => 'brator-heading-6-typograph',
		'label'     => esc_html__( 'H6 Font', 'brator' ),
		'section'   => 'brator_typography_option',
		'default'   => array(
			'font-family'    => '',
			'variant'        => '',
			'font-size'      => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'color'          => '',
			'text-transform' => 'none',
			'text-align'     => '',
		),
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element' => array( 'h6' ),
			),
		),
		'required'  => array(
			array(
				'setting'  => 'enable_typography',
				'operator' => ' == ',
				'value'    => '1',
			),
		),
	)
);
new \Kirki\Section(
	'brator_color_option',
	array(
		'title' => esc_html__( 'Color Option', 'brator' ),
		'panel' => $opt_pref,
	)
);
new \Kirki\Field\Color(
	array(
		'settings' => 'primary_color',
		'label'    => esc_html__( 'Primary Color', 'brator' ),
		'section'  => 'brator_color_option',
		'priority' => 10,
	)
);
new \Kirki\Field\Color(
	array(
		'settings' => 'menu_bg_color',
		'label'    => esc_html__( 'Header 3 Menu BG Color', 'brator' ),
		'section'  => 'brator_color_option',
		'priority' => 10,
	)
);
new \Kirki\Field\Color(
	array(
		'settings' => 'footer_bg',
		'label'    => esc_html__( 'Footer background', 'brator' ),
		'section'  => 'brator_color_option',
		'priority' => 10,
	)
);
new \Kirki\Field\Color(
	array(
		'settings' => 'footer_bottom_text_color',
		'label'    => esc_html__( 'Footer bottom text color', 'brator' ),
		'section'  => 'brator_color_option',
		'priority' => 10,
	)
);
new \Kirki\Field\Color(
	array(
		'settings' => 'footer_bottom_link_color',
		'label'    => esc_html__( 'Footer bottom link color', 'brator' ),
		'section'  => 'brator_color_option',
		'priority' => 10,
	)
);
