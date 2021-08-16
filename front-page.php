<?php if(!defined('ABSPATH')) exit; ?>
<?php get_header(); ?>
<div class="p-page--home__hero" id="main-visual">
  <div class="p-page--home__hero__menu">
    <div class="p-page--home__hero__menu__btn">
      <div class="p-page--home__hero__menu__btn--more"><span>詳しくみる</span></div>
      <div class="p-page--home__hero__menu__btn--less"><span>閉じる</span></div>
    </div>
    <button class="p-page--home__hero__menu__btn--close">
      <svg class="svg-icon icon-close" viewBox="0 0 24 24">
        <path d="M21 4.565L19.435 3 12 10.435 4.565 3 3 4.565 10.435 12 3 19.435 4.565 21 12 13.565 19.435 21 21 19.435 13.565 12z"></path>
      </svg>
    </button>
  </div>
  <div class="p-page--home__hero__index">
    <div class="p-page--home__hero__index--current">
      <div class="p-page--home__hero__index--num">01</div>
    </div>
    <div class="p-page--home__hero__index--total">02</div>
  </div>
  <div class="p-page--home__hero__nav">
    <button class="p-page--home__hero__nav__btn--prev">
      <svg role="img" viewBox="0 0 11.38 6">
        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shared__arrow"></use>
      </svg>
    </button>
    <button class="p-page--home__hero__nav__btn--next">
      <svg role="img" viewBox="0 0 11.38 6">
        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shared__arrow"></use>
      </svg>
    </button>
  </div>
  <section class="p-page--home__hero__page is-current">
    <?php
    	setPostViews(get_the_ID());
    	$args = array(
          'meta_key' => 'post_views_count',
          'orderby' => 'meta_value_num',
          'order' => 'DESC',
          'post_status' => 'publish',
    		'posts_per_page' => 1,
    		'post_type' => 'post',
    		'category_name' => 'interior'
    	);
    	$my_query = new WP_Query($args);
    	if($my_query->have_posts()):
    	while ($my_query->have_posts()) : $my_query->the_post();
    ?>
    <div class="p-page--home__hero__page__content">
      <h2 class="p-page--home__hero__ttl">Interior</h2>
      <div class="p-page--home__hero__txt"><?php if ($post->post_excerpt) { ?>
        <p><? echo $post->post_excerpt; ?></p><?php } else {
        	$summary = strip_tags($post->post_content);
        	$summary = str_replace("\n", "", $summary);
        	$summary = mb_substr($summary, 0, 120). "…";
        ?>
        <p><?php echo $summary; ?></p><?php } ?>
      </div>
    </div>
    <div class="p-page--home__hero__page__image">
      <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture>
    </div>
    <div class="p-page--home__hero__page__more">
      <div class="p-page--home__hero__page__more__inner is-bg1"><span class="p-page--home__hero__page__more__txt">Read more</span>
        <div class="read-more"><a href="<?php the_permalink() ?>"><span class="text">記事を読む</span>
            <div class="icon">
              <div class="arrow"><span></span></div>
              <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg">
                  <circle stroke-dashoffset="0%" stroke-dasharray="300%" cx="50%" cy="50%" r="47%" fill="none" stroke-width="1"></circle>
                </svg>
              </div>
            </div></a></div>
      </div>
    </div>
    <div class="p-page--home__hero__page__expander"></div>
    <ul class="p-page--home__hero__detail">
      <li class="p-page--home__hero__detail__item">
        <h3 class="p-page--home__hero__detail__ttl"><?php the_title(); ?></h3>
      </li>
      <li class="p-page--home__hero__detail__item"><span class="tag-lists">TAG LISTS</span>
        <ul>
          <?php
          	$count = 10;
          	$tagchk = get_the_tags();
          	if($tagchk) {
          		$wptags = array_slice(get_the_tags(), 0, $count);
          		foreach($wptags as $tag) {
          			echo '<li>'.$tag->name.'</li>';
          		}
          	}
          ?>
        </ul>
      </li>
      <li class="p-page--home__hero__detail__item is-clickable" data-gallery="gallery1">
        <div class="p-page--home__hero__detail__image"><img class="c-ofi--cover lazyload" data-src="<?php echo bloginfo('template_url') ?>/images/category/interior/symbol.jpg" alt="Some image"/>
          <svg class="svg-icon icon--grid" viewBox="0 0 24 24">
            <path d="M8.982 8.982h5.988v5.988H8.982zM0 0h5.988v5.988H0zM8.982 17.965h5.988v5.988H8.982zM0 8.982h5.988v5.988H0zM0 17.965h5.988v5.988H0zM17.965 0h5.988v5.988h-5.988zM8.982 0h5.988v5.988H8.982zM17.965 8.982h5.988v5.988h-5.988zM17.965 17.965h5.988v5.988h-5.988z"></path>
          </svg>
        </div><span class="popular-articles-list">人気記事一覧を表示</span>
      </li>
    </ul><?php endwhile; endif; ?>
    <div class="p-page--home__hero__gallery" id="gallery1">
      <?php
      	setPostViews(get_the_ID());
      	$args = array(
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
      		'posts_per_page' => 6,
      		'post_type' => 'post',
      		'category_name' => 'interior',
      	);
      	$my_query = new WP_Query($args);
      	if($my_query->have_posts()):
      	while ($my_query->have_posts()): $my_query->the_post();
      ?><a class="p-page--home__hero__gallery__item" href="<?php the_permalink() ?>">
        <div class="p-page--home__hero__gallery__image">
          <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture>
        </div>
        <div class="p-page--home__hero__gallery__ttl"><?php the_title(); ?></div></a><?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </section>
  <section class="p-page--home__hero__page">
    <?php
    	setPostViews(get_the_ID());
    	$args = array(
          'meta_key' => 'post_views_count',
          'orderby' => 'meta_value_num',
          'order' => 'DESC',
          'post_status' => 'publish',
    		'posts_per_page' => 1,
    		'post_type' => 'post',
    		'category_name' => 'architecture'
    	);
    	$my_query = new WP_Query($args);
    	if($my_query->have_posts()):
    	while ($my_query->have_posts()) : $my_query->the_post();
    ?>
    <div class="p-page--home__hero__page__content">
      <h2 class="p-page--home__hero__ttl">Architect</h2>
      <div class="p-page--home__hero__txt"><?php if ($post->post_excerpt) { ?>
        <p><? echo $post->post_excerpt; ?></p><?php } else {
        	$summary = strip_tags($post->post_content);
        	$summary = str_replace("\n", "", $summary);
        	$summary = mb_substr($summary, 0, 120). "…";
        ?>
        <p><?php echo $summary; ?></p><?php } ?>
      </div>
    </div>
    <div class="p-page--home__hero__page__image">
      <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture>
    </div>
    <div class="p-page--home__hero__page__more">
      <div class="p-page--home__hero__page__more__inner is-bg2"><span class="p-page--home__hero__page__more__txt">Read more</span>
        <div class="read-more">
          <div class="mask">
            <div class="clip"><a href="<?php the_permalink() ?>"><span class="text">記事を読む</span>
                <div class="icon">
                  <div class="arrow"><span></span></div>
                  <div class="circle">
                    <svg xmlns="http://www.w3.org/2000/svg">
                      <circle stroke-dashoffset="0%" stroke-dasharray="300%" cx="50%" cy="50%" r="47%" fill="none" stroke-width="1"></circle>
                    </svg>
                  </div>
                </div></a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="p-page--home__hero__page__expander"></div>
    <ul class="p-page--home__hero__detail">
      <li class="p-page--home__hero__detail__item">
        <h3 class="p-page--home__hero__detail__ttl"><?php the_title(); ?></h3>
      </li>
      <li class="p-page--home__hero__detail__item"><span class="tag-lists">TAG LISTS</span>
        <ul>
          <?php
          	$count = 10;
          	$tagchk = get_the_tags();
          	if($tagchk) {
          		$wptags = array_slice(get_the_tags(), 0, $count);
          		foreach($wptags as $tag) {
          			echo '<li>'.$tag->name.'</li>';
          		}
          	}
          ?>
        </ul>
      </li>
      <li class="p-page--home__hero__detail__item is-clickable" data-gallery="gallery2">
        <div class="p-page--home__hero__detail__image"><img class="c-ofi--cover lazyload" data-src="<?php echo bloginfo('template_url') ?>/images/category/architecture/symbol.jpg" alt="Some image"/>
          <svg class="svg-icon icon--grid" viewBox="0 0 24 24">
            <path d="M8.982 8.982h5.988v5.988H8.982zM0 0h5.988v5.988H0zM8.982 17.965h5.988v5.988H8.982zM0 8.982h5.988v5.988H0zM0 17.965h5.988v5.988H0zM17.965 0h5.988v5.988h-5.988zM8.982 0h5.988v5.988H8.982zM17.965 8.982h5.988v5.988h-5.988zM17.965 17.965h5.988v5.988h-5.988z"></path>
          </svg>
        </div><span class="popular-articles-list">人気記事一覧を表示</span>
      </li>
    </ul><?php endwhile; endif; wp_reset_postdata(); ?>
    <div class="p-page--home__hero__gallery" id="gallery2">
      <?php
      	setPostViews(get_the_ID());
      	$args = array(
      		'posts_per_page' => 6,
      		'post_type' => 'post',
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
      		'category_name' => 'architecture',
      	);
      	$my_query = new WP_Query($args);
      	if($my_query->have_posts()):
      	while ($my_query->have_posts()): $my_query->the_post();
      ?><a class="p-page--home__hero__gallery__item" href="<?php the_permalink() ?>">
        <div class="p-page--home__hero__gallery__image">
          <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture>
        </div>
        <div class="p-page--home__hero__gallery__ttl"><?php the_title(); ?></div></a><?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </section>
</div>
<div class="p-page--home__ranking" id="ranking">
  <div class="c-inner">
    <div class="p-page--home__header"><span class="p-page--home__ttl--en">PICK UP</span>
      <p class="p-page--home__ttl--ja">人気記事</p>
    </div>
    <div class="p-page--home__article__wrap">
      <?php
      	setPostViews(get_the_ID());
      	$args = array(
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish',
      		'posts_per_page' => 4,
      		'post_type' => 'post',
      	);
      	$my_query = new WP_Query($args);
      	if($my_query->have_posts()): while ($my_query->have_posts()): $my_query->the_post();
      ?>
      <div class="p-page--home__article__item"><a class="p-page--home__article__img" href="<?php the_permalink() ?>">
          <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload fadein" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture></a>
        <div class="p-page--home__article__txt">
          <ul class="p-page--home__article__cat"><?php $categories = get_the_category($post->ID); ?>
<?php if ($categories): foreach ($categories as $category): ?>
<li class="c-cat--<?php echo $category->slug; ?>"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a><?php endforeach; endif; ?>
          </ul><a class="p-page--home__article__ttl" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
          <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
        </div>
      </div><?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div>
<div class="p-page--home__room-tour" id="room-tour">
  <div class="c-inner">
    <div class="p-page--home__header"><span class="p-page--home__ttl--en">ROOM TOUR</span>
      <p class="p-page--home__ttl--ja">ルームツアー記事</p>
    </div>
    <div class="p-page--home__article__wrap array-fade">
      <?php
      	$args = array(
      		'posts_per_page' => 4,
      		'orderby'=>'rand',
      		'post_type' => 'post',
      		'tag' => 'ルームツアー',
      	);
      ?><?php $myquery = new WP_Query($args); ?>
<?php if($myquery->have_posts()): ?>
<?php while($myquery->have_posts()): $myquery->the_post(); ?>
      <div class="p-page--home__article__item fade"><a class="p-page--home__article__img" href="<?php the_permalink() ?>">
          <?php $image_id = get_post_thumbnail_id();
          	$image_url = wp_get_attachment_image_src($image_id, 'large');
          ?>
          <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload fadein" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture></a>
        <div class="p-page--home__article__txt">
          <ul class="p-page--home__article__cat"><?php $categories = get_the_category($post->ID); ?>
<?php if ($categories): foreach ($categories as $category): ?>
<li class="c-cat--<?php echo $category->slug; ?>"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a><?php endforeach; endif; ?>
          </ul><a class="p-page--home__article__ttl" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
          <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
        </div>
      </div><?php endwhile; else: ?>
      <p>まだ、投稿がありません。</p><?php endif; wp_reset_query(); ?>
    </div>
    <div class="p-page--home__article__btn"><a class="c-btn--square" href="<?php echo home_url('/') ?>article/tag/ルームツアー/">VIEW MORE</a></div>
  </div>
</div>
<div class="p-page--home__artist" id="artist">
  <div class="c-inner">
    <div class="p-page--home__header"><span class="p-page--home__ttl--en">CREATOR</span>
      <p class="p-page--home__ttl--ja">クリエイター</p>
    </div>
    <div class="p-page--home__article__wrap array-fade">
      <?php query_posts( array(
      	'posts_per_page' => 4,
      	'post_type' => 'artists',
      	'taxonomy' => '',
      	'term' => '',
      )); ?><?php if(have_posts()): while(have_posts()): the_post(); ?>
      <div class="p-page--home__article__item fade"><a class="p-page--home__article__img" href="<?php the_permalink() ?>">
          <?php $image_id = get_post_thumbnail_id();
          	$image_url = wp_get_attachment_image_src($image_id, 'large');
          ?>
          <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload fadein" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture></a>
        <div class="p-page--home__article__txt">
          <ul class="p-page--home__article__cat"><?php $terms = get_the_terms($post->ID, 'artist'); ?>
<?php if ($terms): foreach ($terms as $term): ?>
<li class="c-cat--<?php echo $term->slug; ?>"><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a><?php endforeach; endif; ?>
          </ul><a class="p-page--home__article__ttl" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>
      </div><?php endwhile; else: ?>
      <p>まだ、投稿がありません。</p><?php endif; wp_reset_query(); ?>
    </div>
    <div class="p-page--home__article__btn"><a class="c-btn--square" href="<?php echo home_url('/') ?>article/artists/">VIEW MORE</a></div>
  </div>
</div>
<section class="p-page--home__about" id="about">
  <div class="c-inner">
    <div class="p-page--home__header"><span class="p-page--home__ttl--en">ABOUT</span>
      <p class="p-page--home__ttl--ja">Sumikaについて</p>
    </div>
    <div class="p-page--home__about__wrap">
      <div class="p-page--home__about__txt">
        <p>
          Sumikaは、暮らしに関する情報を「発信」「シェア」するためのWEBサイトとなっています。<br>
          サイトへ訪れて下さった方々が「暮らしを楽しむ」際に役立つ情報を発信していくことをテーマにサイトを運営して参りますので、ご協力の程よろしくお願いいたします。<br>
          Sumika 編集部
        </p>
      </div>
    </div>
  </div>
</section>
<div class="p-page--home__latest" id="latest">
  <div class="c-inner">
    <div class="p-page--home__header"><span class="p-page--home__ttl--en">LATEST</span>
      <p class="p-page--home__ttl--ja">新着記事</p>
    </div>
    <div class="p-page--home__article__wrap array-fade" id="js-infinite">
      <?php
      	$page_count = 8;
      	if(isSmartPhone()) {
      		$page_count = 4;
      	}
      	$args = array(
      		'posts_per_page' => $page_count,
      		'post_type' => array('post', 'artist'),
      		'post__not_in' => array(116),
      		'taxonomy' => '',
      		'term' => '',
      	);
        $myquery = new WP_Query($args);
        if($myquery->have_posts()):
        while($myquery->have_posts()): $myquery->the_post();
      ?>
      <div class="p-page--home__article__item fade"><a class="p-page--home__article__img" href="<?php the_permalink() ?>">
          <?php $image_id = get_post_thumbnail_id();
          	$image_url = wp_get_attachment_image_src($image_id, 'large');
          ?>
          <picture><?php if(has_post_thumbnail()): ?><img class="c-ofi--cover lazyload fadein" src="data:image/gif;base64,R0lGODlhAQABAGAAACH5BAEKAP8ALAAAAAABAAEAAAgEAP8FBAA7" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>"/><?php else: ?><img class="c-ofi--cover lazyload fadein" src="<?php get_bloginfo('template_url') ?>/images/common/common_eyecatch.jpg" alt="<?php the_title(); ?>"/><?php endif; ?></picture></a>
        <div class="p-page--home__article__txt">
          <ul class="p-page--home__article__cat"><?php $categories = get_the_category($post->ID); ?>
<?php if ($categories): foreach ($categories as $category): ?>
<li class="c-cat--<?php echo $category->slug; ?>"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a><?php endforeach; endif; ?>
          </ul><a class="p-page--home__article__ttl" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <time><?php echo get_post_time('Y.m.d D H:i') ?></time>
        </div>
      </div><?php endwhile; else: ?>
      <p>まだ、投稿がありません。</p><?php endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div><?php get_footer(); ?>