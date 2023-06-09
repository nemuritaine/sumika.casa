<?php
  $title = block_value('title');
  $link = block_value('link');
  $positionY = block_value('up-and-down');
  $positionX = block_value('position');
  $top = block_value('top');
  $left = block_value('left');
?>
<?php if($title || $link || $top || $left): ?>
<?php if($link): ?>
<div class="p-editorRoomtour__pin"
  style="
    <?php if($top): ?>top: <?php echo $top; ?>%;<?php endif; ?>
    <?php if($left): ?>left: <?php echo $left; ?>%;<?php endif; ?>
  ">
  <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="p-editorRoomtourPin">
    <span></span>
    <span></span>
  </a>
</div>
<div
  class="p-editorRoomtour__item --<?php if($positionX): ?><?php echo $positionX; ?><?php endif; ?> --<?php if($positionY): ?><?php echo $positionY; ?><?php endif; ?>"
  style="
    <?php if($top): ?>top: <?php echo $top; ?>%;<?php endif; ?>
    <?php if($left): ?>left: <?php echo $left; ?>%;<?php endif; ?>
  "
>
  <span class="p-editorRoomtour__pointer">
    <span></span>
  </span>
  <?php if($title): ?>
    <span class="p-editorRoomtour__title">
      <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer"><?php echo $title; ?></a>
    </span>
  <?php endif; ?>
</div>
<?php endif; ?>
<?php endif; ?>