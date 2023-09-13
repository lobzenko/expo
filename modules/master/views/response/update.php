<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Response $model */

$this->title = 'Редактировать отзыв: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="response-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
