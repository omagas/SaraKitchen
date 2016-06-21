<?php
/**
 * The category template
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aglee Pro
 */
 

 $aglee_pro_default_layout = get_theme_mod('archive_pagelayout_setting', 'no_sidebar_wide');
 
 $aglee_pro_blog_display_type = get_theme_mod('archive_postdisplay_setting', 'post_image_full');
 
 $aglee_pro_blog_display_class = '';
 switch($aglee_pro_blog_display_type){
    case 'post_image_large' :
        $aglee_pro_blog_display_class = 'blog-image-large';       
        break;
    case 'post_image_medium' :
        $aglee_pro_blog_display_class = 'blog-image-medium';       
        break;
    case 'post_image_alterate_medium' :
        $aglee_pro_blog_display_class = 'blog-image-alternate-medium';       
        break;
    case 'post_image_full' :
        $aglee_pro_blog_display_class = 'blog-full-content';       
        break;
 }
 
 // Dynamically Generating Classes for #primary on the basis of page layout
 $aglee_pro_content_class = '';
    switch($aglee_pro_default_layout){
        case 'left_sidebar':
            $aglee_pro_content_class = 'left-sidebar';
            break;
        case 'right_sidebar':
            $aglee_pro_content_class = 'right-sidebar';
            break;
        case 'both_sidebar':
            $aglee_pro_content_class = 'both-sidebar';
            break;
        case 'no_sidebar_wide':
            $aglee_pro_content_class = 'no-sidebar-wide';
            break;
        case 'no_sidebar_narrow':
            $aglee_pro_content_class = 'no-sidebar-narraow';
            break;
    }
 
get_header(); ?>
	<main id="main" class="site-main <?php echo esc_attr($aglee_pro_content_class).' '.esc_attr($aglee_pro_blog_display_class); ?>" role="main">
        <!-- banner part -->
        <?php
            $aglee_pro_header_banner_background = get_theme_mod('show_header_banner_setting','1');
            if($aglee_pro_header_banner_background == '1'){
                do_action('aglee_pro_banner_section');    
                }
        ?>
        <!-- end banner part -->
        
        <div class="ap-container clearfix hao">
        <?php if($aglee_pro_default_layout == 'both_sidebar') : ?>
            <div id="primary-wrap" class="clearfix">
        <?php endif; ?>
            <div id="primary" class="content-area">
        
        			<?php /* Start the Loop */ ?>
        			<?php while ( have_posts() ) : the_post(); ?>
        
        				<?php
        					/* Include the Post-Format-specific template for the content.
        					 * If you want to override this in a child theme, then include a file
        					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        					 */
        					get_template_part( 'template-parts/content', get_post_format() );
        				?>
        
        			<?php endwhile; ?>
        
        			<?php //the_posts_navigation(); ?>
        
        		<?php if ( !have_posts() ) : ?>
        
        			<?php get_template_part( 'content', 'none' ); ?>
        
        		<?php endif; ?>
            </div><!-- #primary -->
            <?php if($aglee_pro_default_layout == 'left_sidebar' || $aglee_pro_default_layout == 'both_sidebar') : ?>
                <?php get_sidebar('left'); ?>
            <?php endif; ?>
        <?php if($aglee_pro_default_layout == 'both_sidebar') : ?>
            </div>
        <?php endif; ?>
        <?php if($aglee_pro_default_layout == 'right_sidebar' || $aglee_pro_default_layout == 'both_sidebar') : ?>
            <?php get_sidebar('right'); ?>
        <?php endif; ?>
        </div>
	</main><!-- #main -->
<?php get_footer(); ?>