<?php

use app\models\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Response $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
$this->params['button-block'] = Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']);
?>

<div class="card">
    <div class="card-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'author',
            'content:raw',
            'stateLabel:raw:Активен',
            'created_at:date',
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