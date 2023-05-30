<?php
  $post_id = $param->get_param('id');
  $isUnlike = $param->get_param('unlike') == '1';

  $likes = get_field('likes_count', $post_id);

  if ($isUnlike) {
    $likes = $likes > 0 ? $likes - 1 : 0; // 確実に0以上であるように
  } else {
    $likes = empty($likes) ? 1 : $likes + 1;
  }

  update_field('likes_count', $likes, $post_id);
  return rest_ensure_response(['likes_count' => $likes]);
?>