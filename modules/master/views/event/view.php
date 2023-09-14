<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Event $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card">
    <div class="card-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [                        
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
        ],
    ]) ?>
    </div>
</div>