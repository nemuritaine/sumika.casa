<?php
  // カスタム投稿タイプ 'element' の全ての投稿を取得
  $posts = get_posts([
    'post_type' => 'element',
    'numberposts' => -1
  ]); 
  $likes_count = array();

  foreach ($posts as $post) {
    $post_id = $post->ID;
    $likes_count[$post_id] = get_field('likes_count', $post_id);
  }

  return rest_ensure_response($likes_count);
?>

