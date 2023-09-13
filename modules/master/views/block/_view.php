<?php use yii\helpers\Html;?>
<div class="card block" data-id="<?=$data->id_block?>">
    <input type="hidden" name="ord[<?=$data->id_block?>]" value="<?=$data->ord?>"/>
	<div class="card-header d-flex justify-content-between">
        <h5>
            <?=$data->type?>                
        </h5>
        <div class="ibox-tools">
            <!--a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a-->
            <a href="/master/block/update?id=<?=$data->id_block?>">
                <i class="fa fa-wrench"></i>
            </a>

            <?= Html::a('<i class="btn btn-sm fa fa-times"></i>', ['block/delete', 'id' => $data->id_block], [
                'class' => 'close-link',
                'data' => [
                    'confirm' => 'Вы уверены?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
	<div class="card-body text-center">
		<?=$data->getName()?>
	</div>
</div>