<?php
/*
 Template Name: youtubembed
 */
get_header();
?>
<?php
$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->users" );
echo "<p>User count is {$user_count}</p>";
?>

<div class="welcome-col1">

<?
//$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('showposts=10&orderby=time&category_name=youtube&paged=$page'); 


// $args = array(
//     'post_type' => 'custom-video-feat',
//     //custom-video-feat
//     //'orderby'   => 'meta_value_num',
//     'meta_key'  => '_ayvpp_video',
// );
// $query = new WP_Query( $args );




//if ($query->have_posts() ) : while ( $query->have_posts() ) : the_post();
if (have_posts() ) : while (have_posts() ) : the_post();
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