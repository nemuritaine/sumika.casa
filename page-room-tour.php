<?php get_header(); ?>
<article class="inner"> 
  <div class="header">
    <h1 class="title"><?php the_title(); ?></h1>
  </div>
  <section>
    <div class="title">
      <h3>ルームツアーとは？</h3>
    </div>
    <div class="paragraph">
      <div class="text">
        <p>ルームツアーの記事を作成して皆さんのお部屋を紹介させていただきます🌿🍃</p>
        <p>下記のフォームに記入していただいた内容を元に、SUMIKA編集部が記事を作成します📝</p>
        <p>過去に作成した記事の一覧は<a href="https://sumika.casa/article/tag/%e3%83%ab%e3%83%bc%e3%83%a0%e3%83%84%e3%82%a2%e3%83%bc/">こちら</a></p>
      </div>
    </div>
  </section>
  <section>
    <div class="title">
      <h3>注意点</h3>
    </div>
    <div class="paragraph">
      <div class="text">
        <p>投稿された記事は、Sumikaのインスタグラムアカウントのストーリーで紹介させていただきます🕊</p>
        <p>記事の作成にあたり、記事で使用する画像をユーザーのインスタグラムアカウントからSumikaのサーバーに保存させていただくことをご了承ください。</p>
      </div>
    </div>
  </section><?php echo do_shortcode('[contact-form-7 id="476" title="room-tour"]') ?>
</article><?php get_footer(); ?>