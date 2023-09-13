<?php

use app\models\Event;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Event $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'События';
$this->params['breadcrumbs'][] = $this->title;
$this->params['button-block'] = Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']);
?>
<div class="card">    
    <div class="card-body">    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            
            'id_event',
            'name',
            [
                'attribute' => 'date_begin',
                'format' => ['datetime', 'php:d.m.Y']
            ],
            [
                'attribute' => 'date_end',
                'format' => ['datetime', 'php:d.m.Y']
            ],
            'stateLabel:raw:Статус',
            ['class' => 'yii\grid\ActionColumn',
                 'template' => '<div><span class="btn btn-light">{update}</span><span class="btn btn-light">{delete}</span></div>',
                 'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="bx bx-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="bx bx-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                        ]);
                    },
                ],
                'contentOptions'=>['class'=>'button-column']
            ]
        ],
        'tableOptions'=>[
            'class'=>'table dt-responsive w-100 dataTable no-footer dtr-inline ids-style'
        ]
    ]); ?>
    </div>
</div>