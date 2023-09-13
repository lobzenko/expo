<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Subplace $model */

$this->title = 'Добавить локацию';
$this->params['breadcrumbs'][] = ['label' => 'Места', 'url' => ['place/index']];
$this->params['breadcrumbs'][] = ['label' => $model->place->name, 'url' => ['place/view','id'=>$model->id_place]];
?>
<div class="subplace-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
