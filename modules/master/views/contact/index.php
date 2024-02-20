<?php

use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Contact $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">    
    <div class="card-body">    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            
            'id_contact',
            'name',
            'phone',
            'email:email',
            'firm',
            
        ],
    ]); ?>

    </div>

</div>
