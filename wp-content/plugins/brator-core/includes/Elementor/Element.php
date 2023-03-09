<?php
namespace Brator\Helper\Elementor;

use Elementor\Plugin;

class Element {

	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
		add_action( 'elementor/widgets/register', array( $this, 'widgets_registered' ) );
	}
	public function widgets_registered() {
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Main_Slider() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Blog() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Clients() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_App_Banner() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Testimonial() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Offer_Slider() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Shop_Category() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Why_Chooseus() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Story() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Page_Banner() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Team() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Newsletter() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Contact_US() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Collapse_Content() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Makes_List() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Products_Section() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Coming_Soon() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Footer_About() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Footer_Links() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Mega_Menu() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Search_Form() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Banner() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Hot_Offer_Slider() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Tabs() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Footer_Newsletter() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Footer_About_Two() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Recently_Viewed_Products() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Megasell_Slider() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Feature_Box() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Reviews() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Brand_Box() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Category_Dropdown() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Sidebar_Products() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Sidebar_Testimonial() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_List_Products() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Sidebar_Blog() );
		Plugin::instance()->widgets_manager->register( new Widgets\Brator_Banner_Slider() );
	}
	function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'brator',
			array(
				'title' => __( 'Brator', 'brator' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}
}
