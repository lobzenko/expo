<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['user/view', 'id' => $model->id_user]];
$this->params['breadcrumbs'][] = $this->title = Yii::t('app', 'Bills');
?>
<?=$this->render('_nav',['model'=>$model])?>

<form action="" method="get" class="ibox-content border-bottom m-t">
    <div class="row">
        <!--div class="col-sm-2">
            <div class="form-group">
                <input type="text" id="order_id" name="order_id" value="" placeholder="Bill ID" class="form-control">
            </div>
        </div-->
        <div class="col-sm-2">
            <div class="form-group">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_begin" type="text" class="datepicker form-control" value="03/04/2014">
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_end" type="text" class="datepicker form-control" value="03/06/2014">
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <select id="status" name="outin" value="" class="form-control">
                    <option>All payments</option>
                    <option>Inbox</option>
                    <option>Outbox</option>
                </select>
            </div>
        </div>
        <div class="col-sm-1">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>

<div class="ibox m-t">
    <div class="ibox-content">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                'id_bill',
                [
                    'attribute'=>'date',
                    'value'=>function($model){return (!empty($model->date))?date('d.m.Y H:i',$model->date):'';},
                ],
                [
                    'attribute'=>'money',
                    'value'=>function($model){
                        if ($model->money<0)
                            return '<span class="text-danger">-'.number_format($model->money,2).'$</span>';
                        else
                            return number_format($model->money,2).'$';
                    },
                    'contentOptions'=>[
                        'style'=>'font-size:20px;'
                    ]
                ],
                [
                    'attribute'=>'state',
                    'format'=>'html',
                    'value'=>function($model){return '<span class="label label-primary">Paid</span>';},
                ],
                [
                    'label' => 'description',
                    'format'=>'html',
                    'value'=>function($model) {
                        $out = '';

                        if (!empty($model->id_sticker))
                            $out .= Html::a('For image #'.$model->sticker->id_picture,['picture/view','id'=>$model->sticker->id_picture]);

                        if (!empty($model->sticker->id_media))
                            $out.= '<img height="45" src="'.$model->sticker->media->getFilePath().'"/>';
                        else
                            $out.='Shape';
                    },
                    'contentOptions'=>['class'=>'preview']
                ],
            ],
            'tableOptions'=>[
                'class'=>'panel table table-striped ids-style valign-middle'
            ]
        ]); ?>
    </div>
</div>