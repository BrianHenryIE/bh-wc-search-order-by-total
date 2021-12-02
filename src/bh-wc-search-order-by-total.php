<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           brianhenryie/bh-wc-search-order-by-total
 *
 * @wordpress-plugin
 * Plugin Name:       Search Order by Total
 * Plugin URI:        http://github.com/BrianHenryIE/bh-wc-search-order-by-total/
 * Description:       Enables searching WooCommerce orders by the order total.
 * Version:           1.0.1
 * Requires PHP:      7.4
 * Author:            BrianHenryIE
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wc-search-order-by-total
 * Domain Path:       /languages
 */

namespace BrianHenryIE\WC_Search_Order_by_Total;

use BrianHenryIE\WC_Search_Order_by_Total\Includes\BH_WC_Search_Order_By_Total;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BH_WC_SEARCH_ORDER_BY_TOTAL_VERSION', '1.0.1' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function instantiate_bh_wc_search_order_by_total(): BH_WC_Search_Order_By_Total {

	$plugin = new BH_WC_Search_Order_By_Total();

	return $plugin;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and frontend-facing site hooks.
 */
$GLOBALS['bh_wc_search_order_by_total'] = instantiate_bh_wc_search_order_by_total();
