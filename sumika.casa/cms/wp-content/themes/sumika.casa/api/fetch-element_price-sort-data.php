<?php
  $min_price = $param['min_price'];
  $max_price = $param['max_price'];
  $post_data = [];

  $post_args = [
    'post_type' => 'element',
    'posts_per_page' => $param['per_page'] ?: 20,
    'post_status' => 'publish',
    'paged' => $param['page'] ?: 1,
    'meta_query' => array(
      array(
        'key' => 'p-elementItem__price',
        'value' => array($min_price, $max_price),
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC',
      )
    )
  ];

  $post_query = new WP_Query($post_args);
  if ($post_query->have_posts()):
    while ($post_query->have_posts()):
      $post_query->the_post();
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
        'image_src' => get_the_post_thumbnail_url($post->ID, 'full'),
        'brand' => $brands && !is_wp_error($brands) && isset($brands[0]) ? html_entity_decode($brands[0]->name) : '',
        'price' => $price,
        'likes_count' => get_field('likes_count'),
        'link' => get_the_permalink()
      ];
    endwhile;
    wp_reset_postdata();
  endif;

  return $post_data;
?>