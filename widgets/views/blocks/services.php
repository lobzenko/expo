<?php 
  if (!empty($services->value))
  {
      $ids = json_decode($services->value,true);
      $records = \app\models\Service::find()->where(['state'=>1,'id_service'=>$ids])->limit($limit??100)->all();
  }
  else 
      $records = \app\models\Service::find()->where(['state'=>1])->limit($limit??100)->all();
?>
<div class="container-cover" style="<?=(!empty($background)?'background-color:'.$background.';':'')?> <?=(!empty($color)?'color:'.$color.';':'')?> <?=(!empty($background_image->media)?'background-image:url('.$background_image->media->showThumb(['w'=>1920]).');':'')?>">
  <div class="container py-5">
    <p class="pre-header"><?=$sub_title?></p>
    <h2 class="mb-5"><?=$title?></h2>

    <?php if ($template!='table'){?>
    <div id="services" class="carousel carousel-cascade mt-5 mb-md-4 mb-5">
      <div class="swiper">
        <div class="swiper-wrapper">            
          <?php foreach ($records as $data){?>
          <div class="swiper-slide">
            <div class="card">
              <?php if (!empty($data->media)){?>
              <img src="<?=$data->media->showThumb(['w'=>350])?>" class="card-img-top" alt="">
              <?php }?>
              <div class="card-body">
                  <h5 class="card-title"><?=$data->name?></h5>            
                  <p class="card-text"><?=$data->description?></p>
              </div>
            </div>
          </div>
          <?php }?>
        </div>            
      </div>
      <div class="swiper-pagination d-lg-none"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
    
    <a class="arrow" href="/services">ВСЕ УСЛУГИ</a>

    <?php }else {?>
      <div class="row">
      <?php foreach ($records as $data){?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
              <?php if (!empty($data->media)){?>
              <img src="<?=$data->media->showThumb(['w'=>350])?>" class="card-img-top" alt="">
              <?php }?>
              <div class="card-body">
                  <h5 class="card-title"><?=$data->name?></h5>            
                  <p class="card-text"><?=$data->description?></p>
              </div>
            </div>
          </div>
      <?php }?>
      </div>
    <?php }?>
  </div>    
</div>