<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <?=''/* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_page',
            'id_parent',
            'title',
            'description:ntext',
            'keywords',
            'content:ntext',
            'alias',
            'hidemenu',
            'ord',
            'secure',
        ],
    ]) */?>

    <?php $form = ActiveForm::begin([
    ]); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <?=$form->field($block, 'type', ['template' => "{input}"])->dropDownList($block->getTypesLabels()) ?>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Добавить блок</button>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="blocks" class="blocks ordered " data-order-url="/master/block/order">
                <?php foreach ($blocks as $key => $block) {?>
                    <?=$this->render('/block/_view',['data'=>$block])?>
                <?php }?>
            </div>
        </div>
    </div>
</div>
