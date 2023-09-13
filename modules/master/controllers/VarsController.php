<?php

namespace app\modules\master\controllers;

use Yii;
use app\models\Vars;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VarsController implements the CRUD actions for Vars model.
 */
class VarsController extends Controller
{
    /**
     * Lists all Vars models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Vars::find()->where('id_page IS NULL'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vars model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vars model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vars();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_var]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vars model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->cache->delete("var_".$model->alias);

            return $this->redirect(['index', 'id' => $model->id_var]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vars model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vars model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Vars the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vars::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSitemap()
    {

        $oldApp = \Yii::$app;
        new \yii\console\Application([
            'id' => 'Command runner',
            'basePath' => '@app',
            'components' => [
                'db' => $oldApp->db,
            ],
        ]);
        Yii::$app->urlManager->hostInfo = 'https://deti.art';
        Yii::$app->controllerNamespace = "app\commands";
        Yii::$app->runAction('sitemap/all');
        Yii::$app = $oldApp;
        Yii::$app->controllerNamespace = "app\controllers";

        /*
        $command = Yii::getAlias('@app')."/yii sitemap/all";
            var_dump($command);
        $res = shell_exec($command);

        var_dump($res); die();
        */

        return $this->render('done');
    }
}
