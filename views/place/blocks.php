<?php 

$this->params['breadcrumbs'][] = ['label' => 'Площадки', 'url' => ['place']];
$this->params['breadcrumbs'][] = $model->name;


foreach ($model->getBlocks()->where(['state'=>1])->all() as $key => $block)
{
	$widget = $block->getWidget();

	if (!empty($widget))
		echo $widget::widget(['page' => $model,'block'=>$block]);
	elseif (!empty($block->code))
		echo $block->code;
	else
		echo app\widgets\Block::widget(['page' => $model,'block'=>$block]);
}
?>