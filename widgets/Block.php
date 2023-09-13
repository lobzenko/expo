<?php
namespace app\widgets;

use Yii;

class Block extends \yii\base\Widget
{
	public $page;
	public $block;

    public function run()
    {
    	$blockVars = $this->block->getBlockVars()->indexBy('alias')->all();        

        return $this->render('blocks/'.$this->block->type,$blockVars);
    }
}
