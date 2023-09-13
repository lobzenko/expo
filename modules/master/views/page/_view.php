<div class="row tree">
    <div class="col-sm-<?=11-$offset?> col-sm-offset-<?=$offset?>">
        <?=$data->id_page?>&nbsp;&nbsp;&nbsp; <a href="/master/page/update?id=<?=$data->id_page?>"><?=$data->title?></a> <span class="help">/<?=$data->alias?></span>
    </div>
    <div class="col-sm-1 pull-right text-right">
        <span class="btn btn-default btn-sm"><a href="/master/page/update?id=<?=$data->id_page?>" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a></span>
    </div>
</div>
<?php 
	foreach ($data->childs as $key => $child)
		echo $this->render("_view",['data'=>$child,'offset'=>$offset+1])
?>