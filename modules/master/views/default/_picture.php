<?php
	use yii\helpers\Html;
?>
<div id="picture<?=$data->id_picture?>" class="ibox grid-item">
    <div class="ibox-title">
        <a href="/master/user/view?id=<?=$data->id_user?>">
    	<img class="img-sm img-circle" src="<?=$data->user->makeThumb(['w'=>50,'h'=>50])?>"/>
        <?=$data->user->name?></a>
        <small class="pull-right text-muted">
              <?=date('d.m.Y H:i',$data->date_create)?>
        </small>
    </div>
    <a href="/master/picture/view?id=<?=$data->id_picture?>"><img class="main-img" src="<?=$data->makeThumb(['w'=>300])?>"></a>
    <div class="ibox-footer">
        <p><?=Html::encode($data->description)?></p>

		<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> <?=$data->getComments()->count()?></button>
        <?php if (empty($data->id_log_moderation)){?>
		<center>
	        <a data-id="<?=$data->id_picture?>" href="/master/picture/aprove?id=<?=$data->id_picture?>" class="btn btn-primary moderate_aprove" type="button"><i class="fa fa-check"></i>&nbsp;Check</a>
	        <button data-id="<?=$data->id_picture?>" class="btn btn-danger abuse-button" data-placement="bottom"><i class="fa fa-times"></i>&nbsp;Decline</button>
        </center>
        <?php }?>
    </div>
</div>