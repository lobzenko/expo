<?php

use app\models\Rub;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Rub $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Типы площадок';
$this->params['breadcrumbs'][] = $this->title;
$this->params['button-block'] = Html::a('Добавить', ['create'], ['class' => 'btn btn-primary pull-right']);
?>

<div class="card">
    <div class="card-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_rub',
            'name',
            'stateLabel:raw:Статус',
            ['class' => 'yii\grid\ActionColumn',
             'template' => '<span class="btn btn-default">{update}</span> <span class="btn btn-default">{delete}</span>',
             'contentOptions'=>['class'=>'button-column']
            ]
        ],
        'tableOptions'=>[
            'class'=>'panel table table-striped ids-style valign-middle'
        ]
    ]); ?>
    </div>
</div>

