<?php 
    $records = \app\models\Personal::find()->where(['state'=>1])->limit($limit??100)->all();
?>
<div class="container py-5">
    <p class="pre-header"><?=$sub_title?></p>
    <h2 class="mb-5"><?=$title?></h2>
    <div class="row">
    <?php foreach ($records as $data){?>
      <div class="col-lg-4 col-md-6">
      <div class="card">
        <?php if (!empty($data->media)){?>
        <img src="<?=$data->media->showThumb(['w'=>350])?>" class="card-img-top" alt="">
        <?php }?>
        <div class="card-body">
            <h5 class="card-title"><?=$data->name?></h5>            
            <p class="card-text">
              <?=$data->description?><br/>
              <a href='mailto:<?=$data->email?>'><?=$data->email?></a>
            </p>
        </div>
      </div>
      </div>
    <?php }?>
    </div>
</div>