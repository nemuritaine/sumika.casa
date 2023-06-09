<?php
  $post_types = array('element', 'news', 'study', 'post');
  $result = array();

  foreach ($post_types as $type) {
    $posts = get_posts(array(
      'post_type' => $type,
      'post_status' => 'publish',
      'posts_per_page' => -1,
    ));

    // 各投稿のIDと最終更新日を結果に追加します
    foreach ($posts as $post) {
      array_push($result, array(
        'id' => $post->ID,
        'last_modified' => $post->post_modified,
        'type' => $type,
      ));
    }
  }

  return $result;
?>

