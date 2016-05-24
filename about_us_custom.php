<?php
/**
 * Template Name: 客製化關於我tpl
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


<!--head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>
    html, body {
      height: 100%;
      font-family: open_sansregular, Arial, "文泉驛正黑", "WenQuanYi Zen Hei", "PingFang TC", "儷黑 Pro", "LiHei Pro", "source-han-sans-traditional", "Microsoft JhengHei", "新細明體", DFKai-SB, sans-serif;
    }

    @media screen and (min-device-width: 769px) {
      .about-header {
        text-align: center;
        border-bottom: 5px solid #5C40A6;
        margin-bottom: 30px;
      }

      .about-header p {
        font-size: 2em;
        margin-bottom: 0.5em;
        color: #5C40A6;
      }

      .about-container {
        background: url('http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/05/abus_background.png');
        background-size: 100% auto;
        max-width: 1024px;
        height: 100%;
        margin: 0 auto;
      }
      .about-container > div:nth-child(n+2) {
        width: 100%;
        height: 50%;
        position: relative;
      }

      .about-container .about-top img {
        max-width: 50%;
        max-height: 100%;
        float: left;
      }

      .about-container .about-top div {
        width: 50%;
        padding-left: 20px;
        float: left;
        box-sizing: border-box;
      }

      .about-container .about-bottom div {
        width: 50%;
        clear: both;
      }

      .about-container .about-bottom img {
        position: absolute;
        top: -30%;
        right: 5%;
        max-width: 50%;
        max-height: 120%;
      }
      .about-container .about-bottom p:nth-child(1) {
        margin-top: 20px;
      }
      .about-container p {
        color: #666;
        line-height: 1.8em;
        letter-spacing: 0.2em;
      }

      .desktop-show {
        display: block;
      }

      .mobile-show {
        display: none;
      }

    }

    @media screen and (max-device-width: 768px) {
      .about-container p {
        color: #666;
        /*line-height: 1.8em;*/
        letter-spacing: 0.2em;
        padding: 0 3em;
        font-size: 1.6em;
      }

      .about-container .about-top img {
        margin: 0 auto;
          display: block;
      }

      .about-container .about-bottom img {
        margin: 0 auto;
      }

      .about-header {
        text-align: center;
        border-bottom: 5px solid #5C40A6;
        margin-bottom: 30px;
      }

      .about-header p {
        font-size: 3em;
        margin-bottom: 0.5em;
        color: #5C40A6;
      }

      .desktop-show {
        display: none;
      }

      .mobile-show {
        display: block;
      }
    }

  </style>
</head-->

  <div class="about-container">
    <div class="about-header">
      <p>關於 Sara</p>
    </div>
    <div class="about-top">
      <img src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/05/abus_left.png" alt="">
      <div>
        <p>
          我相信真正的英雄不是醫者而是患者。因為在習得相信自己身體和心理自癒能力的過程中，他們就是那個盡力改變自己陳舊觀念、辛苦建立新習慣，最後扭轉自己健康命運的人。健康自己來（DIY Health）的概念由此而生。我想將更多協助健康的工具交到英雄的手中，讓這些最了解自己身體和心理的人，拿著他們自己選的工具，去做修復自己、找到健康和快樂的工作。
        </p>
      </div>
    </div>
    <div class="about-bottom">
      <div class="about-bottom-left">
        <img class="mobile-show" src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/05/abus_right.png">
        <p class="desktop-show">
        我寫的五本書和製作的節目就是我所謂的健康工具。這些書沒有參與說服，只有陳述我對身體和心理的看法，並且提供求取身體與心理健康的方法。不參與說服，是因為每一個人都是自己身體和心理的真正專家，只有他們才最知道自己需要什麼。就像螺絲起子不會說服別人去用它，但是有心用它的人，便能為自己解決問題。我的書或節目都是工具，有心使用它的人能得到健康的功效，而這個功效四處彰顯，這就是為什麼我的五本書能常駐於暢銷書榜首、節目一個月能破百萬view的原因。
        </p>
        <p class="desktop-show">
        當然，我的成功還有一個重要因素，那就是
        「也不看看我的經紀人是誰」。
        </p>
      </div>
      <div class="about-bottom-right">
        <img class="desktop-show" src="http://www.sarasdiyhealth.com/test2/wp-content/uploads/2016/05/abus_right.png">
        <p class="mobile-show">
        我寫的五本書和製作的節目就是我所謂的健康工具。這些書沒有參與說服，只有陳述我對身體和心理的看法，並且提供求取身體與心理健康的方法。不參與說服，是因為每一個人都是自己身體和心理的真正專家，只有他們才最知道自己需要什麼。就像螺絲起子不會說服別人去用它，但是有心用它的人，便能為自己解決問題。我的書或節目都是工具，有心使用它的人能得到健康的功效，而這個功效四處彰顯，這就是為什麼我的五本書能常駐於暢銷書榜首、節目一個月能破百萬view的原因。
        </p>
        <p class="mobile-show">
        當然，我的成功還有一個重要因素，那就是
        「也不看看我的經紀人是誰」。
        </p>
      </div>
    </div>
  </div>




<?php get_footer(); ?>