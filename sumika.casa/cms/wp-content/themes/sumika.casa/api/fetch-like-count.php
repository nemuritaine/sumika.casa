<?php
  $post_id = $param->get_param('id');
  $likes = get_field('likes_count', $post_id);

  return rest_ensure_response(['likes_count' => $likes]);
?>