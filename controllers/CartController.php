<?php

namespace app\controllers;
use yii\web\Controller;
use Yii;

use app\models\Order;
use app\models\Place;
use app\models\Subplace;
use app\models\search\PlaceSearch;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends \app\components\BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id=0)
    {   
        $id_subplace = Yii::$app->session->get('id_subplace');

        if (!empty($id_subplace))
            return $this->redirect('/cart/'.$id_subplace);

        return $this->render('index',[
        ]);
    }    

    public function actionView($id)
    {        
        $model = Subplace::findOne($id);

        Yii::$app->session->set('id_subplace',$id);

        if (empty($model))
            throw new NotFoundHttpException();

        $order = new Order();
        $order->id_subplace = $id;
        $order->created_at = time();

        if ($order->load(Yii::$app->request->post()) && $order->save())
        {
            Yii::$app->session->remove('id_subplace',$id);
            
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