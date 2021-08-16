<?php get_header(); ?>
<div class="inner">
  <article id="article">
    <article id="column">
      <div class="header">
        <div class="title">
          <h1><?php single_term_title(); ?>一覧</h1>
        </div>
        <div class="sub-title"><span>category - <?php echo $term ?></span></div>
      </div>
      <div class="wrapper"><?php while (have_posts()) : the_post(); ?>
        <section>
          <div class="content"><a class="image" href="<?php the_permalink(); ?>">
              <picture>
                <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', array('class' => 'cover'));
                    } else {
                        echo '<img class="cover" src="' . get_bloginfo('template_url') . '/images/common/common_eyecatch.jpg' . '" alt="thumbnail" />';
                    }
                ?>
              </picture></a>
            <div class="paragraph">
              <div class="date">
                <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
              </div><a class="title" href="<?php the_permalink(); ?>">
                <h2 class="clamp_3"><?php the_title(); ?></h2></a>
            </div>
          </div>
        </section><?php endwhile; ?>
      </div>
      <section class="pagenation">
        <div class="inner">
          <div class="page_feed">
            <?php 
                the_posts_pagination(array( 
                    'mid_size' => 1,
                    'prev_text' => '<',
                    'next_text' => '>',
                    'screen_reader_text'=>' ',
                ) ); 
            ?>
          </div>
        </div>
      </section>
    </article>
    <aside id="aside"></aside>
  </article>
</div><?php get_footer(); ?>