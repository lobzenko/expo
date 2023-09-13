<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vars */

$this->title = 'Редактировать переменную: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Переменные', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>