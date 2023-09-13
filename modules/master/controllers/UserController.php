<?php

namespace app\modules\master\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\Log;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
        /*    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin','partner'],
                    ],
                ],
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort = ['defaultOrder' => ['id_user'=>SORT_DESC]];

        if (!empty($_GET['type']))
        {
            if ($_GET['type']=='users')
                $dataProvider->query->andWhere("id_user NOT IN (SELECT user_id FROM auth_assignment)");
            else
                $dataProvider->query->andWhere("id_user IN (SELECT user_id FROM auth_assignment WHERE item_name = '".$_GET['type']."')");
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionBalance($id)
    {
        $user = $this->findModel($id);

        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('balance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$user,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index', 'type' => $model->role]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $roles = $model->roles;

        if (!empty($roles))
            $model->role = $roles[0]->name;


        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index', 'type' => $model->role]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionGetUser()
    {
        $output = [];

        if (isset($_GET['term']))
        {
            foreach (User::find()->where(['like', 'firstname', $_GET['term']])->all() as $user)
                $output[] = array('id'=>$user->id_user, 'label'=>$user->firstname, 'value'=>$user->firstname);
        }

        echo json_encode($output);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
