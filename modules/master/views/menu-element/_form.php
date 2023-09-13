<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuElement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
    <div class="card-body">
    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'ord')->textInput() ?>        

    <?= $form->field($model, 'active')->checkBox() ?>

    <hr>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
    </div>
</div>