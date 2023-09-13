<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vars */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-content">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

                <div class="hr-line-dashed"></div>
                    <div class="text-right">
                        <?=Html::a('Отмена', ['index'], ['class' => 'btn btn-default'])?>
                        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                    </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
