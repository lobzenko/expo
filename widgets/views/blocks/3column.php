<div class="container py-5">
    <p class="pre-header"><?=$sub_title?></p>
    <h2><?=$title?></h2>

    <div class="row ">
      <div class="col-md-2 d-flex flex-column justify-content-end order-3 order-md-0">
          <?php if (!empty((string)$link)){?>
          <a class="arrow" href="<?=$link?>"><?=$link_title?></a>
          <?php }?>
      </div>
      <div class="col-md-6  d-flex flex-column justify-content-end">
        <p><?=$description?></p>
        <?php if (!empty($image->media)){?><img src="<?=$image->media->showThumb(['w'=>540])?>" alt=""><?php }?>
      </div>
      <div class="col-md-4 my-4 my-md-0">
        <?php if (!empty($image2->media)){?><img class="w-100 h-100 fit-cover" src="<?=$image2->media->showThumb(['w'=>350])?>" alt=""><?php }?>
      </div>
    </div>
</div>