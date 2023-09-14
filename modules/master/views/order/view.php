<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];

\yii\web\YiiAsset::register($this);
?>
<div class="card">    
    <div class="card-body">    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_order',
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d.m.Y H:i']
            ],
            [
                'attribute' => 'id_subplace',
                'value'=>function($model){                    
                    return Html::a($model->subplace->place->name.' : '.$model->subplace->name,['place/view','id'=>$model->subplace->id_place]);                    
                },
                'format'=>'raw',
            ],
            'name',
            'phone',
            'email:email',            
            'date',
            'time',            
        ],
    ]) ?>
    </div>
</div>