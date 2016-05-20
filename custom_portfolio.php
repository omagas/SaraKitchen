<?php
/*
 Template Name: 客製portfolio
 */
get_header();
?>
        <!-- banner part -->
        <?php
            $aglee_pro_header_banner_background = get_theme_mod('show_header_banner_setting','1');
            if($aglee_pro_header_banner_background == '1'){
                do_action('aglee_pro_banner_section');    
                }
        ?>
        <!-- end banner part -->



		<div class="ag-container clearfix">
         
        
            <div id="primary" class="content-area">

				<article id="post-292" class="post-292 page type-page status-publish hentry">
            
            	<div class="entry-content portfolio_list">
                      
                    <div class="portfolio_slider_wrap clearfix" style="position: relative; height: 2368px;">


					<?
					$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts('showposts=10&orderby=time&category_name=article&paged=$page'); 
					if ( have_posts() ) : while ( have_posts() ) : the_post();


					?>                    	
                            <div class="portfolios clearfix port-cat-18" style="position: absolute; left: 0px; top: 0px;">
                                            <div class="portfolios-inner">
                                                <div class="protfolio-inner-border">
                                                <a href="<?php the_permalink();?>"><?php the_post_thumbnail('article-post-thumbnail'); ?></a>
                                                </div>
                                            </div>
                                            <div class="portfolio_onhover_text">
                                                <h2><? the_title() ?></h2>
                                                <span><?php echo get_the_date('M j,Y');?></span>
                                                <p><?php the_content('Read more...'); ?></p>
                                                <a href="<?php the_permalink();?>">Read More</a>
                                            </div>
                            </div><!-- end of protfolios -->
					<? endwhile; endif;?> 
					</div>
            	</div><!-- .entry-content -->
            
            </article><!-- #post-## -->				            
        </div><!-- #primary -->
            
                        
                
                
    </div>

<?php get_footer(); ?>