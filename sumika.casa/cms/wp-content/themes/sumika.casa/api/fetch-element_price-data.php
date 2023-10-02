<?php
  $search_query = $param['search'];
  $brand_data = [];

  $brand_args = [
    'taxonomy' => 'brand',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false
  ];

  if (!empty($search_query)) {
    // 英名での検索
    $name_query_args = $brand_args;
    $name_query_args['name__like'] = $search_query;
    $brands_by_name = get_terms($name_query_args);

    // 日本語名での検索
    $jp_query_args = $brand_args;
    $jp_query_args['meta_query'] = [
      [
        'key' => 'brand_japanese_reading',
        'value' => $search_query,
        'compare' => 'LIKE'
      ]
    ];
    $brands_by_jp = get_terms($jp_query_args);

    // 2つのクエリの結果を統合
    $brands = array_merge($brands_by_name, $brands_by_jp);
  }

  foreach ($brands as $term):
    $brand_data[] = [
      'id' => $term->term_id,
      'name' => html_entity_decode($term->name),
      'name_jp' => get_term_meta($term->term_id, 'brand_japanese_reading', true),
      'cat_slug' => $term->slug
    ];
  endforeach;
  return $brand_data;
?>