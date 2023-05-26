<?php
  $name = block_value('name');
  $job = block_value('job');
  $house = block_value('house');
  $floor = block_value('floor');
  $favoriteItems = block_value('favoriteItems');
  $obsession = block_value('obsession');
  $style = block_value('style');
  $rent = block_value('rent');
  $comment = block_value('comment');
  $url = block_value('url');
  $linkTitle = block_value('linkTitle');
  $linkText = block_value('linkText');
?>
<?php if($name || $job || $house || $floor || $favoriteItems || $obsession || $style || $comment || $rent || $url || $linkTitle || $linkText): ?>
<div class="p-editorProfile">
  <div class="p-editorProfile__heading">
    <p>Profile</p>
  </div>
  <div class="p-editorProfile__wrapper">
    <?php if($name): ?>
      <div class="p-editorProfile__name">
        <p><?php echo $name; ?></p>
      </div>
    <?php endif; ?>
    <div class="p-editorProfile__detail">
      <dl>
        <?php if($job): ?>
          <dt>職業</dt>
          <dd><?php echo $job; ?></dd>
        <?php endif; ?>
        <?php if($house): ?>
          <dt>暮らし方</dt>
          <dd>
            <h2><?php echo $house; ?></h2>
          </dd>
        <?php endif; ?>
        <?php if($floor): ?>
          <dt>間取り</dt>
          <dd>
            <h2><?php echo $floor; ?></h2>
          </dd>
        <?php endif; ?>
        <?php if($style): ?>
          <dt>スタイル</dt>
          <dd>
            <h2><?php echo $style; ?></h2>
          </dd>
        <?php endif; ?>
        <?php if($obsession): ?>
          <dt>こだわり</dt>
          <dd><?php echo $obsession; ?></dd>
        <?php endif; ?>
        <?php if($rent): ?>
          <dt>家賃</dt>
          <dd><?php echo $rent; ?></dd>
        <?php endif; ?>
        <?php if($favoriteItems): ?>
          <dt>お気に入りのアイテム</dt>
          <dd><?php echo $favoriteItems; ?></dd>
        <?php endif; ?>
        <?php if($comment): ?>
          <dt>コメント</dt>
          <dd><?php echo $comment; ?></dd>
        <?php endif; ?>
        <?php if($linkTitle && $linkText && $url): ?>
          <dt><?php echo $linkTitle; ?></dt>
          <dd>
            <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $linkText; ?></a>
          </dd>
        <?php endif; ?>
      </dl>
    </div>
  </div>
</div>
<?php endif; ?>