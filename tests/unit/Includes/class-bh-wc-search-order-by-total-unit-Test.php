<?php
/**
 * @package BH_WC_Search_Order_By_Total_Unit_Name
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Search_Order_by_Total\Includes;

use BrianHenryIE\WC_Search_Order_by_Total\Admin\Admin;
use BrianHenryIE\WC_Search_Order_by_Total\Frontend\Frontend;
use WP_Mock\Matcher\AnyInstance;

/**
 * Class BH_WC_Search_Order_By_Total_Unit_Test
 *
 * @coversDefaultClass \BH_WC_Search_Order_By_Total\Includes\BH_WC_Search_Order_By_Total
 */
class BH_WC_Search_Order_By_Total_Unit_Test extends \Codeception\Test\Unit {

	protected function setup(): void {
		parent::setup();
		\WP_Mock::setUp();
	}

	protected function tearDown(): void {
		parent::tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * @covers ::set_locale
	 */
	public function test_set_locale_hooked() {

		\WP_Mock::expectActionAdded(
			'init',
			array( new AnyInstance( I18n::class ), 'load_plugin_textdomain' )
		);

		new BH_WC_Search_Order_By_Total();
	}

	/**
	 * @covers ::define_admin_hooks
	 */
	public function test_admin_hooks() {

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			array( new AnyInstance( Admin::class ), 'enqueue_styles' )
		);

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			array( new AnyInstance( Admin::class ), 'enqueue_scripts' )
		);

		new BH_WC_Search_Order_By_Total();
	}

	/**
	 * @covers ::define_frontend_hooks
	 */
	public function test_frontend_hooks() {

		\WP_Mock::expectActionAdded(
			'wp_enqueue_scripts',
			array( new AnyInstance( Frontend::class ), 'enqueue_styles' )
		);

		\WP_Mock::expectActionAdded(
			'wp_enqueue_scripts',
			array( new AnyInstance( Frontend::class ), 'enqueue_scripts' )
		);

		new BH_WC_Search_Order_By_Total();
	}

}
