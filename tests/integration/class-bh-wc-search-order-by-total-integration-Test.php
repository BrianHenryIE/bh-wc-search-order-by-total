<?php
/**
 * Class Plugin_Test. Tests the root plugin setup.
 *
 * @package BH_WC_Search_Order_By_Total
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Search_Order_by_Total;

use BrianHenryIE\WC_Search_Order_by_Total\Includes\BH_WC_Search_Order_By_Total;

/**
 * Verifies the plugin has been instantiated and added to PHP's $GLOBALS variable.
 */
class Plugin_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Test the main plugin object is added to PHP's GLOBALS and that it is the correct class.
	 */
	public function test_plugin_instantiated() {

		$this->assertArrayHasKey( 'bh_wc_search_order_by_total', $GLOBALS );

		$this->assertInstanceOf( BH_WC_Search_Order_By_Total::class, $GLOBALS['bh_wc_search_order_by_total'] );
	}

}
