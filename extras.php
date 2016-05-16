<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Aglee Pro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function aglee_pro_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'aglee_pro_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function aglee_pro_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'aglee-pro' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'aglee_pro_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function aglee_pro_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'aglee_pro_render_title' );
endif;

/** Slider Code Start **/
    function aglee_pro_slidercb(){
        echo '<div class="ap-basic-slider-wrapper"><div class="ap">';
        $slider_type = get_theme_mod('slider_type_setting', 'default_slider');
        if($slider_type == 'default_slider'){
            
        $mode = get_theme_mod('slider_mode_setting', 'horizontal');
        $show_control = get_theme_mod('slider_control_setting','1');
            if($show_control == '1'){
                $s_control = true;
            }else{
                $s_control = false;
            }
        
        $show_pager = get_theme_mod('slider_pager_setting','1');
            if($show_pager == '1'){
                $s_pager = 'true';
            }else{
                $s_pager = 'false';
            }
            
        $slider_pause_time = get_theme_mod('slider_pause_setting', '2500');
        $slider_transistion_time = get_theme_mod('slider_transistion_setting', '2500');
        
        $default_slider_select = get_theme_mod('slider_type_default_setting', 'option1');
        
        $readmore_option = get_theme_mod('readmore_slider_setting', 'read more');
        
        if($default_slider_select == 'option1'){
            $slider_one = get_theme_mod('slider_one');
            if(empty($slider_one)){
                $slider_one = 0;
            }
            $slider_two = get_theme_mod('slider_two');
            if(empty($slider_two)){
                $slider_two = 0;
            }
            $slider_three = get_theme_mod ('slider_three');
            if(empty($slider_three)){
                $slider_three = 0;
            }
            $slider_four = get_theme_mod('slider_four');
            if(empty($slider_four)){
                $slider_four = 0;
            }
            $all_slider = array($slider_one, $slider_two, $slider_three, $slider_four); 
            $remove = array(0);
            $result_slide_opt1 = array_diff($all_slider, $remove); 
        }else{
            $slider_cat = get_theme_mod('slider_category');
        }
        ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($){
                    $(".aglee-home-slider").bxSlider({
                        pager: <?php echo $s_pager; ?>,
                        controls: <?php echo $s_control; ?>,
                        auto: true,
                        mode: "<?php echo $mode; ?>",
                        pause: <?php echo $slider_pause_time; ?>,
                        speed: <?php echo $slider_transistion_time; ?>,
                    });
                });
            </script>
            
                <ul class="aglee-home-slider">
                    <?php
                    if($default_slider_select == 'option1'){
                        foreach($result_slide_opt1 as $rowslide){
                            if(!empty($rowslide)){
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $rowslide ), 'aglee-pro-home-slider', false );
                                $content_post = get_post($rowslide);
                                $aglee_pro_slider_logo = get_post_meta( $rowslide, 'ag_post_slider_id', true );
                                ?>
                                <li>
                                    <?php if(has_post_thumbnail($rowslide)){ ?>
                                        <img src="<?php echo $image[0]; ?>" />
                                    <?php } ?>
                                    <div class="caption_wrap">
                                        <?php if(!empty($aglee_pro_slider_logo)){?>
                                        <div class="slider_image"><img src="<?php echo esc_url($aglee_pro_slider_logo['url']); ?>"/></div>
                                        <?php } ?>
                                        <div class="slider_cont"><?php echo $content_post->post_content; ?></div>
                                        <a target="_blank" href="<?php echo get_the_permalink($rowslide); ?>"><?php _e($readmore_option); ?></a>
                                    </div>
                                </li>
                            <?php }
                        }
                    }
                    
                    elseif($default_slider_select == 'option2'){
                        if(!empty($slider_cat)){
                          $catquery = new WP_Query( 'cat='.$slider_cat.'&posts_per_page=10' );
                           while($catquery->have_posts()){
                                $catquery->the_post(); 
                                $post_id = get_the_ID();
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'aglee-pro-home-slider', false );
                                ?>
                                <li>
                                    <?php if(has_post_thumbnail()){ ?>
                                        <img src="<?php echo $image[0]; ?>" />
                                    <?php } ?>
                                    <div class="caption_wrap">
                                        <?php if(!empty($aglee_pro_slider_logo)){?>
                                            <div class="slider_image"><img src="<?php echo esc_url($aglee_pro_slider_logo['url']); ?>"/></div>
                                        <?php } ?>
                                        <div class="slider_cont"><?php the_excerpt(); ?></div>
                                        <a target="_blank" href="<?php the_permalink(); ?>"><?php _e($readmore_option); ?></a>
                                    </div>
                                </li>
                           <?php }
                       }
                    }
                    wp_reset_query();
                    ?>
                </ul>
        <?php
        } // end of default slider
        else{
            $rev_slider_shortcode = get_theme_mod('rev_slider_setting');
            if (!empty($rev_slider_shortcode)){
            ?>
            <div class="rev_slider_wrapper">
                <?php echo do_shortcode($rev_slider_shortcode); ?>
            </div>
        <?php }else{
            echo '<h1>Revolution Slider Shortcode is not Entered.</h1>';
        }
         }
        echo '</div></div>';
    }
    add_action('aglee_pro_slider','aglee_pro_slidercb',10);
/** Slider code end **/

/** No slider **/
function aglee_pro_nosliderdb(){ ?>
    <div class="ap-basic-slider-wrapper">
        <div class="ap">
            <div class="bx-wrapper">
                <div class="bx-viewport">
                    <ul class="aglee-home-slider">
                        <li>
                            <img src="<?php echo get_template_directory_uri();?>/images/banner-home.jpg">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
<?php 
}
add_action('aglee_pro_noslider', 'aglee_pro_nosliderdb');

/** end no slider **/

/** Feature page section (Home) **/
 function aglee_pro_featured_page_cb(){
        $aglee_pro_feature_section_show = get_theme_mod('homepage_feature_section','0');
        if($aglee_pro_feature_section_show == '1'){
        $aglee_pro_feat_title_home = get_theme_mod('feature_page_heading_part', 'START YOUR WORK WITH ADVANCED AGLEE PRO');
        $aglee_pro_readmoretext = get_theme_mod('home_page_translation','Read More');
        $aglee_pro_feat_one = get_theme_mod('feature_post_one','0');
        $aglee_pro_feat_two = get_theme_mod('feature_post_two','0');
        $aglee_pro_feat_three = get_theme_mod('feature_post_three','0');
        $aglee_feat_array_source = array($aglee_pro_feat_one,$aglee_pro_feat_two,$aglee_pro_feat_three);
        $aglee_feat_array_diff = array(0,0,0);  
        $aglee_feat_actual = array_diff($aglee_feat_array_source,$aglee_feat_array_diff);
         
        if(!empty($aglee_feat_actual)){
            $count = 1;$wow=0.5;
        ?>
        <div id="featured-post-container" class="clearfix">
        <div class="aglee-container clearfix">
            <span class="features_title wow fadeInUp" data-wow-delay="0.5s"> <?php echo $aglee_pro_feat_title_home; ?></span>
            <div class="feature-post-wrap-block clearfix">
            <?php
                foreach($aglee_feat_actual as $feat_row){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($feat_row),'aglee-pro-features-post-thumbnail');
                $img_src = $img[0];
            ?>
            <div class="feature-post-wrap wow fadeInLeft " data-wow-delay="<?php echo 0.5*($wow++);?>s">
                <figure class="feature-post-thumbnail">                
                    <a href="<?php echo get_the_permalink($feat_row); ?>">
                        <?php if(has_post_thumbnail($feat_row)) : ?>
                            <img src="<?php echo $img_src; ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                        <?php else : ?>
                             <img src="<?php echo get_template_directory_uri().'/images/no-feature-post-thumbnail.png'; ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                        <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php echo get_the_permalink($feat_row); ?>"><i class="fa fa-external-link"></i></a>
                    </figcaption>
                </figure>
                <a href="<?php echo get_the_permalink($feat_row); ?>">
                    <h2><?php echo get_the_title($feat_row); ?></h2>
                </a>
                <div class="feature-post-excerpt">
                    <?php echo wp_trim_words(get_post_field('post_content', $feat_row),35,'...');//wp_trim_words(get_the_content($feat_row),35,'...'); ?>
                </div>
                <a class="feat_readmore-button readmore-button" href="<?php echo get_the_permalink($feat_row); ?>">
                    <?php echo esc_attr($aglee_pro_readmoretext); ?>
                </a>
            </div>
            <?php if($count%3 == 0) : ?>
                <div class="clearfix"></div>
                <?php endif; ?>
            <?php
                $count++;
            }
            ?>
            </div>
        </div>
        </div>
    <?php }
    } // end of condition check for enable feature section
     }
 add_action('aglee_pro_home_featured_page_customizer_section', 'aglee_pro_featured_page_cb');
 
 /** Aglee pro testimonial slider **/
     function aglee_pro_testimonial_slider_cb(){
        
       // $category_testimonial = get_theme_mod('slider_testimonial_category');
       
        ?>
        <script type="text/javascript">
                jQuery(document).ready(function ($){
                    $(".aglee-testimonial-slider").bxSlider({
                        pager: true,
                        auto: true,
                        mode: 'horizontal'
                    });
                });
        </script>
        <?php
        $args = array(
                'post_type' => 'custom-testimonial',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'order' => 'DESC'
                );
        $posts_array = get_posts( $args );
        $no_of_testimonial = sizeof($posts_array);
        $loop_no = round($no_of_testimonial/2);
        ?>
        <ul class="aglee-testimonial-slider">
        <?php
            $offset_element = 0;
            for($i=1; $i<=$loop_no; $i++){  
            $args = array(
                    'post_type' => 'custom-testimonial',
                    'posts_per_page' => 2,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'offset' => $offset_element
            );
            $cat_testmonial_query = new WP_Query($args);
                if($cat_testmonial_query->have_posts()){
                echo '<li>';
                while($cat_testmonial_query->have_posts()){
                    $cat_testmonial_query->the_post();
                   $testimonial_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
                    $client_name = get_post_meta( get_the_ID(), 'ag_testimonial_name', true );
                    $client_website = get_post_meta( get_the_ID(), 'ag_testimonial_website', true );
                    $client_description = get_post_meta(get_the_ID(), 'ag_testimonial_description', true);
                    
                    ?>
                    <div class="testimonial_content">
                        <?php if (has_post_thumbnail()){ ?>
                            <img class="testimonial_img" src="<?php echo $testimonial_image[0]; ?>" />
                        <?php } ?>
                        <div class="testimonial_designation"><?php echo wp_trim_words( $client_description, 22, '...' ); ?></div>
                        <?php $client_name_show = get_theme_mod('testimonial_name_information_setting');
                        if($client_name_show == 1){ ?>
                        <div class="testimonial_name"><?php echo $client_name; ?></div>
                        <?php } ?>
                        <?php $client_desc_show = get_theme_mod('testimonial_website_information_setting');
                        if($client_desc_show == 1){ ?>
                        <a href="http://<?php echo $client_website; ?>" target="_blank" class="testimonial_website"><?php echo $client_website ?></a>
                        <?php } ?>        
                    </div>           
            <?php } 
                echo '</li>'; 
            }
            $offset_element = $offset_element+2;
        } // end of for loop
        wp_reset_query();
            ?>
        </ul>
        <?php   
    }
    add_action('aglee_pro_testimonial_slider','aglee_pro_testimonial_slider_cb',10);
 
 
 /** Feature video section Start **/
 
 function aglee_pro_feature_video_cb(){
   $feat_video_id_home = get_theme_mod('home_feature_video_setting');
   //////if($feat_video_id_home){

    query_posts('showposts=1&orderby=time&category_name=youtube&paged=$page'); 
    // while ( have_posts() ){


    while ( have_posts() ) : the_post();
        //echo '<li>';
        $myvals = get_post_meta(get_the_ID(),'_ayvpp_video_url',true);
        
        //echo '</li>';

    endwhile; 


    ?>
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
                     111111111111111
                </div>
            </div>
        </div>
    </div> <!-- end section -->
 <?php 
    /////} // end of checking 
 }
 add_action('aglee_pro_home_video_featurepage_customizer_section', 'aglee_pro_feature_video_cb');
 /** Feature Video Section end **/

 /** Call to action section CTA **/

function aglee_pro_calltoaction_home_cb(){
    $aglee_pro_cta_section_show = get_theme_mod('calltoaction_control_setting', '0');
    if($aglee_pro_cta_section_show == '1'){
    $aglee_pro_cta_title = get_theme_mod ('call_to_action_title');
    $aglee_pro_cta_content = get_theme_mod ('call_to_action_content');
    $aglee_pro_cat_readmoretext = get_theme_mod ('call_to_action_readmore_text','Read More');
    $aglee_pro_cat_readmorelink = get_theme_mod ('call_to_action_readmore_link');
    if((!empty($aglee_pro_cta_title)) || (!empty($aglee_pro_cta_content)) || (!empty($aglee_pro_cat_readmoretext)) || (!empty($aglee_pro_cat_readmorelink)) ){
    ?>
    <div id="cta-container">
    <div class="cta-wrap clearfix">
        <div class="ap-container">
           	<div class="cta-desc-wrap wow fadeInUp">
                <h2 class="cta_title">
                <?php echo esc_attr($aglee_pro_cta_title); ?>
                </h2>
                <div class="cta_descr">
                    <?php echo esc_textarea($aglee_pro_cta_content); ?>
                </div>
           	</div>
            <div class="cta-btn-wrap wow slideInRight">
               	<a href="<?php echo esc_url($aglee_pro_cat_readmorelink); ?>" target="_blank">
                    <?php echo __($aglee_pro_cat_readmoretext,'aglee-pro'); ?>
                </a>
     	 	</div>
        </div>
    </div>
    </div> <!-- end of section -->

<?php } //end of checking empty cta
    }
 } add_action('aglee_pro_cta_home_section','aglee_pro_calltoaction_home_cb');


/** Team home section **/

function aglee_pro_team_section_home_cb(){
    $team_title = get_theme_mod('team_home_title_setting');
    $team_desc = get_theme_mod('team_home_content_setting');
    $team_post_1 = get_theme_mod('home_team_one_setting');
    $team_post_2 = get_theme_mod('home_team_two_setting');
    $team_post_3 = get_theme_mod('home_team_three_setting');
    $team_posts = wp_count_posts('custom-team');
    if($team_posts->publish != '0'){
    ?>
    <?php 
        if(($team_post_1 != '0') || ($team_post_2 != '0') || ($team_post_3 != '0') ) : ?>
        <div class="team-container">
        <h2 class="wow fadeInUp"><?php echo __($team_title); ?></h2>
        <p class="wow fadeInUp"><?php echo __($team_desc); ?></p>
        <?php
            if($team_post_1 != '0'):
            ?>
                <div class="team-wrapper-block clearfix wow fadeInUp"  data-wow-duration="1s">
                    <?php 
                        $img_one = wp_get_attachment_image_src(get_post_thumbnail_id($team_post_1),'team-home-img', true);
                        $team_name_one = get_post_meta( $team_post_1, 'ag_team_designation', true );
                        $team_designation_one = get_the_title($team_post_1);
                        $team_short_desc_one = wp_trim_words(get_post_field('post_content', $team_post_1),20);
                     ?>
                    <a href="<?php echo get_the_permalink($team_post_1); ?>">
                        <div class="team_post">
                            <img src="<?php echo esc_url($img_one[0]);?>"/>
                            <div class="main_team_cont">
                                <div class="team_title_home"><?php echo $team_name_one; ?></div>
                                <div class="team_designation_home"><?php echo $team_designation_one; ?></div>
                            </div>
                            <div class="team_short_content_home"><?php echo $team_short_desc_one; ?></div>
                        </div>
                    </a>
                </div>
                <?php 
                endif; // first team section
                
                if( $team_post_2 != '0' ):
                ?>
                <div class="team-wrapper-block clearfix wow fadeInUp"  data-wow-duration="1s">
                    <?php
                        $img_two = wp_get_attachment_image_src(get_post_thumbnail_id($team_post_2),'team-home-img', true);
                        $team_name_two = get_post_meta( $team_post_2, 'ag_team_designation', true );
                        $team_designation_two = get_the_title($team_post_2);
                        $team_short_desc_two = wp_trim_words(get_post_field('post_content', $team_post_2),20);
                     ?>
                    <a href="<?php echo get_the_permalink($team_post_2); ?>"> 
                        <div class="team_post">
                            <img src="<?php echo $img_two[0];?>"/>
                            <div class="main_team_cont">
                                <div class="team_title_home"><?php echo $team_name_two; ?></div>
                                <div class="team_designation_home"><?php echo $team_designation_two; ?></div>
                            </div>
                            <div class="team_short_content_home"><?php echo $team_short_desc_two; ?></div>
                        </div>
                    </a>
                </div>
                <?php 
                endif; // second team section
                
                if($team_post_3 != '0'):
                ?>
                <div class="team-wrapper-block clearfix clearfix wow fadeInUp"  data-wow-duration="1.5s">
                    <?php
                        $img_three = wp_get_attachment_image_src(get_post_thumbnail_id($team_post_3),'team-home-img', true);
                        $team_name_three = get_post_meta( $team_post_3, 'ag_team_designation', true );
                        $team_designation_three = get_the_title($team_post_3);
                        $team_short_desc_three = wp_trim_words(get_post_field('post_content', $team_post_3),20);
                     ?>
                     <a href="<?php echo get_the_permalink($team_post_3); ?>">
                        <div class="team_post">
                            <img src="<?php echo $img_three[0];?>"/>
                            <div class="main_team_cont">
                                <div class="team_title_home"><?php echo $team_name_three; ?></div>
                                <div class="team_designation_home"><?php echo $team_designation_three; ?></div>
                            </div>
                            <div class="team_short_content_home"><?php echo $team_short_desc_three; ?></div>
                        </div>
                     </a>
                </div>
                <?php 
                endif; // third team section
                
    echo '</div>';
        endif; // Feature posts empty 
        } // checking empty Team posts  
}
add_action('aglee_pro_team_home_section','aglee_pro_team_section_home_cb');


/** Testimonial Slider **/

    /* Portfolio in Home Page */
    function aglee_pro_portfolio_cb(){
        $count_posts = wp_count_posts('custom-portfolio');
        if($count_posts->publish != '0'){
        ?>
        <div class="portfolio-page-container">
            <div class="clearfix">
                <h2 class="wow slideInUp" data-wow-delay="0.4s"><?php echo $portfolio_title = get_theme_mod('portfolio_homepage_title_setting','Portfolio');?> </h2>
                <h3 class="wow slideInUp" data-wow-delay="0.5s"><?php echo $portfolio_desc = get_theme_mod('portfolio_homepage_description_setting','Lorem Ipsum is simply dummy text of the printing and typesetting industry'); ?></h3>
                <div class="portfolio_sub_category wow slideInUp" data-wow-delay="0.4s" >
                <?php 
                    $args_tax = array(
                                'orderby'   => 'name',
                                'hideempty' => true
                                );
                    $terms = get_terms( 'category_protfolio', $args_tax );
                    if(!empty($terms)){
                ?>
                    <ul class="button-group cearfix">
                        <li class="is-checked" data-filter="*"><?php echo __('All','aglee-lite'); ?></li>
                        <?php  
                            foreach($terms as $row){ ?>
                                <li data-filter=".port-cat-<?php echo $row->term_id; ?>"><?php echo $row->name; ?></li>
                        <?php } ?>
                    </ul>
                <?php 
                } // end of empty check terms
                wp_reset_query(); ?>
                </div>
                    
                <div class="portfolio_slider_wrap clearfix wow fadeInDown"  data-wow-delay="0.5s" >
                    <?php
                        $portfolio_args = array('post_type' => 'custom-portfolio',
                                                'posts_per_page' => -1,
                                                'order' => 'DESC',
                                                );
                        $portfolio_query = new WP_Query($portfolio_args);
                        if($portfolio_query -> have_posts()){
                            while($portfolio_query -> have_posts()){
                                $portfolio_query -> the_post();
                                $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'aglee-portfolio-image-grid', true );
                                $term_lists = wp_get_post_terms(get_the_ID(), 'category_protfolio', array("fields" => "ids"));
                                $term_slug = array();
                                foreach($term_lists as $term){
                                    $term_slug[] = 'port-cat-'.$term;
                                    }
                                    $term_slug = join( ' ', $term_slug );
                                    ?>
                                    <div class="portfolios clearfix <?php echo $term_slug; ?>">
                                        <div class="portfolios-inner">
                                            <div class="protfolio-inner-border">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $portfolio_image[0]; ?>" />
                                            <figcaption>
                                                <i class="fa fa-share-square-o"></i>
                                            </figcaption>
                                            </a>
                                            
                                            </div>
                                        </div>
                                    </div><!-- end of protfolios -->
                                    <?php
                                   }
                            }
                            wp_reset_query();
                            ?>
                    </div>
                </div>
            </div>
    <?php 
        }
    }
    add_action('aglee_pro_portfolio_section', 'aglee_pro_portfolio_cb');
    
    /** Blog section **/
        function aglee_pro_blog_homepage_show_cb(){
        $blog_cat = get_theme_mod('blogpage_category_choose_setting');
         ?>
         <div class="blog_home_page_content_wrap clearfix">
            <div class="ap-container">
            <h1 class="wow fadeInUp" data-wow-delay="0.5s"> <?php echo get_theme_mod('blog_homepage_section_text_title', 'Blog Posts'); ?></h1>
            <p  class="wow fadeInUp" data-wow-delay="0.5s"><?php echo get_theme_mod('blog_homepage_section_textarea_title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s'); ?></p>
            <?php 
                $aglee_pro_blog_num_posts = get_theme_mod('blog_section_number_posts', '3');
                $args = array(
                        'post_type' => 'post',
                        'cat' => $blog_cat,
                        'posts_per_page' => $aglee_pro_blog_num_posts,
                        'post_status' => 'publish'
                        );
                $blog_query = new WP_Query($args);
                if($blog_query -> have_posts()){
                    $blog_count = 1;
                    while($blog_query -> have_posts()){
                        $blog_query -> the_post();
                        $blog_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-home-img', true );
                        ?>
                    <div class="blog_content_home <?php if($blog_count%3 == 0){ echo 'blog_third';} ?> wow fadeInUp" data-wow-delay="0.5s">
                        <div class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        <div class="author-info"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div>
                        <a href="<?php the_permalink(); ?>" class="blog_listing_img">
                            <img src="<?php echo $blog_img[0]; ?>" />
                        </a>
                        <div class="blog-excerpt"><?php the_excerpt(); ?></div>
                        <div class="blog-bottom-content">
                            <span class="blog_readmore"><a  href="<?php the_permalink(); ?>">Read More</a></span>
                            <span class="blog_comments">
                                <a href="<?php the_permalink();?>"><?php 
                                printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'aglee-pro' ), number_format_i18n( get_comments_number() ) );                            
                                ?></a>
                            </span>
                        </div>
                	</div><!-- .entry-content -->
                <?php
                $blog_count++;
                 }} ?>
             </div> <!-- apcontainer end -->
         </div>    
    <?php  
    wp_reset_query();   
    }
    add_action('aglee_pro_blog_show_homepage', 'aglee_pro_blog_homepage_show_cb');
    
    function aglee_pro_contact_homepage_show_cb(){
        ?>
        <div class="ap-container clearfix">
            <?php
            $aglee_pro_contact_main_title = get_theme_mod('contact_us_main_title', 'Contact Us Here');
            $aglee_pro_contact_main_subtitle = get_theme_mod('contact_us_sub_title', 'Aglee Pro');
            $aglee_pro_contact_main_content = get_theme_mod('contact_us_desc_text');
            $aglee_pro_contact_name = get_theme_mod('contact_us_company_name', 'Aglee Pro');
            $aglee_pro_contact_address = get_theme_mod('contact_us_company_address','Kathmandu Nepal');
            $aglee_pro_contact_email = get_theme_mod('contact_us_company_email','8degreethemes@gmail.com');
            $aglee_pro_contact_form = get_theme_mod('contact_us_shortcode');
            //$aglee_pro_contact_map = get_theme_mod('map_embed_code');
            ?>
            <div class="contact_home_left wow slideInLeft" data-wow-delay="0.5s">
                <div class="contact_home_title"><?php _e($aglee_pro_contact_main_title,'aglee-pro'); ?></div>
                <div class="contact_home_subtitle"><?php _e($aglee_pro_contact_main_subtitle,'aglee-pro'); ?></div>
                <div class="contact_home_maincontent"><?php _e($aglee_pro_contact_main_content,'aglee-pro'); ?></div>
                <div class="contact_home_name"><?php _e($aglee_pro_contact_name, 'aglee-pro'); ?></div>
                <div class="contact_home_address"><?php _e($aglee_pro_contact_address, 'aglee-pro'); ?></div>
                <div class="contact_home_email"><span><?php _e('Email','aglee-pro'); ?></span><?php _e($aglee_pro_contact_email,'aglee-pro'); ?></div>
            </div>
            <div class="contact_home_right wow slideInRight" data-wow-delay="0.5s">
                <div class="contact_form_home">
                    <?php if(!empty($aglee_pro_contact_form)){ 
                        echo do_shortcode('[contact-form-7 id="267" title="Contact form 1"]');
                     } ?>
                </div>
            </div>
        </div>
        <?php 
    }
    add_action('aglee_pro_contact_show_homepage', 'aglee_pro_contact_homepage_show_cb');

    function aglee_pro_map_homepage_show_cb(){ ?>
        <div id="map-section-container">
            <div class="map_area_home">
            <?php
                $aglee_pro_map_latitude = get_theme_mod('map_logitude_setting','27.6820254');;
                $aglee_pro_map_longitude = get_theme_mod('map_latitude_setting','85.27279290000001');
                $aglee_pro_map_zoom = get_theme_mod('map_zoom_level_setting','10');
                $aglee_pro_map_type = get_theme_mod('map_type_setting','ROADMAP');
                $aglee_pro_map_scroll = get_theme_mod('map_scroll_setting','0');
            ?>
                <script>
                    function initialize() {
                    var mapCanvas = document.getElementById('aglee_pro_map');
                    var mapOptions = {
                                center: new google.maps.LatLng(<?php echo $aglee_pro_map_latitude; ?>, <?php echo $aglee_pro_map_longitude; ?>),
                                zoom: <?php echo $aglee_pro_map_zoom; ?>,
                                scrollwheel: <?php echo $aglee_pro_map_scroll; ?>,
                                mapTypeId: google.maps.MapTypeId.<?php echo $aglee_pro_map_type; ?>
                                }
                                var map = new google.maps.Map(mapCanvas, mapOptions)
                              }
                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>
                <div id="aglee_pro_map"></div>
             </div>
            </div>
        <?php
     }
    add_action ('aglee_pro_map_show_homepage', 'aglee_pro_map_homepage_show_cb');
    
    //services
    function aglee_pro_services_section_cb(){
        $aglee_pro_service_sec_title = get_theme_mod('services_section_title_setting', 'Our Services');
        $aglee_pro_services_sec_post_one = get_theme_mod('home_service_one_setting');
        $aglee_pro_services_sec_post_two = get_theme_mod('home_service_two_setting');
        $aglee_pro_services_sec_post_three = get_theme_mod('home_service_three_setting');
        $aglee_pro_services_sec_post_four = get_theme_mod('home_service_four_setting');
        $aglee_pro_services_sec_post_five = get_theme_mod('home_service_five_setting');
        $aglee_pro_services_sec_post_six = get_theme_mod('home_service_six_setting');
        ?>
        <div id="services-container">
            <div class="service-post-wrapper-block clearfix">
            <h1 class="wow fadeInUp" data-wow-delay="0.5s"><?php _e($aglee_pro_service_sec_title); ?></h1>
            <?php
            if(($aglee_pro_services_sec_post_one != '0') || ($aglee_pro_services_sec_post_two != '0') || ($aglee_pro_services_sec_post_three != '0') || ($aglee_pro_services_sec_post_four != '0') ) :
                
                //for Services post one
                if($aglee_pro_services_sec_post_one){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($aglee_pro_services_sec_post_one),'services-thumb', true);
                $img_src = $img[0];
                ?>
                <div class="service-post-wrap wow fadeInLeft"  data-wow-delay="0.5s">
                    <figure class="services-post-thumbnail">
                    <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_one); ?>">
                    <?php if(has_post_thumbnail($aglee_pro_services_sec_post_one)) : ?>
                        <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute($aglee_pro_services_sec_post_one); ?>" alt="<?php the_title_attribute($aglee_pro_services_sec_post_one); ?>" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri().'/images/no-services-thumbnail.png'; ?>" />
                    <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-chain-broken"></i></a>
                    </figcaption>
                    </figure>
                    <div class="services_caption_wrap">
                            <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_one); ?>">
                            <h5 class="services-post-title">
                                <?php echo get_the_title($aglee_pro_services_sec_post_one); ?>
                            </h5>
                            </a>
                        <div class="services-post-excerpt">
                            <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_services_sec_post_one),10,'...'); ?>
                        </div>
                        <a class="services_readmore-button readmore-button" href="<?php echo get_the_permalink($aglee_pro_services_sec_post_two); ?>">
                            <?php _e('More Info ','aglee-pro'); ?>
                        </a>
                    </div>
                </div>
                <!-- post one end -->
                <?php }
                
                //for Services post two
                if($aglee_pro_services_sec_post_two){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($aglee_pro_services_sec_post_two),'services-thumb', true);
                $img_src = $img[0];
                ?>
                <div class="service-post-wrap wow fadeInLeft"  data-wow-delay="0.5s">
                    <figure class="services-post-thumbnail">
                    <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_two); ?>">
                    <?php if(has_post_thumbnail($aglee_pro_services_sec_post_two)) : ?>
                        <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute($aglee_pro_services_sec_post_two); ?>" alt="<?php the_title_attribute($aglee_pro_services_sec_post_two); ?>" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri().'/images/no-services-thumbnail.png'; ?>" />
                    <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-chain-broken"></i></a>
                    </figcaption>
                    </figure>
                    <div class="services_caption_wrap">
                        <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_two); ?>">
                        <h5 class="services-post-title">
                            <?php echo get_the_title($aglee_pro_services_sec_post_two); ?>
                        </h5>
                        </a>
                    <div class="services-post-excerpt">
                        <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_services_sec_post_two),10,'...'); ?>
                    </div>
                    <a class="services_readmore-button readmore-button" href="<?php echo get_the_permalink($aglee_pro_services_sec_post_two); ?>">
                        <?php _e('More Info ','aglee-pro'); ?>
                    </a>
                </div>
                </div>
                <!-- post two end -->
                <?php }
                
                //for Services post three
                if($aglee_pro_services_sec_post_three){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($aglee_pro_services_sec_post_three),'services-thumb', true);
                $img_src = $img[0];
                ?>
                <div class="service-post-wrap wow fadeInLeft"  data-wow-delay="0.5s">
                    <figure class="services-post-thumbnail">
                    <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_three); ?>">
                    <?php if(has_post_thumbnail($aglee_pro_services_sec_post_three)) : ?>
                        <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute($aglee_pro_services_sec_post_three); ?>" alt="<?php the_title_attribute($aglee_pro_services_sec_post_three); ?>" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri().'/images/no-services-thumbnail.png'; ?>" />
                    <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php get_the_permalink($aglee_pro_services_sec_post_three); ?>"><i class="fa fa-chain-broken"></i></a>
                    </figcaption>
                    </figure>
                    <div class="services_caption_wrap">
                        <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_three); ?>">
                        <h5 class="services-post-title">
                            <?php echo get_the_title($aglee_pro_services_sec_post_three); ?>
                        </h5>
                        </a>
                    <div class="services-post-excerpt">
                        <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_services_sec_post_three),10,'...'); ?>
                    </div>
                    <a class="services_readmore-button readmore-button" href="<?php echo get_the_permalink($aglee_pro_services_sec_post_three); ?>">
                        <?php _e('More Info','aglee-pro'); ?>
                    </a>
                </div>
                </div>
                <!-- post two end -->
                <?php }
                
                //for Services post two
                if($aglee_pro_services_sec_post_four){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($aglee_pro_services_sec_post_four),'services-thumb', true);
                $img_src = $img[0];
                ?>
                <div class="service-post-wrap wow fadeInLeft"  data-wow-delay="0.5s">
                    <figure class="services-post-thumbnail">
                    <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_four); ?>">
                    <?php if(has_post_thumbnail($aglee_pro_services_sec_post_four)) : ?>
                        <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute($aglee_pro_services_sec_post_four); ?>" alt="<?php the_title_attribute($aglee_pro_services_sec_post_four); ?>" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri().'/images/no-services-thumbnail.png'; ?>" />
                    <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-chain-broken"></i></a>
                    </figcaption>
                    </figure>
                    <div class="services_caption_wrap">
                        <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_four); ?>">
                        <h5 class="services-post-title">
                            <?php echo get_the_title($aglee_pro_services_sec_post_four); ?>
                        </h5>
                        </a>
                    <div class="services-post-excerpt">
                        <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_services_sec_post_four),10,'...'); ?>
                    </div>
                    <a class="services_readmore-button readmore-button" href="<?php echo get_the_permalink($aglee_pro_services_sec_post_four); ?>">
                        <?php _e('More Info','aglee-pro'); ?>
                    </a>
                </div>
                </div>
                <!-- post two end -->
                <?php }
                
                //for Services post five
                if($aglee_pro_services_sec_post_five){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($aglee_pro_services_sec_post_five),'services-thumb', true);
                $img_src = $img[0];
                ?>
                <div class="service-post-wrap wow fadeInLeft"  data-wow-delay="0.5s">
                    <figure class="services-post-thumbnail">
                    <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_five); ?>">
                    <?php if(has_post_thumbnail($aglee_pro_services_sec_post_five)) : ?>
                        <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute($aglee_pro_services_sec_post_five); ?>" alt="<?php the_title_attribute($aglee_pro_services_sec_post_four); ?>" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri().'/images/no-services-thumbnail.png'; ?>" />
                    <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-chain-broken"></i></a>
                    </figcaption>
                    </figure>
                    <div class="services_caption_wrap">
                        <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_five); ?>">
                        <h5 class="services-post-title">
                            <?php echo get_the_title($aglee_pro_services_sec_post_five); ?>
                        </h5>
                        </a>
                    <div class="services-post-excerpt">
                        <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_services_sec_post_five),10,'...'); ?>
                    </div>
                    <a class="services_readmore-button readmore-button" href="<?php echo get_the_permalink($aglee_pro_services_sec_post_five); ?>">
                        <?php _e('More Info','aglee-pro'); ?>
                    </a>
                </div>
                </div>
                <!-- post two end -->
                <?php }
                
                //for Services post six
                if($aglee_pro_services_sec_post_six){
                $img = wp_get_attachment_image_src(get_post_thumbnail_id($aglee_pro_services_sec_post_six),'services-thumb', true);
                $img_src = $img[0];
                ?>
                <div class="service-post-wrap wow fadeInLeft"  data-wow-delay="0.5s">
                    <figure class="services-post-thumbnail">
                    <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_six); ?>">
                    <?php if(has_post_thumbnail($aglee_pro_services_sec_post_six)) : ?>
                        <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute($aglee_pro_services_sec_post_six); ?>" alt="<?php the_title_attribute($aglee_pro_services_sec_post_four); ?>" />
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri().'/images/no-services-thumbnail.png'; ?>" />
                    <?php endif; ?>
                    </a>
                    <figcaption> 
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-chain-broken"></i></a>
                    </figcaption>
                    </figure>
                    <div class="services_caption_wrap">
                        <a href="<?php echo get_the_permalink($aglee_pro_services_sec_post_six); ?>">
                        <h5 class="services-post-title">
                            <?php echo get_the_title($aglee_pro_services_sec_post_six); ?>
                        </h5>
                        </a>
                    <div class="services-post-excerpt">
                        <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_services_sec_post_six),10,'...'); ?>
                    </div>
                    <a class="services_readmore-button readmore-button" href="<?php echo get_the_permalink($aglee_pro_services_sec_post_six); ?>">
                        <?php _e('More Info','aglee-pro'); ?>
                    </a>
                </div>
                </div>
                <!-- post two end -->
                <?php }
                
                
                
                endif; ?>
                </div>
            </div>
        <?php
    }
    add_action('aglee_pro_services_section_customize', 'aglee_pro_services_section_cb');
    
    // feature page section
    function aglee_pro_main_feature_page_cb(){
        $aglee_pro_feat_page_id = get_theme_mod('main_feature_page_setting');
        $aglee_pro_readmore_text = get_theme_mod('readmore_text_featurepage_setting', 'Read More');
        if(!empty($aglee_pro_feat_page_id)){
        ?>
        <div id="featured-page-container">
        <div class="feat-page-wrap wow fadeInLeft"  data-wow-delay="0.5s">
            <h2 class="feat-page-title wow fadeInUp"  data-wow-delay="0.5s"><?php echo get_the_title($aglee_pro_feat_page_id); ?></h2>
            <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id($aglee_pro_feat_page_id), 'feature-page-home', false ); ?>
            <?php     
                if(has_post_thumbnail($aglee_pro_feat_page_id)){ ?>
                <img src="<?php echo esc_url($img_src[0]); ?>"/>
                <?php } ?>
                <div class="feat-page-content">
                    <?php echo wp_trim_words(get_post_field('post_content', $aglee_pro_feat_page_id),22,'...');
                     ?>
                </div>
                <a class="button feat-page_readmore_btn" href="<?php echo get_the_permalink($aglee_pro_feat_page_id); ?>">
                    <?php echo esc_attr($aglee_pro_readmore_text); ?>
                </a>
        </div>  
        </div>  
    <?php
        }    
    }
    add_action('aglee_pro_featured_page_section', 'aglee_pro_main_feature_page_cb');
    
    /** Breadcrumb action **/
    
    function aglee_pro_breadcrumb_section_cb(){
        global $post;
        $delimiter = get_theme_mod('breadcrumb_separator', '>');
        $home = get_theme_mod('breadcrumb_home_text', 'Home');
    
        $showOnHome = get_theme_mod('home_breadcrumb_show_setting','1');; // 1 - show breadcrumbs on the homepage, 0 - don't show
    
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
    	  
        $homeLink = esc_url(home_url());
        
        
        if(is_page()){
            $background_banner_color = get_theme_mod('header_banner_color_setting');
            $background_banner_img = get_theme_mod('singlepage_header_img_setting');
        }
        elseif(is_archive()){
            $background_banner_color = get_theme_mod('archive_header_color_setting');
            $background_banner_img = get_theme_mod('archive_header_image_setting');
        }
        elseif(is_single()){
            $background_banner_color = get_theme_mod('singlepost_banner_color');
            $background_banner_img = get_theme_mod('signlepost_banner_image');
        }
        /*elseif(is_template('tpl-testimonial.php')){
            
        }*/
        else{
           $background_banner_color = get_theme_mod('header_banner_color_setting');
           $background_banner_img = get_theme_mod('singlepage_header_img_setting'); 
        }
        
        if (is_home() || is_front_page()) {
            if ($showOnHome == 1) { ?>
              <div id="aglee-breadcrumbs"><div class="ap-container"><a href="<?php echo $homeLink; ?> "><?php echo $home; ?></a></div></div>
              <?php 
        } } 
        else {
            echo '<div id="aglee-breadcrumbs"><div class="ap-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    	  
    	    if ( is_category() ) {
    	      $thisCat = get_category(get_query_var('cat'), false);
    	      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
    	      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    	  
    	    } elseif ( is_search() ) {
    	      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    	  
    	    } elseif ( is_day() ) {
    	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
    	      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
    	      echo $before . get_the_time('d') . $after;
    	  
    	    } elseif ( is_month() ) {
    	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
    	      echo $before . get_the_time('F') . $after;
    	  
    	    } elseif ( is_year() ) {
    	      echo $before . get_the_time('Y') . $after;
    	  
    	    } elseif ( is_single() && !is_attachment() ) {
    	      if ( get_post_type() != 'post' ) {
    	        $post_type = get_post_type_object(get_post_type());
    	        $slug = $post_type->rewrite;
    	        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
    	        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    	      } else {
    	        $cat = get_the_category(); $cat = $cat[0];
    	        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
    	        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
    	        echo $cats;
    	        if ($showCurrent == 1) echo $before . get_the_title() . $after;
    	      }
    	  
    	    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
    	      $post_type = get_post_type_object(get_post_type());
    	      echo $before . $post_type->labels->singular_name . $after;
    	  
    	    } elseif ( is_attachment() ) {
    	      $parent = get_post($post->post_parent);
    	      $cat = get_the_category($parent->ID); $cat = $cat[0];
    	      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
    	      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
    	      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    	  
    	    } elseif ( is_page() && !$post->post_parent ) {
    	      if ($showCurrent == 1) echo $before . get_the_title() . $after;
    	  
    	    } elseif ( is_page() && $post->post_parent ) {
    	      $parent_id  = $post->post_parent;
    	      $breadcrumbs = array();
    	      while ($parent_id) {
    	        $page = get_page($parent_id);
    	        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
    	        $parent_id  = $page->post_parent;
    	      }
    	      $breadcrumbs = array_reverse($breadcrumbs);
    	      for ($i = 0; $i < count($breadcrumbs); $i++) {
    	        echo $breadcrumbs[$i];
    	        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
    	      }
    	      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    	  
    	    } elseif ( is_tag() ) {
    	      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    	  
    	    } elseif ( is_author() ) {
    	       global $author;
    	      $userdata = get_userdata($author);
    	      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    	  
    	    } elseif ( is_404() ) {
    	      echo $before . 'Error 404' . $after;
    	    }
    	  
    	    if ( get_query_var('paged') ) {
    	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
    	      echo __('Page' , 'accesspress-basic') . ' ' . get_query_var('paged');
    	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    	    }
 	     
    	    echo '</div></div>';
 	     
    	  }
    }
    add_action('aglee_pro_breadcrumb_section','aglee_pro_breadcrumb_section_cb');
    
    function aglee_pro_header_banner_section_cb(){
        if(is_page_template('tpl-services.php') || is_page_template('tpl-demosertices.php')){
           $aglee_pro_header_bk_color = get_theme_mod('services_banner_color_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('services_banner_image_setting'); 
        }elseif(is_page_template('tpl-portfolio.php') || is_page_template('tpl-demoportfolio.php')){
            $aglee_pro_header_bk_color = get_theme_mod('portfolio_post_headercolor_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('portfolio_post_headerimage_setting'); 
        }elseif(is_page_template('tpl-testimonials.php') || is_page_template('tpl-demotestimonials.php')){
            $aglee_pro_header_bk_color = get_theme_mod('testimonial_page_headercolor_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('testimonial_page_headerimage_setting');
        }elseif(is_page_template('tpl-team.php') || is_page_template('tpl-demoteam.php')){
            $aglee_pro_header_bk_color = get_theme_mod('team_post_headercolor_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('team_post_headerimage_setting');
        } elseif(is_page_template('tpl-blog.php') || is_page_template('tpl-demoblog.php')){
            $aglee_pro_header_bk_color = get_theme_mod('blog_header_color_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('blogpage_header_image_setting');
        }
         elseif(is_single()){
            $aglee_pro_header_bk_color = get_theme_mod('header_banner_color_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('singlepage_header_img_setting');
        }
        elseif ( class_exists( 'WooCommerce' )) {
            if(is_shop()){
                $aglee_pro_header_bk_color = get_theme_mod('product_header_color_setting','#d1e9ff');
                $aglee_pro_header_bk_image = get_theme_mod('product_header_image_setting');   
            }
        } elseif( is_archive() || is_category() ){
            $aglee_pro_header_bk_color = get_theme_mod('archive_header_color_setting','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('archive_header_image_setting'); 
        }
        else{
            $aglee_pro_header_bk_color = get_theme_mod('header_banner_background_color','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('header_banner_background_image');
        }
        if((empty($aglee_pro_header_bk_color)) && (empty($aglee_pro_header_bk_image))){
            $aglee_pro_header_bk_color = get_theme_mod('header_banner_background_color','#d1e9ff');
            $aglee_pro_header_bk_image = get_theme_mod('header_banner_background_image');
        }
        
        ?>
        <div id="page-header-banner" class="page-banners" style="background: <?php echo $aglee_pro_header_bk_color; ?> url(<?php echo $aglee_pro_header_bk_image; ?>) no-repeat center top;">
            <div class="ag-container">
                <h1 class="entry-title" style="">
                    <?php 
                        if(class_exists( 'WooCommerce' )){
                            if(is_shop()){
                                    woocommerce_page_title();
                                }else{
                                    the_title();
                                }
                            }else { the_title(); }//if(is_shop()){ woocommerce_page_title();  }else{ the_title(); }?></h1>
                <?php
                $aglee_pro_show_breadcum_option = get_theme_mod('show_header_banner_setting', '1');
                if($aglee_pro_show_breadcum_option == '1'){
                    do_action('aglee_pro_breadcrumb_section');
                }
                
                ?>                                                                  
            </div>
        </div>
        <?php 
    }
    add_action('aglee_pro_banner_section', 'aglee_pro_header_banner_section_cb');
    
    // for email home page display
    function aglee_pro_cart_email_cb(){
        $aglee_pro_email_home_show = get_theme_mod('email_address_homepage_show_hide', '1');
        $aglee_pro_email_home_email = get_theme_mod('email_address_homepage_setting', 'info@8degreethemes.com');
            if($aglee_pro_email_home_show == '1'){ ?>
              <a class="home_email" href="mailto:<?php echo $aglee_pro_email_home_email; ?>" class="email_home"><i class="fa fa-envelope"></i><span class="home_mail_onhover"><?php _e($aglee_pro_email_home_email); ?></span></a>    
            <?php }
        ?>
   <?php
    }
    add_action('aglee_pro_email', 'aglee_pro_cart_email_cb');
    
    // for cart home page display
    function aglee_pro_cart_home_cb(){
        if(class_exists( 'WooCommerce' )) {
                global $woocommerce;
                ?>
   	            <a class="home_cart" href="<?php echo $cart_url = $woocommerce->cart->get_cart_url(); ?>">
                <i class="fa fa-shopping-cart"></i>
                   <span class="home_cart_onhover">
                   <?php
                    echo "Items in cart: ".sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
                    echo "<br />";
                    echo "Total: ".$woocommerce->cart->get_cart_total();
                   ?>
                   </span>
                   </a>
            <?php
            }
    }
    add_action ('aglee_pro_cart_home' , 'aglee_pro_cart_home_cb');
?>