<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

class Brator_Blog extends Widget_Base {



	public function get_name() {
		return 'brator_blog';
	}

	public function get_title() {
		return esc_html__( 'Brator Blog Posts', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	private function get_blog_categories() {
		$options  = array();
		$taxonomy = 'category';
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
			'section_blogs',
			array(
				'label' => esc_html__( 'Blog Posts', 'brator-core' ),
			)
		);
		$this->add_control(
			'layout_style',
			array(
				'label'   => esc_html__( 'Layout Style', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'style_1' => esc_html__( 'Style One', 'brator-core' ),
					'style_2' => esc_html__( 'Style Two', 'brator-core' ),
					'style_3' => esc_html__( 'Style Three', 'brator-core' ),
					'style_4' => esc_html__( 'Style Four', 'brator-core' ),
				),
				'default' => 'style_1',
			)
		);
		$this->add_control(
			'title',
			array(
				'label'      => esc_html__( 'Title', 'brator-core' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => __( 'Tips & Guides', 'brator-core' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'layout_style',
							'operator' => '!=',
							'value'    => 'style_3',
						),
					),
				),
			)
		);
		$this->add_control(
			'btn_text',
			array(
				'label'      => esc_html__( 'Button Text', 'brator-core' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => __( 'See All Articles', 'brator-core' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'layout_style',
							'operator' => '!=',
							'value'    => 'style_3',
						),
					),
				),
			)
		);
		$this->add_control(
			'btn_url',
			array(
				'label'         => esc_html__( 'Button URL', 'brator-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'brator-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
				'conditions'    => array(
					'terms' => array(
						array(
							'name'     => 'layout_style',
							'operator' => '!=',
							'value'    => 'style_3',
						),
					),
				),
			)
		);
		$this->add_control(
			'category_id',
			array(
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Category', 'brator-core' ),
				'options' => $this->get_blog_categories(),
			)
		);
		$this->add_control(
			'featured_posts',
			array(
				'type'  => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Featured Posts', 'brator-core' ),
			)
		);
		$this->add_control(
			'number',
			array(
				'label'   => esc_html__( 'Number of Post', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
			)
		);
		$this->add_control(
			'order_by',
			array(
				'label'   => esc_html__( 'Order By', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => esc_html__( 'Date', 'brator-core' ),
					'ID'            => esc_html__( 'ID', 'brator-core' ),
					'author'        => esc_html__( 'Author', 'brator-core' ),
					'title'         => esc_html__( 'Title', 'brator-core' ),
					'modified'      => esc_html__( 'Modified', 'brator-core' ),
					'rand'          => esc_html__( 'Random', 'brator-core' ),
					'comment_count' => esc_html__( 'Comment count', 'brator-core' ),
					'menu_order'    => esc_html__( 'Menu order', 'brator-core' ),
				),
			)
		);
		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order', 'brator-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => array(
					'desc' => esc_html__( 'DESC', 'brator-core' ),
					'asc'  => esc_html__( 'ASC', 'brator-core' ),
				),
			)
		);
		$this->add_control(
			'extra_class',
			array(
				'label' => esc_html__( 'Extra Class', 'brator-core' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		// Typography Section
		$this->start_controls_section(
			'typography_section',
			array(
				'label' => __( 'Typography Section', 'brator-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_text_typography',
				'label'    => __( 'Button Text', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-section-header a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'blog_title_typography',
				'label'    => __( 'Blog Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} h3.brator-blog-listing-single-item-title a',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'blog_description_typography',
				'label'    => __( 'Blog Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-blog-listing-single-item-excerpt p',
			)
		);

		$this->end_controls_section();

		// Color Section
		$this->start_controls_section(
			'color_section',
			array(
				'label' => __( 'Color Section', 'brator-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header h2' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Button Text Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-section-header a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'blog_title_color',
			array(
				'label'     => __( 'Blog Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} h3.brator-blog-listing-single-item-title a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'blog_description_color',
			array(
				'label'     => __( 'Blog Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-blog-listing-single-item-excerpt p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings();
		$layout_style = $settings['layout_style'];

		$posts_per_page = $settings['number'];
		$title          = $settings['title'];
		$extra_class    = $settings['extra_class'];

		$order_by = $settings['order_by'];
		$order    = $settings['order'];

		$btn_text         = $settings['btn_text'];
		$btn_url          = $settings['btn_url']['url'];
		$btn_url_external = $settings['btn_url']['is_external'] ? 'target="_blank"' : '';
		$btn_url_nofollow = $settings['btn_url']['nofollow'] ? 'rel="nofollow"' : '';

		$pg_num = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		if ( is_array( $settings['category_id'] ) && ! empty( $settings['category_id'] ) ) {
			$category_arr = array();
			$category_arr = implode( ', ', $settings['category_id'] );
		} else {
			$category_arr = $settings['category_id'];
		}

		$featured_posts = $settings['featured_posts'];

		if ( $featured_posts == 'yes' ) {
			$args = array(
				'post_type'      => array( 'post' ),
				'post_status'    => array( 'publish' ),
				'nopaging'       => false,
				'paged'          => $pg_num,
				'posts_per_page' => $posts_per_page,
				'category_name'  => $category_arr,
				'orderby'        => $order_by,
				'order'          => $order,
				'meta_key'       => 'brator_core_post_featured',
				'meta_value'     => '1',
			);
		} else {
			$args = array(
				'post_type'      => array( 'post' ),
				'post_status'    => array( 'publish' ),
				'nopaging'       => false,
				'paged'          => $pg_num,
				'posts_per_page' => $posts_per_page,
				'category_name'  => $category_arr,
				'orderby'        => $order_by,
				'order'          => $order,
			);
		}

		$query = new \WP_Query( $args );
		?>
		<?php if ( $layout_style == 'style_1' ) { ?>
			<div class="blog-section-layout grid-type <?php echo $extra_class; ?>">
				<div class="container-lg-c container">
					<div class="row">
						<div class="col-12">
							<div class="brator-section-header">
								<div class="brator-section-header-title">
									<h2><?php echo $title; ?></h2>
								</div>
								<a href="<?php echo esc_url( $btn_url ); ?>" <?php echo $btn_url_external; ?> <?php echo $btn_url_nofollow; ?>><?php echo $btn_text; ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
									</svg></a>
							</div>
						</div>
						<div class="col-12">
							<?php
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
									global $post;
									?>
									<div class="brator-blog-listing-single-item-area list-type-two">
										<div class="type-post">
											<div class="brator-blog-listing-single-item-thumbnail">
												<a class="blog-listing-single-item-thumbnail-link" href="<?php echo esc_url( get_permalink() ); ?>">
													<?php the_post_thumbnail( 'brator-blog-grid' ); ?>
												</a>
											</div>
											<div class="brator-blog-listing-single-item-content">
												<div class="brator-blog-listing-single-item-info">
													<?php brator_category_list(); ?>
													<?php brator_posted_on(); ?>
												</div>
												<h3 class="brator-blog-listing-single-item-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
												<div class="brator-blog-listing-single-item-excerpt">
													<p>
														<?php
														$content = substr( get_the_excerpt(), 0, 90 );
														echo $content . ' [...]';
														?>
													</p>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
								wp_reset_postdata();
							}
							?>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_2' ) { ?>
			<div class="brator-blog-featured-area grid-type design-two <?php echo $extra_class; ?>">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-section-header">
								<div class="brator-section-header-title">
									<h2><?php echo $title; ?></h2>
								</div>
								<a href="<?php echo esc_url( $btn_url ); ?>" <?php echo $btn_url_external; ?> <?php echo $btn_url_nofollow; ?>><?php echo $btn_text; ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
									</svg></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-12">
							<?php
							$posts_per_loop = 1;
							if ( $query->have_posts() ) :
								while ( $query->have_posts() ) :
									$query->the_post();
									get_template_part( 'template-parts/blog-layout/blog-grid-content-first' );
									if ( $query->current_post + 1 == $posts_per_loop ) {
										break;
									}
								endwhile;
							else :
								get_template_part( 'template-parts/content', 'none' );
							endif;
							wp_reset_postdata();
							?>
						</div>
						<div class="col-xl-6 col-lg-12">
							<div class="hug-padding-left">
								<?php
								$posts_per_loop2 = 4;
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) :
										$query->the_post();
										get_template_part( 'template-parts/blog-layout/blog-grid-content-2' );
										if ( $query->current_post + 1 == $posts_per_loop2 ) {
											break;
										}
									endwhile;
								else :
									get_template_part( 'template-parts/content', 'none' );
								endif;
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_3' ) { ?>
			<div class="brator-banner-slider-area blog-desing-slider-one <?php echo $extra_class; ?>">
				<div class="container-xxxl container-xxl container">
					<div class="row">
						<div class="col-md-12">
							<div class="brator-banner-slider arrow-design-one splide js-splide p-splide" data-splide='{"pagination":true,"type":"slide","perPage":1,"perMove":"1"}'>
								<div class="splide__arrows">
									<button class="splide__arrow splide__arrow--prev"><span></span><img src="<?php echo BRATOR_CORE_THEME_IMG; ?>/arow-left.png" alt="alt" /></button>
									<button class="splide__arrow splide__arrow--next"><span></span><img src="<?php echo BRATOR_CORE_THEME_IMG; ?>/arow-right.png" alt="alt" /></button>
								</div>
								<div class="splide__track">
									<div class="splide__list">
										<?php
										if ( $query->have_posts() ) {
											while ( $query->have_posts() ) {
												$query->the_post();
												global $post;
												$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
												?>
												<div class="brator-banner-area design-one splide__slide lazyload" data-bg="<?php echo esc_url( $image_url ); ?>">
													<div class="brator-banner-content">
														<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
														<p>
															<?php
															$content = substr( get_the_excerpt(), 0, 130 );
															echo $content . ' [...]';
															?>
														</p>
													</div>
												</div>
												<?php
											}
											wp_reset_postdata();
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ( $layout_style == 'style_4' ) { ?>
			<section class="brator-blog-area">
				<div class="container container-xxl container-xxxl">
					<div class="row">
						<div class="col-lg-12">
							<div class="brator-section-header all-item-left">
								<div class="brator-section-header-title">
									<h2><?php echo $title; ?></h2>
								</div>
								<a href="<?php echo esc_url( $btn_url ); ?>" <?php echo $btn_url_external; ?> <?php echo $btn_url_nofollow; ?>><?php echo $btn_text; ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
									</svg></a>
							</div>
						</div>
					</div>
					<div class="brator-blog-slider style-three splide js-splide p-splide" data-splide='{"pagination":false,"type":"loop","perPage":4,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "1" }, "767" :{ "perPage" : "1" }, "1090":{ "perPage" : "2" }, "1366":{ "perPage" : "3" }, "1500":{ "perPage" : "3" }, "1920":{ "perPage" : "4" }}}'>
						<div class="splide__arrows style-three">
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
						<div class="splide__track">
							<div class="splide__list">
								<?php
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) :
										$query->the_post();
										get_template_part( 'template-parts/blog-layout/blog-grid-content-slide' );
									endwhile;
								else :
									get_template_part( 'template-parts/content', 'none' );
								endif;
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		}
	}
}
