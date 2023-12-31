<?php

namespace app\controllers;
use yii\web\Controller;
use Yii;

use app\models\Rub;
use app\models\Event;
use app\models\SubEvent;
use app\models\search\EventSearch;
use yii\web\NotFoundHttpException;

class EventController extends \app\components\BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {        
        $rubs = Rub::find()->where(['state'=>1])->all();
        
        $events = Event::find()->orderBy('date_begin DESC')->all();

        $page = Page::findOne(['alias' => 'event']);
        
        if (empty($page) || !$page->enabled)
            throw new NotFoundHttpException();
    
        $id_rub = Yii::$app->request->get('id');

        $records = Event::find();

        if (!empty($id_rub))
            $records->joinWith('rubs as rubs')->where(['rubs.id_rub' => $id_rub]);

        $blocks = $page->blocks;    

        $this->setSeo($page);

        return $this->render((empty($blocks))?'page':'blocks',[
            'page'=>$page
        ]);

        return $this->render('index',[
            'rubs'=>$rubs,
            'records'=>$events,
            'id_rub'=>$id,
        ]);
    }    

    public function actionView($alias)
    {
        $model = Event::find()->where(['alias'=>$alias])->one();

        if (empty($model) || !$model->state)
            throw new NotFoundHttpException();

        $this->setSeo($model);

        if (!empty($model->blocks))
            return $this->render('blocks',[
                'model'=>$model                
            ]);

        return $this->render('view',[
            'model'=>$model,        
        ]);
    }

    public function actionModal($id)
    {        
        $model = SubEvent::findOne($id);        

        return $this->renderPartial('_modal',[
            'model'=>$model,            
        ]);
    }
}