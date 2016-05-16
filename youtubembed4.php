<?php
/*
 Template Name: 客製首頁news
 */
get_header();
?>


<div class="welcome-col1">



<?
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('showposts=1&orderby=time&category_name=youtube&paged=$page'); 
if ( have_posts() ) : while ( have_posts() ) : the_post();



?>


    <div class="media">

        <div class="media-left">
            <a href="#">
              <? //_ayvpp_video_url : http://www.youtube.com/watch?v=0A_nK1h3RzY
                //$myvals = get_post_meta(get_the_ID(),'ayvpp_video',true);
                $myvals = get_post_meta(get_the_ID(),'_ayvpp_video_url',true);
                if($myvals != '') {
                  echo $myvals;
                } 


                // foreach($myvals as $key=>$val)//HAO 測試meta key & meta value的值
                // {
                //     echo $key . ' : ' . $val[0] . '<br/>';
                // }

  
               ?>
            </a>
        </div>

        <div class="media-body">
            <h4 class="media-heading">
            <span class="media-heading-left"><a href="<?php the_permalink();?>" title="<? the_title();?>"><? the_title() ?></a></span> 
            <span class="media-heading-right"><?php echo get_the_date('M j,Y');?></span>
            </h4>
            <?php the_content('Read more...'); ?>
        </div>
    </div>



<? endwhile; endif;?> 
</div>
    <div id="feature_video_section" class="clearfix"> <!-- start section -->
        <div class="featured-video-wrapper-block clearfix">
            <div class="feature_video_section clearfix">
                <?php          
                $video_feat = get_post_meta( $feat_video_id_home, 'ag_featured_video_id', true );
                ?>
                <div class="feat_video">
                    <?php echo do_shortcode('[video src="'.$myvals.'" autoplay="off"][/video]');  ?>
                </div>
                <div class="feat_video_content wow fadeInRight" data-wow-delay="0.3s">
                    <h2><?php echo get_the_title($feat_video_id_home); ?></h2>
                    <p><?php echo wp_trim_words(get_post_field('post_content', $feat_video_id_home),50,'...'); // get_the_content($feat_video_id_home); ?></p>
                    <a href="<?php echo get_the_permalink($feat_video_id_home); ?>" class="readmore readmore_feat_video"><?php echo __('READ MORE','aglee-pro'); ?></a>
                    
                </div>
            </div>
        </div>
    </div> <!-- end section -->
<div class="col"> 



<?php get_footer(); ?>