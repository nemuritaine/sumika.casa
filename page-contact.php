<?php get_header(); ?>
<article class="inner"> 
  <div class="header">
    <h1 class="title"><?php the_title(); ?></h1>
  </div>
  <input id="contact" type="radio" name="tab_item" checked=""/>
  <label class="tab_item" for="contact">
    <h2>一般お問い合わせ</h2>
  </label>
  <input id="artist" type="radio" name="tab_item"/>
  <label class="tab_item" for="artist">
    <h2>作家様お問い合わせ</h2>
  </label>
  <input id="company" type="radio" name="tab_item"/>
  <label class="tab_item" for="company">
    <h2>企業様お問い合わせ</h2>
  </label>
  <section class="tab_content" id="contact_content"><?php echo do_shortcode('[contact-form-7 id="130" title="contact"]') ?></section>
  <section class="tab_content" id="artist_content"><?php echo do_shortcode('[contact-form-7 id="171" title="artist"]') ?></section>
  <section class="tab_content" id="company_content"><?php echo do_shortcode('[contact-form-7 id="170" title="company"]') ?></section>
</article><?php get_footer(); ?>