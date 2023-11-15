<div class="container py-5">
    <p class="pre-header"><?=$sub_title?></p>
    <h2><?=$title?></h2>

    <div class="row ">      
      <div class="col-md-4 my-4 my-md-0">
        <?php if (!empty($image->media)){?><img class="w-100 h-100 fit-cover" src="<?=$image->media->showThumb(['w'=>700])?>" alt=""><?php }?>
      </div>
      <div class="col-md-6  d-flex flex-column justify-content-end">
        <p><?=$description?></p>
        <?php if (!empty($image2->media)){?><img src="<?=$image2->media->showThumb(['w'=>1080])?>" alt=""><?php }?>
      </div>      
    </div>
</div>