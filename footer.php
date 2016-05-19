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
                        <?php if(is_active_sidebar('aglee_footer_one')) : ?>
                            <div class="featured-footer-1 featured-footer wow fadeInUp" data-wow-delay="0.2s">
                                <?php dynamic_sidebar('aglee_footer_one'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(is_active_sidebar('aglee_footer_two')) : ?>
                            <div class="feaatured-footer-2 featured-footer wow fadeInUp" data-wow-delay="0.4s">
                                <?php dynamic_sidebar('aglee_footer_two'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(is_active_sidebar('aglee_footer_three')) : ?>
                            <div class="featured-footer-3 featured-footer wow fadeInUp" data-wow-delay="0.6s">
                                <?php dynamic_sidebar('aglee_footer_three'); ?>
                            </div>
                        <?php endif; ?>
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
