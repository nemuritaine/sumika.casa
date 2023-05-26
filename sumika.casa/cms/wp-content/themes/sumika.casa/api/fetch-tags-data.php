<?php
  $tags_data = [];
  $tags = get_terms(array(
    'taxonomy' => 'post_tag',
    'hide_empty' => false,
  ));
  foreach ($tags as $tag):
    $tags_data[] = [
      'id' => $tag->term_id,
      'name' => $tag->name,
      'slug' => $tag->slug
    ];
  endforeach;
  return $tags_data;
?>