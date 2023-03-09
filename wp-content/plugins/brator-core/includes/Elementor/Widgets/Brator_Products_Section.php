<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

class Brator_Products_Section extends Widget_Base
{

	public function get_name()
	{
		return 'brator_products_section';
	}

	public function get_title()
	{
		return esc_html__('Products Section', 'brator-core');
	}

	public function get_icon()
	{
		return 'sds-widget-ico';
	}

	public function get_categories()
	{
		return array('brator');
	}

	private function grid_get_all_post_type_categories()
	{
		$options  = array();
		$taxonomy = 'product_cat';
		if (!empty($taxonomy)) {
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => true,
				)
			);
			if (!empty($terms)) {
				foreach ($terms as $term) {
					if (isset($term)) {
						if (isset($term->slug) && isset($term->name)) {
							$options[$term->slug] = $term->name;
						}
					}
				}
			}
		}

		return $options;
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'general_setting',
			array(
				'label' => esc_html__('General Settings', 'brator-core'),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__('Title', 'brator-core'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Deals of The Week', 'brator-core'),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__('Button Text', 'brator-core'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('See All Products', 'brator-core'),
			)
		);
		$this->add_control(
			'button_url',
			array(
				'label'         => esc_html__('Button URL', 'brator-core'),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__('https://your-link.com', 'brator-core'),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);
		$this->add_control(
			'heading_alignment',
			array(
				'label'   => __('Heading Alignment', 'brator-core'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array(
						'title' => __('Left', 'brator-core'),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => __('Right', 'brator-core'),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default' => 'right',
				'toggle'  => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_settings',
			array(
				'label' => esc_html__('Content Settings', 'brator-core'),
			)
		);
		$this->add_control(
			'product_style',
			array(
				'label'   => esc_html__('Product Style', 'brator-core'),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style_1' => esc_html__('Style One', 'brator-core'),
					'style_2' => esc_html__('Style Two', 'brator-core'),
					'style_3' => esc_html__('Style Three', 'brator-core'),
					'style_4' => esc_html__('Style Four', 'brator-core'),
					'style_5' => esc_html__('Style Five', 'brator-core'),
					'style_6' => esc_html__('Style Six', 'brator-core'),
				),
				'default' => 'style_1',
			)
		);
		$this->add_control(
			'product_grid_type',
			array(
				'label'   => esc_html__('Product Type', 'brator-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'recent_products',
				'options' => array(
					'featured_products'     => esc_html__('Featured Products', 'brator-core'),
					'sale_products'         => esc_html__('Sale Products', 'brator-core'),
					'best_selling_products' => esc_html__('Best Selling Products', 'brator-core'),
					'recent_products'       => esc_html__('Recent Products', 'brator-core'),
					'top_rated_products'    => esc_html__('Top Rated Products', 'brator-core'),
					'product_category'      => esc_html__('Product Category', 'brator-core'),
				),
			)
		);

		// Product categories.
		$this->add_control(
			'catagory_name',
			array(
				'type'      => Controls_Manager::SELECT2,
				'label'     => esc_html__('Category', 'brator-core'),
				'options'   => $this->grid_get_all_post_type_categories(),
				'multiple'  => true,
				'condition' => array(
					'product_grid_type' => 'product_category',
				),
			)
		);

		$this->add_control(
			'product_per_page',
			array(
				'label'   => esc_html__('Number of Products', 'brator-core'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
			)
		);

		$this->add_control(
			'product_order_by',
			array(
				'label'   => esc_html__('Order By', 'brator-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => esc_html__('Date', 'brator-core'),
					'ID'            => esc_html__('ID', 'brator-core'),
					'author'        => esc_html__('Author', 'brator-core'),
					'title'         => esc_html__('Title', 'brator-core'),
					'modified'      => esc_html__('Modified', 'brator-core'),
					'rand'          => esc_html__('Random', 'brator-core'),
					'comment_count' => esc_html__('Comment count', 'brator-core'),
					'menu_order'    => esc_html__('Menu order', 'brator-core'),
				),
			)
		);

		$this->add_control(
			'product_order',
			array(
				'label'   => esc_html__('Product Order', 'brator-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__('DESC', 'brator-core'),
					'ASC'  => esc_html__('ASC', 'brator-core'),
				),
			)
		);
		$this->add_control(
			'count_down_enable',
			array(
				'label'   => esc_html__('Countdown', 'brator-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'count_down_date',
			array(
				'label'       => esc_html__('Countdown Date', 'brator-core'),
				'type'        => Controls_Manager::DATE_TIME,
				'placeholder' => esc_html__('29 April 2022 9:56', 'brator-core'),
				'condition'   => array('count_down_enable' => 'yes'),
			)
		);
		$this->add_control(
			'extra_class',
			array(
				'label' => esc_html__('Extra Class', 'brator-core'),
				'type'  => Controls_Manager::TEXT,
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'tab_setting',
			array(
				'label' => esc_html__('Tab Settings', 'brator-core'),
			)
		);
		$this->add_control(
			'catagory_tabs',
			array(
				'type'     => Controls_Manager::SELECT2,
				'label'    => esc_html__('Category Tabs', 'brator-core'),
				'options'  => $this->grid_get_all_post_type_categories(),
				'multiple' => true,
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_additional_options',
			array(
				'label' => esc_html__('Slider Settings', 'brator-core'),
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'   => esc_html__('Enable Dots', 'brator-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_control(
			'arrows',
			array(
				'label'   => esc_html__('Enable Arrows', 'brator-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->add_control(
			'infinite',
			array(
				'label'   => esc_html__('Enable Infinite', 'brator-core'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'              => esc_html__('Speed', 'brator-core'),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 300,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'slidesToShow',
			array(
				'label'              => esc_html__('Slides To Show', 'brator-core'),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 4,
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'slidesToScroll',
			array(
				'label'              => esc_html__('Slides To Scroll', 'brator-core'),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'frontend_available' => true,
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_option_layouts',
			array(
				'label' => esc_html__('Style', 'brator-core'),
			)
		);
		$this->add_control(
			'area_padding',
			array(
				'label'      => esc_html__('Area Padding', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em'),
				'selectors'  => array(
					'{{WRAPPER}} .brator-deal-product-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'area_header_margin',
			array(
				'label'      => esc_html__('Area Header Margin', 'plugin-name'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em'),
				'selectors'  => array(
					'{{WRAPPER}} .brator-best-seller-section-header-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		//Typography Section
		$this->start_controls_section(
			'typography_section',
			array(
				'label' => __('Typography Section', 'brator-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __('Title', 'brator-core'),
				'selector' => '{{WRAPPER}} .brator-section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_text_typography',
				'label'    => __('Button Text', 'brator-core'),
				'selector' => '{{WRAPPER}} .brator-section-header a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_category_typography',
				'label'    => __('Item Category', 'brator-core'),
				'selector' => '{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-cat a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_title_typography',
				'label'    => __('Item Title', 'brator-core'),
				'selector' => '{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-title h5',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_button_title_typography',
				'label'    => __('Cart Button Title', 'brator-core'),
				'selector' => '{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button',
			)
		);
		$this->end_controls_section();

		//Color Section
		$this->start_controls_section(
			'color_section',
			array(
				'label' => __('Color Section', 'brator-core'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __('Title Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_text_color',
			array(
				'label'     => __('Button Text Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'item_category_color',
			array(
				'label'     => __('Item Category Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-cat a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'item_title_color',
			array(
				'label'     => __('Item Title Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-title h5 a' => 'color: {{VALUE}}!important',
				),
			)
		);

		$this->start_controls_tabs('tabs_button_style');
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __('Normal', 'brator-core'),
			)
		);
		$this->add_control(
			'cart_button_title_color',
			array(
				'label'     => __('Cart Button Title Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cart_button_title_bg_color',
			array(
				'label'     => __('Cart Button BG Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cart_button_border_color',
			array(
				'label'     => __('Cart Button Border Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __('Hover', 'brator-core'),
			)
		);
		$this->add_control(
			'cart_button_title_hover_color',
			array(
				'label'     => __('Cart Button Title Hover Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cart_button_title_bg_hover_color',
			array(
				'label'     => __('Cart Button BG Hover Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button:hover' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cart_button_border_hover_color',
			array(
				'label'     => __('Cart Button Border Color', 'brator-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-product-single-item-area .brator-product-single-item-mini .brator-product-single-item-btn a.add_to_cart_button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings          = $this->get_settings();
		$title             = $settings['title'];
		$button_text       = $settings['button_text'];
		$button_url        = $settings['button_url']['url'];
		$product_style     = $settings['product_style'];
		$product_grid_type = $settings['product_grid_type'];
		$product_per_page  = $settings['product_per_page'];
		$catagory_name     = $settings['catagory_name'];
		$product_order_by  = $settings['product_order_by'];
		$product_order     = $settings['product_order'];
		$extra_class       = $settings['extra_class'];

		if (is_array($catagory_name) && !empty($catagory_name)) {
			$category_arr = array();
			$category_arr = implode(', ', $catagory_name);
		} else {
			$category_arr = $catagory_name;
		}

		if ($settings['dots'] == 'yes') {
			$dots = true;
		} else {
			$dots = false;
		}
		if ($settings['arrows'] == 'yes') {
			$arrows = true;
		} else {
			$arrows = false;
		}
		if ($settings['infinite'] == 'yes') {
			$infinite = true;
		} else {
			$infinite = false;
		}

		$slidesToShow   = $settings['slidesToShow'];
		$slidesToScroll = $settings['slidesToScroll'];
		$dots           = $settings['dots'];
		if ($dots == 'yes') {
			$arrows = 'true';
		} else {
			$dots = 'false';
		}
		$atts = array(
			'dots'           => $dots,
			'arrows'         => $arrows,
			'infinite'       => $infinite,
			'speed'          => $settings['speed'],
			'slidesToShow'   => !empty($settings['slidesToShow']) ? $settings['slidesToShow'] : 4,
			'slidesToScroll' => !empty($settings['slidesToScroll']) ? $settings['slidesToScroll'] : 4,
		);

		$catagory_tabs = $settings['catagory_tabs'];

		if ($catagory_tabs) {
			$class_tab  = 'project-tiles';
			$class_tab2 = 'product-tab-section';
		} else {
			$class_tab  = '';
			$class_tab2 = '';
		}

		$heading_alignment = $settings['heading_alignment'];
		if ($heading_alignment == 'left') {
			$heading_class = 'all-item-left';
		} else {
			$heading_class = '';
		}
		$count_down_date   = $settings['count_down_date'];
		$count_down_enable = $settings['count_down_enable'];
		if ($count_down_enable == 'yes') {
			$css_title = 'header-title-countdown';
		} else {
			$css_title = '';
		}
?>
		<div class="brator-deal-product-slider <?php echo $extra_class . ' ' . $class_tab2; ?> woocommerce">
			<div class="row">
				<div class="col-12">
					<div class="brator-best-seller-section-header-area">
						<div class="brator-section-header <?php echo $heading_class; ?>">
							<div class="brator-section-header-title <?php echo $css_title; ?>">
								<h2><?php echo $title; ?></h2>
								<?php if ($count_down_enable == 'yes') { ?>
									<div class="brator-product-countdown">
										<div class="brator-coming-soon-counter" data-attr="<?php echo esc_attr($count_down_date); ?>">
											<span><?php esc_html_e('Expires in:', 'brator-core'); ?></span>
											<div id="countdown">
												<ul>
													<li><span id="days"></span>D :</li>
													<li><span id="hours"></span>H :</li>
													<li><span id="minutes"></span>M :</li>
													<li><span id="seconds"></span>S</li>
												</ul>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							<?php if (!empty($button_text) && !empty($button_url)) { ?>
								<a href="<?php echo esc_url($button_url); ?>"><?php echo esc_html($button_text); ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
									</svg>
								</a>
							<?php } ?>
						</div>
						<?php
						if (!empty($catagory_tabs) && is_array($catagory_tabs)) {
						?>
							<input type="hidden" id="product_grid_type" value="<?php echo $product_grid_type; ?>" />
							<input type="hidden" id="product_per_page" value="<?php echo $product_per_page; ?>" />
							<input type="hidden" id="product_order_by" value="<?php echo $product_order_by; ?>" />
							<input type="hidden" id="product_order" value="<?php echo $product_order; ?>" />
							<input type="hidden" id="catagory_name" value="<?php echo $catagory_name; ?>" />
							<input type="hidden" id="product_style" value="<?php echo $product_style; ?>" />
							<div class="brator-best-seller-sub-filter-area">
								<ul class="brator-best-seller-sub-filter-content">
									<li class="brator-best-seller-sub-filter-list"><a href="javascript:void(0)" class="cat-list_item active" data-slug="all"><?php esc_html_e('Top 10', 'brator-core'); ?></a></li>
									<?php
									foreach ($catagory_tabs as $catagory_tab) {
										$catagory_slug_by  = get_term_by('slug', $catagory_tab, 'product_cat');
										$catagory_tab_item = sprintf(esc_html__('Top', 'brator-core') . esc_html(' %s'), $catagory_slug_by->name);
									?>
										<li class="brator-best-seller-sub-filter-list"><a href="javascript:void(0)" class="cat-list_item" data-slug="<?php echo $catagory_slug_by->slug; ?>" data-count="<?php echo $catagory_slug_by->count; ?>"><?php echo $catagory_tab_item; ?></a></li>
									<?php
									}
									?>
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-12">
					<?php
					if ($product_grid_type == 'sale_products') {
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => $product_per_page,
							'meta_query'     => array(
								'relation' => 'OR',
								array(
									'key'     => '_sale_price',
									'value'   => 0,
									'compare' => '>',
									'type'    => 'numeric',
								),
								array( // Variable products type
									'key'     => '_min_variation_sale_price',
									'value'   => 0,
									'compare' => '>',
									'type'    => 'numeric',
								),
							),
							'orderby'        => $product_order_by,
							'order'          => $product_order,
						);
					}
					if ($product_grid_type == 'best_selling_products') {
						$args = array(
							'post_type'      => 'product',
							'meta_key'       => 'total_sales',
							'orderby'        => 'meta_value_num',
							'posts_per_page' => $product_per_page,
							'order'          => $product_order,
						);
					}
					if ($product_grid_type == 'recent_products') {
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => $product_per_page,
							'orderby'        => $product_order_by,
							'order'          => $product_order,
						);
					}
					if ($product_grid_type == 'featured_products') {
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => $product_per_page,
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
								),
							),
							'orderby'        => $product_order_by,
							'order'          => $product_order,
						);
					}
					if ($product_grid_type == 'top_rated_products') {
						$args = array(
							'posts_per_page' => $product_per_page,
							'no_found_rows'  => 1,
							'post_status'    => 'publish',
							'post_type'      => 'product',
							'meta_key'       => '_wc_average_rating',
							'orderby'        => $product_order_by,
							'order'          => $product_order,
							'meta_query'     => WC()->query->get_meta_query(),
							'tax_query'      => WC()->query->get_tax_query(),
						);
					}

					if ($product_grid_type == 'product_category') {
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => $product_per_page,
							'product_cat'    => $category_arr,
							'orderby'        => $product_order_by,
							'order'          => $product_order,
						);
					}

					$loop = new \WP_Query($args);

					if ($loop->have_posts()) {
					?>
						<div class="brator-product-slider splide js-splide p-splide" data-splide='{"pagination":<?php echo $dots; ?>,"type":"slide","perPage":<?php echo $slidesToShow; ?>,"perMove":"<?php echo $slidesToScroll; ?>","gap":20, "breakpoints":{ "620" :{ "perPage": "1" },"991" :{ "perPage": "2" }, "1030" :{ "perPage" : "3" }, "1199":{ "perPage" : "3" }, "1366":{ "perPage" : "4" }, "1500":{ "perPage" : "<?php echo $slidesToShow; ?>" }, "1920":{ "perPage" : "<?php echo $slidesToShow; ?>" }}}'>
							<?php if ($arrows == 'yes') { ?>
								<div class="splide__arrows style-two">
									<button class="splide__arrow splide__arrow--prev">
										<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
										</svg>
									</button>
									<button class="splide__arrow splide__arrow--next">
										<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
										</svg>
									</button>
								</div>
							<?php } ?>
							<div class="splide__track">
								<div class="splide__list <?php echo $class_tab; ?>">
									<?php
									while ($loop->have_posts()) :
										$loop->the_post();
										if (class_exists('WooCommerce')) {
											if ($product_style == 'style_2') {
												wc_get_template_part('content', 'product-slide');
											} elseif ($product_style == 'style_3') {
												wc_get_template_part('content', 'product-slide-three');
											} elseif ($product_style == 'style_4') {
												wc_get_template_part('content', 'product-slide-four');
											} elseif ($product_style == 'style_5') {
												wc_get_template_part('content', 'product-slide-five');
											} elseif ($product_style == 'style_6') {
												wc_get_template_part('content', 'product-slide-six');
											} else {
												wc_get_template_part('content', 'product-slidetwo');
											}
										} else {
											echo '<p class="text-center">' . esc_html__('WooCommerce Not Active.', 'brator-core') . '</p>';
										}
									endwhile;
									?>
								</div>
							</div>
						</div>
					<?php
					} else {
						echo '<p class="text-center">' . esc_html__('No Products found.', 'brator-core') . '</p>';
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
<?php
	}
}
