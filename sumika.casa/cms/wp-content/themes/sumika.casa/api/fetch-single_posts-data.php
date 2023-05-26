<?php
  $post_id = $param['id'];
  $post = get_post($post_id);

  if (!$post) {
    return new WP_Error('no_post', '記事が見つかりませんでした。', array('status' => 404));
  }

  // Genesis Custom Blocksのフィルターを適用
  $content = apply_filters('the_content', $post->post_content);
  $content = apply_filters('genesis_custom_blocks_render_content', $content);

  $post_data = array(
    'ID' => $post->ID,
    'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
    'slug' => $post->post_name,
    'date' => $post->post_date,
    'modified' => $post->post_modified,
    'title' => $post->post_title,
    'excerpt' => $post->post_excerpt,
    'content' => $content,
    'category' => get_the_terms($post->ID, 'category')[0]->slug,
  );

  return $post_data;
?>