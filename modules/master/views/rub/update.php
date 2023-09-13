<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rub $model */

$this->title = 'Редактировать тип: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_rub' => $model->id_rub]];

?>
<div class="rub-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
