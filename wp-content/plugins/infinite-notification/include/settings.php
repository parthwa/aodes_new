<?php
class Infinite_Notification_Settings {

	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_settings_fields' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu_item' ) );
	}
	public function admin_menu_item() {
		add_menu_page(
			'Sales Notification',
			'Sales Notification',
			'manage_options',
			'sales-notification',
			array(
				$this,
				'settings_page',
			),
			'dashicons-megaphone'
		);
	}
	public function admin_settings_fields() {
		add_settings_section( 'notification_section', 'Infinite Notification Settings', null, 'notification_fields' );
		add_settings_field( 'notification_switch', 'Notification On/Off', array( $this, 'notification_switch' ), 'notification_fields', 'notification_section' );
		add_settings_field( 'time_interval', 'Set Time Interval', array( $this, 'time_interval' ), 'notification_fields', 'notification_section' );
		add_settings_field( 'notification_position', 'Position', array( $this, 'notification_position' ), 'notification_fields', 'notification_section' );
		add_settings_field( 'notification_limit', 'Limit', array( $this, 'notification_limit' ), 'notification_fields', 'notification_section' );
		add_settings_field( 'notification_cookie_limit', 'Keep Off Days', array( $this, 'notification_cookie_limit' ), 'notification_fields', 'notification_section' );
		add_settings_field( 'powered_by_switch', 'Powered By', array( $this, 'powered_by_switch' ), 'notification_fields', 'notification_section' );

		register_setting( 'notification_section', 'notification-switch' );
		register_setting( 'notification_section', 'notification-sound-switch' );
		register_setting( 'notification_section', 'time-interval' );
		register_setting( 'notification_section', 'notification-position' );
		register_setting( 'notification_section', 'notification-limit' );
		register_setting( 'notification_section', 'notification-cookie-limit' );
		register_setting( 'notification_section', 'powered-by-switch' );
	}


	public function settings_page() {
		?>
	  <div class="wrap">
		 <h1><?php esc_html_e( 'Infinite Notification Settings', 'infinite-notification' ); ?></h1>
		 <form method="post" action="options.php">
		<?php
		   settings_fields( 'notification_section' );
		   do_settings_sections( 'notification_fields' );
		   submit_button();
		?>
		 </form>
	  </div>
		<?php
	}

	public function notification_switch() {
		$options = get_option( 'notification-switch' );
		$check   = 'checked';
		if ( $options != '1' ) {
			$check = '';
		}
		?>
		<input type="checkbox" name="notification-switch" value="1" <?php echo esc_attr( $check ); ?>>
		<?php
	}

	public function notification_sound_switch() {
		$options = get_option( 'notification-sound-switch' );
		$check   = 'checked';
		if ( ! isset( $options ) && $options != '1' ) {
			$check = '';
		}
		?>
		<input type="checkbox" name="notification-sound-switch" value="1" <?php echo esc_attr( $check ); ?>>
		<?php
	}

	public function time_interval() {
		?>
		<select name="time-interval">
		  <option value="10" <?php selected( get_option( 'time-interval' ), '10' ); ?>><?php esc_html_e( '10 Seconds', 'infinite-notification' ); ?></option>
		  <option value="15" <?php selected( get_option( 'time-interval' ), '15' ); ?>><?php esc_html_e( '15 Seconds', 'infinite-notification' ); ?></option>
		  <option value="20" <?php selected( get_option( 'time-interval' ), '20' ); ?>><?php esc_html_e( '20 Seconds', 'infinite-notification' ); ?></option>
		  <option value="30" <?php selected( get_option( 'time-interval' ), '30' ); ?>><?php esc_html_e( '30 Seconds', 'infinite-notification' ); ?></option>
		  <option value="40" <?php selected( get_option( 'time-interval' ), '40' ); ?>><?php esc_html_e( '40 Seconds', 'infinite-notification' ); ?></option>
		  <option value="50" <?php selected( get_option( 'time-interval' ), '50' ); ?>><?php esc_html_e( '50 Seconds', 'infinite-notification' ); ?></option>
		  <option value="60" <?php selected( get_option( 'time-interval' ), '60' ); ?>><?php esc_html_e( '1 minute', 'infinite-notification' ); ?></option>
		</select>
		<?php
	}

	public function notification_position() {
		?>
		<select name="notification-position">
		<option value="bottom_left" <?php selected( get_option( 'notification-position' ), 'bottom_left' ); ?>><?php esc_html_e( 'Bottom Left', 'infinite-notification' ); ?></option>
		<option value="bottom_right" <?php selected( get_option( 'notification-position' ), 'bottom_right' ); ?>><?php esc_html_e( 'Bottom Right', 'infinite-notification' ); ?></option>
		<option value="top_left" <?php selected( get_option( 'notification-position' ), 'top_left' ); ?>><?php esc_html_e( 'Top Left', 'infinite-notification' ); ?></option>
		<option value="top_right" <?php selected( get_option( 'notification-position' ), 'top_right' ); ?>><?php esc_html_e( 'Top Right', 'infinite-notification' ); ?></option>
		</select>
		<?php
	}

	public function notification_limit() {
		$notification_limit       = get_option( 'notification-limit' );
		$notification_limit_count = '10';
		if ( $notification_limit ) {
			$notification_limit_count = $notification_limit;
		}
		?>
		<input type="number" name="notification-limit" value="<?php echo esc_attr( $notification_limit_count ); ?>">
		<?php
	}

	public function notification_cookie_limit() {
		$notification_cookie_limit       = get_option( 'notification-cookie-limit' );
		$notification_cookie_limit_count = '3';
		if ( $notification_cookie_limit ) {
			$notification_cookie_limit_count = $notification_cookie_limit;
		}
		?>
		<input type="number" name="notification-cookie-limit" value="<?php echo esc_attr( $notification_cookie_limit_count ); ?>">
		<?php
	}

	public function powered_by_switch() {
		$options = get_option( 'powered-by-switch' );
		$check   = '';
		if ( isset( $options ) && $options == '1' ) {
			$check = 'checked';
		}
		?>
		<input type="checkbox" name="powered-by-switch" value="1" <?php echo esc_attr( $check ); ?>>
		<?php
	}

}

new Infinite_Notification_Settings();
