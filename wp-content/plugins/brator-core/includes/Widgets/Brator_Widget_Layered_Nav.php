<?php
namespace Brator\Helper\Widgets;

/**
 * Layered Navigation Widget.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.6.0
 * @extends  WC_Widget
 */
class Brator_Widget_Layered_Nav extends \WC_Widget {

	public static $chosen_attributes;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce brator_widget_layered_nav';
		$this->widget_description = esc_html__( 'Shows a custom attribute in a widget which lets you narrow down the list of products when viewing product categories.', 'brator-core' );
		$this->widget_id          = 'brator_wc_layered_nav';
		$this->widget_name        = esc_html__( 'Brator WooCommerce Layered Nav', 'brator-core' );
		parent::__construct();
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see WP_Widget->update
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$this->init_settings();
		return parent::update( $new_instance, $old_instance );
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see WP_Widget->form
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		$this->init_settings();
		parent::form( $instance );
	}

	/**
	 * Init settings after post types are registered.
	 */
	public function init_settings() {
		$attribute_array = array();

		$attribute_taxonomies = get_object_taxonomies( 'product' );

		$attribute_taxonomies = array_splice( $attribute_taxonomies, 0, 4 );
		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $tax ) {
					$attribute_array[ $tax ] = $tax;

			}
		}

		$this->settings = array(
			'title'      => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Filter by', 'brator-core' ),
				'label' => esc_html__( 'Title', 'brator-core' ),
			),
			'attribute'  => array(
				'type'    => 'select',
				'std'     => '',
				'label'   => esc_html__( 'Attribute', 'brator-core' ),
				'options' => $attribute_array,
			),
			'query_type' => array(
				'type'    => 'select',
				'std'     => 'and',
				'label'   => esc_html__( 'Query type', 'brator-core' ),
				'options' => array(
					'and' => esc_html__( 'And', 'brator-core' ),
					'or'  => esc_html__( 'Or', 'brator-core' ),
				),
			),
		);
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}
		$_chosen_attributes = $this->get_layered_nav_chosen_taxonomy();
		$taxonomy           = isset( $instance['attribute'] ) ? $instance['attribute'] : $this->settings['attribute']['std'];
		$query_type         = isset( $instance['query_type'] ) ? $instance['query_type'] : $this->settings['query_type']['std'];

		if ( ! taxonomy_exists( $taxonomy ) ) {
			return;
		}

		$get_terms_args = array( 'hide_empty' => '1' );
		$orderby        = wc_attribute_orderby( $taxonomy );

		switch ( $orderby ) {
			case 'name':
				$get_terms_args['orderby']    = 'name';
				$get_terms_args['menu_order'] = false;
				break;
			case 'id':
				$get_terms_args['orderby']    = 'id';
				$get_terms_args['order']      = 'ASC';
				$get_terms_args['menu_order'] = false;
				break;
			case 'menu_order':
				$get_terms_args['menu_order'] = 'ASC';
				break;
		}

		$terms = get_terms( $taxonomy, $get_terms_args );
		if ( 0 === sizeof( $terms ) ) {
			return;
		}
		switch ( $orderby ) {
			case 'name_num':
				usort( $terms, '_wc_get_product_terms_name_num_usort_callback' );
				break;
			case 'parent':
				usort( $terms, '_wc_get_product_terms_parent_usort_callback' );
				break;
		}

		ob_start();
		$this->widget_start( $args, $instance );

		$found = $this->layered_nav_list( $terms, $taxonomy, $query_type );

		$this->widget_end( $args );
		if ( ! is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) ) {
			$found = true;
		}

		if ( ! $found ) {
			echo ob_end_clean();
		} else {
			echo ob_get_clean();
		}
	}

	/**
	 * Return the currently viewed taxonomy name.
	 *
	 * @return string
	 */
	protected function get_current_taxonomy() {
		return is_tax() ? get_queried_object()->taxonomy : '';
	}

	/**
	 * Return the currently viewed term ID.
	 *
	 * @return int
	 */
	protected function get_current_term_id() {
		return absint( is_tax() ? get_queried_object()->term_id : 0 );
	}

	/**
	 * Return the currently viewed term slug.
	 *
	 * @return int
	 */
	protected function get_current_term_slug() {
		return absint( is_tax() ? get_queried_object()->slug : 0 );
	}

	/**
	 * Get current page URL for layered nav items.
	 *
	 * @return string
	 */
	protected function get_page_base_url( $taxonomy ) {
		if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url( '/' );
		} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			$link = get_post_type_archive_link( 'product' );
		} elseif ( is_product_category() ) {
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		} elseif ( is_product_tag() ) {
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		} else {
			$queried_object = get_queried_object();
			$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
		}

		// Min/Max
		if ( isset( $_GET['min_price'] ) ) {
			$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
		}

		if ( isset( $_GET['max_price'] ) ) {
			$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
		}

		// Orderby
		if ( isset( $_GET['orderby'] ) ) {
			$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
		}

		/**
		 * Search Arg.
		 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
		 */
		if ( get_search_query() ) {
			$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
		}

		// Post Type Arg
		if ( isset( $_GET['post_type'] ) ) {
			$link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
		}

		// Min Rating Arg
		if ( isset( $_GET['min_rating'] ) ) {
			$link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
		}

		// All current filters

		if ( $_chosen_attributes = $this->get_layered_nav_chosen_taxonomy() ) {

			foreach ( $_chosen_attributes as $name => $data ) {
				if ( $name === $taxonomy ) {
					continue;
				}

				// $filter_name = sanitize_title(str_replace('pa_', '', $name));
				if ( ! empty( $data['terms'] ) ) {
					$link = add_query_arg( 'filter_' . $name, implode( ',', $data['terms'] ), $link );
				}
				if ( 'or' == $data['query_type'] ) {
					$link = add_query_arg( 'query_type_' . $name, 'or', $link );
				}
			}
		}

		return esc_url( $link );
	}

	/**
	 * Show list based layered nav.
	 *
	 * @param  array  $terms
	 * @param  string $taxonomy
	 * @param  string $query_type
	 * @return bool Will nav display?
	 */
	protected function layered_nav_list( $terms, $taxonomy, $query_type ) {

		// List display
		echo '<div class="brator-filter-item-content">';
		echo '<ul>';

		$_chosen_attributes = $this->get_layered_nav_chosen_taxonomy();
		$found              = false;

		foreach ( $terms as $term ) {

			$current_values = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();

			$option_is_set = in_array( $term->slug, $current_values );

			$count = $term->count;

			// Only show options with count > 0
			if ( 0 < $count ) {
				$found = true;
			}

			$filter_name = 'filter_' . sanitize_title( $taxonomy );

			$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();

			$current_filter = array_map( 'sanitize_title', $current_filter );

			if ( ! in_array( $term->slug, $current_filter ) ) {
				$current_filter[] = $term->slug;
			}

			$link = $this->get_page_base_url( $taxonomy );
			// Add current filters to URL.
			foreach ( $current_filter as $key => $value ) {
				// Exclude query arg for current term archive term
				if ( $value === $this->get_current_term_slug() ) {
					unset( $current_filter[ $key ] );
				}

				// Exclude self so filter can be unset on click.
				if ( $option_is_set && $value === $term->slug ) {
					unset( $current_filter[ $key ] );
				}
			}

			if ( ! empty( $current_filter ) ) {

				$link = str_replace( '#038;', '&', $link );

				$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

				// Add Query type Arg to URL
				if ( $query_type === 'or' && ! ( 1 === sizeof( $current_filter ) && $option_is_set ) ) {
					$link = add_query_arg( 'query_type_' . sanitize_title( $taxonomy ), 'or', $link );

				}
			}

			$brand_chosen = '';
			$model_chosen = '';
			if ( isset( $_REQUEST['search'] ) == 'advanced' && ! is_admin() ) {
				if ( isset( $_GET['brand'] ) && ! empty( $_GET['brand'] ) ) {
					$brand = $_GET['brand'];
					if ( $brand == $term->slug ) {
						$brand_chosen = 'chosen';
					}
				}
				if ( isset( $_GET['model'] ) && ! empty( $_GET['model'] ) ) {
					$model = $_GET['model'];
					if ( $model == $term->slug ) {
						$model_chosen = 'chosen';
					}
				}
			}

			echo '<li class="wc-layered-nav-term ' . $model_chosen . ' ' . $brand_chosen . ' ' . ( $option_is_set ? 'chosen' : '' ) . '">';

			if ( $count > 0 ) {
				echo '<a href="' . esc_url( apply_filters( 'woocommerce_layered_nav_link', $link ) ) . '">';
			} else {
				echo '<span>';
			}

			echo esc_html( $term->name );
			if ( $count > 0 ) {
				echo '</a>';
			} else {
				echo '</span>';
			}
			echo apply_filters( 'woocommerce_layered_nav_count', '<span class="count">(' . absint( $count ) . ')</span>', $count, $term );
			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';
		return $found;
	}



	public function get_layered_nav_chosen_taxonomy() {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( ! is_array( self::$chosen_attributes ) ) {
			self::$chosen_attributes = array();

			if ( ! empty( $_GET ) ) {
				foreach ( $_GET as $key => $value ) {

					if ( 0 === strpos( $key, 'filter_' ) ) {
						$attribute = wc_sanitize_taxonomy_name( str_replace( 'filter_', '', $key ) );

						$taxonomy     = $attribute;
						$filter_terms = ! empty( $value ) ? explode( ',', wc_clean( wp_unslash( $value ) ) ) : array();

						if ( empty( $filter_terms ) || ! taxonomy_exists( $taxonomy ) ) {

							continue;
						}

						$query_type                                    = ! empty( $_GET[ 'query_type_' . $attribute ] ) && in_array( $_GET[ 'query_type_' . $attribute ], array( 'and', 'or' ), true ) ? wc_clean( wp_unslash( $_GET[ 'query_type_' . $attribute ] ) ) : '';
						self::$chosen_attributes[ $taxonomy ]['terms'] = array_map( 'sanitize_title', $filter_terms ); // Ensures correct encoding.
						self::$chosen_attributes[ $taxonomy ]['query_type'] = $query_type ? $query_type : apply_filters( 'woocommerce_layered_nav_default_query_type', 'and' );
					}
				}
			}
		}
		return self::$chosen_attributes;
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
	}


}
