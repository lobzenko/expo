<?php
namespace app\widgets;

use Yii;
use app\models\Contact;

class FormWidget extends \yii\base\Widget
{
    public $block;
    public $page;

    public function run()
    {        
        if (!empty($this->block))
            $blockVars = $this->block->getBlockVars()->indexBy('alias')->all();
        else 
            $blockVars = [];

        return $this->render('form',$blockVars);
    }
}