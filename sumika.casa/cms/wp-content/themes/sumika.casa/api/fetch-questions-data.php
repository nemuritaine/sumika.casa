<?php

  $post_data = [];
  $random_elements = [];
  $excluded_posts = [];
  $post_args = [
    'post_type' => 'element',
    'post_status' => 'publish',
  ];

  // idパラメータがある場合
  if (!empty($param['id'])) {
    $post_args['post__in'] = $param['id'];
    $post_args['orderby'] = 'post__in'; 
    $post_args['posts_per_page'] = count($param['id']);

    $post_query = new WP_Query($post_args);
    while ($post_query->have_posts()): $post_query->the_post();
      global $post;

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
  
      $post_data[] = [
        'id' => $post->ID,
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'),
        'style' => $styles_data,
        'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? html_entity_decode($brands[0]->name) : '',
        'likes_count' => get_field('likes_count'),
        'link' => get_the_permalink()
      ];

    endwhile;
    wp_reset_postdata();

  } else {
    
    // orderパラメータがある場合
    if (!empty($param['order'])) {
      $post_args['orderby'] = $param['order'];
    }
    $post_args['posts_per_page'] = 1;
    $tags = get_terms([
      'taxonomy' => 'style',
      'hide_empty' => false,
    ]);

    foreach ($tags as $tag) {
      $post_args['tax_query'] = [];
      $post_args['tax_query'][] = [
        'taxonomy' => 'style',
        'field' => 'id',
        'terms' => $tag->term_id,
      ];
      $post_args['post__not_in'] = $excluded_posts; 
  
      $random_element = new WP_Query($post_args);
  
      if ($random_element->have_posts()) {
        $random_elements[] = $random_element->posts[0];
        $excluded_posts[] = $random_element->posts[0]->ID;
      }
    }
  
    shuffle($random_elements);
    $random_elements = array_slice($random_elements, 0, 10); // 最終的に10件に収める
  
    // $random_elementsの各ポストに対してループ
    foreach ($random_elements as $post) {
      setup_postdata($post);

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

      $price = get_field('p-elementItem__price', $post->ID);
      if(is_numeric($price)) {
        if ($price == 0) {
          $price = "???";
        } else {
          $price = number_format($price);
        }
      }
  
      $post_data[] = [
        'id' => $post->ID,
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'),
        'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? html_entity_decode($brands[0]->name) : '',
        'title' => $post->post_title,
        'price' => $price,
        'size' => get_field('p-elementItem__size', $post->ID),
        'style' => $styles_data,
        'coordination_data' => $coordination_data,
        'likes_count' => get_field('likes_count', $post->ID),
        'affiliate' => get_field('p-elementItem__affiliate', $post->ID),
        'link' => get_the_permalink()
      ];
    }

    wp_reset_postdata();
  }

  return $post_data;
?>