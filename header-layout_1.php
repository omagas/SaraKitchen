    <?php
        $header_text = get_theme_mod ('header_text_setting','+1-123-123-45-78');
        $show_social = get_theme_mod ('show_social', '0');
        $show_search = get_theme_mod ('show_search' ,'0');
        if($header_text == '' && $show_search == '1' && $show_social == '1'){
            $show_top_header = 'hide_top_header';
        }else{
            $show_top_header = '';
        }
        $aglee_pro_header_menu_align = get_theme_mod('header_menu_display_setting', 'menu_align_right');
        
    ?>
            <div class="social-media-hao">
                <a href="https://www.facebook.com/Sara%E7%9A%84%E9%A3%9F%E9%A3%9F%E8%AA%B2%E8%AA%B2-234239390013839/" target="_blank">
                    <img src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/06/icon-fb.png">
                </a>
                <a href="https://www.youtube.com/channel/UCa2PO2-QJMf65xCmaAN8xKQ" target="_blank">
                    <img src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/06/icon-youtube3.png">
                </a>  
                <a href="＃" target="_blank">
                    <img src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/06/icon-line.png">
                </a>                  
                <a href="＃" target="_blank">
                    <img src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/06/icon-wechat.png">
                </a>                               
            </div>    
    <header id="masthead" class="site-header layout-one <?php echo $show_top_header; ?> <?php echo $aglee_pro_header_menu_align; ?>" role="banner">

            <div class="top-header clearfix">
                <div class="ap clearfix">
                    <!-- header top content -->
                    <div class="content-top-head">
                       
                        <?php if(($show_search=get_theme_mod('show_search')) == 0) : ?>
                            <div class="search-icon">
                                <!--i class="fa fa-search">
                                </i-->
                                <div class="aglee-search">
                                         <form action="<?php echo site_url(); ?>" class="search-form" method="get" role="search">
                                            <label>
                                                <span class="screen-reader-text"><?php _e('Search for:', 'aglee-lite'); ?></span>
                                                <input type="search" title="Search for:" name="s" value="" placeholder="<?php _e('在煩惱什麼？', 'aglee-lite'); ?>" class="search-field">
                                            </label>
                                            <input type="submit" value="搜尋" class="search-submit">
                                         </form>
                                </div>
                            </div> 
                        <?php endif; ?>

                        <?php
                         if(($show_social_links = get_theme_mod('show_social')) == 0 && is_active_sidebar('aglee_header_social_links')) : ?>
                        <div class="social-icons-head">
                            <div class="social-container">
                                <?php dynamic_sidebar('aglee_header_social_links'); ?>                              
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        
                        <?php if(is_active_sidebar('agleelite_header_text')) : ?>
                            <div class="call-us"><?php dynamic_sidebar('agleelite_header_text'); ?></div>
                        <?php else : ?>
                            <?php
                            $header_text = get_theme_mod('header_text_setting','+1-123-123-45-78');
                             if(!empty(  $header_text ) ) : ?>
                                <div class="call-us"><span>Call Us:</span><?php echo ($header_text); ?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <!-- End header top content -->
                    
                </div> <!-- ap-container -->
            </div> <!-- top-header -->
            
            <div class="bottom-header clearfix">
                <div class="site-branding">
                    <?php $show_header = get_theme_mod('header_text_image_display','header_text_only'); ?>
                    <?php if($show_header != 'disable') : ?>
                    <?php if($show_header == 'header_logo_only') : ?>
                        <?php if(get_header_image()) : ?>
                            <div class="header-logo-container">
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/05/cropped-index-final-01_031-1.png" /></a></h1>
                            </div>
                        <?php endif; ?>
                        <?php elseif($show_header == 'header_text_only') : ?>
                            <div class="header-text-container">
                               <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                            </div>
                        <?php else : ?>
                            <?php if(get_header_image()) : ?>
                                <div class="header-logo-container">
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo header_image(); ?>" /></a></h1>
                                </div>
                            <?php endif; ?>
                                <div class="header-text-container">
                                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                  <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                </div><!-- .site-branding -->
                
                <div class="menu-wrapper"> 
                    <div class="ap">
                        <a class="menu-trigger"><span></span><span></span><span></span></a>   
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <button class="menu-toggle hide" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                        </nav><!-- #site-navigation -->
                    </div>
                </div>
            </div>
            <nav id="site-navigation-responsive" class="main-navigation-responsive">
                <button class="menu-toggle hide" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Primary Menu', 'aglee-pro' ); ?></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
    </header><!-- #masthead -->