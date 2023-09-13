<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AuthItem;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
$this->params['button-block'] = Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-primary pull-right']);
?>


<div class="card">
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id_user',
                'email',
                'firstname',
                'phone',
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
                'class'=>'panel table table-striped ids-style valign-middle'
            ]
        ]); ?>
    </div>
</div>