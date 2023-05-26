<?php
  $categories_data = [];
  $categories = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false,
  ));
  foreach ($categories as $category):
    $categories_data[] = [
      'id' => $category->term_id,
      'name' => $category->name,
      'slug' => $category->slug
    ];
  endforeach;
  return $categories_data;
?>