<?php
  $args_single = array(
    'posts_per_page' => 1,
    'post_type' => 'element',
    'post_status' => 'publish',
    'include' => urldecode($param['id'])
  );
  $single_post = get_posts($args_single);
  $targets = $single_post;
  $result = [];
  foreach($targets as $post):
    $brands = get_the_terms($post->ID, 'brand');

    $rooms = get_field('p-elementItem__room', $post->ID);
    $room_data = [];
    if ($rooms) {
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
        );
        array_push($coordination_data, $coordination_item);
      }
    } else {
      // $coordinationsが存在しない場合、$stylesと同じtermの記事を取得
      $added_ids = array();
      $styles = get_the_terms($post->ID, 'style');
      if ($styles && !is_wp_error($styles)) {
        foreach ($styles as $style) {
          $style_posts = get_posts(array(
            'post_type' => 'element',
            'post_status' => 'publish',
            'posts_per_page' => 20,
            'orderby' => 'rand',
            'tax_query' => array(
              array(
                'taxonomy' => 'style',
                'field' => 'slug',
                'terms' => $style->slug,
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
      'affiliate' => get_field('p-elementItem__affiliate', $post->ID),
      'category' => get_the_terms($post->ID, 'class')[0]->name,
      'room_data' => $room_data,
      'coordination_data' => $coordination_data,
      'relation_data' => $relation_data,
      'carousel_data' => $carousels,
    );
    array_push($result, $data);
  endforeach;

  return $result[0];
?>