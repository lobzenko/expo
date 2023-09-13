<?php
	use yii\helpers\Html;
	use app\models\Seo;

	foreach ($records as $rkey=>$model)
	{
?>
		<div class="form-group">
			<label class="control-label"><?=$model->title?></label>
			<?php
			if ($model->type == Seo::INPUT)
			{
				echo Html::activeTextInput($model,"[$rkey]text",['class'=>'form-control']);
			}
			elseif ($model->type == Seo::AREA)
			{
				echo Html::activeTextArea($model,"[$rkey]text",['class'=>'form-control']);
			}
			elseif ($model->type == Seo::RICHTEXT)
			{
				echo Html::activeTextArea($model,"[$rkey]text",['class'=>'form-control redactor']);
			}?>
		</div>
<?php
	}
?>