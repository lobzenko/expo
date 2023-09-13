<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Event $model */

$this->title = 'Редактировать событие: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_event' => $model->id_event]];
?>
<div class="event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
