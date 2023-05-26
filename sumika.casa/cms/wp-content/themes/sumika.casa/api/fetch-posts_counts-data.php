<?php
  $post_types = ['post', 'news', 'element', 'study'];
  $counts = [];
  foreach ($post_types as $post_type) {
    $counts[$post_type] = wp_count_posts($post_type)->publish;
  }
  return $counts;
?>