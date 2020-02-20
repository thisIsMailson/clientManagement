<?php

namespace backend\controllers;

use Yii;
use backend\models\Notification;
use backend\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['notification/index'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['notification/create'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['notification/update'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['notification/delete'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['notification/view'],
                        ],
                    ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notification();
        $users = new User();
        $user = $users::getUsers();
        
        if ($model->load(Yii::$app->request->post())) {
            $estado = $_POST['Notification']['estado'];
            $model->user_id = \Yii::$app->user->identity->id;
            $model->estado  = $estado;
            if(!$model->data) $model->data = date("Y-m-d");
            $model->save();
            Yii::$app->session->setFlash('success', 'Notificação adicionada com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'user'=> $user
        ]);
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $users = new User();
        $user = $users::getUsers();
        
        if ($model->load(Yii::$app->request->post()) ) {
            $estado = $_POST['Notification']['estado'];
            $model->estado  = $estado;
            $model->save();
            Yii::$app->session->setFlash('success', 'Notificação atualizado com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'user'=> $user
        ]);
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

            Yii::$app->session->setFlash('success', 'Notificação apagada com sucesso!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
