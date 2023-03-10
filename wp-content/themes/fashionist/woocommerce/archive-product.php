<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header(); 
$temp = '';

$shopLayout = FashionistOptions::get( 'shop_layout' );
if($shopLayout != null){
	$temp = $shopLayout;
}
if(isset($_GET['style'])){
	$temp = $_GET['style'];		
}
?>
<!-- page title -->
 <?php $current_category = single_cat_title("", false); ?> 
<div class="sub-nav hidden-xs hidden-sm hidden-md">
    <div class="container">
        <div class="row">
              <span class="sub-nav-span product-page-category-title"><?php woocommerce_breadcrumb(); ?></span>  

        </div>
    </div>
</div>
<!--/ page title -->

<div class="container">
	<div class="row">
		<?php if($temp === '3' || $temp === '4') { ?>
			<aside id="shop-sidebar" class="sidebar col-xs-12 col-md-3 woocommerce">
				<?php dynamic_sidebar('woocommerce'); ?>
			</aside>
		<?php } ?>

		<?php if($temp === '1' || $temp === '3') { ?>
			<div id="shop-list" class="content col-xs-12 <?php if($temp === '3'){ echo 'col-md-9'; }?>">
		<?php }	else { ?>
			<div id="shop-grid" class="content col-xs-12 <?php if($temp === '4'){ echo 'col-md-9'; }?>">	
		<?php } ?>

			<div class="row">				
					
					<div class="product-category-title"><span><?php echo $current_category; ?></span></div>

					<?php
						do_action( 'woocommerce_archive_description' );						
					?>
					<div class="product-listing-view">

					<?php if ( have_posts() ) : ?>
						
							<div class="row">
								<div class="shop-options">

									<?php do_action( 'woocommerce_before_shop_loop' ); ?>
								</div>	
							</div>
						<div class="sub_cat">
							<?php woocommerce_product_loop_start(); ?>
</div>
								<?php woocommerce_product_subcategories(); ?>

								<?php 
									while ( have_posts() ) : the_post();
										if($temp === '1' || $temp === '3') {
											wc_get_template_part( 'list-content', 'product' );
										}else{
											wc_get_template_part( 'grid-content', 'product' );
										}
									endwhile;								
								?>
							<?php woocommerce_product_loop_end(); ?>						
						<?php
							do_action( 'woocommerce_after_shop_loop' );
						?>
					
					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
						<?php wc_get_template( 'loop/no-products-found.php' ); ?>
					<?php endif; ?>
					</div>


				<?php
					do_action( 'woocommerce_after_main_content' );
				?>
				
				
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>