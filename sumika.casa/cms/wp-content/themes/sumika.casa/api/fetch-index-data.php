<?php
  $result = [];

  $article_data = [];
  $article_args = [
    'post_type' => 'post',
    'posts_per_page' => 20,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => array('66', '44', '131', '1597'),
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => 'interior',
      ),
    ),
  ];
  $article_query = new WP_Query($article_args);
  if ($article_query->have_posts()):
    while ($article_query->have_posts()):
      $article_query->the_post();
      global $post;
      $categories = get_the_category();
      $categories_data = [];
      foreach ($categories as $category) {
        $categories_data[] = [
          'id' => $category->term_id,
          'name' => $category->name,
        ];
      }
      $tags = get_the_tags();
      $tags_data = [];
      if ($tags) {
        foreach ($tags as $tag) {
          $tags_data[] = [
            'id' => $tag->term_id,
            'name' => $tag->name,
          ];
        }
      }
      $article_data[] = [
        'id' => $post->ID,
        'time' => get_the_time('Y.m.d'), // 公開日
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'), // 画像URL
        'title' => $post->post_title,
        'excerpt' => nl2br(get_the_excerpt()),
        'categories' => $categories_data,
        'tags' => $tags_data,
        'link' => get_the_permalink(),
      ];
    endwhile;
    wp_reset_postdata();
  endif;


  $element_data = [];
  $element_args = [
    'post_type' => 'element',
    'posts_per_page' => 20,
    'post_status' => 'publish',
  ];
  $element_query = new WP_Query($element_args);
  if ($element_query->have_posts()):
    while ($element_query->have_posts()):
      $element_query->the_post();
      global $post;
      
      $classes = get_the_terms($post->ID, 'class');
      $classes_data = [];
      if ($classes) {
        foreach ($classes as $class) {
          $classes_data[] = [
            'id' => $class->term_id,
            'name' => $class->name,
          ];
        }
      }

      $brands = get_the_terms($post->ID, 'brand');
      $brands_data = [];
      if ($brands) {
        foreach ($brands as $brand) {
          $brands_data[] = [
            'id' => $brand->term_id,
            'name' => $brand->name,
          ];
        }
      }

      $prices = get_the_terms($post->ID, 'price');
      $prices_data = [];
      if ($prices) {
        foreach ($prices as $price) {
          $prices_data[] = [
            'id' => $price->term_id,
            'name' => $price->name,
          ];
        }
      }

      $styles = get_the_terms($post->ID, 'style');
      $styles_data = [];
      if ($styles) {
        foreach ($styles as $style) {
          $styles_data[] = [
            'id' => $style->term_id,
            'name' => $style->name,
          ];
        }
      }

      $price = get_field('p-elementItem__price');
      if(is_numeric($price)) {
        $price = number_format($price);
      }

      $element_data[] = [
        'id' => $post->ID,
        'time' => get_the_time('Y.m.d'),
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'),
        'title' => $post->post_title,
        'excerpt' => get_the_excerpt(),
        'classes' => $classes_data,
        'style' => $styles_data,
        'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? html_entity_decode($brands[0]->name) : '',
        'price' => $price,
        'likes_count' => get_field('likes_count'),
        'link' => get_the_permalink()
      ];
    endwhile;
    wp_reset_postdata();
  endif;


  $study_data = [];
  $study_args = [
    'post_type' => 'study',
    'posts_per_page' => 20,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
  ];
  $study_query = new WP_Query($study_args);
  if ($study_query->have_posts()):
    while ($study_query->have_posts()):
      $study_query->the_post();
      global $post;

      $study_data[] = [
        'id' => $post->ID, // 記事ID
        'title' => $post->post_title,
        'link' => get_the_permalink(), // リンク
        'order' => $post->menu_order
      ];
    endwhile;
    wp_reset_postdata();
  endif;

  $study_cat_data = [];
  $study_cat_args = [
    'taxonomy' => 'study_cat',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];
  $study_cat = get_terms($study_cat_args);
  foreach ($study_cat as $term):
    $study_cat_data[] = [
      'id' => $term->term_id,
      'cat_name' => $term->name,
      'cat_slug' => $term->slug
    ];
  endforeach;


  $news_data = [];
  $news_args = [
    'post_type'  => 'news',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
  ];
  $news_query = new WP_Query($news_args);
  if ($news_query->have_posts()):
    while ($news_query->have_posts()):
      $news_query->the_post();
      global $post;
      $category = get_the_terms($post->ID, 'news_cat');
      $cat_name = $category[0]->name;
      $cat_slug = $category[0]->slug;
      $news_data[] = [
        'id' => $post->ID, // 記事ID
        'title' => $post->post_title,
        'time' => get_the_time('Y.m.d'), // 公開日
        'category' => $cat_name,
        'category_slug' => $cat_slug,
        'icon' => get_field('p-topNewsItem__icon', $post->ID),
        'content' => $post->post_content,
        'link' => get_the_permalink() // リンク
      ];
    endwhile;
    wp_reset_postdata();
  endif;


  $post_types = ['post', 'news', 'element', 'study'];
  $counts = [];
  foreach ($post_types as $post_type) {
    $counts[$post_type] = wp_count_posts($post_type)->publish;
  }


  $result = [
    'article' => $article_data,
    'element' => $element_data,
    'study' => $study_data,
    'study_cat' => $study_cat_data,
    'news' => $news_data,
    'counts' => $counts,
  ];
  return $result;
?>