<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Place $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->params['button-block'] = Html::a('Редактировать', ['update', 'id' => $model->id_place], ['class' => 'btn btn-primary']);
$this->params['button-block'] .= ' '.Html::a('Удалить', ['delete', 'id' => $model->id_place], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены',
                'method' => 'post',
            ],
        ]);
?>
<div class="card">
    <div class="card-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_place',
            'name',
            'address',
            'stateLabel:raw:Статус',
        ],
    ]) ?>
    </div>
</div>

<h2 class="mb-4 d-flex justify-content-between">
    Локации

    <?=Html::a('Добавить', ['subplace/create', 'id' => $model->id_place], ['class' => 'btn btn-primary'])?>
</h2>

<div class="card">
    <div class="card-body">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_subplace',                        
            'name',
            'price',
            'price_type',
            'area',
            'capacity',
            'comment:ntext',
            ['class' => 'yii\grid\ActionColumn',
                 'template' => '<div><span class="btn btn-light">{update}</span><span class="btn btn-light">{delete}</span></div>',
                 'buttons' => [
                    'update' => function ($url, $model) {                        
                        return Html::a('<span class="bx bx-pencil"></span>', '/master/subplace/update?id='.$model->id_subplace, [
                            'title' => Yii::t('app', 'Update'),
                            'class'=>'btn btn-secondary',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="bx bx-trash"></span>', '/master/subplace/delete?id='.$model->id_subplace, [
                            'title' => Yii::t('app', 'Delete'),
                            'class'=>'btn btn-secondary',
                        ]);
                    },
                ],
                'contentOptions'=>['class'=>'button-column']
            ]
        ],
        'tableOptions'=>[
            'class'=>'table dt-responsive nowrap w-100 dataTable no-footer dtr-inline ids-style'
        ]
    ]); 
?>
    </div>
</div>