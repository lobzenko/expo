<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Place $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>        
            
        <?= $form->field($model, 'template')->dropDownList([0=>'Локации',1=>'Шаблон'])?>

        <div class="form-group">
            <label class="control-label">
                Типы
            </label>
            <?php
            $records = $model->getRecords('rubs');
            $rubs = \app\models\Rub::find()->where(['state'=>1])->all();
            $rubs = ArrayHelper::map($rubs, 'id_rub', 'name');
            
            if (!empty($records[0]->id_rub))
                $records = ArrayHelper::map($records, 'id_rub', 'id_rub');
            else
                $records = [];            

            echo Html::dropDownList('Rub[rubs][]id_rub',$records,$rubs,['class'=>'select2 form-control select2-multiple form-select','multiple'=>true]);
            ?>
        </div>

        <div class="row mb-5">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'latitude')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'longitude')->hiddenInput()->label(false) ?>
            </div>
            <div class="col-md-6">
                <?=\app\widgets\MapWidget::widget(['point'=>[
                    'x'=>$model->latitude,
                    'y'=>$model->longitude,
                ],'model'=>$model])?>
            </div>
        </div>

        <?= app\extensions\multifile\MultiFileWidget::widget([
            'model'=>$model,
            'single'=>true,
            'relation'=>'media',
            'extensions'=>['jpg','jpeg','gif','png'],
            'grouptype'=>1,
            'showPreview'=>true
        ]);?>
        

        <?= $form->field($model, 'state')->dropDownList($model->getStates()) ?>

        <hr>

        <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'capacity')->textInput() ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>        

        <?= $form->field($model, 'order')->textInput() ?>

        <hr>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
