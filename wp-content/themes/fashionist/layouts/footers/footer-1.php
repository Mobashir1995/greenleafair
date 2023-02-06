<!-- Footer -->
<?php 
    $fsFooter =  FashionistOptions::get( 'footer_v' );    
?>
<footer id="footer" class="<?php if($fsFooter == 2 || $fsFooter == null){ echo esc_html__('bordertop','fashionist'); } ?>">
    <div class="container">
        <div class="col-xs-12 col-lg-4">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
                    <?php dynamic_sidebar('footer-left'); ?>
                <?php endif; ?>
                <div class="social">
                    <?php 
                        $facebook = FashionistOptions::get( 'facebook_link');
                        $twitter = FashionistOptions::get( 'twitter_link');
                        $instagram = FashionistOptions::get( 'instagram_link');
                        $pinteresr = FashionistOptions::get( 'pinterest_link');
                    ?>                  
                    <a href="<?php if($twitter != null ) { echo esc_html($twitter); } else { echo esc_html__('#','fashionist'); } ?>"><span class="icon-twitter-square"></span><span class="hidden-xs"><?php echo esc_html__('Twitter','fashionist'); ?></span></a>                    

                    <a href="<?php if($facebook != null ) { echo esc_html($facebook); } else { echo esc_html__('#','fashionist'); } ?>"><span class="icon-facebook-square"></span><span class="hidden-xs"><?php echo esc_html__('Facebook','fashionist'); ?></span></a>
                    
                    <a href="<?php if($instagram != null ) { echo esc_html($instagram); } else { echo esc_html__('#','fashionist'); } ?>"><span class="icon-instagram-square"></span><span class="hidden-xs"><?php echo esc_html__('Instagram','fashionist'); ?></span></a>
                    
                    <a href="<?php if($pinteresr != null ) { echo esc_html($pinteresr); } else { echo esc_html__('#','fashionist'); } ?>"><span class="icon-pinterest-square"></span><span class="hidden-xs"><?php echo esc_html__('Pinterest','fashionist'); ?></span></a>

                </div>
            </div>
        </div>
        <?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
            <?php dynamic_sidebar('footer-right'); ?>
        <?php endif; ?>
    </div>
    <div class="footer-container">
        <div class="col-xs-12 col-sm-12">
            <div class="row">
                <span class="copy">
                    <?php  
                        $copyright_text = FashionistOptions::get( 'copyright_text'); 
                        if($copyright_text != null ){
                            echo esc_html($copyright_text);
                        } else {
                            echo esc_html(''.date("Y").' by Fashionist | All rights reserved','fashionist');
                        }
                    ?>                    
                </span>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12">
            <div class="row">
                <div class="cards">
                    <?php if ( is_active_sidebar( 'footer-cards' ) ) : ?>
                        <?php dynamic_sidebar('footer-cards'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div> 
    </div>
	
	
	
</footer>

<script>
jQuery(document).ready(function(){
	jQuery(".mobile-menu").click(function(){
		jQuery(this).toggleClass("menu-open");
	});
});
	document.querySelector('.footer-payment-method').insertAdjacentHTML('afterend','<a href="https://www.shopperapproved.com/reviews/GREENLEAFAIR.COM/" class="shopperlink" style="text-align: center;"><img src="//www.shopperapproved.com/newseals/28848/white-mini-icon.gif" style="border: 0" alt="Customer Reviews" oncontextmenu="var d = new Date(); alert(\'Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 \'+d.getFullYear()+\'.\'); return false;" /></a>');
(function() { var js = window.document.createElement("script"); js.src = '//www.shopperapproved.com/seals/certificate.js'; js.type = "text/javascript"; document.getElementsByTagName("head")[0].appendChild(js); })();
	function getStarContainer(){
	var CartButts=document.querySelectorAll('.add_to_cart_button');
for(var c=0;c < CartButts.length;c++){
   var CartBtn=CartButts[c];
   var prodId=CartBtn.getAttribute('data-product_id');
   CartBtn.insertAdjacentHTML('beforebegin', '<div class="star_container '+prodId+'"></div>');
   // console.log(prodId);
}

function saLoadScript(src) { var js = window.document.createElement('script'); js.src = src; js.type = 'text/javascript'; document.getElementsByTagName("head")[0].appendChild(js); } saLoadScript('//www.shopperapproved.com/widgets/group2.0/28848.js'); 
	
	}
if( window.location.pathname.indexOf("shop") > -1 ){
setTimeout(getStarContainer,2000);

}
</script>
<style>
.woocommerce .star-rating {
    display: none;
}
</style>