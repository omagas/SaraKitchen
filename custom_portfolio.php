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
					//$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
					//$the_query=query_posts('posts_per_page=3&orderby=time&category_name=article&paged=$page'); 


					  // set up or arguments for our custom query
					  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					  $query_args = array(
					    'post_type' => 'post',
					    'posts_per_page' => 5,
					    'paged' => $paged
					  );
					  // create a new instance of WP_Query
					  $the_query = new WP_Query( $query_args );

					?>      
					<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
               	
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
					<? endwhile; ?>
					
					<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
							  <div class="nav">
							  <nav class="prev-next-posts">
							    <div class="prev-posts-link">
							      <?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
							    </div>
							    <div class="next-posts-link">
							      <?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
							    </div>
							  </nav>
							</div>
					<?php } ?>

					<?php else: ?>
							  <article>
							    <h1>Sorry...</h1>
							    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							  </article>
					<?php endif; ?>	


					</div>

            	</div><!-- .entry-content -->
            
            </article><!-- #post-## -->				            
        </div><!-- #primary -->
            
                        
                
                
    </div>

<?php get_footer(); ?>