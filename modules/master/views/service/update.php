<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Service $model */

$this->title = 'Редактировать услугу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_service' => $model->id_service]];
?>
<div class="service-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
