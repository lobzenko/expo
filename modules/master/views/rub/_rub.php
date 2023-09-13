<?php 
    use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-<?=12-$level?> col-md-offset-<?=$level?>">
        <div class="ibox">
            <div class="ibox-content">
                <?= Html::a($model->name, ['update', 'id' => $model->idr])?>        
            </div>
        </div>
    </div>
</div>
<?php 
    foreach ($model->children()->all() as $child)
    {
        echo $this->render('_rub',['model'=>$child,'level'=>$level+1]);
    }
?>