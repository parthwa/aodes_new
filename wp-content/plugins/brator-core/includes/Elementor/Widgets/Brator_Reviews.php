<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

class Brator_Reviews extends Widget_Base {


	private function time_elapsed_string( $datetime, $full = false ) {
		$now  = new \DateTime();
		$ago  = new \DateTime( $datetime );
		$diff = $now->diff( $ago );

		$diff->w  = floor( $diff->d / 7 );
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ( $string as $k => &$v ) {
			if ( $diff->$k ) {
				$v = $diff->$k . ' ' . $v . ( $diff->$k > 1 ? 's' : '' );
			} else {
				unset( $string[ $k ] );
			}
		}

		if ( ! $full ) {
			$string = array_slice( $string, 0, 1 );
		}
		return $string ? implode( ', ', $string ) . ' ago' : 'just now';
	}
	public function get_name() {
		return 'brator_reviews';
	}

	public function get_title() {
		return esc_html__( 'Brator Reviews', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_reviews',
			array(
				'label' => esc_html__( 'Reviews', 'brator-core' ),
			)
		);
		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Clients Satisfaction, Our Reputation', 'brator-core' ),
			)
		);
		$this->add_control(
			'review_titile',
			array(
				'label'   => esc_html__( 'Review Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Excellent', 'brator-core' ),
			)
		);
		$this->add_control(
			'overall_review',
			array(
				'label'   => esc_html__( 'Overall Review', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '5',
				'max'     => '5',
			)
		);
		$this->add_control(
			'review_desc',
			array(
				'label'   => esc_html__( 'Review Description', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Based On <span>4,522 Reviews</span>', 'brator-core' ),
			)
		);
		$this->add_control(
			'reputation_text',
			array(
				'label'   => esc_html__( 'Reputation Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Trustpilot', 'brator-core' ),
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
				'name'     => 'heading_typography',
				'label'    => __( 'Heading', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-review-title .title',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_title_typography',
				'label'    => __( 'Review Title', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-review-content h5',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'review_description_typography',
				'label'    => __( 'Review Description', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-review-content span',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reputation_text_typography',
				'label'    => __( 'Reputation Text', 'brator-core' ),
				'selector' => '{{WRAPPER}} .brator-review-content h4',
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
			'heading_color',
			array(
				'label'     => __( 'Heading Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-review-title .title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'review_title_color',
			array(
				'label'     => __( 'Review Title Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-review-content h5' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'review_description_color',
			array(
				'label'     => __( 'Review Description Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-review-content span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'reputation_text_color',
			array(
				'label'     => __( 'Reputation Text Color', 'brator-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .brator-review-content h4' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$posts_per_page  = $settings['number'];
		$heading         = $settings['heading'];
		$review_titile   = $settings['review_titile'];
		$overall_review  = $settings['overall_review'];
		$review_desc     = $settings['review_desc'];
		$reputation_text = $settings['reputation_text'];
		$extra_class     = $settings['extra_class'];

		$args = array(
			'number'      => $posts_per_page,
			'status'      => 'approve',
			'post_status' => 'publish',
			'post_type'   => 'product',
		);

		$comments = get_comments( $args );
		?>
		<section class="brator-review-area <?php echo $extra_class; ?>">
			<div class="container container-xxl container-xxxl">
				<div class="row">
					<div class="col-lg-12">
						<div class="brator-review-title">
							<h3 class="title"><?php echo $heading; ?></h3>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-2">
						<div class="brator-review-content">
							<h5 class="title"><?php echo $review_titile; ?></h5>
							<ul>
								<?php
								$allrating = array( 1, 2, 3, 4, 5 );
								foreach ( $allrating as $rating ) {
									?>
									<li><i class="eicon-star"></i></li>
									<?php
									if ( $rating == $overall_review ) {
										break;
									}
								}
								?>
							</ul>
							<span><?php echo $review_desc; ?></span>
							<h4><i class="eicon-star"></i> <?php echo $reputation_text; ?></h4>
						</div>
					</div>
					<div class="col-lg-10">
						<div class="brator-review-slider style-three splide js-splide p-splide" data-splide='{"pagination":false,"type":"loop","perPage":5,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "1" }, "767" :{ "perPage" : "1" }, "1090":{ "perPage" : "2" }, "1366":{ "perPage" : "3" }, "1500":{ "perPage" : "3" }, "1920":{ "perPage" : "4" }}}'>
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
									foreach ( $comments as $comment ) {
										$itemrating = get_comment_meta( $comment->comment_ID, 'rating', true );
										$title      = get_comment_meta( $comment->comment_ID, 'title', true );
										?>
										<div class="brator-review-box splide__slide">
											<ul>
												<?php
												$allrating = array( 1, 2, 3, 4, 5 );
												foreach ( $allrating as $rating ) {
													?>
													<li><i class="eicon-star"></i></li>
													<?php
													if ( $rating == $itemrating ) {
														break;
													}
												}
												?>
											</ul>
											<span class="braton-review-date"><?php echo $this->time_elapsed_string( $comment->comment_date ); ?></span>
											<h5 class="title"><?php echo $title; ?></h5>
											<p><?php echo $comment->comment_content; ?></p>
											<span><?php echo $comment->comment_author; ?></span>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>





		<?php
	}
}
