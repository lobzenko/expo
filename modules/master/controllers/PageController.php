<?php

namespace app\modules\master\controllers;

use Yii;
use app\models\Page;
use app\models\Vars;
use app\models\Block;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find(),
        ]);

        $dataProvider->pagination->pageSize=100;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $page = $this->findModel($id);
        $block = new Block;
        $block->id_page = $id;
        $blocks = $page->blocks;

        if ($block->load(Yii::$app->request->post()) && $block->validate())
        {
            $block->ord = $page->getBlocks()->count()-1;

            if ($block->save())
                $this->redirect(['block/update','id'=>$block->id_block]);
        }

        return $this->render('view',[
            'model'=>$page,
            'block'=>$block,
            'blocks'=>$blocks,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()))
        {
            if (empty($model->id_parent))
                $parent = Page::find()->roots()->one();
            else
                $parent = Page::findOne($model->id_parent);

            $model->prependTo($parent);

            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (!empty($_POST['Vars']))
            {
                foreach ($_POST['Vars'] as $id_var => $value) {
                    $var = Vars::findOne($id_var);
                    $var->content = $value['content'];
                    $var->update();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
