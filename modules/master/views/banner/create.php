<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = 'Добавить баннер';
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
