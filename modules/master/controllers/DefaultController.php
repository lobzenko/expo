<?php

namespace app\modules\master\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `master` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('master/page');
    }

    public function actionReord()
    {
        $pos        = (int)$_POST['pos']+1;
        $id_model   = (int)$_POST['id'];
        $pk_model   = $_POST['pk'];
        $table      = $_POST['table'];
        $where      = (isset($_POST['where']))?$_POST['where']:'';

        $sql = "SELECT ord FROM $table WHERE `$pk_model` = '$id_model'".((!empty($where))?" AND $where":'');
        $current_ord = (int)Yii::$app->db->createCommand($sql)->queryScalar();

        $sql = "UPDATE $table SET ord = ord-1 WHERE ord > $current_ord".((!empty($where))?" AND $where":'');
        Yii::$app->db->createCommand($sql)->execute();

        $sql = "UPDATE $table SET ord = ord+1 WHERE ord >= $pos".((!empty($where))?" AND $where":'');
        Yii::$app->db->createCommand($sql)->execute();

        $sql = "UPDATE $table SET ord = $pos WHERE `$pk_model` = '$id_model'".((!empty($where))?" AND $where":'');
        Yii::$app->db->createCommand($sql)->execute();
    }
}
