<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Event $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <div class="card-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255,'row'=>3]) ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'date_begin')->textInput(['type'=>'date','value'=>(!empty($model->date_begin))?date('Y-m-d', $model->date_begin):''])?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'date_end')->textInput(['type'=>'date','value'=>(!empty($model->date_end))?date('Y-m-d', $model->date_end):''])?>
        </div>
    </div>

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
