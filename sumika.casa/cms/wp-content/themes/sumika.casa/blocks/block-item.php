<?php
  $image = block_value('image');
  $title = block_value('title');
  $detail = block_value('detail');
  $issue = block_value('issue');
  $page = block_value('page');
  $price = block_value('price');
  $link = block_value('link');
?>
<?php if($image || $title || $detail|| $issue || $page || $price || $link): ?>

<div class="p-editorItem">
  <?php if($link): ?>  
    <a class="p-editorItem__link" href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer">
      <?php if($image): ?>
      <span class="p-editorItem__image">
        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
      </span>
      <?php endif; ?>
      <?php if($title): ?>
      <span class="p-editorItem__title">
        <span><?php echo $title; ?></span>
      </span>
      <?php endif; ?>
      <?php if($detail): ?>
      <span class="p-editorItem__detail">
        <span><?php echo $detail; ?></span>
      </span>
      <?php endif; ?>
      <?php if($issue || $page): ?>
      <span class="p-editorItem__info">
        <?php if($issue): ?>
        <span class="p-editorItem__issue">
          <span><?php echo $issue; ?></span>
        </span>
        <?php endif; ?>
        <?php if($page): ?>
        <span class="p-editorItem__page">
          <span><?php echo $page; ?></span>
        </span>
        <?php endif; ?>
      </span>
      <?php endif; ?>
      <?php if($price): ?>
      <span class="p-editorItem__price">
        <span><?php echo $price; ?></span>
      </span>
      <?php endif; ?>
      <span class="p-editorItem__button">
        <span>詳細を見る</span>
      </span>
    </a>
  <?php endif; ?>
</div>
<?php endif; ?>
