<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class Brator_Category_Dropdown extends Widget_Base {

	public function get_name() {
		return 'brator_category_dropdown';
	}

	public function get_title() {
		return esc_html__( 'Brator Category Dropdown', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	private function get_product_categories() {
		$options  = array();
		$taxonomy = 'product_cat';
		if ( ! empty( $taxonomy ) ) {
			$terms = get_terms(
				array(
					'parent'     => 0,
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						$options[''] = 'Select';
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}
		return $options;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__( 'general', 'brator-core' ),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Categories', 'brator-core' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'category_items-area',
			array(
				'label' => esc_html__( 'Category Select', 'brator-core' ),
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'category_item',
			array(
				'label'     => __( 'Select Category', 'brator-core' ),
				'separator' => 'before',
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->get_product_categories(),
			)
		);
		$repeater->add_control(
			'category_item_icon',
			array(
				'label' => esc_html__( 'Category Icon', 'brator-core' ),
				'type'  => Controls_Manager::ICONS,
			)
		);
		$repeater->add_control(
			'category_item_title',
			array(
				'label' => esc_html__( 'Category Title', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'category_item_cat',
			array(
				'label'   => esc_html__( 'Sub Category Show', 'brator-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->add_control(
			'category_items',
			array(
				'label'  => esc_html__( 'Category List', 'brator-core' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);
		$this->end_controls_section();

	}
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$title          = $settings['title'];
		$category_items = $settings['category_items'];
		?> 
			<div class="brator-home-sidebar-area">
				<div class="brator-home-sidebar-title">
					<?php echo wp_kses_post( $title ); ?>
				</div>
				<div class="brator-home-sidebar-content">
					<div class="brator-home-sidebar-content-category">
						<ul>
							<?php
							foreach ( $category_items as $item ) {
								$category_item = $item['category_item'];

									$category_item_name     = get_term_by( 'slug', $category_item, 'product_cat' )->name;
									$category_item_taxonomy = get_term_by( 'slug', $category_item, 'product_cat' )->taxonomy;
									$category_item_id       = get_term_by( 'slug', $category_item, 'product_cat' )->term_id;

									$category_item_child = get_term_children( $category_item_id, $category_item_taxonomy );

									$category_item_cat   = $item['category_item_cat'];
									$category_item_icon  = $item['category_item_icon'];
									$category_item_title = $item['category_item_title'];
								if ( $category_item_id ) {
									?>
										<li>
											<span>
									<?php if ( $category_item_title != '' ) : ?>
													<a href="<?php echo esc_url( get_term_link( $category_item_id ) ); ?>">
														<?php Icons_Manager::render_icon( ( $category_item_icon ), array( 'aria-hidden' => 'true' ) ); ?>
														<?php echo wp_kses_post( $category_item_title ); ?>
													</a>
												<?php else : ?>
													<a href="<?php echo esc_url( get_term_link( $category_item_id ) ); ?>">
														<?php Icons_Manager::render_icon( ( $category_item_icon ), array( 'aria-hidden' => 'true' ) ); ?>
														<?php echo wp_kses_post( $category_item_name ); ?>
													</a>
												<?php endif; ?>
									<?php
									if ( ! empty( $category_item_child ) ) :
										?>
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
													</svg>
										<?php endif; ?>
											</span>
											<?php
											if ( ! empty( $category_item_child ) ) :
												?>
												<ul>
												<?php
												foreach ( $category_item_child as $key => $category_item_child_item ) {
													$name = get_term_by( 'ID', $category_item_child_item, $category_item_taxonomy )->name;
													$id   = get_term_by( 'ID', $category_item_child_item, $category_item_taxonomy )->term_id;
													?>
													<li><a href="<?php echo esc_url( get_term_link( $id ) ); ?>"><?php echo wp_kses_post( $name ); ?></a></li>
														<?php
												}
												?>
												</ul>
												<?php endif; ?>
										</li>
										<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		<?php
	}
}
