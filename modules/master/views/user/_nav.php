<?php
    use yii\helpers\Html;

    $this->params['button-block'] = Html::a(Yii::t('app', 'Edit'), ['user/update', 'id' => $model->id_user], ['class' => 'btn btn-primary']).' '.Html::a(Yii::t('app', 'Delete'), ['user/delete', 'id' => $model->id_user], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);
?>

<ul class="nav nav-pills nav-list-topbar">
    <li class="<?=empty(Yii::$app->request->get('type'))?'active':''?>">
        <?=Html::a("View", ['view','id'=>$model->id_user])?>
    </li>
    <li class="">
        <?=Html::a("Balance", ['balance','id'=>$model->id_user])?>
    </li>
    <li class="">
        <?=Html::a("Photos: ".$model->getPictures()->count(), ['pictures','id'=>$model->id_user])?>
    </li>
    <li class="">
        <?=Html::a("Albums: ".$model->getAlbums()->count(), ['album/user','id'=>$model->id_user])?>
    </li>
    <li class="">
        <?=Html::a("Comments: ".$model->getComments()->count(), ['comment/index','id_user'=>$model->id_user])?>
    </li>
    <li class="">
        <?=Html::a("Messages", ['album','id'=>$model->id_user])?>
    </li>
</ul>