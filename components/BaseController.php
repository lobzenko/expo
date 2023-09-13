<?php
namespace app\components;

use Yii;
use yii\web\Controller;
use app\models\Page;

class BaseController extends Controller
{
	public $pagetitle;
	public $description;
	public $keywords;
	public $metaimage;


    protected function setSeo($model=null)
    {
    	if (empty($model))
    		$model = Page::find()->where(['alias'=>Yii::$app->request->pathInfo?:'/'])->one();

    	if (empty($model))
    		return false;

        $seos = $model->getSeos()->indexBy('name')->all();

        if (!empty($seos['title']->text))
            $this->view->title = $seos['title']->text;
        else if (!empty($model->name))
            $this->view->title = $model->name;

        if (!empty($seos['description']->text))
            Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $seos['description']->text
            ]);

        if (!empty($model->media))
            Yii::$app->view->params['og_image'] = Yii::$app->request->hostInfo.$model->media->showThumb(['w'=>1200]);

        if (!empty($seos['keywords']))
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content'=>$seos['keywords']->text
            ]);

        if (!empty($seos['bottom-text']))
            Yii::$app->view->params['bottom-text'] = $seos['bottom-text'];

        return $seos;
    }
}

?>