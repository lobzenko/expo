<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vars */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vars-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['Редактировать', 'id' => $model->id_var], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['Удалить', 'id' => $model->id_var], [
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
            'id_var',
            'name',
            'alias',
            'content:ntext',
        ],
    ]) ?>

</div>
