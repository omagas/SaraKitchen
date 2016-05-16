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
              aaa<? 
                $myvals = get_post_meta(get_the_ID());

                foreach($myvals as $key=>$val)//HAO 測試meta key & meta value的值
                {
                    echo $key . ' : ' . $val[0] . '<br/>';
                }

              //$my_meta=get_post_meta( get_the_ID());
              //echo $my_meta['_ayvpp_video'];
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
<div class="col"> 



<?php get_footer(); ?>