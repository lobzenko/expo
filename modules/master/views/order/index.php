<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            
            'id_order',
            [
                'attribute' => 'date',
                'value'=>function($model){                    
                    return $model->date.' '.$model->time;                    
                },                
            ],    
            [
                'attribute' => 'id_subplace',
                'value'=>function($model){         

                    $places = $model->places;

                    $output = '';
                    
                    if (!empty($places))
                    {
                        foreach ($places as $place)
                            $output .= Html::a($place->name,['place/view','id'=>$place->id_place]).'<br>';
                    }

                    return $output; 
                },
                'format'=>'raw',
            ],
            'name',
            'phone',
            'email:email',
            ['class' => 'yii\grid\ActionColumn',
                 'template' => '<div><span class="btn btn-light">{view}</span><span class="btn btn-light">{delete}</span></div>',
                 'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="bx bx-detail"></span>', $url, [
                            'title' => Yii::t('app', 'View'),
                        ]);
                    },
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
            'class'=>'table dt-responsive nowrap w-100 dataTable no-footer dtr-inline ids-style'
        ]
    ]); ?>
    </div>
</div>