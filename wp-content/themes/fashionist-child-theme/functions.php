<?php
/**
 * Theme functions
 *
 * @since 1.0.3
 * @package PluginDevs
 * 
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add Theme Support Functionalities
 */
function pd_fashion_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'pd_fashion_add_woocommerce_support' );

/**
 * Loads parent and child themes' style.css
 */
function pd_fashion_enqueue() {
	$parent_style    = 'fashion_style';
	$parent_base_dir = 'fashionist';
	$time            = time();
	// phpcs:disable
	/*
	if ( is_product() ) {
		wp_deregister_script('jquery');
		wp_deregister_script('jquery-migrate');
	}
	*/
	// phpcs:enable

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		array(),
		$time
	);

	wp_enqueue_style(
		'font-awesome-5',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css',
		array(),
		'5.3.0'
	);

	wp_enqueue_style(
		'child_theme_style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		$time
	);

	wp_enqueue_script( 'fashionist-child', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(), $time, true );
}
add_action( 'wp_enqueue_scripts', 'pd_fashion_enqueue' );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

/**
 * Show Product Images
 */
function fashion_woocommerce_show_product_images() {
	global $product;
	echo '<a href="' . wp_get_attachment_image_url( $product->get_image_id(), 'single-post-thumbnail' ) . '">' . wp_get_attachment_image( $product->get_image_id(), 'single-post-thumbnail' ) . '</a>'; // phpcs:ignore
}
add_action( 'woocommerce_before_single_product_summary', 'fashion_woocommerce_show_product_images', 20 );

require_once get_stylesheet_directory() . '/inc/option-fields.php';
require_once get_stylesheet_directory() . '/inc/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/force-comment.php';

/**
 * Remove product data tabs
 *
 * @param $tabs array Tab Information
 * @return $tabs array Tab Information
 */
function woo_remove_product_tabs( $tabs ) {

	// unset( $tabs['description'] );          // Remove the description tab.
	unset( $tabs['reviews'] );          // Remove the reviews tab.
	unset( $tabs['additional_information'] );   // Remove the additional information tab.

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );


add_action( 'woocommerce_after_single_product_summary', 'comments_template', 50 );

/**
 * Change Product Price Programatically.
 *
 * @param $cart_item_data   object  Cart Item Object
 * @param $product_id       integer Product ID
 */
function wdm_add_item_data( $cart_item_data, $product_id ) {

	global $woocommerce;
	$product = wc_get_product( $product_id );
	if ( ! $product || ! $product->is_type( 'yith_bundle' ) ) {
		return $cart_item_data;
	}
	$new_value = array();
	if ( isset( $_REQUEST['green-custom-product-price'] ) && $_REQUEST['green-custom-product-price'] > 0 ) {
		$new_value['_custom_options']['custom_price'] = $_REQUEST['green-custom-product-price'];
	}

	if ( empty( $cart_item_data ) ) {
		return $new_value;
	} else {
		return array_merge( $cart_item_data, $new_value );
	}
}
add_filter( 'woocommerce_add_cart_item_data', 'wdm_add_item_data', 1, 10 );

/**
 * Get Cart Items from Session
 *
 * @param $item array
 * @param $values array
 * @param $key array
 */
function wdm_get_cart_items_from_session( $item, $values, $key ) {

	if ( array_key_exists( '_custom_options', $values ) ) {
		$item['_custom_options'] = $values['_custom_options'];
	}

	return $item;
}
add_filter( 'woocommerce_get_cart_item_from_session', 'wdm_get_cart_items_from_session', 1, 3 );

/**
 * Update Cart Custom Price
 *
 * @param $cart_object object
 */
function update_custom_price( $cart_object ) {

	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) {
		return;
	}

	foreach ( $cart_object->cart_contents as $cart_item_key => $value ) {
		// Version 2.x
		// $value['data']->price = $value['_custom_options']['custom_price'];
		// Version 3.x / 4.x
		if ( array_key_exists( '_custom_options', $value ) ) {
			$value['data']->set_price( $value['_custom_options']['custom_price'] );
		}
	}
}
add_action( 'woocommerce_before_calculate_totals', 'update_custom_price', 1, 1 );

/**
 * @snippet       Display FREE if Price Zero or Empty - WooCommerce Single Product
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @param $price  integer
 * @param $product object
 * @testedwith    WooCommerce 3.8
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
function bbloomer_price_free_zero_empty( $price, $product ) {
	if ( '' === $product->get_price() || 0 == $product->get_price() ) {
		$price = '<span class="woocommerce-Price-amount amount">$0.00</span>';
	}
	return $price;
}
add_filter( 'woocommerce_get_price_html', 'bbloomer_price_free_zero_empty', 9999, 2 );
