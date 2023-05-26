<?php
  $cat_data = [];
  $terms_args = [
    'taxonomy' => 'class',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];

  $terms = get_terms($terms_args);
  foreach ($terms as $term):
    $cat_data[] = [
      'id' => $term->term_id,
      'cat_name' => $term->name,
      'cat_slug' => $term->slug
    ];
  endforeach;
  return $cat_data;
?>