<?php get_header(); ?>
<div class="inner">
  <div id="article">
    <article id="column">
      <div class="header">
        <?php
        	$cat = get_the_category();
        	$cat = $cat[0];
        ?>
        <div class="title">
          <h1><?php echo $cat->cat_name; ?>の記事一覧</h1>
        </div>
        <div class="sub-title"><span>category - <?php echo $cat->category_nicename; ?></span></div>
      </div>
      <div class="wrapper"><?php while (have_posts()) : the_post(); ?>
        <section>
          <div class="content"><a class="image" href="<?php the_permalink(); ?>">
              <picture>
                <?php
                	if (has_post_thumbnail()) {
                		the_post_thumbnail('full', array('class' => 'cover'));
                	} else {
                		echo '<img class="cover" src="' . get_bloginfo('template_url') . '/images/common/common_eyecatch.jpg' . '" alt="thumbnail" />';
                	}
                ?>
              </picture></a>
            <div class="paragraph">
              <div class="date">
                <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
              </div><a class="title" href="<?php the_permalink(); ?>">
                <h2 class="clamp_3"><?php the_title(); ?></h2></a><?php if(!isSmartPhone()): ?>
              <div class="user">
                <picture><?php echo get_avatar(get_the_author_id(), 20); ?></picture>
                <div class="name"><?php the_author_posts_link(); ?></div>
              </div><?php endif; ?>
            </div>
          </div>
        </section><?php endwhile; ?>
      </div><?php 
      	global $wp_query;
      	$maxpages = $wp_query->max_num_pages;
      	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      	select_pagenation($maxpages, $paged);
      ?>
    </article>
    <aside id="aside" role="complementary">
      <div class="wrapper"><?php get_sidebar(); ?></div>
    </aside>
  </div>
</div><?php get_footer(); ?>