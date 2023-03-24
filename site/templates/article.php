<?php snippet('header') ?>

  <main class="main" role="main">
    <header class="wrap">
      <div class="intro text">
        <h1>
        <?= $page->title()->kirbytext() ?> </h1>

        <div class="desc">
          <?= $page->text()->kirbytext()?>

        </div>
        <div class="readmore pagination-item">
          <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
        </div>
        <div class="back pagination-item">
          <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
        </div>
      </div>
    <div class="img-wrap">
      <?php $num = 1; foreach($page->children()->visible() as $item): ?>
      <div id=<?php echo 'place'.$num ?> class="template">
        <?php if($item->object()->isNotEmpty()): ?>

         <?php echo $item->object()->toFile(); ?>

        <?php else: ?>
        <?php endif ?>

        <div class="desc_wrap">
          <h2 id="desc"> <?php echo $item->title()?></h2>
        </div>

      </div>
        <?php $num++ ?>
      <?php endforeach ?>
    </div>
 <?php snippet('prevnext') ?>
    </header>

  </main>

<?php snippet('footer') ?>