<?php

namespace app\controllers;
use yii\web\Controller;
use Yii;

use app\models\Rub;
use app\models\Place;
use app\models\Page;
use app\models\Subplace;
use app\models\search\PlaceSearch;
use yii\web\NotFoundHttpException;

class PlaceController extends \app\components\BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {        
        $page = Page::findOne(['alias' => '/place']);
        
        if (empty($page) || !$page->enabled)
            throw new NotFoundHttpException();
    
        $id_rub = Yii::$app->request->get('id');
        
        $blocks = $page->blocks;    

        $this->setSeo($page);

        return $this->render((empty($blocks))?'page':'blocks',[
            'page'=>$page
        ]);
    }    

    public function actionView($id)
    {
        $model = Place::findOne($id);    
        
        if (empty($model) || !$model->state)
            throw new NotFoundHttpException();
            
        $this->setSeo($model);

        if ($model->template == 1 )
            return $this->render('blocks',[
                'model'=>$model                
            ]);

        $subplaces = $model->subplaces;

        $this->setSeo();

        return $this->render('view',[
            'model'=>$model,
            'records'=>$subplaces,
        ]);
    }

    public function actionModal($id)
    {        
        $model = Subplace::findOne($id);        

        return $this->renderPartial('_modal',[
            'model'=>$model,            
        ]);
    }
}