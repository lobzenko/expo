<div class="container">
  <p class="pre-header"><?=$sub_title?></p>
  <?php if (empty((string)$h) || $h!='h1'){?>
  <h2 class="mb-5"><?=$title?></h2>     
  <?php }else {?>
  <h1 class="mb-5"><?=$title?></h1>
  <?php }?>
</div>