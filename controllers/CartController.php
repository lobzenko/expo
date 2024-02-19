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
        $cart = [];

        if (!empty($_COOKIE['cart']))
            $cart = json_decode($_COOKIE['cart'],true);

        $records = [];

        if (!empty($cart))        
            $records = Subplace::find()->where(['id_subplace'=>$cart])->all();

        $order = new Order();
        $order->id_subplace = $id;
        $order->created_at = time();

        if ($order->load(Yii::$app->request->post()) && $order->save())
        {
            $cookies = Yii::$app->response->cookies;
            $cookies->remove('cart');            
                
            Yii::$app->mailer->compose('order',['order'=>$order])
                ->setTo('msd_86@mail.ru')
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setSubject('Новый заказ '.$order->id_order)
                ->send();

            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return [
                'success'=>true
            ];
        }        

        return $this->render('index',[
            'records'=>$records,
            'order'=>$order,
        ]);
    }    

    public function actionRemove($id)
    {
        $cart = [];
        
        if (!empty($_COOKIE['cart']))
            $cart = json_decode($_COOKIE['cart'],true);    

        
        $cart = array_diff($cart,[$id]);        
        
        setcookie('cart', json_encode($cart), time()+7*24*3600, '/');

        return $this->redirect('/cart');
    }

    public function actionView($id)
    {        
        return $this->redirect('/cart');

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