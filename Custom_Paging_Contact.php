<?php
/**
 * Template Name: 客製化分頁contact
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

        
<div class="ag-container clearfix">
                
  <div class="entry-content contact-content">

      <div class="content-mail">
          <div class="mail-first">
                <a href="mailto:villagers.store@gmail.com" rel="home"><img src="http://www.sarasdiyhealth.com/wp-content/uploads/2016/06/contact-mail-icon.png"></a>
                <h2>演講/通告邀約</h2>
          </div>
          <div class="mail-second">
                <a href="mailto:sarasdiyhealth@gmail.com" rel="home"><img src="http://www.sarasdiyhealth.com/wp-content/uploads/2016/06/contact-mail-icon.png"></a>
                <h2>預約與老師聊天時間</h2>
          </div>
      </div>
      <div class="content-description">
          <p>
              舉凡溝通、相處問題，若同意老師把聊天過程錄下來（只照老師）做教學教材，便可與老師預約聊天時間。
          </p>
          <div class="content-youtube">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/-MzhgSAl--A" frameborder="0" allowfullscreen></iframe>
          </div>
      </div>



  </div><!-- .entry-content -->
                        
</div> <!-- end of primary and secondary div -->
    



<?php get_footer(); ?>