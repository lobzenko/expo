<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Place $model */

$this->title = 'Редактировать площадку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_place]];
?>
<div class="place-update">    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
