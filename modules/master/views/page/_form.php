<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Page;
use app\models\Vars;
use app\models\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>
    <div class="card m-t">
        <div class="card-body">
            <?= $form->field($model, 'enabled')->checkbox() ?>

            <?= $form->field($model, 'id_parent')->dropDownList(ArrayHelper::map(Page::find()->where('id <> '.(int)$model->id)->all(), 'id', 'title'),['maxlength' => 10,'prompt'=>'Выберите родителя']) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 16,'class'=>'form-control redactor']) ?>
        </div>
    </div>

    <?php
        if (!$model->isNewRecord)
        {
    ?>

    <div class="card m-t">
        <div class="card-title">Переменные</div>
        <div class="card-content">
            <?php
            $vars = $model->getVarsByTemplate();

            if (!empty($vars))
            {
                foreach ($vars as $key => $var) {
                    switch ($var->type) {
                        case 0:
                            echo $form->field($var, '['.$key.']content')->textarea(['rows' => 6])->label($var->name);
                            break;
                        case Vars::TYPE_MENU:
                            echo $form->field($var, '['.$key.']content')->dropDownList(ArrayHelper::map(Menu::find()->all(), 'id_menu', 'name'),['maxlength' => 10,'prompt'=>'Выберите список'])->label($var->name);
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php
        }
    ?>
    <div class="card m-t">
        <div class="card-header">SEO даннные</div>
        <div class="card-body">
            <?=app\extensions\seo\SeoInputWidget::widget([
                'model'=>$model,
                'form'=>$form,
            ]);?>
    
        </div>
    </div>
    <div class="text-right mb-5">
        <?=Html::a('Отмена', ['index'], ['class' => 'btn btn-default'])?>
        <?=Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
