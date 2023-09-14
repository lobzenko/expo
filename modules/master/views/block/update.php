<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Block */

$this->title = 'Редактировать блок: ' . $model->id_block;

if (!empty($model->id_place))
    $this->params['breadcrumbs'][] = ['label' => $model->page->name, 'url' => ['place/template','id' => $model->id_place]];
elseif (!empty($model->id_event))
    $this->params['breadcrumbs'][] = ['label' => $model->page->name, 'url' => ['event/template','id' => $model->id_event]];
else 
    $this->params['breadcrumbs'][] = ['label' => $model->page->title, 'url' => ['page/view','id' => $model->id_page??$model->id_page_layout]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="block-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>