<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Service $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <div class="card-body">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList($model->getStates()) ?>        

    <?= app\extensions\multifile\MultiFileWidget::widget([
        'model'=>$model,
        'single'=>true,
        'relation'=>'media',
        'extensions'=>['jpg','jpeg','gif','png'],
        'grouptype'=>1,
        'showPreview'=>true
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>