<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Subplace $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subplaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subplace-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_subplace' => $model->id_subplace], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_subplace' => $model->id_subplace], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_subplace',
            'id_place',
            'id_media',
            'name',
            'price',
            'price_type',
            'area',
            'capacity',
            'comment:ntext',
        ],
    ]) ?>

</div>
