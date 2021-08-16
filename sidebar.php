<ins class="adsbygoogle" style="display:inline-block;width:300px;height:600px" data-ad-client="ca-pub-8411870945056099" data-ad-slot="9049992075"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<article id="ranking"><?php dynamic_sidebar('aside'); ?>
  <div class="header">
    <div class="sub-title"><span>PICK UP</span></div>
    <div class="title">
      <p>人気記事</p>
    </div>
  </div>
  <div class="wrapper">
    <?php
        setPostViews(get_the_ID());
        $args = array(
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
            'post_type' => 'post',
            'posts_per_page' => 3,
        );
        $my_query = new WP_Query($args);
        if($my_query->have_posts()):
        while ($my_query->have_posts()) : $my_query->the_post();
    ?>
    <section><a class="content" href="<?php the_permalink() ?>">
        <div class="image">
          <picture><?php if(has_post_thumbnail()): ?><img class="cover lazyload fadein" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture>
        </div>
        <div class="paragraph">
          <div class="title">
            <h3><?php the_title(); ?></h3>
          </div>
          <div class="date">
            <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
          </div>
        </div></a></section><?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
  </div>
</article><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8411870945056099" data-ad-slot="3212160272" data-ad-format="auto" data-full-width-responsive="true"></ins><script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>