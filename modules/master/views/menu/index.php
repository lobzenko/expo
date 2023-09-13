<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;

$this->params['button-block'] = Html::a('Добавить', ['create'], ['class' => 'btn btn-primary pull-right']);
?>
<div class="card">
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id_menu',
                'name',
                'alias',
                ['class' => 'yii\grid\ActionColumn',
                     'template' => '<span class="btn btn-default">{view}</span> <span class="btn btn-default">{update}</span> <span class="btn btn-default">{delete}</span>',
                     'contentOptions'=>['class'=>'button-column']
                ]
            ],
            'tableOptions'=>[
                'class'=>'panel table table-striped ids-style valign-middle'
            ]
        ]); ?>
    </div>
</div>