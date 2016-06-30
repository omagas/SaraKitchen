<?php
/**
 * Template Name: 客製化分頁tpl
 * The custom page template file
 */
?>

<?php get_header(); ?>

        <!-- banner part -->
        <?php
            $aglee_pro_header_banner_background = get_theme_mod('show_header_banner_setting','1');
            if($aglee_pro_header_banner_background == '1'){
                do_action('aglee_pro_banner_section');    
                }
        ?>
        <!-- end banner part -->

    <div class="ag-container">
         
         
        <div id="primary" class="content-area">

        <article  class="page type-page status-publish hentry">
            
              <div class="entry-content portfolio_list">
                      
                    <div class="portfolio_slider_wrap">




<?php 

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $custom_args = array(
      'post_type' => 'post',
      'category_name' => '文章POST',
      'posts_per_page' => 5,
      'paged' => $paged
    );

  $custom_query = new WP_Query( $custom_args ); ?>

  <?php if ( $custom_query->have_posts() ) : ?>

    <!-- the loop -->
    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>


                            <div class="portfolios">
                                            <div class="portfolios-inner">
                                                <div class="protfolio-inner-border">
                                                <a href="<?php the_permalink();?>"><?php the_post_thumbnail('article-post-thumbnail'); ?></a>
                                                </div>
                                            </div>
                                            <div class="portfolio_onhover">
                                                <h2><a href="<?php the_permalink();?>"><? the_title() ?><a></h2>
                                                <span><?php echo get_the_date('M j,Y');?></span>
                                                <p><?php the_excerpt(); ?></p>
                                                <!--a href="<?php the_permalink();?>">Read More</a-->
                                            </div>
                            </div><!-- end of protfolios -->


    <?php endwhile; ?>
        <!-- end of the loop -->


                    </div><!-- portfolio_slider_wrap -->
              </div><!-- .entry-content -->
    <!-- pagination here -->
    <?php
      if (function_exists(custom_pagination)) {
        custom_pagination($custom_query->max_num_pages,"",$paged);
      }
    ?>

  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>

        </article><!-- #post-## -->   
        </div><!-- #primary -->    

        <?php get_sidebar('right'); ?>





            
                        
                
                
    </div>



<?php get_footer(); ?>