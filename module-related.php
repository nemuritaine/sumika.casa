
<div class="wrapper">
   <?php
  	$categories = get_the_category($post->ID);
  	$category_ID = array();  
  	foreach($categories as $category) {
  		array_push($category_ID, $category->cat_ID);
  	}
  	$posts_number = 3;
  	$args = array(
  		'post__not_in'=>array($post->ID),
  		'category__in'=>$category_ID,
  		'orderby'=>'rand',
  		'posts_per_page'=>$posts_number,
  	);
  	$wp_query = new WP_Query($args);
  	if ($wp_query->have_posts()):
  	while ($wp_query->have_posts()): $wp_query->the_post();
  ?>
  <section><a class="content" href="<?php the_permalink(); ?>">
      <div class="image">
        <picture><?php if(has_post_thumbnail()): ?><img class="cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture>
      </div>
      <div class="paragraph">
        <div class="title">
          <p class="clamp_3"><?php the_title(); ?></p>
        </div>
        <div class="info">
          <div class="date">
            <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
          </div>
          <p class="category"><?php echo get_the_term_list($post->ID, ''); ?></p>
        </div>
      </div></a></section><?php endwhile; wp_reset_query(); else: ?>
  <p>関連記事がありません。</p><?php endif; ?>
</div>