<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;
use app\models\Firm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'rank')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'newpassword')->textInput(['maxlength' => 255]) ?>

                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '7(999)999-9999'])?>

                    <?php if (Yii::$app->user->can('admin')){?>
                    <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(AuthItem::find()->all(), 'name', 'description'),['prompt'=>'Права доступа']) ?>

                    <?php }else{?>
                    <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(AuthItem::find()->where(['in','name',['deposit','aproved','user']])->all(), 'name', 'description'),['prompt'=>'Права доступа']) ?>
                    <?php }?>
                    <div class="hr-line-dashed"></div>
                    <div class="text-right">
                        <?=Html::a('Отмена', ['index'], ['class' => 'btn btn-default'])?>
                        <?=Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4>Фотография</h4>
                    <?= app\extensions\multifile\MultiFileWidget::widget([
                        'model'=>$model,
                        'single'=>true,
                        'relation'=>'media',
                        //'records'=>[$value_model->media],
                        'extensions'=>['jpg','jpeg','gif','png'],
                        'grouptype'=>1,
                        'showPreview'=>true
                    ]);?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>