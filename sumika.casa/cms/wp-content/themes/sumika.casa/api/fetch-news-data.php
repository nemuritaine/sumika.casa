<?php
  $post_data = [];
  $post_args = [
    'post_type'  => 'news',
    'posts_per_page' => $param['per_page'] ?: 20,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $param['page'] ?: 1,
  ];
  if (!empty($param['categories'])) {
    $post_args['tax_query'][] = [
      'taxonomy' => 'news_cat',
      'field' => 'slug',
      'terms' => $param['categories'],
    ];
  }
  $post_query = new WP_Query($post_args);
  if ($post_query->have_posts()):
    while ($post_query->have_posts()):
      $post_query->the_post();
      global $post;
      // カテゴリ取得
      $category = get_the_terms($post->ID, 'news_cat');
      $cat_name = $category[0]->name;
      $cat_slug = $category[0]->slug;
      // タグ
      // $tags = get_the_tags();
      // $tags_array = [];
      // foreach ($tags as $tag) {
      //   $tags_array[] = [
      //     'tag_id' => $tag->term_id,
      //     'tag_name' => $tag->name
      //   ];
      // }

      $post_data[] = [
        'id' => $post->ID, // 記事ID
        'title' => $post->post_title,
        'time' => get_the_time('Y.m.d'), // 公開日
        'category' => $cat_name,
        'category_slug' => $cat_slug,
        'icon' => get_field('p-topNewsItem__icon'),
        'content' => $post->post_content,
        // 'tags' => $tags_array, // タグ
        'link' => get_the_permalink() // リンク
      ];
    endwhile;
    wp_reset_postdata();
  endif;
  return $post_data;
?>