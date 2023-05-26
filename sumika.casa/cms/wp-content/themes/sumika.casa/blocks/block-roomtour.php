<?php
  $image = block_value('image');
  $item = block_value('item');
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
<?php endif; ?>
<?php endif; ?>