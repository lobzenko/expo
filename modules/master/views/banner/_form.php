<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ibox">
	<div class="ibox-content">
	    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'place')->dropDownlist($model->places) ?>

        <?= $form->field($model, 'ord')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>

	    <?= $form->field($model, 'show')->dropDownlist([0=>'Нет',1=>'Да']) ?>

	    <h4>Изображение</h4>
        <?= app\extensions\multifile\MultiFileWidget::widget([
            'model'=>$model,
            'single'=>true,
            'relation'=>'media',
            //'records'=>[$value_model->media],
            'extensions'=>['jpg','jpeg','gif','png'],
            'grouptype'=>1,
            'showPreview'=>true
        ]);?>

	    <hr>
	    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

	    <?php ActiveForm::end(); ?>
    </div>
</div>
