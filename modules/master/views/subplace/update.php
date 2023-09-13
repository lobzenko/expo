<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Subplace $model */

$this->title = 'Редактировать локацию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->place->name, 'url' => ['place/view', 'id' => $model->id_place]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subplace-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
