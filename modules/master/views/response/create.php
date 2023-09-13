<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Response $model */

$this->title = 'Добавить отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
