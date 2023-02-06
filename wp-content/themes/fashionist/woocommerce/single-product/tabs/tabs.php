<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="product-tab" id="tabs">
		<ul class="nav nav-tabs">
			<?php
			$counter = 1;
			foreach ( $tabs as $key => $tab ) :
			?>
				<li class="<?php echo ($counter==1)?'nav active':''; ?>">
					<a data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php
			$counter++;
			endforeach;
			?>
		</ul>
		<div class="tab-content">
			<?php
			$counter = 1;
			foreach ( $tabs as $key => $tab ) : ?>
				<div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane <?php echo ($counter==1)?'active':''; ?>">		<div class="ui-tabs-panel ui-corner-bottom ui-widget-content">		
                	
						<?php if($key=="reviews"){ ?>
                        <script type="text/javascript"> 
						document.querySelector('.entry-summary .rating').insertAdjacentHTML('beforebegin','<div id="product_just_stars" class="reg"></div>');
						var sa_products_count = 3; var sa_date_format = 'F j, Y'; var sa_product = document.querySelector('input[name=ppom_product_id]').value; (function(w,d,t,f,o,s,a){ o = 'shopperapproved'; if (!w[o]) { w[o] = function() { (w[o].arg = w[o].arg || []).push(arguments) }; s=d.createElement(t), a=d.getElementsByTagName(t)[0];s.async=1;s.src=f;a.parentNode.insertBefore(s,a)} })(window,document,'script','//www.shopperapproved.com/product/28848/'+sa_product+'.js'); </script> <div id="shopper_review_page"><div id="review_header"></div><div id="product_page"></div><div id="review_image"><a href="https://www.shopperapproved.com/reviews/GREENLEAFAIR.COM/" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; var certheight=screen.availHeight-90; window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no'); return false;" target="_blank" rel="nofollow"></a></div></div>
							<?php
							}
						else{call_user_func( $tab['callback'], $key, $tab );} ?>
                        
					</div>	
				</div>
			<?php
			$counter++;
			endforeach;
			?>
		</div>	
	</div>

<?php endif; ?>
