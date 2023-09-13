<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Переменные';
$this->params['breadcrumbs'][] = $this->title;
$this->params['button-block'] = Html::a('Добавить переменную', ['create'], ['class' => 'btn btn-primary']);
?>
<div class="ibox">
    <div class="ibox-content">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute'=>'id_var',
                'label'=>'id'
            ],
            'name',
            'alias',
            'content:ntext',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '<span class="btn btn-default">{update}</span> <span class="btn btn-default">{delete}</span>',
             'contentOptions'=>['class'=>'button-column']
            ],
        ],
        'tableOptions'=>[
                'class'=>'panel table table-striped ids-style'
            ]
        ]); ?>
    </div>
</div>