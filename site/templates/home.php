<?php snippet('header') ?>

  <main class="main" role="main">
    <header class="wrap">
      <div class="intro text">
        <h1>
        <?= $page->title()->kirbytext() ?> </h1>
        <?= $page->intro()->kirbytext() ?>
      </div>
    <div class="img-wrap">
      <?php $num = 1; foreach($page->children()->visible() as $item): ?>
      <div id=<?php echo 'place'.$num ?> class="template">
        <div class="number"> <?php echo $num ?></div>
         <a href=<?php echo $item ?>>
        <?php if($item->object()->isNotEmpty()): ?>

         <?php echo $item->object()->toFile(); ?>

        <?php else: ?>
        <?php endif ?>

        <div class="desc_wrap">
          <h2 id="desc"> <?php echo $item->title()?></h2>
        </div>
          </a>
      </div>
        <?php $num++ ?>
      <?php endforeach ?>
    </div>

    </header>

  </main>

<?php snippet('footer') ?>