<?php
/**
 *
 * Forcefulle Enable/Disable Comment
 *
 * @since 1.0.3
 * @package PluginDevs
 */

/**
 * 
 * Display Product Category Shortcode
 * 
 * @param array $atts Shortcode Attributes.
 * 
 * @return string HTML
 * 
 */
function fashion_product_categories_shortcode( $atts ) {
	$attr = shortcode_atts(
		array(
			'ids' => '',
		),
		$atts
	);
	ob_start();
	$ids                = array_filter( array_map( 'trim', explode( ',', $attr['ids'] ) ) );
	$args               = array(
		'include' => $ids,
	);
	$product_categories = apply_filters(
		'woocommerce_product_categories',
		get_terms( 'product_cat', $args )
	);
	?>
	<div class="fashion_services_lists">
		<?php
		if ( ! empty( $product_categories ) ) {
			foreach ( $product_categories as $category ) {
				$cat_thumb_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
				?>
			<div class="fashion-service">
				<div class="fashion-service-inn">
					<div class="fashion-service-image">
						<a href="<?php echo get_term_link( $category->term_id, 'product_cat' ); ?>">
										<?php echo wp_get_attachment_image( $cat_thumb_id, 'medium' ); ?>
						</a>
					</div>
					<div class="fashion-service-content">
						<h2>
							<a href="<?php echo get_term_link( $category->term_id, 'product_cat' ); ?>">
										<?php echo trim( $category->name ); ?>
							</a>
						</h2>
					</div>
				</div>
			</div>
					<?php
			}
		}
		?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fashion_product_categories', 'fashion_product_categories_shortcode' );

/**
 * 
 * Display Fashion Service Lists Shortcode
 * 
 * @param array $atts Shortcode Attributes.
 * 
 * @return void
 * 
 */
function fashion_services_lists_shortcode( $atts, $content = 'null' ) {
	ob_start();
	echo '<div class="fashion_services_lists">' . apply_filters( 'the_content', $content ) . '</div>';
	return ob_get_clean();
}
add_shortcode( 'fashion_services_lists', 'fashion_services_lists_shortcode' );

/**
 * 
 * Display Fashion Service Single List Shortcode
 * 
 * @param array $atts Shortcode Attributes.
 * 
 * @return void
 * 
 */
function fashion_service_list_shortcode( $atts ) {
	$attr = shortcode_atts(
		array(
			'image' => '',
			'title' => '',
			'link'  => '',
			'text'  => '',
		),
		$atts
	);
	ob_start();
	?>
	<div class="fashion-service">
		<div class="fashion-service-inn">
			<div class="fashion-service-image">
				<a href="<?php echo $attr['link']; ?>"><img src="<?php echo $attr['image']; ?>" alt="<?php echo $attr['title']; ?>"></a>
			</div>
			<div class="fashion-service-content">
				<h2><a href="<?php echo $attr['link']; ?>"><?php echo $attr['title']; ?></a></h2>
				<div class="fahsion-service-desc">
					<?php echo $attr['text']; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fashion_service', 'fashion_service_list_shortcode' );

/**
 * 
 * Display Fashion Product Grid Shortcode
 * 
 * @param array $atts Shortcode Attributes.
 * 
 * @return void
 * 
 */
function fashion_product_grid_shortcode( $atts ) {
	$attr = shortcode_atts(
		array(
			'cat_slug' => 'goodman-air-handler',
			'limit'    => '9',
		),
		$atts
	);
	ob_start();
	$cat_slug = explode( ',', $attr['cat_slug'] );
	// $products = wc_get_products($args);
	$products = new WP_Query(
		array(
			'post_type'           => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $attr['limit'],
			'tax_query'           => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $cat_slug,
				),
			),
		)
	);

	// print_r($args);
	if ( $products->have_posts() ) {
		echo '<div class="fashion-product-grid">';
		while ( $products->have_posts() ) {
			$products->the_post();
			$product = wc_get_product( get_the_ID() );
			$img_url = wp_get_attachment_image( get_post_thumbnail_id( $product->get_id() ), 'large' );
			?>
			<div class="fashion-product">
				<div class="fashion-product-inn">
					<?php if ( trim( $img_url ) != '' ) { ?>
						<div class="fashion-product-image">
							<a href="<?php echo get_permalink( $product->get_id() ); ?>">
								<?php echo $img_url; ?>
							</a>
							<div class="actions show">
								<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $product->get_id() . '" label="" icon="fa-heart-o" already_in_wishslist_text="" browse_wishlist_text=""]' ); ?>
								<a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="action add_to_cart_button ajax_add_to_cart added" data-wpel-link="internal"><span class="icon-shoppingcart"></span></a>
							</div>
						</div>
					<?php } ?>
					<div class="fashion-product-desc">
						<h2 class="fashion-product-title">
							<a href="<?php echo get_permalink( $product->get_id() ); ?>">
								<?php echo $product->get_name(); ?>
							</a>
						</h2>
						<p class="fashion-product-price"><?php echo $product->get_price_html(); ?></p>
					</div>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
		echo '</div>';
	}
	return ob_get_clean();
}
add_shortcode( 'fashion_product_grid', 'fashion_product_grid_shortcode' );

/**
 * 
 * Display Fashion Blog Posts List Shortcode
 * 
 * @param array $atts Shortcode Attributes.
 * 
 * @return void
 * 
 */
function fashion_blog_posts_grid_shortcode( $atts ) {
	$attr = shortcode_atts(
		array(
			'limit' => '3',
		),
		$atts
	);
	ob_start();
	$args  = array(
		'posts_per_page'      => $attr['limit'],
		'ignore_sticky_posts' => 1,
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		?>
		<div class="linp-post-list wh-post-list wh-text-color">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
		  <div class="wh-padding fashion-blog-item">
			 <div class="img-container">
				<div class="date">
				   <div class="month">
				  <?php echo get_the_date( 'M' ); ?>
				   </div>
				   <div class="separator"></div>
				   <div class="day">
				  <?php echo get_the_date( 'j' ); ?>
				   </div>
				</div>
				<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'large' );
				} else {
					echo '<img src="https://via.placeholder.com/400">'; }
				?>
				</a>
			 </div>
			 <div class="data">
				<h3>
				   <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="content">
				<?php the_excerpt(); ?>
				</div>
			 </div>
		  </div>
		  <?php } wp_reset_postdata(); ?>
		</div>
		<?php
	}
	return ob_get_clean();
}
add_shortcode( 'fashion_blog_posts_grid', 'fashion_blog_posts_grid_shortcode' );


/**
 * 
 * Display Fashion Review List Shortcode
 * 
 * @param array $atts Shortcode Attributes.
 * 
 * @return void
 * 
 */
function client_review_grid_shortcode( $atts ) {
	$attr = shortcode_atts(
		array(
			'limit' => '3',
		),
		$atts
	);
	ob_start();
	$args  = array(
		'post_type'           => 'client',
		'posts_per_page'      => $attr['limit'],
		'ignore_sticky_posts' => 1,
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		?>
		<div class="fashion-clients-reviews">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
		  <div class="fashion-client-review">
			 <!-- <div class="fashion-client-img">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'large' );
				} else {
					echo '<img src="https://via.placeholder.com/100">'; }
				?>
			 </div> -->
			 <div class="fashion-client-desc">
				<div class="fashion-client-desc">
				<?php the_excerpt(); ?>
				</div>
				<div class="fashion-client-designation">
					<h3><?php the_title(); ?></h3>
					<span class="color-green"><?php echo get_post_meta( get_the_ID(), 'client_designation', true ); ?></span>
				</div>
			 </div>
		  </div>
		  <?php } wp_reset_postdata(); ?>
		</div>
		<?php
	}
	return ob_get_clean();
}
add_shortcode( 'client_review_grid', 'client_review_grid_shortcode' );
