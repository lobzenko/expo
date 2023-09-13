<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Response $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'redactor']) ?>

        <?= $form->field($model, 'state')->dropDownList($model->getStates()) ?>        

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
