<?php

namespace app\modules\master\controllers;

use Yii;
use app\models\Block;
use app\models\BlockVar;

use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Block models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Block::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Block model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Block model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Block();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id_block]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionOrder()
    {
        $ords = Yii::$app->request->post('ords');

        foreach ($ords as $key => $id_block)
            Yii::$app->db->createCommand()->update('cnt_block',['ord'=>$key],['id_block'=>$id_block])->execute();
    }

    /**
     * Updates an existing Block model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            if (!empty(Yii::$app->request->post('BlockVar')))
            {
                foreach (Yii::$app->request->post('BlockVar') as $key => $post)
                {
                    $varModel = BlockVar::find()->where(['id_block'=>$id,'alias'=>$key])->one();

                    if (empty($varModel))
                    {
                        $varModel = new BlockVar;
                        $varModel->id_block = $id;
                        $varModel->alias = $key;
                        $varModel->type = $model->blocks[$model->type]['vars'][$key]['type'];
                        $varModel->name = $model->blocks[$model->type]['vars'][$key]['name'];
                    }

                    $varModel->value = $post['value'];

                    if ($varModel->type == BlockVar::TYPE_MEDIAS || $varModel->type == BlockVar::TYPE_MEDIA)
                        $varModel->setModelIndex($key);

                    if (!$varModel->save())
                        print_r($varModel->errors);
                }            
            }

            if (!empty($model->id_page))
                return $this->redirect(['page/view', 'id' => $model->id_page]);
            elseif (!empty($model->id_place))
                return $this->redirect(['place/template', 'id' => $model->id_place]);
            elseif (!empty($model->id_service))
                return $this->redirect(['service/view', 'id' => $model->id_service]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Block model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_page = $model->id_page;

        if ($model->delete()) {
            return $this->redirect(['page/view','id'=>$id_page]);    
        }        
    }

    /**
     * Finds the Block model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Block the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Block::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
