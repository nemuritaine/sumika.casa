<?php get_header(); ?>
<div class="inner">
  <div id="article">
    <article id="column">
      <div class="header">
        <?php
        	$term = get_queried_object();
        	$term_name = single_term_title( '', false );
        	$term_slug = $term->slug;
        ?>
        <div class="title">
          <h1><?php echo $term_name ?>の記事一覧</h1>
        </div>
        <div class="sub-title"><span>TAG #<?php echo $term_name ?></span></div>
      </div>
      <div class="wrapper"><?php while (have_posts()) : the_post(); ?>
        <section>
          <div class="content"><a class="image" href="<?php the_permalink(); ?>">
              <picture>
                <?php
                	if (has_post_thumbnail()) {
                		the_post_thumbnail('full', array('class' => 'cover lazyload'));
                	} else {
                		echo '<img class="cover lazyload" src="' . get_bloginfo('template_url') . '/images/common/common_eyecatch.jpg' . '" alt="thumbnail" />';
                	}
                ?>
              </picture></a>
            <div class="paragraph">
              <div class="date">
                <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
              </div><a class="title" href="&lt;?php the_permalink(); ?&gt;">
                <h2 class="clamp_3"><?php the_title(); ?></h2></a>
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