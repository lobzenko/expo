<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Place $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
