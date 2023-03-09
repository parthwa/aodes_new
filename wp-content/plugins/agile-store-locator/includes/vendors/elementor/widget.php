<?php


namespace AgileStoreLocator\Vendors\Elementor;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direptly.
}


/**
 * Elementor AgileStoreLocatorAddonWidget
 *
 * Elementor widget for AgileStoreLocatorAddonWidget
 *
 * @since 1.0.0
 */
class Widget extends \Elementor\Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'agile-store-locator-addon';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Store Locator', 'asl-admin' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-map-pin';
	}


	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'asl-admin' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [];
	}


	/**
	 * Check for empty values and return provided default value if required
	 */
	protected function set_default( $value, $default ){
		if( isset($value) && $value!="" ){
			return $value;
		}else{
			return $default;
		}
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Agile Store Locator Shortcode', 'asl-admin' ),
			]
		);	

		$this->add_control(
			'agileStoreLocator_notice',
			[
				'label' => __( '', 'asl-admin' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<strong style="color:red">It is only a shortcode builder. Kindly update/publish the page and check the actually Agile Store Locator on front-end</strong>',
				'content_classes' => 'agileStoreLocator_notice',
			]
		);


		$this->add_control(
			'search_type',
			[
				'label' => __( 'Search Type', 'asl-admin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => '0',
				'options' => array(
					'0' => esc_attr__('Search By Address','asl-admin'),
					'3' => esc_attr__('Geocoding on Enter key','asl-admin'),
				),
			]
		);

		$this->add_control(
			'prompt_location',
			[
				'label' => __( 'Prompt Location', 'asl-admin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => '0',
				'options' => array(
					'0' => esc_attr__('Disable','asl-admin'),
					'1' => esc_attr__('Geo-location Box','asl-admin'),
					'2' => esc_attr__('Type your Location','asl-admin'),
					'3' => esc_attr__('Geolocation On Load','asl-admin'),
					'4' => esc_attr__('GeoJS IP Service','asl-admin'),
				),
			]
		);

		$this->add_control(
			'distance_unit',
			[
				'label' => esc_html__( 'Distance Unit', 'asl-admin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'Miles',
				'options' => [
					'Miles' => esc_html__( 'Miles', 'asl-admin' ),
					'KM' => esc_html__( 'KM', 'asl-admin' )
				],

			]
		);

		$this->add_control(
			'time_format',
			[
				'label' => esc_html__( 'Time Format', 'asl-admin' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => '0',
				'options' => [
					'0' => esc_html__( '12 Hours', 'asl-admin' ),
					'1' => esc_html__( '24 Hours', 'asl-admin' )
				],

			]
		);
		
		$this->end_controls_section();

		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings();

		$shortcode_attr = array();


		// Select Search Type
		((!empty($settings['search_type']) || $settings['search_type'] == '0') ? $shortcode_attr['search_type'] = 'search_type="'.$settings['search_type'].'"' : '0' );

		//	Distance Unit
		((!empty($settings['distance_unit']) || $settings['distance_unit'] == 'KM') ? $shortcode_attr['distance_unit'] = 'distance_unit="'.$settings['distance_unit'].'"' : 'Miles' );

		// Layout Selection
		((!empty($settings['time_format'])  || $settings['time_format'] == '0') ? $shortcode_attr['time_format'] = 'time_format="'.$settings['time_format'].'"' : '1' );

		// Select Prompt Location
		((!empty($settings['prompt_location']) || $settings['prompt_location'] == '0') ? $shortcode_attr['prompt_location'] = 'prompt_location="'.$settings['prompt_location'].'"' : '0' );


		$shortcode_attr = implode(' ', $shortcode_attr);
		$shortcode = '[ASL_STORELOCATOR '.$shortcode_attr.']';


		echo'<div class="elementor-shortcode asl-free-addon">';
		echo $shortcode;
 		echo'</div>';
	}	
}
