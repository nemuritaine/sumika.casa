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

  // orderパラメータがある場合
  if (!empty($param['order'])) {
    $post_args['orderby'] = $param['order'];
  }

  // min_priceパラメータまたはmax_priceパラメータがある場合
  if (!empty($param['min_price']) || !empty($param['max_price'])) {
    $post_args['meta_query'][] = [
      'key' => 'p-elementItem__price',
      'value' => array($param['min_price'], $param['max_price']),
      'compare' => 'BETWEEN',
      'type' => 'NUMERIC',
    ];
  }

  // idパラメータがある場合
  if (!empty($param['id'])) {
    $post_args['post__in'] = $param['id'];
  }

  // excluded_idsパラメータがある場合
  if (isset($param['excluded_ids'])) {
    $excludedIdsArray = explode(",", $param['excluded_ids']);  // カンマ区切りの文字列を配列に変換
    $post_args['post__not_in'] = $excludedIdsArray;
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

      $coordinations = get_field('p-elementItem__coordination', $post->ID);
      $coordination_data = [];
      if ($coordinations) {
        foreach ($coordinations as $coordination) {
          $brands = get_the_terms($coordination, 'brand');
          $coordination_item = array(
            'id' => $coordination,
            'thumbnail' => get_the_post_thumbnail_url($coordination, 'full'),
            'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? $brands[0]->name : '',
            'price' => get_field('p-elementItem__price', $coordination),
            'link' => get_permalink($coordination),
            'likes_count' => get_field('likes_count', $post->ID),
          );
          array_push($coordination_data, $coordination_item);
        }
      } else {
        // $coordinationsが存在しない場合、$stylesと同じtermの記事を取得
        $added_ids = array();
        $styles = get_the_terms($post->ID, 'style');
        $class_terms = get_the_terms($post->ID, 'class');
        $class_slugs = array();
        if ($class_terms && !is_wp_error($class_terms)) {
          foreach ($class_terms as $class_term) {
            array_push($class_slugs, $class_term->slug);
          }
        }

        if ($styles && !is_wp_error($styles)) {
          foreach ($styles as $style) {
            $style_posts = get_posts(array(
              'post_type' => 'element',
              'post_status' => 'publish',
              'posts_per_page' => 10,
              'orderby' => 'rand',
              'post__not_in' => array($post->ID),
              'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy' => 'style',
                  'field' => 'slug',
                  'terms' => $style->slug,
                ),
                array(
                  'taxonomy' => 'class',
                  'field' => 'slug',
                  'terms' => $class_slugs,
                  'operator' => 'NOT IN',
                ),
              ),
            ));

            foreach ($style_posts as $style_post) {

              $price = get_field('p-elementItem__price', $style_post->ID);
              if(is_numeric($price)) {
                if ($price == 0) {
                  $price = "???";
                } else {
                  $price = number_format($price);
                }
              }

              if (!in_array($style_post->ID, $added_ids)) {
                $brands = get_the_terms($style_post, 'brand');
                $style_item = array(
                  'id' => $style_post->ID,
                  'thumbnail' => get_the_post_thumbnail_url($style_post->ID, 'full'),
                  'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? $brands[0]->name : '',
                  'price' => $price,
                  'link' => get_permalink($style_post->ID),
                  'likes_count' => get_field('likes_count', $style_post->ID),
                );
                array_push($coordination_data, $style_item);
                array_push($added_ids, $style_post->ID);
              }
            }
          }
        }
      }

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
            'slug' => $style->slug,
            'name' => $style->name,
          ];
        }
      }

      $price = get_field('p-elementItem__price');
      if(is_numeric($price)) {
        if ($price == 0) {
          $price = "???";
        } else {
          $price = number_format($price);
        }
      }

      $post_data[] = [
        'id' => $post->ID,
        'time' => get_the_time('Y.m.d'),
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'),
        'title' => $post->post_title,
        'excerpt' => get_the_excerpt(),
        'classes' => $classes_data,
        'style' => $styles_data,
        'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? html_entity_decode($brands[0]->name) : '',
        'price' => $price,
        'coordination_data' => $coordination_data,
        'size' => get_field('p-elementItem__size', $post->ID),
        'likes_count' => get_field('likes_count'),
        'link' => get_the_permalink()
      ];
    endwhile;
    wp_reset_postdata();
  endif;
  return $post_data;
?>