<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * frontend-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wc-search-order-by-total
 */

namespace BrianHenryIE\WC_Search_Order_by_Total\Includes;

use BrianHenryIE\WC_Search_Order_by_Total\WooCommerce\Order_Admin_List;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * frontend-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    brianhenryie/bh-wc-search-order-by-total
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class BH_WC_Search_Order_By_Total {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the frontend-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->define_woocommerce_orer_admin_list_hooks();
	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 */
	protected function define_woocommerce_orer_admin_list_hooks(): void {

		$order_admin_list = new Order_Admin_List();

		add_action( 'parse_query', array( $order_admin_list, 'remove_currency_symbol' ) );
		add_filter( 'woocommerce_shop_order_search_fields', array( $order_admin_list, 'search_order_by_total' ) );

	}

}
