<?php
/**
 * Bundle add-to-cart template
 *
 * @author  YITH
 * @var array $attributes           The attributes.
 * @var array $selected_attributes  The selected attributes.
 * @var array $bundled_items        The bundled items.
 *
 * @var array $available_variations The available variations.
 * @package YITH\ProductBundles\Templates
 */

defined( 'YITH_WCPB' ) || exit;

/**
 * The bundle product
 *
 * @var WC_Product_Yith_Bundle $product
 */
global $product;

// Late style and scripts loading.
wp_enqueue_style( 'yith_wcpb_bundle_frontend_style' );
wp_enqueue_script( 'yith_wcpb_bundle_frontend_add_to_cart' );

echo wc_get_stock_html( $product ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

$form_data = array(
	'product-id'        => $product->get_id(),
	'per-item-pricing'  => $product->per_items_pricing,
	'ajax-update-price' => apply_filters( 'yith_wcpb_ajax_update_price_enabled', $product->per_items_pricing, $product ),
);

$form_data = apply_filters( 'yith_wcpb_bundle_product_form_data', $form_data, $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<?php do_action( 'yith_wcpb_before_add_to_cart_form' ); ?>

	<form class="cart yith-wcpb-bundle-form" method="post" enctype='multipart/form-data'
		<?php yith_plugin_fw_html_data_to_string( $form_data, true ); ?>
	>

		<?php
		$bi_args = array(
			'product'              => $product,
			'available_variations' => $available_variations,
			'attributes'           => $attributes,
			'selected_attributes'  => $selected_attributes,
			'bundled_items'        => $bundled_items,
		);
		wc_get_template( '/single-product/add-to-cart/yith-bundle-items-list.php', $bi_args, '', YITH_WCPB_TEMPLATE_PATH . '/premium' );

		if ( ! $product->is_purchasable() ) {
			echo '</form>';

			return;
		}
		?>

		<?php //do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		if ( ! $product->is_sold_individually() ) {
			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
				)
			);
		}

		/**
		 * Action: woocommerce_after_add_to_cart_quantity
		 *
		 * @since 1.2.8
		 */
		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>

		<?php
		$add_to_cart_button = '<button type="submit" class="single_add_to_cart_button button alt yith-wcpb-add-to-cart-button">' . esc_html( $product->single_add_to_cart_text() ) . '</button>';
		echo apply_filters( 'yith_wcpb_single_product_add_to_cart_button', $add_to_cart_button ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
