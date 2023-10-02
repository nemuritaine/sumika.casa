<?php
  $image = block_value('image');
  $item = block_value('item');
  $item_id = block_value('item_id');
?>
<?php if($image || $item): ?>
  <?php if($image): ?>
    <div class="p-editorRoomtour">
      <div class="p-editorRoomtour__guidance">
        <div class="p-editorRoomtourGuidance">
          <div class="p-editorRoomtourGuidance__icon">
            <svg>
              <use xlink:href="/assets/images/common/graphics.svg#ico_search"></use>
            </svg>
          </div>
          <div class="p-editorRoomtourGuidance__text">アイテムを見る</div>
        </div>
      </div>
      <figure class="p-editorRoomtour__image">
        <img src="<?php echo $image; ?>" alt="" width="" height="">
        <figcaption class="p-editorRoomtour__wrapper">
          <?php if($item): ?><?php echo $item; ?><?php endif; ?>
        </figcaption>
      </figure>
    </div>
    <?php
      $item_ids_array = explode(',', str_replace(' ', '', $item_id));
      $post_args = array(
        'post_type' => 'element',
        'post__in' => $item_ids_array,
        'orderby' => 'post__in',
        'posts_per_page' => -1
      );
      $post_query = new WP_Query($post_args);
      if ($post_query->have_posts()):
    ?>
    <div class="p-editorCard">
      <ul class="p-editorCard__item">
        <?php
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
        ?>
        <li class="p-editorCardItem">
          <a href="/element/<?php echo $post->ID; ?>" class="p-editorCardItem__link">
            <span class="p-editorCardItem__detail">
              <span class="p-editorCardItem__title"><?php echo $brands && !is_wp_error($brands) && isset($brands[0]) ? html_entity_decode($brands[0]->name) : ''; ?></span>
              <span class="p-editorCardItem__price"><?php echo $price; ?></span>
            </span>
            <span class="p-editorCardItem__image">
              <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="" width="" height="">
            </span>
          </a>
          <span class="p-editorCardItem__like">
            <button class="p-editorCardItemLike">
              <span class="p-editorCardItemLike__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                  <path d="m45.03,7.81c-2.62-2.62-6.1-4.09-9.78-4.09s-7.16,1.43-9.78,4.05l-.45.45-.45-.45c-2.62-2.62-6.1-4.05-9.78-4.05s-7.12,1.43-9.74,4.05c-2.62,2.62-4.05,6.1-4.05,9.78s1.43,7.16,4.05,9.78l18.25,18.25c.45.45,1.06.7,1.72.7s1.27-.25,1.72-.7l18.21-18.21c2.62-2.62,4.05-6.1,4.05-9.78s-1.43-7.16-4.05-9.78h.08Z"/>
                  <path d="m45.03,7.81c-2.62-2.62-6.1-4.09-9.78-4.09s-7.16,1.43-9.78,4.05l-.45.45-.45-.45c-2.62-2.62-6.1-4.05-9.78-4.05s-7.12,1.43-9.74,4.05c-2.62,2.62-4.05,6.1-4.05,9.78s1.43,7.16,4.05,9.78l18.25,18.25c.45.45,1.06.7,1.72.7s1.27-.25,1.72-.7l18.21-18.21c2.62-2.62,4.05-6.1,4.05-9.78s-1.43-7.16-4.05-9.78h.08Zm-18.29,5.69l2.25-2.25c1.68-1.68,3.93-2.62,6.3-2.62s4.62.94,6.3,2.62c1.68,1.68,2.62,3.93,2.62,6.3s-.94,4.62-2.62,6.3l-16.49,16.49L8.53,23.81c-1.68-1.68-2.62-3.93-2.62-6.3s.94-4.62,2.58-6.3c1.68-1.68,3.93-2.62,6.3-2.62s4.62.94,6.3,2.62l2.21,2.21c.94.9,2.46.94,3.44.04v.04Z"/>
                </svg>
              </span>
              <span class="p-editorCardItemLike__text"><?php echo get_field('likes_count'); ?></span>
            </button>
          </span>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
      </ul>
    </div>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>