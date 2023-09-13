<div class="col-md-4 mb-4">
  <a href="/place/<?=$model->id_place?>" class="card">
    <img src="<?=(!empty($model->media))?$model->media->showThumb(['w'=>'350']):''?>" class="card-img-top" alt="">
    <div class="card-body">
        <h5 class="card-title"><?=$model->name?></h5>
        <p class="card-text"><?=$model->address?></p>
    </div>
  </a>
</div>