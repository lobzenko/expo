<?php
namespace app\widgets;

use Yii;
use app\models\Rub;
use app\models\Place;

class PlaceWidget extends \yii\base\Widget
{
	public $page;
	public $block;

    public function run()
    {
    	$blockVars = $this->block->getBlockVars()->indexBy('alias')->all();

        $id_rub = Yii::$app->request->get('id');

        $records = Place::find();

        if (!empty($id_rub))
            $records->joinWith('rubs as rubs')->where(['rubs.id_rub' => $id_rub]);

        $records = $records->andWhere(['db_place.state'=>1])->all();

        $blockVars['records'] = $records; 
        $blockVars['rubs'] = Rub::find()->where(['state'=>1])->all();    
        $blockVars['places'] = $records;
        $blockVars['id_rub'] = $id_rub;

        return $this->render('places',$blockVars);
    }
}