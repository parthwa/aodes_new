<?php
namespace Brator\Helper\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;

class Brator_Makes_List extends Widget_Base {


	public function get_name() {
		return 'brator_makes_list';
	}

	public function get_title() {
		return esc_html__( 'Brator Make & Model List', 'brator-core' );
	}

	public function get_icon() {
		return 'sds-widget-ico';
	}

	public function get_categories() {
		return array( 'brator' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__( 'general', 'brator-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Featured Makes', 'brator-core' ),
			)
		);

		$this->add_control(
			'collapse_button_text',
			array(
				'label'   => esc_html__( 'Collapse Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'view more', 'brator-core' ),
			)
		);

		$this->add_control(
			'expant_button_text',
			array(
				'label'   => esc_html__( 'Expant Button Text', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'view less', 'brator-core' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item',
			array(
				'label' => esc_html__( 'item', 'brator-core' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'   => esc_html__( 'Title', 'brator-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Accura', 'brator-core' ),
			)
		);

		$repeater->add_control(
			'item_link',
			array(
				'label'         => esc_html__( 'Link', 'brator-core' ),
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
		$settings             = $this->get_settings_for_display();
		$heading              = $settings['heading'];
		$collapse_button_text = $settings['collapse_button_text'];
		$expant_button_text   = $settings['expant_button_text'];
		?> 
		<div class="brator-makes-list-area">
			<div class="row">
				<?php if ( ! empty( $heading ) ) { ?>
				<div class="col-md-12">
					<div class="brator-section-header">
						<div class="brator-section-header-title">
							<h2><?php echo $heading; ?></h2>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-12">
					<div class="brator-makes-list">
						<?php
						$i = 0;
						foreach ( $settings['items'] as $item ) {
							$i++;
							$item_title         = $item['item_title'];
							$item_link          = $item['item_link']['url'];
							$item_link_external = $item['item_link']['is_external'] ? 'target="_blank"' : '';
							$item_link_nofollow = $item['item_link']['nofollow'] ? 'rel="nofollow"' : '';
							if ( $i > 20 ) {
								$class = 'disable';
							} else {
								$class = '';
							}
							?>
						<div class="brator-makes-list-single <?php echo $class; ?>">
							<a href="<?php echo esc_url( $item_link ); ?>" <?php echo $item_link_external; ?> <?php echo $item_link_nofollow; ?>><span><?php echo $item_title; ?></span>
							</a>
						</div>
							<?php
						}
						?>

					</div>
				</div>
				<div class="col-md-12">
					<div class="brator-makes-list-view-more">
						<button> <span><b><?php echo $collapse_button_text; ?></b>
						<svg class="bi bi-chevron-down" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path></svg></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- bread end-->
		<?php
	}
}
