<?php get_header(); ?>
<article class="inner">
  <div class="header">
    <h1 class="title"><?php the_title(); ?></h1>
  </div><?php if(have_posts()): while(have_posts()): the_post(); ?><?php 
  	remove_filter('the_content', 'wpautop');
  	the_content();
  	add_filter('the_content', 'wpautop');
  ?><?php endwhile; endif; ?>
</article><?php get_footer(); ?>