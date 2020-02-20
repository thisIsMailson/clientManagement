<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthItem;
use backend\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
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
                        'roles' => ['roles/index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['roles/create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['roles/update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['roles/delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['roles/view'],
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new AuthItemSearch;
        $dataProvider1 = $searchModel->search_(Yii::$app->request->queryParams, 1,$id);

        $dataProvider2 = $searchModel->search_(Yii::$app->request->queryParams, 2, $id);
        $flag=\Yii::$app->request->post('flag',null);
        $permission=\Yii::$app->request->post('selection',null);
        $perfil=\Yii::$app->authManager->getRole($id);

        if($flag==1 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $aux=\Yii::$app->authManager->getPermission($obj);
                \Yii::$app->authManager->removeChild($perfil,$aux);
            }
        }elseif($flag==2 && $permission){
            foreach($permission as $obj){
                if(!$obj)continue;
                $aux=\Yii::$app->authManager->getPermission($obj);
                \Yii::$app->authManager->addChild($perfil,$aux);
            }
        }
        return $this->render('view', [
            'model' => $this->findModel($id),'dataProvider2'=>$dataProvider2,'dataProvider1'=>$dataProvider1,'searchModel'=>$searchModel
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $model->type = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->type = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
