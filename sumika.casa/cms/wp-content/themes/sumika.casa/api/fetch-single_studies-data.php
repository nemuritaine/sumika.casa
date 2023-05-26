<?php
  $args_single = array(
    'posts_per_page' => 1,
    'post_type' => 'study',
    'post_status' => 'publish',
    'include' => urldecode($param['id'])
  );
  $single_post = get_posts($args_single);
  $targets = $single_post;
  $result = [];
  foreach($targets as $post):
    $data = array(
      'ID' => $post->ID,
      'slug' => $post->post_name,
      'modified' => $post->post_modified,
      'title' => $post->post_title,
      'category' => get_the_terms($post->ID, 'study_cat')[0]->name,
    );
    array_push($result, $data);
  endforeach;
  return $result[0];
?>