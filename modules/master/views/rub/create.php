<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rub $model */

$this->title = 'Добавить тип';
$this->params['breadcrumbs'][] = ['label' => 'Типы площадок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rub-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
