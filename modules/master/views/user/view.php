<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['button-block'] = Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary']).' '.Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_user], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);
?>