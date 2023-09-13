<div class="container">
	<?php foreach ($records as $model){?>
	<div class="response mb-5">
	    <p><?=$model->content?></p>
	    <p class="text-right"><strong> - <?=$model->author?></strong></p>
	</div>
	<?php }?>
</div>