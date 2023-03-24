<?php snippet('header') ?>

  <main class="main" role="main">
    <header class="wrap">
      <div class="intro text">
        <h1>
        <?= $page->title()->kirbytext() ?> </h1>

        <div class="desc">
          <?= $page->text()->kirbytext()?>

        </div>
      </div>
    </header>

  </main>

<?php snippet('footer') ?>