<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Subplace $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <div class="card-body">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'price_type')->dropDownList(['час'=>'час','cут.'=>'сутки']) ?>
        </div>
    </div>

    <?= $form->field($model, 'area')->textInput()->hint('кв.м') ?>

    <?= $form->field($model, 'capacity')->textInput(['maxlength' => true])->hint('человек') ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= app\extensions\multifile\MultiFileWidget::widget([
        'model'=>$model,
        'single'=>false,
        'relation'=>'medias',
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