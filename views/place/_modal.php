<div class="row">
    <div class="col-lg-7 pe-0">
        <div id="modal-swiper" class="swiper">                        
          <div class="swiper-wrapper">
            <?php foreach ($model->medias as $media){?>
            <div class="swiper-slide"><img src="<?=$media->showThumb(['w'=>800,'h'=>800])?>"></div>
            <?php }?>
          </div>                        
          <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="col-lg-5 ps-0 d-flex flex-column justify-content-center">
        <div class="p-4">
          <h2 class=""><?=$model->name?></h2>
          <p class="my-4"><?=$model->place->address?></p>
          <p class="mb-4">Площадь: <?=$model->area?> кв.м.<br/>
              Посадочных мест: <?=$model->capacity?><br/>
              <?=nl2br($model->comment)?></p>
          <a class="btn btn-primary btn-lg add-to-cart" data-id="<?=$model->id_subplace?>" href="/cart/<?=$model->id_subplace?>">Отправить заявку</a>
        </div>
    </div>
</div>