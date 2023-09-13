<?php

use app\models\Subplace;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\SubplaceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Subplaces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subplace-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Subplace', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_subplace',
            'id_place',
            'id_media',
            'name',
            'price',
            //'price_type',
            //'area',
            //'capacity',
            //'comment:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Subplace $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_subplace' => $model->id_subplace]);
                 }
            ],
        ],
    ]); ?>


</div>
