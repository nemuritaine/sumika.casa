<?php
  $args_single = array(
    'posts_per_page' => 1,
    'post_type' => 'element',
    'post_status' => 'publish',
    'include' => urldecode($param['id'])
  );
  $single_post = get_posts($args_single);
  $targets = $single_post;
  $room_presence;
  $result = [];
  foreach($targets as $post):
    $brands = get_the_terms($post->ID, 'brand');
    $styles = get_the_terms($post->ID, 'style');

    $rooms = get_field('p-elementItem__room', $post->ID);
    $room_data = [];
    if ($rooms) {
      $room_presence = true;
      foreach ($rooms as $room) {
        $room_item = array(
          'id' => $room,
          'title' => get_the_title($room),
          'tags' => get_the_terms($room, 'post_tag'),
          'thumbnail' => get_the_post_thumbnail_url($room, 'full'),
          // 'custom_field' => get_field('カスタムフィールドのキー', $room),
          'link' => get_permalink($room),
        );
        array_push($room_data, $room_item);
      }
    } else {
      // $roomsが存在しない場合、カテゴリーinteriorの記事を取得
      $room_presence = false;
      $styles = get_the_terms($post->ID, 'style');
      $style_slugs = array();
      if ($styles && !is_wp_error($styles)) {
        foreach ($styles as $style) {
          array_push($style_slugs, $style->slug);
        }
      }
      $added_ids = array();
      $room_posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'post__not_in' => array('1597', '260', '249', '44', '238', '66', '131', '63'),
        'tax_query' => array(
          'relation'  => 'AND',
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'interior',
            'operator' => 'AND',
          ),
          array(
            'taxonomy' => 'post_tag',
            'field' => 'slug',
            'terms' => $style_slugs,
            'operator' => 'IN',
          ),
        ),
      ));
      foreach ($room_posts as $room_post) {

        if (!in_array($room_post->ID, $added_ids)) {
          $room_item = array(
            'id' => $room_post->ID,
            'title' => get_the_title($room_post->ID),
            'tags' => get_the_terms($room_post->ID, 'post_tag'),
            'thumbnail' => get_the_post_thumbnail_url($room_post->ID, 'full'),
            'link' => get_permalink($room_post->ID),
          );
          array_push($room_data, $room_item);
          array_push($added_ids, $room_post->ID);
        }
      }
    }

    $taxonomies = get_terms(array(
      'taxonomy' => 'class',
      'hide_empty' => true, // 記事のないtermを除外
    ));
    $valid_terms = array();
    foreach ($taxonomies as $term) {
      $count = $term->count;
      if ($count >= 5) { // 5つ以上の記事があるtermだけを保存
        array_push($valid_terms, $term);
      }
    }
    shuffle($valid_terms); // 配列をシャッフルする
    $valid_terms = array_slice($valid_terms, 0, 3); // ランダムに3つのtermを取得する

    $carousels = [];
    foreach ($valid_terms as $taxonomy) {
      $carousel_posts = get_posts(array(
        'post_type' => 'element',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'tax_query' => array(
          array(
            'taxonomy' => 'class',
            'field' => 'slug',
            'terms' => $taxonomy->slug,
          ),
        ),
      ));

      $carousel_data = [];

      foreach ($carousel_posts as $carousel_post) {
        $carousel_item = array(
          'ID' => $carousel_post->ID,
          'thumbnail' => get_the_post_thumbnail_url($carousel_post->ID, 'full'),
          'slug' => $carousel_post->post_name,
          'taxonomy_slug' => $taxonomy->slug,
        );
        array_push($carousel_data, $carousel_item);
      }

      array_push($carousels, array(
        'taxonomy_slug' => $taxonomy->slug,
        'posts' => $carousel_data,
      ));
    }

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
            'posts_per_page' => 20,
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
              $price = number_format($price);
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

    $relations = get_field('p-elementItem__relation', $post->ID);
    $relation_data = [];
    if (is_array($relations) && $relations) {
      foreach ($relations as $relation) {
        $brands = get_the_terms($relation, 'brand');
        $relation_item = array(
          'id' => $relation,
          'thumbnail' => get_the_post_thumbnail_url($relation, 'full'),
          'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? $brands[0]->name : '',
          'price' => get_field('p-elementItem__price', $relation),
          'link' => get_permalink($relation),
          'likes_count' => get_field('likes_count', $post->ID),
        );
        array_push($relation_data, $relation_item);
      }
    } else {
      // $relationsが存在しない場合、$brandsと同じtermの記事を取得
      $brands = get_the_terms($post->ID, 'brand');
      if ($brands && !is_wp_error($brands)) {
        foreach ($brands as $brand) {
          $related_posts = get_posts(array(
            'post_type' => 'element',
            'post_status' => 'publish',
            'posts_per_page' => 20,
            'orderby' => 'rand',
            'post__not_in' => array($post->ID),
            'tax_query' => array(
              array(
                'taxonomy' => 'brand',
                'field' => 'slug',
                'terms' => $brand->slug,
              ),
            ),
          ));

          foreach ($related_posts as $related_post) {

            $price = get_field('p-elementItem__price', $related_post->ID);
            if(is_numeric($price)) {
              $price = number_format($price);
            }

            $relation_item = array(
              'id' => $related_post->ID,
              'thumbnail' => get_the_post_thumbnail_url($related_post->ID, 'full'),
              'brand' => $brand->name,
              'price' => $price,
              'link' => get_permalink($related_post->ID),
              'likes_count' => get_field('likes_count', $related_post->ID),
            );
            array_push($relation_data, $relation_item);
          }
        }
      }
    }

    $price = get_field('p-elementItem__price', $post->ID);
    if(is_numeric($price)) {
      $price = number_format($price);
    }

    $data = array(
      'ID' => $post->ID,
      'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
      'slug' => $post->post_name,
      'modified' => $post->post_modified,
      'title' => $post->post_title,
      'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? $brands[0]->name : '',
      'price' => $price,
      'size' => get_field('p-elementItem__size', $post->ID),
      'affiliate' => get_field('p-elementItem__affiliate', $post->ID),
      'store' => get_field('p-elementItem__store', $post->ID),
      'category' => get_the_terms($post->ID, 'class')[0]->name,
      'room_presence' => $room_presence,
      'room_data' => $room_data,
      'coordination_data' => $coordination_data,
      'relation_data' => $relation_data,
      'carousel_data' => $carousels,
      'likes_count' => get_field('likes_count', $post->ID),
      'style_name' => $styles && !is_wp_error($styles) && isset($styles[0]) ? $styles[0]->name : '',
      'style_slug' => $styles && !is_wp_error($styles) && isset($styles[0]) ? $styles[0]->slug : '',
    );
    array_push($result, $data);
  endforeach;

  return $result[0];
?>