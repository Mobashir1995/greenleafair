<?php if( is_page('home-devss') ){ ?>
<!-- Main header -->
<!-- <?php $logoText //= //FashionistOptions::get( 'logo_text' ); ?> -->
<div class="top-bar_background">
<div class="main-top_bar content container">
<?php dynamic_sidebar('Sidebar'); ?>
</div>
</div>
<header id="mainh" class="container-fluid hidden-xs hidden-sm hidden-md">

    <div class="logo"><a href="<?php echo site_url(); ?>"> <img src="<?php echo site_url(); ?>/wp-content/uploads/2018/03/logo.png">
    <!--<?php if($logoText != null ) { echo esc_html($logoText); } else { echo esc_html__('Fashionist','fashionist'); } ?>-->     
    </a></div>
    <div class="container">
        <nav id="main-nav">
            <?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>            
        </nav>
    </div>    
  
    <div id="right-menu">
        <div class="lang">
            <?php if ( is_active_sidebar( 'languages' ) ) : ?>
                <?php dynamic_sidebar('languages'); ?>
            <?php endif; ?>               
        </div>
    
        <div class="currency">
            <?php if ( is_active_sidebar( 'currency' ) ) : ?>
                <?php dynamic_sidebar('currency'); ?>
            <?php endif; ?>
        </div>

        <?php if(fashionist_checkPlugin('woocommerce/woocommerce.php') ){ ?>
            <div class="cart">
                <?php do_action('fashionist_ajax_cart','true'); ?>
            </div>
        <?php } ?>
        
        <div class="slash">/</div>
        
        <div class="search">
            <span class="icon-search search-open"></span>
            <div id="bigsearch">
                <div class="close-search"></div>
                <div class="searchform">
                    <form role="search" method="get" class="searchform" action="<?php echo esc_url(site_url()); ?>">
                        <input type="text" class="search-field" placeholder="Search for something..." value="" name="s">
                       <input type="submit" value="Search" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /Main header -->

<!-- Mobile header -->
<header id="mobile-header" class="container-fluid hidden-lg">
    <span class="nav-open mobile-menu"><span class="icon-navicon custom-mobile-menu" id="mobile-custom"></span></span>
    <div>
        <div class="logo"><a href="<?php echo site_url(); ?>">
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2018/03/logo.png">
       <!-- <?php if($logoText != null ) { echo esc_html($logoText); } else { echo esc_html__('Green Leaf Air','fashionist'); } ?> -->
        </a></div>
    </div>
    
    <nav id="mobile-nav" class="col-xs-10 col-sm-5">
        <?php wp_nav_menu( array( 'theme_location' => 'mobile') ); ?>
    </nav>

<div class=""><?php if(fashionist_checkPlugin('woocommerce/woocommerce.php') ){ ?>
            <div class="cart">
                <?php do_action('fashionist_ajax_cart','true'); ?>
            </div>
        <?php } ?>
        
        <div class="slash">/</div>
        
        <div class="search">
            <span class="icon-search search-open"></span>
            <div id="bigsearch">
                <div class="close-search"></div>
                <div class="searchform">
                    <form role="search" method="get" class="searchform" action="<?php echo esc_url(site_url()); ?>">
                        <input type="text" class="search-field" placeholder="Search for something..." value="" name="s">
                       <input type="submit" value="Search" />
                    </form>
                </div>
            </div>
        </div></div>

</header>
<!-- /Mobile header -->
<?php }else{ ?>
<!-- New header -->
<!-- Main header -->
<!-- <?php $logoText //= //FashionistOptions::get( 'logo_text' ); ?> -->
<div class="top-bar_background header-top-bar_background ">
    <div class="main-top_bar content container d-flex lg-align-center">
        <?php //dynamic_sidebar('Sidebar'); ?>
        
        <?php
            $scheduled_appoint_text = FashionistOptions::get( 'scheduled_appoint_text');
            $scheduled_appoint_url = FashionistOptions::get( 'scheduled_appoint_url');
        ?>
        <div class="w-lg-25 appoint-button d-flex justify-con-start" >
            <a class="appoint-button-inn" href="<?php echo esc_url($scheduled_appoint_url); ?>">
                <i class="fas fa-calendar-alt"></i>
                <span><?php echo $scheduled_appoint_text; ?></span>
            </a>
        </div>
        <div class="w-lg-25 shoppers-review">
            <?php
                $review_one = FashionistOptions::get( 'review_one');
                echo $review_one;
            ?>
        </div>
        <div class="w-lg-25 d-none">
            <?php
                $review_two = FashionistOptions::get( 'review_two');
                echo $review_two;
            ?>
        </div>
        <div class="w-lg-25 d-flex justify-con-end">
            <div class="header-phone d-flex">
                <i class="fa fa-phone-square" aria-hidden="true"></i>
                <?php
                    $phone = FashionistOptions::get( 'call_text');
                    $callus_top_text = FashionistOptions::get( 'callus_top_text');
                ?>
                <div class="header-phone-text">
                    <strong class="header-phone-top">
                        <a href="tel: <?php echo $phone; ?>"><?php echo str_replace('{{phone_number}}', $phone, $callus_top_text); ?></a>
                    </strong>
                    <span class="header-phone-bottom"><?php echo $callus_bottom_text; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<header id="mainh" class="container-fluid hidden-xs hidden-sm hidden-md pd-fashion-header">

    <div class="logo pd-fashion-logo">
        <a href="<?php echo site_url(); ?>">
            <?php
                $logo = FashionistOptions::get( 'logo');
                if( !empty($logo) ){
                    echo wp_get_attachment_image($logo['id'], 'medium');
                }else{
                     echo esc_html__('Fashionist','fashionist');
                }
            ?>
        </a>
    </div>
    <div class="container">
        <nav id="main-nav">
            <?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>            
        </nav>
    </div>    
  
    <div id="right-menu">
        <div class="lang">
            <?php if ( is_active_sidebar( 'languages' ) ) : ?>
                <?php dynamic_sidebar('languages'); ?>
            <?php endif; ?>               
        </div>
    
        <div class="currency">
            <?php if ( is_active_sidebar( 'currency' ) ) : ?>
                <?php dynamic_sidebar('currency'); ?>
            <?php endif; ?>
        </div>

        <?php if(fashionist_checkPlugin('woocommerce/woocommerce.php') ){ ?>
            <div class="cart">
                <?php do_action('fashionist_ajax_cart','true'); ?>
            </div>
        <?php } ?>
        
        <div class="slash">/</div>
        
        <div class="search">
            <span class="icon-search search-open"></span>
            <div id="bigsearch">
                <div class="close-search"></div>
                <div class="searchform">
                    <form role="search" method="get" class="searchform" action="<?php echo esc_url(site_url()); ?>">
                        <input type="text" class="search-field" placeholder="Search for something..." value="" name="s">
                       <input type="submit" value="Search" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /Main header -->

<!-- Mobile header -->
<header id="mobile-header" class="container-fluid hidden-lg">
    <span class="nav-open mobile-menu"><span class="icon-navicon custom-mobile-menu" id="mobile-custom"></span></span>
    <div>
        <div class="logo"><a href="<?php echo site_url(); ?>">
            <?php
                if( !empty($logo) ){
                    echo wp_get_attachment_image($logo['id'], 'medium');
                }else{
            ?>
                <img src="<?php echo site_url(); ?>/wp-content/uploads/2018/03/logo.png">
            <?php } ?>
        </a></div>
    </div>
    
    <nav id="mobile-nav" class="col-xs-10 col-sm-5">
        <?php wp_nav_menu( array( 'theme_location' => 'mobile') ); ?>
    </nav>

<div class=""><?php if(fashionist_checkPlugin('woocommerce/woocommerce.php') ){ ?>
            <div class="cart">
                <?php do_action('fashionist_ajax_cart','true'); ?>
            </div>
        <?php } ?>
        
        <div class="slash">/</div>
        
        <div class="search">
            <span class="icon-search search-open"></span>
            <div id="bigsearch">
                <div class="close-search"></div>
                <div class="searchform">
                    <form role="search" method="get" class="searchform" action="<?php echo esc_url(site_url()); ?>">
                        <input type="text" class="search-field" placeholder="Search for something..." value="" name="s">
                       <input type="submit" value="Search" />
                    </form>
                </div>
            </div>
        </div></div>

</header>
<!-- /Mobile header -->
<!-- New header -->
<?php } ?>