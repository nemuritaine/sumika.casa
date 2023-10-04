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


  $price_range_data = [];
  global $wpdb;
  $sql = $wpdb->prepare(
    "SELECT
      MIN(CAST(meta_value AS UNSIGNED)) as min_price,
      MAX(CAST(meta_value AS UNSIGNED)) as max_price
    FROM
      $wpdb->postmeta
    WHERE
      meta_key = %s",
    'p-elementItem__price'
  );
  $min_max_prices = $wpdb->get_row($sql);
  $price_range_data = [
    'min_price' => (int) $min_max_prices->min_price,
    'max_price' => (int) $min_max_prices->max_price
  ];


  $price_range_data = [];
  global $wpdb;
  // 価格データを取得
  $sql = $wpdb->prepare(
    "SELECT CAST(meta_value AS UNSIGNED) as price
    FROM $wpdb->postmeta
    WHERE meta_key = %s
    ORDER BY price",
    'p-elementItem__price'
  );
  $prices = $wpdb->get_col($sql);
  // データの数
  $n = count($prices);
  // パーセンタイルを計算
  $percentile_25 = $prices[floor($n * 0.25)];
  $percentile_50 = $prices[floor($n * 0.50)];
  $percentile_75 = $prices[floor($n * 0.75)];
  // 最小値と最大値を取得
  $min_price = $prices[0];
  $max_price = $prices[$n - 1];
  // データを格納
  $price_range_data = [
    'min_price' => $min_price,
    'max_price' => $max_price,
    'percentile_25' => $percentile_25,
    'percentile_50' => $percentile_50,
    'percentile_75' => $percentile_75
  ];


  $class_data = [];
  $class_args = [
    'taxonomy' => 'class',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => false,
  ];
  $class = get_terms($class_args);
  foreach ($class as $term):
    $thumbnail_url = get_term_meta($term->term_id, 'thumbnail_url', true);
    $class_data[] = [
      'id' => $term->term_id,
      'cat_name' => $term->name,
      'cat_slug' => $term->slug,
      'thumbnail_url' => $thumbnail_url,
      'parent' => $term->parent
    ];
  endforeach;
  

  $brand_data = [];
  $brand_args = [
    'taxonomy' => 'brand',
    'orderby' => 'count', // タームのカウント（使用回数）に基づいて並び替え
    'order' => 'DESC', // 降順に並び替えて、最も使用されているタームを先頭にする
    'hide_empty' => false,
  ];
  $brand = get_terms($brand_args);
  foreach ($brand as $term):
    $brand_data[] = [
      'id' => $term->term_id,
      'cat_name' => html_entity_decode($term->name),
      'name_jp' => get_term_meta($term->term_id, 'brand_japanese_reading', true),
      'cat_slug' => $term->slug
    ];
  endforeach;


  $detail_data = [
    'style' => $style_data,
    'price' => $price_data,
    'price_range' => $price_range_data,
    'class' => $class_data,
    'brand' => $brand_data,
  ];
  return $detail_data;
?>