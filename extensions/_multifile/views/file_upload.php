<?php
	use yii\helpers\Html;

	$this->registerJsFile('/js/fileuploader/fileuploader.js?12',['depends'=>[\yii\web\JqueryAsset::className()],'position'=>\yii\web\View::POS_END]);
	$this->registerJsFile('/js/fileuploader/multiupload.js?12',['depends'=>[\yii\web\JqueryAsset::className()],'position'=>\yii\web\View::POS_END]);
	$this->registerCssFile('/js/fileuploader/fileuploader.css');

	$uniq_id = substr(md5(time().rand(0,9999)),0,10);
?>

<?php
	if (!empty($attribute))
		echo Html::activeHiddenInput($model,$attribute)
?>
<div id="uploader<?=$uniq_id?>" class="file-uploader-place">
	<noscript>
		<p>Please enable JavaScript to use file uploader.</p>
	</noscript>
</div>
<input type="hidden" name="multiupload_<?=$POST_relation_name?>" value="1" />
<?php
$records = json_encode($records);

if (!empty($extensions)) {
	$allowedExtensions = "allowedExtensions: ['".implode("','",$extensions)."'],";
}

$script = <<< JS
	$(document).ready(function(){
		$("#uploader$uniq_id").multiupload(
			{
				group: $group,
				single: $single,
				relationname: '$POST_relation_name',
				records: $records,
				$allowedExtensions
				showPreview: $showPreview,
				tpl: $template
			}
		);
	});
JS;

if (Yii::$app->request->isAjax)
	echo '<script>'.$script.'</script>';
else
	$this->registerJs($script, yii\web\View::POS_END);
?>