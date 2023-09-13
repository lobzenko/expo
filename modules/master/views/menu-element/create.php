<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuElement */

$this->title = 'Добавить элемент';
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index','id'=>$model->id_menu]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-element-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
