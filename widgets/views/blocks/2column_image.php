<div class="container my-4">
  <div class="row mb-lg-4 mb-5">
      <div class="col-md-6 <?=$align=='left'?'order-0':'order-0 order-md-1'?>">
          <?php if (!empty($image->media)){?><img class="mb-4 mb-md-0" src="<?=$image->media->showThumb(['w'=>730])?>" alt="" /><?php }?>
      </div>
      <div class="col-md-6 d-flex flex-column justify-content-end fs-15 <?=$align=='left'?'order-1 order-md-1':'order-1 order-md-0'?>">
        <?=$content?>
      </div>
  </div>
</div>