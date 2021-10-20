<?php
/**
 * Tests for the root plugin file.
 *
 * @package BH_WC_Search_Order_By_Total
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Search_Order_by_Total;

use BrianHenryIE\WC_Search_Order_by_Total\Includes\BH_WC_Search_Order_By_Total;

/**
 * Class Plugin_WP_Mock_Test
 */
class Plugin_Unit_Test extends \Codeception\Test\Unit {

	protected function setup() : void {
		parent::setUp();
		\WP_Mock::setUp();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
		parent::tearDown();
	}

	/**
	 * Verifies the plugin initialization.
	 * Verifies the plugin does not output anything to screen.
	 */
	public function test_plugin_include() {

		// Prevents code-coverage counting, and removes the need to define the WordPress functions that are used in that class.
		\Patchwork\redefine(
			array( BH_WC_Search_Order_By_Total::class, '__construct' ),
			function() {}
		);

		$plugin_root_dir = dirname( __DIR__, 2 ) . '/src';

		\WP_Mock::userFunction(
			'plugin_dir_path',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => $plugin_root_dir . '/',
			)
		);

		\WP_Mock::userFunction(
			'register_activation_hook'
		);

		\WP_Mock::userFunction(
			'register_deactivation_hook'
		);

		ob_start();

		include $plugin_root_dir . '/bh-wc-search-order-by-total.php';

		$printed_output = ob_get_contents();

		ob_end_clean();

		$this->assertEmpty( $printed_output );

		$this->assertArrayHasKey( 'bh_wc_search_order_by_total', $GLOBALS );

		$this->assertInstanceOf( BH_WC_Search_Order_By_Total::class, $GLOBALS['bh_wc_search_order_by_total'] );

	}

}
