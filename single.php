<?php
/**
 * The template for displaying all single posts.
 *
 * @package Aglee Pro
 */

get_header(); ?>
<?php
    global $post;
    $aglee_pro_page_layout =  get_post_meta($post->ID,'apbasic_page_layout');
    $aglee_pro_default_page_layout = '';
    if(empty($aglee_pro_page_layout)){
        $aglee_pro_default_page_layout = get_theme_mod('signlepost_layout_setting', 'no_sidebar_wide');
    }else{
        foreach($aglee_pro_page_layout as $aglee_pro_row){
           if($aglee_pro_row == 'default_layout'){
                $aglee_pro_default_page_layout = get_theme_mod('signlepost_layout_setting', 'no_sidebar_wide');
           }else{
                $aglee_pro_default_page_layout = $aglee_pro_row;
           }
        }
    }
    $aglee_pro_content_class = '';
    switch($aglee_pro_default_page_layout){
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
        default:
            $aglee_pro_content_class = 'no-sidebar-wide';
    }
?>	
<?php while ( have_posts() ) : the_post(); ?>
	<main id="main" class="site-main <?php echo $aglee_pro_content_class; ?>" role="main">
        
        <!-- banner part -->
        <?php do_action('aglee_pro_banner_section');  ?> 
        <!-- end banner part -->
    
        <div class="ap-container">
            <?php if($default_post_layout == 'both_sidebar') : ?>
                <div id="primary-wrap" class="clearfix">
            <?php endif; ?>
                <div id="primary" class="content-area">
                
            			<?php get_template_part( 'template-parts/content', 'single' ); 
                            //previous_post_link( '%link', 'Prev post in category', true );
                            //next_post_link( '%link', 'Next post in category', true );
                        ?>
            <div class="col-md-12">            
            <span class="previous-link"><?php previous_post_link("上一篇: %link","%title", true); ?></span>
            <span class="next-link"><?php next_post_link("下一篇: %link","%title", true); ?></span> 
            </div>
                        <?php if(($enable_comments_post = get_theme_mod('post_comment','1') ) == 1) : ?>
            			<?php
            				// If comments are open or we have at least one comment, load up the comment template
            				if ( comments_open() || get_comments_number() ) :
            					comments_template();
            				endif;
            			?>
                        <?php endif; ?>
         
                </div><!-- #primary -->

                <?php if($aglee_pro_default_page_layout == 'left_sidebar' || $aglee_pro_default_page_layout == 'both_sidebar') : ?>
                    <?php get_sidebar('left'); ?>
                <?php endif; ?>
            <?php if($aglee_pro_default_page_layout == 'both_sidebar') : ?>
                </div> <!-- #primary-wrap -->
            <?php endif; ?>
            
            <?php if($aglee_pro_default_page_layout == 'right_sidebar' || $aglee_pro_default_page_layout == 'both_sidebar') : ?>
                <?php get_sidebar('right'); ?>
            <?php endif; ?>

        </div><!-- ap-container -->
	</main><!-- #main -->
<?php endwhile; // end of the loop. ?> 
     
<?php get_footer(); ?>

