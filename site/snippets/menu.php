<div id="myNav" class="overlay">

  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <img class="nav-image-top" src="<?php echo site()->image('menu_asset.png')->url() ?>">

   <img class="nav-image-bottom" src="<?php echo site()->image('menu_asset.png')->url() ?>">
  <div class="overlay-content">
    <?php foreach(page('home')->children() as $item): ?>
      <a href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
    <?php endforeach ?>
  </div>
</div>
