<?php
/**
 * Aglee pro functions and definitions
 *
 * @package Aglee Pro
 */

if ( ! function_exists( 'aglee_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */




function aglee_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Aglee pro, use a find and replace
	 * to change 'aglee-pro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aglee-pro', get_template_directory() . '/languages' );
    
    /**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style();	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'aglee-pro' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aglee_pro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // aglee_pro_setup
add_action( 'after_setup_theme', 'aglee_pro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aglee_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aglee_pro_content_width', 640 );
}
add_action( 'after_setup_theme', 'aglee_pro_content_width', 0 );


$var = get_option('AP_8DT');
//check if theme is activated
if($var['activated']=='true'):

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function aglee_pro_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'aglee-pro' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'aglee_pro_widgets_init' );




/**
**Paging Fun Hao
**/

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}
add_action( 'after_setup_theme', 'custom_pagination', 0 );



/**
 * Enqueue scripts and styles.
 */
function aglee_pro_scripts() {
    $query_args = array(
          'family' => 'Oswald:400,300,700|Raleway:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Lato:400,300,700,900|PT+Sans:400,700',
    ); 
	wp_enqueue_style( 'aglee-pro-style', get_stylesheet_uri() );
    wp_enqueue_style( 'aglee-superfish-css', get_template_directory_uri() . '/css/superfish.css');
    wp_enqueue_style('aglee-google-fonts-css', add_query_arg($query_args, "//fonts.googleapis.com/css"));
    // wow slider
    wp_enqueue_style( 'aglee-pro-responsive-style', get_template_directory_uri() . '/css/animate.css');
    
    // owl slider css
    //wp_enqueue_style( 'aglee-pro-owlslider-style', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array(), '1.3.3', true);
    //wp_enqueue_style( 'aglee-pro-owlslider-style-theme', get_template_directory_uri() . '/js/owl-carousel/owl.theme.css', array(), '1.3.3', true);
    
    if(get_theme_mod('responsive_layout_setting','1') == '1'){
    wp_enqueue_style( 'aglee-responsive-style', get_template_directory_uri() . '/css/responsive.css', array() );
    }
    
	wp_enqueue_script( 'aglee-pro-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'accesspress-basic-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery','hoverIntent'));
	wp_enqueue_script( 'aglee-pro-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    wp_enqueue_script( 'aglee-pro-isotope', get_template_directory_uri() . '/js/isotope-min.js', array(), '2.2.2', true );
    wp_enqueue_script( 'aglee-pro-aglee-slider-js', get_template_directory_uri() . '/js/aglee-slider.js', array('jquery'), '', true );
    wp_enqueue_script( 'aglee-pro-aglee-wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '', true );
    
    // owl slider js
    wp_enqueue_script( 'aglee-pro-owlslider', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array(), '1.3.3', true );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}  
}
add_action( 'wp_enqueue_scripts', 'aglee_pro_scripts' );

function load_custom_wp_admin_script() {
        
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/fawesome/css/font-awesome.min.css', array(),'4.3.0',false); 
        wp_enqueue_style('aglee-pro-admin-style', get_template_directory_uri() . '/css/admin-style.css', array(),'',false);
        wp_enqueue_style('aglee-pro-admin', get_template_directory_uri() . '/inc/admin-panel/css/admin.css', array(),'',false);
        wp_enqueue_script( 'aglee-pro-admin-style', get_template_directory_uri() . '/js/admin-script.js', array('jquery'), '4.3', true );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script' );


/**
 * For image size
 */
 add_image_size( 'aglee-pro-home-slider', 1920, 950, true); //Portfolio Image	
 add_image_size ( 'aglee-services-thumb', 236, 133, true); // services thumb image
 add_image_size ( 'aglee-pro-features-post-thumbnail', 363, 269, true); // featured post home page display img
 add_image_size ( 'team-home-img', 447,670, true); //fot team page
 add_image_size ( 'aglee-portfolio-image-grid', 600,500, true); //portfolio
 add_image_size ( 'portfolio-image-list', 300,199, true); //portfolio
 
 add_image_size( 'blog-home-img', 344,231, true); // blog home page display img
 
 add_image_size('team-page-img', 310, 310, true); //team page
 

 
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widgets fields 
 */
 require get_template_directory() . '/inc/agleepro_widgets.php';


/**
 * To select the category for sliders
 */
 require get_template_directory() . '/inc/category-dropdown.php'; 
/**
 * Customizer_Options additions.
 *
 * @since Accesspresspro
 */
require get_template_directory() . '/inc/post-dropdown.php';

/**
 * Load Kirki for extending customizer
 */
require get_template_directory() . '/inc/kirki/kirki.php';

require get_template_directory() . '/inc/aglee-customizer.php'; 
 

 function kirki_update_url( $config ) {

    $config['url_path'] = get_template_directory_uri() . '/inc/kirki/';
    return $config;

}
add_filter( 'kirki/config', 'kirki_update_url' );



/**
 * Load aglee pro function
 */
 require get_template_directory() . '/inc/agleepro_functions.php';
 
 /**
 * Load Aglee pro Metabox
 */
require get_template_directory() . '/inc/aglee-custom-metabox.php';

 /**
 * Load Custom Post type
 */
 require get_template_directory() . '/inc/custom-post-type/custom_post_type.php';  
 
  /**
 * Load Meta Box 
 */
 require get_template_directory() . '/inc/meta-box/meta-box.php'; 
/**
* Load Demo import class
*/
require get_template_directory() . '/inc/class/class-image-radio.php';
/**
 * Load Aglee Pro Impoter file
 */
require get_template_directory() . '/inc/import/ed-importer.php';
/**
 * Load Dynamic css
 */
require get_template_directory() . '/inc/admin-panel/dynamic-css.php';

endif; //closing of if theme activated

/**
 * 8Degree Actimate Themes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

// Add activate link to the menu.
function aglee_pro_add_activate() {
  $page = add_theme_page(
    __( 'Activate Theme', 'aglee-pro' ),
    __( 'Activate Theme', 'aglee-pro' ),
    'administrator',
    'aglee-pro-themes',
    'aglee_pro_display_activate'
    );
}
add_action( 'admin_menu', 'aglee_pro_add_activate', 11 );

// Define markup for the upsell page.
function aglee_pro_display_activate() {

  // Set template directory uri
  $directory_uri = get_template_directory_uri();
  ?>
  <div class="wrap">
    <div class="container-fluid">
      <div id="upsell_container">  
        <div class="row">
          <div id="upsell_header" class="col-md-12">
            <h2>
              <a href="https://8degreethemes.com/" target="_blank">
                <img src="https://8degreethemes.com/wp-content/uploads/2015/05/logo.png"/>
              </a>
            </h2>

            <h3><?php _e( 'Activate Aglee Pro Theme', 'aglee-pro' ); ?></h3>
            <?php 
            $var = get_option('AP_8DT');
            if($var['activated']=='true'): ?>
            <h4>You have activated theme for this domain (i.e.<?php echo site_url(); ?>). <br /> Thanks!</h4>
          <?php else: ?>
            <div class="validate_serial_key">
             <?php _e( 'Serial Key', 'aglee-pro' ); ?>: 
             <input type="text" id="serial_key"><br />
             <input type="hidden" id="serial_key_uuid" value="<?php echo site_url(); ?>">
             <input type="button" id="validate" value="Activate Theme">
             <input type="hidden" id="sku" value="8dt-ap">
             <p id="result"></p>
             <div class='us-info'>Enter the License Key you got when bought this product. If you lost the key, you can always retrieve it from <a href='https://8degreethemes.com/my-account/my_serial_keys/' target='_blank'>My Account</a></div>
           </div> 
         <?php endif; ?>   
       </div>
     </div>
   </div>
 </div>
 <script type="text/javascript">
  jQuery(function(){
    jQuery("input#validate").on("click", function(){
      jQuery.ajax({
        url: "https://8degreethemes.com/?wc-api=validate_serial_key",
        type: "post",
        dataType: "json",
        data: {
          serial: jQuery("input#serial_key").val(),
          uuid: jQuery("input#serial_key_uuid").val(),
          sku: jQuery("input#sku").val()
        },
        success: function( response ) {
          jQuery("p#result").text('');
          jQuery.ajax({
            url: "<?php echo admin_url() . 'admin-post.php' ?>",
            type: "post",
            data: "activated="+response.success+"&update=1&action=edtsave_validation_settings"
          });
          if ( response.success == "true" ) {
            jQuery("p#result").append( '<p style="background: green; color: white">'+response.message+'.</p>' );                
          } else {
            jQuery("p#result").append( '<p style="background: red; color: white">'+response.message+'.</p>' );
          }
        }
      });
    });
  });
</script>
</div>
<?php
}
add_action('admin_post_edtsave_validation_settings','edtsave_validation_settings'); //save the options in the wordpress options table.
function edtsave_validation_settings(){
  $val = $_POST['activated'];
  $upd = $_POST['update'];
  $res = update_option('AP_8DT',array('activated'=>$val,'update'=>$upd,'upd_date'=>date('Y-m-d H:i:s')));
  echo $res;
}
/** End checking theme activation */