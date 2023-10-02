<?php
  $post_data = [];
  $post_args = [
    'post_type' => 'post',
    'posts_per_page' => $param['per_page'] ?: 20,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $param['page'] ?: 1,
    'post__not_in' => array('66', '44', '131', '1597'),
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => 'interior',
      ),
    ),
  ];
  if (!empty($param['categories'])) {
    $post_args['category__in'] = $param['categories'];
  }
  if (!empty($param['tags'])) {
    $post_args['tag__in'] = $param['tags'];
  }
  if (!empty($param['tags_slug'])) {
    $post_args['tag_slug__and'] = $param['tags_slug'];
  }
  // orderパラメータがある場合
  if (!empty($param['order'])) {
    $post_args['orderby'] = $param['order'];
  }
  $post_query = new WP_Query($post_args);
  if ($post_query->have_posts()):
    while ($post_query->have_posts()):
      $post_query->the_post();
      global $post;
      //著者情報
      // $author = get_userdata($post->post_author);
      // $author_id = $author->ID;
      // $author_nicename = get_the_author_meta('user_nicename');
      // カスタムフィールドの画像を取得
      // $avatar_src = scf_auther_src($author_id, 'cf_writer_avatar', 'thumbnail');
      // カテゴリ取得
      // $category = get_the_category();
      // $cat_name = $category[0]->cat_name;
      // $cat_slug = $category[0]->slug;
      $categories = get_the_category();
      $categories_data = [];
      foreach ($categories as $category) {
        $categories_data[] = [
          'id' => $category->term_id,
          'name' => $category->name,
        ];
      }
      // タグ
      // $tags = get_the_tags();
      // $tags_array = [];
      // foreach ($tags as $tag) {
      //   $tags_array[] = [
      //     'tag_id' => $tag->term_id,
      //     'tag_name' => $tag->name
      //   ];
      // }
      $tags = get_the_tags();
      $tags_data = [];
      if ($tags) {
        foreach ($tags as $tag) {
          $tags_data[] = [
            'id' => $tag->term_id,
            'slug' => $tag->slug,
            'name' => $tag->name,
          ];
        }
      }

      $post_data[] = [
        // 記事ID
        'id' => $post->ID,
        'time' => get_the_time('Y.m.d'), // 公開日
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'), // 画像URL
        // 'author_name' => $author_nicename, // 執筆者
        // 'avatar_src' => $avatar_src, // 執筆者の画像
        'title' => $post->post_title,
        'excerpt' => nl2br(get_the_excerpt()),
        'categories' => $categories_data,
        'tags' => $tags_data,
        'name' => get_field('p-postProfile__name', $post->ID),
        'sns' => get_field('p-postProfile__link', $post->ID),
        'url' => get_field('p-postProfile__url', $post->ID),
        //リンク
        'link' => get_the_permalink(),
      ];
    endwhile;
    wp_reset_postdata();
  endif;
  // return new WP_REST_Response($post_data, 200);
  return $post_data;
?>