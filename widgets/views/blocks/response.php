<?php 
    $records = \app\models\Response::find()->where(['state'=>1])->limit($limit??10)->all();
?>
<div class="container py-5">
    <p class="pre-header"><?=$sub_title?></p>
    <h2 class="mb-5"><?=$title?></h2>

    <div id="responses" class="carousel mt-5 same-height">
      <div class="swiper">
        <div class="swiper-wrapper">            
          <?php foreach ($records as $data){?>
          <div class="swiper-slide">
            <div class="card d-flex flex-column justify-content-center">
              <div class="card-body fs-18">
                  <div class="text-justify"><?=$data->content?></div>
                  <p class="text-right mt-4">
                    <b>– <?=$data->author?></b>
                  </p>
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
</div>