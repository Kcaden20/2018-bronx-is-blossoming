<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">

  <?= css('assets/css/default.css') ?>
  <?= css('assets/plugins/embed/css/embed.css') ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <?= js('assets/plugins/embed/js/embed.js') ?>

  <style>
  <?php if($page->background()->isNotEmpty()): ?>
    body {
      background: url(
      <?php echo $page->background()->toFile()->url(); ?>
      );
      background-repeat: no-repeat;
      background-size: cover;
    }

    <?php else: ?>

  <?php endif ?>

    <?php if($page->isHomePage()): ?>
    #place2 {

     top: 40%;
    left: 8%;
             -webkit-transform: rotate(-20deg);
  -ms-transform: rotate(-20deg);
  transform: rotate(-20deg);

    }
      #place3 {
         top: 70%;
         left: 5%;
        right: inherit;
         -webkit-transform: rotate(-20deg);
  -ms-transform: rotate(-20deg);
  transform: rotate(-20deg);

    }
      #place4 {

            top: 80%;
  left: 40%;
      }

      #place5 {
    right: 5%;
    top: 70%;
      -webkit-transform: rotate(20deg);
  -ms-transform: rotate(20deg);
  transform: rotate(20deg);

      }
      #place7 {
              top: 10%;
              left: 81%;
               -webkit-transform: rotate(20deg);
  -ms-transform: rotate(20deg);
  transform: rotate(20deg);

      }
      #place1{
  top: 0%;
  left: 5%;
            -webkit-transform: rotate(-20deg);
  -ms-transform: rotate(-20deg);
  transform: rotate(-20deg);
      }

      #place1:hover, #place7:hover{
    -webkit-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  transform: rotate(0deg);
}
#place4:hover {
   -webkit-transform: rotate(0deg) !important;
  -ms-transform: rotate(0deg) !important;
  transform: rotate(0deg) !important;
}


      .template img {
        max-height: 200px;
        max-width: 200px;
      }

      #place6 {
                top: 40%;
        right: 6% !important;
        left:auto;
          -webkit-transform: rotate(20deg) !important;
  -ms-transform: rotate(20deg) !important;
  transform: rotate(20deg) !important;

      }

      #place6:hover {
           -webkit-transform: rotate(0deg) !important;
  -ms-transform: rotate(0deg) !important;
  transform: rotate(0deg) !important;

      }


       @media screen and (max-width: 600px) {
         #place7 {
           left: 12%;
         }

         #place4{
           left: 19%;
         }
       }

    <?php else: ?>
    <?php endif ?>
  </style>

</head>
<body>

  <header class="header wrap wide" role="banner">
      <!-- Button to close the overlay navigation -->
 <?php if($page->isHomePage()): ?>


      <?php else: ?>
      <div class="branding column">
        <a href="<?= url() ?>" rel="home"><h2><?= $site->title()->html() ?> </h2></a>
      </div>
      <?php endif ?>

    <div class="menu" onclick="openNav()">


	    <div class="one"></div>
      <div class="two"></div>
      <div class="three"></div>
		</div>

    <div class="grid">

      <?php snippet('menu') ?>

    </div>
  </header>
