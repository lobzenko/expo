<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Personal $model */

$this->title = 'Редактировать сотрудника: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_personal' => $model->id_personal]];

?>
<div class="personal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
