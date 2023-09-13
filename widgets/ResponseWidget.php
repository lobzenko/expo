<?php
namespace app\widgets;

use Yii;
use app\models\Response;

class ResponseWidget extends \yii\base\Widget
{
	public $page;
	public $block;

    public function run()
    {
    	//$blockVars = $this->block->getBlockVars()->indexBy('alias')->all();

        $records = Response::find()->where(['state'=>1])->all();

        return $this->render('responses',[
            'records'=>$records,
        ]);
    }
}
