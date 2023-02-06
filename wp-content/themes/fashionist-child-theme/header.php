<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fashionist 
 */
?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/uploads/2018/03/logo.png" type="image/x-icon" />
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> -->
<script>
	jQuery(document).ready(function(){
	    jQuery(".rating").click(function(){
	        jQuery("ul.nav-tabs > li.nav").removeClass("active");
	        jQuery(".tab-content #tab-description").removeClass("active");
	    });
	});
     
    jQuery(document).ready(function(){
	    jQuery(".rating").click(function(){
	        jQuery("#product-review-tabs").addClass("active");
	        jQuery(".tab-content #tab-reviews").addClass("active");
	    });
	});

	jQuery(document).ready(function(){
	jQuery(".nav-tabs > li:nth-child(2)").attr("id","product-review-tabs");
	});

	jQuery(document).ready(function(){
	    jQuery(".rating").click(function() {
	    window.location = "#product-review-tabs";
		});
			setTimeout(function(){
document.querySelector('.review-top').innerHTML=('<a href="https://www.shopperapproved.com/reviews/GREENLEAFAIR.COM/" class="shopperlink"><img src="//www.shopperapproved.com/newseals/28848/white-header-details.gif" style="border: 0" alt="Customer Reviews" oncontextmenu="var d = new Date(); alert(\'Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 \'+d.getFullYear()+\'.\'); return false;" /></a>');
				document.querySelectorAll('.review-top')[0].style.display="block";
				(function() { var js = window.document.createElement("script"); js.src = '//www.shopperapproved.com/seals/certificate.js'; js.type = "text/javascript"; document.getElementsByTagName("head")[0].appendChild(js); })();
},800);
		
	});

</script>
<style>
.review-top:nth-child(1) {
    display: none;
}
</style>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('/layouts/headers/header','1'); ?>	
