<?php
  $style_data = [];
  $style_args = [
    'taxonomy' => 'style',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];
  $style = get_terms($style_args);
  foreach ($style as $term):
    $style_data[] = [
      'id' => $term->term_id,
      'cat_name' => $term->name,
      'cat_slug' => $term->slug
    ];
  endforeach;

  $price_data = [];
  $price_args = [
    'taxonomy' => 'price',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];
  $price = get_terms($price_args);
  foreach ($price as $term):
    $price_data[] = [
      'id' => $term->term_id,
      'cat_name' => $term->name,
      'cat_slug' => $term->slug
    ];
  endforeach;

  $class_data = [];
  $class_args = [
    'taxonomy' => 'class',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];
  $class = get_terms($class_args);
  foreach ($class as $term):
    $class_data[] = [
      'id' => $term->term_id,
      'cat_name' => $term->name,
      'cat_slug' => $term->slug
    ];
  endforeach;

  $brand_data = [];
  $brand_args = [
    'taxonomy' => 'brand',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];
  $brand = get_terms($brand_args);
  foreach ($brand as $term):
    $brand_data[] = [
      'id' => $term->term_id,
      'cat_name' => html_entity_decode($term->name),
      'cat_slug' => $term->slug
    ];
  endforeach;

  $detail_data = [
    'style' => $style_data,
    'price' => $price_data,
    'class' => $class_data,
    'brand' => $brand_data,
  ];
  return $detail_data;
?>