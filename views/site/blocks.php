<?php 

$parents = $page->parents()->all();

if (count($parents)>0 && $page->url!='/')
{
	array_shift($parents);

	foreach ($parents as $data)
	{
		$this->params['breadcrumbs'][] = ['label' => $data->title, 'url' => $page->url];	
	}

	$this->params['breadcrumbs'][] = $page->title;
}

foreach ($page->getBlocks()->where(['state'=>1])->all() as $key => $block)
{
	$widget = $block->getWidget();

	if (!empty($widget))
		echo $widget::widget(['page' => $page,'block'=>$block]);
	elseif (!empty($block->code))
		echo $block->code;
	else
		echo app\widgets\Block::widget(['page' => $page,'block'=>$block]);
}

?>