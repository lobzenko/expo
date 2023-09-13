<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Rub $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rub-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_rub' => $model->id_rub], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_rub' => $model->id_rub], [
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
            'id_rub',
            'name',
            'state',
        ],
    ]) ?>

</div>
