<?php
  $post_data = [];
  $post_args = [
    'post_type' => 'study',
    'posts_per_page' => $param['per_page'] ?: 20,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $param['page'] ?: 1,
  ];
  if (!empty($param['categories'])) {
    $post_args['tax_query'][] = [
      'taxonomy' => 'study_cat',
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
      // $category = get_the_category();
      // $cat_name = $category[0]->cat_name;
      // $cat_slug = $category[0]->slug;
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
        // 'category' => $cat_name,
        // 'category_slug' => $cat_slug,
        // 'tags' => $tags_array, // タグ
        'title' => $post->post_title,
        'link' => get_the_permalink(), // リンク
        'order' => $post->menu_order
      ];
    endwhile;
    wp_reset_postdata();
  endif;
  return $post_data;
?>