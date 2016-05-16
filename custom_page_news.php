<?php
/*
 Template Name: 客製首頁news
 */
get_header();
?>


<div class="welcome-col1">
	 <h2>最新消息</h2>

<?php echo do_shortcode('[mdf_search_form id="308"]'); ?>
<?
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('showposts=10&orderby=time&category_name=new&paged=$page'); 
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>


    <div class="media">
        <div class="media-left">
            <a href="#">
              <?php the_post_thumbnail('article-post-thumbnail'); ?>
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