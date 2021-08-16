<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<figure class="eyecatch" id="canvas">
  <?php
  	if (has_post_thumbnail()) {
  		the_post_thumbnail('full', array('class' => 'cover'));
  	} else {
  		echo '<img class="cover" src="' . get_bloginfo('template_url') . '/images/common/common_eyecatch.jpg' . '" alt="thumbnail">';
  	}
  ?>
  <figcaption><span><?php echo get_post_meta($post->ID, 'english', true); ?></span>
    <h1 id="title"><?php the_title(); ?></h1>
  </figcaption>
</figure>
<aside class="inner">
  <ul><?php if(get_post_meta($post->ID, 'wix', true)): ?>
<li><a href="<?php echo get_post_meta($post->ID, 'wix', true); ?>" target="_blank">WIX</a></li>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'tumblr', true)): ?>
<li><a href="<?php echo get_post_meta($post->ID, 'tumblr', true); ?>" target="_blank">TUMBLR</a></li>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'issuu', true)): ?>
<li><a href="<?php echo get_post_meta($post->ID, 'issuu', true); ?>" target="_blank">ISSUU</a></li>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'facebook', true)): ?>
<li><a href="<?php echo get_post_meta($post->ID, 'facebook', true); ?>" target="_blank">FACEBOOK</a></li>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'instagram', true)): ?>
<li><a href="<?php echo get_post_meta($post->ID, 'instagram', true); ?>" target="_blank">INSTAGRAM</a></li>
<?php endif; ?>
  </ul>
</aside>
<article class="inner split_2"><?php the_content(); ?></article><?php endwhile; endif; ?>
<?php get_footer(); ?>