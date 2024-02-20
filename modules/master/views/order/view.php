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
                    $places = $model->places;

                    $output = '';
                    
                    if (!empty($places))
                    {
                        foreach ($places as $place)
                            $output .= Html::a($place->name,['place/view','id'=>$place->id_place]).' '.$place->date.' '.$place->time.'<br>';
                    }

                    return $output; 
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