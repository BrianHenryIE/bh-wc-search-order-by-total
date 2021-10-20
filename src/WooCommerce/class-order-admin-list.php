<?php
/**
 * If the search is for a decimal number, remove the currency symbol and search only the order total.
 *
 * @package brianhenryie/bh-wc-search-orders-by-total
 */

namespace BrianHenryIE\WC_Search_Order_by_Total\WooCommerce;

use WP_Query;

/**
 * WooCommerce stores the order total in the `_order_total` postmeta key.
 *
 * @see https://wordpress.stackexchange.com/questions/63664/do-i-need-to-sanitize-wordpress-search-query
 */
class Order_Admin_List {

	/**
	 * If the search query is an amount prefixed with a currency symbol, remove the currency symbol.
	 * The `_order_total` meta key does not contain the currency symbol.
	 *
	 * @hooked parse_query
	 * @see WP_Query::parse_query()
	 *
	 * @param WP_Query $_query The query object, which will be unused.
	 */
	public function remove_currency_symbol( WP_Query $_query ): void {

		$search_query = get_search_query();

		if ( empty( $search_query ) ) {
			return;
		}

		if ( ! file_exists( WP_PLUGIN_DIR . '/woocommerce/i18n/locale-info.php' ) ) {
			return;
		}

		$locale_info = include WP_PLUGIN_DIR . '/woocommerce/i18n/locale-info.php';

		$currency_symbols = array_map(
			function( $element ): string {
				$currency_symbol = $element['short_symbol'] ?? '';
				return preg_quote( $currency_symbol, '/' );
			},
			$locale_info
		);

		$unique_currency_symbols = array_filter( array_unique( array_values( $currency_symbols ) ) );

		$currency_symbols_string = implode( '|', $unique_currency_symbols );

		if ( 1 !== preg_match( '/^(' . $currency_symbols_string . ')?([\d.,]*\d+[.,]\d{2})$/u', $search_query, $output_array ) ) {
			return;
		}

		$_GET['s'] = $output_array[2];

	}

	/**
	 * If the search query is for an amount, search the order total.
	 * Remove other fields to improve performance.
	 *
	 * @hooked woocommerce_shop_order_search_fields
	 * @see WC_Order_Data_Store_CPT::search_orders()
	 *
	 * @param string[] $search_fields The existing set of meta fields to be used in the search.
	 * @return string[] Either the existing fields, or only '_order_total' meta key.
	 */
	public function search_order_by_total( $search_fields ): array {

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		if ( ! isset( $_GET['s'] ) ) {
			return $search_fields;
		}

		$search_query = sanitize_text_field( wp_unslash( $_GET['s'] ) );

		if ( 1 !== preg_match( '/^([\d.,]*\d+[.,]\d{2})$/u', $search_query, $output_array ) ) {
			return $search_fields;
		}

		$search_fields = array( '_order_total' );

		return $search_fields;
	}

}
