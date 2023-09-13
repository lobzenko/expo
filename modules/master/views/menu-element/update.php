<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuElement */

$this->title = 'Редактировать: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_element]];
?>
<div class="menu-element-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
