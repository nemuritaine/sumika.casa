<?php
  // $args_all = [
  //   'post_type' => 'post',
  //   'posts_per_page' => -1,
  //   'post_status' => 'publish',
  //   'orderby' => 'date',
  //   'order' => 'DESC',
  // ];
  // $all_posts = get_posts($args_all);
  // $all_posts_ids = [];
  // foreach($all_posts as $post):
  //   array_push($all_posts_ids, $post->ID);
  // endforeach;
  $args_single = array(
    'posts_per_page' => 1,
    'post_type' => 'news',
    'post_status' => 'publish',
    'include' => urldecode($param['id'])
  );
  $single_post = get_posts($args_single);
  // $single_post_index = !empty($single_post) ? array_search((int) $parameter[id], $all_posts_ids, true) : -2;
  // $prev_post_id = $single_post_index < count($all_posts_ids) - 1 ? $single_post_index + 1 : null;
  // $next_post_id = !is_null($single_post_index) && ($single_post_index > 0) ? $single_post_index - 1 : null;
  // $targets = array($all_posts[$next_post_id], $single_post[0], $all_posts[$prev_post_id]);
  $targets = $single_post;
  $result = [];
  foreach($targets as $post):
    $data = array(
      'ID' => $post->ID,
      'slug' => $post->post_name,
      'date' => $post->post_date,
      'modified' => $post->post_modified,
      'title' => $post->post_title,
      'excerpt' => $post->post_excerpt,
      'content' => $post->post_content,
      'category' => get_the_terms($post->ID, 'category')[0]->name,
    );
    array_push($result, $data);
  endforeach;
  return $result[0];
?>