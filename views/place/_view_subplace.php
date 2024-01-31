<div class="col-md-4 mb-4">
  <a href="/place/modal/<?=$model->id_subplace?>" class="card place-modal">
    <div class="card-image">
        <img src="<?=$model->media->showThumb(['w'=>350,'h'=>400])?>" class="card-img-top" alt="">
        <span class="price"><?php if (!empty($model->price)){?><?=$model->price?>/<?=$model->price_type?><?php }else {?> по запросу<?php }?></span>
    </div>            
    <div class="card-body">
        <h5 class="card-title"><?=$model->name?></h5>
        <p class="card-text">Площадь: <?=$model->area?> кв.м.<br/>Посадочных мест: <?=$model->capacity?></p>
    </div>
  </a>
</div>