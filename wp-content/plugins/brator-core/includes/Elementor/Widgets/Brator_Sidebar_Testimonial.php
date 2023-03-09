<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Brator_Sidebar_Testimonial extends Widget_Base {


	public function get_name() {
		return 'brator_sidebar_testimonial';
	}

	public function get_title() {
		return esc_html__( 'Sidebar Testimonial', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}
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
				'default' => __( 'Testimonials', 'brator-core' ),
			)
		);
		$this->add_control(
			'number',
			array(
				'label'   => esc_html__( 'Number of Review', 'brator-core' ),
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
		$repeater = new Repeater();
		$repeater->add_control(
			'item_author_image',
			array(
				'label'   => esc_html__( 'Author Image', 'brator-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),

			)
		);
		$repeater->add_control(
			'item_author_name',
			array(
				'label'   => esc_html__( 'Author Name', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Colin Mathew', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_designation',
			array(
				'label'   => esc_html__( 'Designation', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Brooklyn, NY', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'item_description',
			array(
				'label'   => esc_html__( 'Review Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 6,
				'default' => __( '“Best WP/WooCommercetheme i used to used.Fast, Flexiable and easyto customize. The supportreally is professional!”', 'brator-core' ),
			)
		);
		$repeater->add_control(
			'review',
			array(
				'label'   => esc_html__( 'Review', 'brator-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '5',
				'max'     => '5',
			)
		);
		$repeater->add_control(
			'date',
			array(
				'label' => esc_html__( 'Date', 'brator-core' ),
				'type'  => Controls_Manager::DATE_TIME,
			)
		);
		$this->add_control(
			'items',
			array(
				'label'   => esc_html__( 'Repeater List', 'brator-core' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'list_title'   => esc_html__( 'Title #1', 'brator-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'brator-core' ),
					),
					array(
						'list_title'   => esc_html__( 'Title #2', 'brator-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'brator-core' ),
					),
				),
			)
		);
		$this->end_controls_section();

	}
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$title       = $settings['title'];
		$extra_class = $settings['extra_class'];
		?>
<div class="brator-home-sidebar-area">
	<div class="brator-home-sidebar-title"><?php echo $title; ?></div>
	<div class="brator-sidebar-review-slider splide js-splide p-splide" data-splide='{"pagination":true,"arrows":false,"type":"loop","perPage":1,"perMove":"1","gap":30}'>
		<div class="splide__track">
			<div class="splide__list">
			<?php
			$i = 1;
			foreach ( $settings['items'] as $item ) {
				$item_author_image     = ( $item['item_author_image']['id'] != '' ) ? wp_get_attachment_image( $item['item_author_image']['id'], 'full' ) : $item['item_author_image']['url'];
				$item_author_image_alt = get_post_meta( $item['item_author_image']['id'], '_wp_attachment_image_alt', true );
				$item_author_name      = $item['item_author_name'];
				$item_designation      = $item['item_designation'];
				$item_description      = $item['item_description'];
				$itemrating            = $item['review'];
				$date                  = $item['date'];
				?>
				<div class="brator-review-sidebar-item splide__slide">
					<div class="flex">
						<ul>
							<?php
							$allrating = array( 1, 2, 3, 4, 5 );
							foreach ( $allrating as $rating ) {
								?>
										<li><svg class="active" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><path d="M59.7,23.9l-18.1-2.8L33.4,3.9c-0.6-1.2-2.2-1.2-2.8,0l-8.2,17.3L4.4,23.9c-1.3,0.2-1.8,1.9-0.8,2.8l13.1,13.5l-3.1,18.9  c-0.2,1.3,1.1,2.4,2.3,1.6l16.3-8.9l16.2,8.9c1.1,0.6,2.5-0.4,2.2-1.6l-3.1-18.9l13.1-13.5C61.4,25.8,61,24.1,59.7,23.9z"></path></svg></li>
								<?php
								if ( $rating == $itemrating ) {
									break;
								}
							}
							?>
						</ul>
						<span class="braton-review-date"><?php echo $this->time_elapsed_string( $date ); ?></span>
					</div>
					<p><?php echo $item_description; ?></p>
					<div class="flex brator-review-sidebar-text">
						<div>
							<?php
							if ( wp_http_validate_url( $item_author_image ) ) {
								?>
								<img src="<?php echo esc_url( $item_author_image ); ?>" alt="<?php esc_url( $item_author_image_alt ); ?>">
								<?php
							} else {
								echo $item_author_image;
							}
							?>
						</div>
						<div>
							<span><?php echo $item_author_name; ?></span>
							<p><?php echo $item_designation; ?></p>
						</div>
					</div>
				</div>
				<?php
				$i++;
			}
			?>
			</div>
		</div>
	</div>
</div>
		<?php
	}
}
