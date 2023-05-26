<?php
  $post_data = [];
  $post_args = [
    'post_type' => 'post',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
  ];
  $post_query = new WP_Query($post_args);
  if ($post_query->have_posts()):
    while ($post_query->have_posts()):
      $post_query->the_post();
      global $post;
      // 著者情報
      // $author = get_userdata($post->post_author);
      // $author_id = $author->ID;
      // $author_nicename = get_the_author_meta('user_nicename');
      // カスタムフィールドの画像を取得
      // $avatar_src = scf_auther_src($author_id, 'cf_writer_avatar', 'thumbnail');
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
        // 'time' => get_the_time('Y.m.d'), // 公開日
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'), // 画像URL
        'title' => get_the_title(), // タイトル
        // 'author_name' => $author_nicename, // 執筆者
        // 'avatar_src' => $avatar_src, // 執筆者の画像
        // 'category' => $cat_name,
        // 'category_slug' => $cat_slug,
        // 'tags' => $tags_array, // タグ
        'link' => get_the_permalink() // リンク
      ];
    endwhile;
    wp_reset_postdata();
  endif;
  return $post_data;
?>