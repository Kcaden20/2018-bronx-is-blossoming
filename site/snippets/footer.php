  <footer class="footer cf" role="contentinfo">
    <div class="wrap wide">

      <p class="footer-copyright"><?php
        // Parse Kirbytext to support dynamic year,
        // but remove all HTML like paragraph tags:
        echo html::decode($site->copyright()->kirbytext())
      ?></p>


    </div>
  </footer>
<script>

  <?php if($page->isHomePage()): ?>

<?php else: ?>
  $('.readmore').hide();
  $('.back').hide();
  $('.desc').hide();
  if(!$('.desc:empty').length) {
    $('.desc').show();
  } else {

  }
  <?php
      $num = 1;
    foreach($page->children()->visible() as $link):?>
    $(<?php echo '"#place'.$num.'"' ?>).click(function(){
      $('.desc').html(<?php echo "'".$link->text()->kirbytext()."'" ?>);
      $('.back').hide();
      window.scrollTo(0, 0);


       if(!$('.desc:empty').length) {
      <?php if($link->text2()->isNotEmpty()):?>
        $('.readmore').show();
        $('.readmore').click(function(){
           $('.desc').html(<?php echo "'".$link->text2()->kirbytext()."'" ?>);
           $('.readmore').hide();
           $('.back').show();
           $('.back').click(function(){
              $('.desc').html(<?php echo "'".$link->text()->kirbytext()."'" ?>);
              $('.back').hide();
              $('.readmore').show();
           });
        });


      <?php else: ?>
        $('.readmore').hide();
      <?php endif ?>
    }
    });



    <?php $num++ ?>
  <?php endforeach ?>
<?php endif ?>

function openNav() {
  document.getElementById("myNav").style.display = "block";
}

function closeNav() {
  document.getElementById("myNav").style.display = "none";
}

/*
$('.template').hover(
  function(){
    $('#title').css('display', 'block');
  }
)
*/
</script>
</body>
</html>