<?php

namespace app\controllers;
use yii\web\Controller;
use Yii;

use app\models\Order;
use app\models\Place;
use app\models\Subplace;
use app\models\search\PlaceSearch;
use yii\web\NotFoundHttpException;

class CartController extends \app\components\BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {                        
        $places = Place::find()->all();

        $this->setSeo();

        return $this->render('index',[
            'records'=>$places,
            'id_rub'=>$id,
        ]);
    }    

    public function actionView($id)
    {        
        $model = Subplace::findOne($id);

        if (empty($model))
            throw new NotFoundHttpException();

        $order = new Order();
        $order->id_subplace = $id;
        $order->created_at = time();

        if ($order->load(Yii::$app->request->post()) && $order->save())
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success'=>true
            ];
        }

        $this->setSeo();

        return $this->render('cart',[
            'model'=>$model,
            'order'=>$order,
        ]);
    }
}