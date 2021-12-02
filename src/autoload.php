<?php
/**
 * Loads all required classes
 *
 * Uses classmap, PSR4 & wp-namespace-autoloader.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           brianhenryie/bh-wc-search-order-by-total
 *
 * @see https://github.com/pablo-sg-pacheco/wp-namespace-autoloader/
 */

namespace BrianHenryIE\WC_Search_Order_by_Total;

use BrianHenryIE\WC_Search_Order_by_Total\Pablo_Pacheco\WP_Namespace_Autoloader\WP_Namespace_Autoloader;

// Load strauss classes after autoload-classmap.php so classes can be substituted.
require_once __DIR__ . '/strauss/autoload.php';

$wpcs_autoloader = new WP_Namespace_Autoloader();
$wpcs_autoloader->init();

