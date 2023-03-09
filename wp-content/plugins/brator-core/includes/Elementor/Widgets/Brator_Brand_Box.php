<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Brand_Box extends Widget_Base {
    
	public function get_name() {
		return 'brator_brand_box';
	}

	public function get_title() {
		return esc_html__( 'Brator Brand Box', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}
    
    protected function register_controls() {
		$this->start_controls_section(
			'brator_brand_box_area',
			array(
				'label' => esc_html__( 'Area', 'brator-core' ),
			)
		);
		$this->add_control(
			'area_title',
			array(
				'label'   => esc_html__( 'Area Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Featured Brands', 'brator-core' ),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'brator_brand_box_list',
			array(
				'label' => esc_html__( 'List Items', 'brator-core' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__( 'Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Wireless Controller', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_title_sub',
			array(
				'label'   => esc_html__( 'Title Sub', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'xbox onedual vibration', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_url',
			array(
				'label'         => esc_html__( 'URL', 'brator-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'brator-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);
        $repeater->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				]
			]
		);
        $repeater->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'brator_brand_box_items',
			array(
				'label'   => esc_html__( 'Items List', 'brator-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls()
			)
		);
		$this->end_controls_section();
    }
	protected function render() {
		$settings = $this->get_settings_for_display();
		    $brator_brand_box_items = $settings['brator_brand_box_items'];
        ?>
            <section class="brator-service-area">
                <div class="container container-xxxl container-xxl">
                    <div class="row">
                        <?php
                            foreach ( $brator_brand_box_items as $item ) {
                                $item_image        = ( $item['item_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_image']['id'], 'full' ) : $item['item_image']['url'];
								$item_image_alt = get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true );

                                $item_title        = $item['item_title'];
                                $item_title_sub    = $item['item_title_sub'];

                                $item_url          = $item['item_url']['url'];
                                $item_url_external = $item['item_url']['is_external'] ? 'target="_blank"' : '';
                                $item_url_nofollow = $item['item_url']['nofollow'] ? 'rel="nofollow"' : '';
                            
                                $title_color       = $item['title_color'];
                                $sub_title_color   = $item['sub_title_color'];
                        ?>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php
    }
}