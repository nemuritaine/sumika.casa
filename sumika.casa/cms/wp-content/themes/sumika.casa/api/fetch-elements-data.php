<?php
  $post_data = [];
  $post_args = [
    'post_type' => 'element',
    'posts_per_page' => $param['per_page'] ?: 20,
    'post_status' => 'publish',
    'paged' => $param['page'] ?: 1,
  ];

  // sortパラメータに基づいてソートを設定
  switch($param['sort']) {
    case 'date_desc':
      $post_args['orderby'] = 'date';
      $post_args['order'] = 'DESC';
      break;
    case 'likes_desc':
      $post_args['orderby'] = 'meta_value_num';
      $post_args['meta_key'] = 'likes_count';
      $post_args['order'] = 'DESC';
      break;
    case 'price_desc':
      $post_args['orderby'] = 'meta_value_num';
      $post_args['meta_key'] = 'p-elementItem__price';
      $post_args['order'] = 'DESC';
      break;
    case 'price_asc':
      $post_args['orderby'] = 'meta_value_num';
      $post_args['meta_key'] = 'p-elementItem__price';
      $post_args['order'] = 'ASC';
      break;
    default:
      $post_args['orderby'] = 'date';
      $post_args['order'] = 'DESC';
  }

  // liked_idsパラメータがある場合、それらのIDのアイテムだけを取得
  if (!empty($param['liked_ids'])) {
    $post_args['post__in'] = $param['liked_ids'];
  }
  
  if (!empty($param['classes'])) {
    $post_args['tax_query'][] = [
      'taxonomy' => 'class',
      'field' => 'slug',
      'terms' => $param['classes'],
    ];
  }
  if (!empty($param['brands'])) {
    $post_args['tax_query'][] = [
      'taxonomy' => 'brand',
      'field' => 'slug',
      'terms' => $param['brands'],
    ];
  }
  if (!empty($param['prices'])) {
    $post_args['tax_query'][] = [
      'taxonomy' => 'price',
      'field' => 'slug',
      'terms' => $param['prices'],
    ];
  }
  if (!empty($param['styles'])) {
    $post_args['tax_query'][] = [
      'taxonomy' => 'style',
      'field' => 'slug',
      'terms' => $param['styles'],
    ];
  }
  $post_query = new WP_Query($post_args);
  if ($post_query->have_posts()):
    while ($post_query->have_posts()):
      $post_query->the_post();
      global $post;

      $classes = get_the_terms($post->ID, 'class');
      $classes_data = [];
      if ($classes) {
        foreach ($classes as $class) {
          $classes_data[] = [
            'id' => $class->term_id,
            'name' => $class->name,
          ];
        }
      }

      $brands = get_the_terms($post->ID, 'brand');
      $brands_data = [];
      if ($brands) {
        foreach ($brands as $brand) {
          $brands_data[] = [
            'id' => $brand->term_id,
            'name' => $brand->name,
          ];
        }
      }

      $prices = get_the_terms($post->ID, 'price');
      $prices_data = [];
      if ($prices) {
        foreach ($prices as $price) {
          $prices_data[] = [
            'id' => $price->term_id,
            'name' => $price->name,
          ];
        }
      }

      $styles = get_the_terms($post->ID, 'style');
      $styles_data = [];
      if ($styles) {
        foreach ($styles as $style) {
          $styles_data[] = [
            'id' => $style->term_id,
            'name' => $style->name,
          ];
        }
      }

      $price = get_field('p-elementItem__price');
      if(is_numeric($price)) {
        $price = number_format($price);
      }

      $post_data[] = [
        'id' => $post->ID,
        'time' => get_the_time('Y.m.d'),
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'),
        'title' => $post->post_title,
        'excerpt' => get_the_excerpt(),
        'classes' => $classes_data,
        'style' => $styles_data,
        'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? $brands[0]->name : '',
        'price' => $price,
        'likes_count' => get_field('likes_count'),
        'link' => get_the_permalink()
      ];
    endwhile;
    wp_reset_postdata();
  endif;
  return $post_data;
?>