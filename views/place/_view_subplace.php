<div class="col-md-4 mb-4">
  <a href="/place/modal/<?=$model->id_subplace?>" class="card place-modal">
    <div class="card-image">
        <img src="<?=$model->media->showThumb(['w'=>350])?>" class="card-img-top" alt="">
        <span class="price"><?=$model->price?>/<?=$model->price_type?></span>
    </div>            
    <div class="card-body">
        <h5 class="card-title"><?=$model->name?></h5>
        <p class="card-text">Площадь: <?=$model->area?> кв.м.<br/>Посадочных мест: <?=$model->capacity?></p>
    </div>
  </a>
</div>