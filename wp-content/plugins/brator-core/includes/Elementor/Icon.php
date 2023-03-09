<?php
namespace Brator\Helper\Elementor;

class Icon {

	public function __construct() {
		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'brator_icon' ) );
	}

	function brator_icon( $array ) {
		$plugin_url = plugins_url();

		return array(
			'custom-icon' => array(
				'name'          => 'custom-icon',
				'label'         => 'Brator Icon',
				'url'           => '',
				'enqueue'       => array(
					$plugin_url . '/brator-core/assets/elementor/icon/icons-style.css',
				),
				'prefix'        => '',
				'displayPrefix' => '',
				'labelIcon'     => 'brator-icon',
				'ver'           => '',
				'fetchJson'     => $plugin_url . '/brator-core/assets/elementor/icon/js/regular.js',
				'native'        => 1,
			),
		);
	}
}
