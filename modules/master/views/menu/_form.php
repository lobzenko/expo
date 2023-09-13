<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
	<div class="card-body">
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

		<hr>
	       <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

	    <?php ActiveForm::end(); ?>
    </div>
</div>
