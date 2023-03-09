<header>
	<?php
	$header_widget_elementor = brator_get_options('header_widget_elementor');
	if (class_exists('\\Elementor\\Plugin')) {
		$pluginElementor = \Elementor\Plugin::instance();
		$brator_all_ssave_elements = $pluginElementor->frontend->get_builder_content($header_widget_elementor);
		echo do_shortcode($brator_all_ssave_elements);
	}
	?>
</header>