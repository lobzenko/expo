<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ibox">
     <div class="ibox-content">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id_seo',
                'title',
                'text:ntext',
                'model',
                //'id_object',
                //'name',
                ['class' => 'yii\grid\ActionColumn',
                 'template' => '<span class="btn btn-default">{update}</span>',
                 'contentOptions'=>['class'=>'button-column']
                ]
            ],
            'tableOptions'=>[
                'class'=>'panel table table-striped ids-style valign-middle'
            ]
        ]); ?>
    </div>
</div>