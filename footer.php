<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Aglee Pro
 */
?>

    </div><!-- #content -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        <?php // if(($show_footer_featured_section = get_theme_mod('footer_widget')) == 1) : ?>
            <div class="footer-featured-section">
                <div class="ap-container clearfix">
                    <div class="featured-footer-wrap">

                        <!-- footer_one -->
                        <?php if(is_active_sidebar('aglee_footer_one')) : ?>
                            <div class="featured-footer-3 featured-footer wow fadeInUp" data-wow-delay="0.6s">
                                <?php //dynamic_sidebar('aglee_footer_three'); ?>

 
                                <aside id="text-8" class="widget widget_text">
                                    <h3 class="widget-title"><span><a href="http://www.sarasdiyhealth.com/test2/faq-2/">根治飲食FAQ</a></span></h3>          
                                    <div class="textwidget">
                                    <?php echo do_shortcode('[metaslider id=660]');?>
                                    </div>
                                </aside>                            

                            </div>
                        <?php endif; ?>

                        
                        <!-- footer_two -->
                        <?php //if(is_active_sidebar('aglee_footer_two')) : ?>
                            <div class="feaatured-footer-2 featured-footer wow fadeInUp" data-wow-delay="0.4s">
                                <?php //dynamic_sidebar('aglee_footer_two'); ?>

                                <aside id="recent-posts-3" class="widget widget_recent_entries">        
                                        <h3 class="widget-title"><span>文章</span></h3>     
                                <ul>
                                <?
                                //$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                query_posts('showposts=4&orderby=time&category_name=article&paged=$page'); 
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                ?>        
                                        <li>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <a href="<?php the_permalink();?>"><? the_title() ?></a>
                                            <span class="post-date"><?php echo get_the_date('M j,Y');?></span>
                                            <a class="button feat-page_readmore_btn" href="<?php the_permalink();?>">
                                            Read More
                                            </a>
                                        </li>
                                <? endwhile; endif;?>     

                                </ul>
                                </aside>                                  
                            </div>
                        <?php //endif; ?>


                        <!-- footer_three -->
                        <?php if(is_active_sidebar('aglee_footer_three')) : ?>
                            <div class="featured-footer-3 featured-footer wow fadeInUp" data-wow-delay="0.6s">
                                <?php //dynamic_sidebar('aglee_footer_three'); ?>

 
                                <aside id="text-8" class="widget widget_text">
                                    <h3 class="widget-title"><span><a href="http://www.sarasdiyhealth.com/test2/faq-2/">根治飲食FAQ</a></span></h3>          
                                    <div class="textwidget">
                                    <?php echo do_shortcode('[metaslider id=660]');?>
                                    </div>
                                </aside>                            



                            </div>
                             <div class="featured-footer-1 featured-footer wow fadeInUp" data-wow-delay="0.2s">
                                <?php dynamic_sidebar('aglee_footer_one'); ?>                              
                            </div>                           
                        <?php endif; ?>
                        

                        <!-- footer_four -->
                        <?php if(is_active_sidebar('aglee_footer_four')) : ?>
                            <div class="featured-footer-4 featured-footer wow fadeInUp" data-wow-delay="0.8s">
                                <?php dynamic_sidebar('aglee_footer_four'); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>  
        <?php // endif; ?>
        
        <div class="site-info">
            <div class="ap-container clearfix">
                <div class="copyright-info">
                    Copyright &copy; <?php the_date( 'Y' ); ?> <a href="<?php get_home_url(); ?>">添翼創越工作室
                    </a>
                      
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->
<div id="go-top"><a href="#page"><i class="fa fa-caret-up"></i></a></div>
<?php wp_footer(); ?>
</body>
</html>
