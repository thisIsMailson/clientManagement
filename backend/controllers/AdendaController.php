<?php

namespace backend\controllers;

use Yii;
use backend\models\Adendas;
use backend\models\AdendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Equipamentos;
use backend\models\Model;
use backend\models\AdendaEquipamentos;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
/**
 * AdendaController implements the CRUD actions for Adendas model.
 */
class AdendaController extends Controller
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
                        'roles' => ['adenda/index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['adenda/create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['adenda/update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['adenda/delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['adenda/view'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list'],
                        'roles' => ['adenda/list'],
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
     * Lists all Adendas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdendaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adendas model.
     * @param string $id
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
     * Creates a new Adendas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Adendas();
        $model->user_id = Yii::$app->user->identity->id;
        $modelsEquipamento = [new AdendaEquipamentos];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsEquipamento = Model::createMultiple(Equipamentos::classname());
            Model::loadMultiple($modelsEquipamento, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsEquipamento) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsEquipamento as $modelEquipamento) {
                            $modelEquipamento->adenda_id = $model->id;
                            if (! ($flag = $adendaEquipamento->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Adenda registado com sucesso!');
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsEquipamento' => (empty($modelsEquipamento)) ? [new Equipamentos] : $modelsEquipamento
        ]);
    }

    /**
     * Updates an existing Adendas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelAdenda = $this->findModel($id);
        $modelAdenda->user_id = Yii::$app->user->identity->id;

        $modelsEquipamento = AdendaEquipamentos::find()->where(['adenda_id'=>$id])->all();
        
        if ($modelAdenda->load(Yii::$app->request->post())) {

            $modelAdenda->user_id = \Yii::$app->user->identity->id;
            $servicoList = json_encode($_POST['Adendas']['servicos']);
            $simulador = $_POST['Adendas']['simulador'];

            
            $modelAdenda->servicos = $servicoList;
            $modelAdenda->save();

            $oldIDs = ArrayHelper::map($modelsEquipamento, 'id', 'id');

            $modelsEquipamento = Model::createMultiple(AdendaEquipamentos::classname());
            Model::loadMultiple($modelsEquipamento, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEquipamento, 'id', 'id')));

            // validate all models
            
            $valid = $modelAdenda->validate();
            $valid = Model::validateMultiple($modelsEquipamento) && $valid;
            
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelAdenda->save(false)) {
                        if (! empty($deletedIDs)) {
                            AdendaEquipamentos::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsEquipamento as $modelEquipamento) { 
                            $modelEquipamento->adenda_id = $modelAdenda->id;
                            if (! ($flag = $modelEquipamento->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Cedencia atualizado com sucesso!');
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }
        }
        return $this->renderAjax('update', [
            'model' => $modelAdenda,
            'modelsEquipamento' => (empty($modelsEquipamento)) ? [new AdendaEquipamentos] : $modelsEquipamento
        ]);
    }

    /**
     * Deletes an existing Adendas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Adenda apagado com sucesso!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Adendas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Adendas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adendas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionList($id, $date) {
       $user_id = \Yii::$app->user->identity->id;
        if ($id == "gestor") {
            $id = $user_id;
        }
        $filterYear = $date;
        
        $adendaDataSet = (new \yii\db\Query())
                ->select('dataInicioContrato as label, count(id) as val')
                ->from('adendas')
                ->where('user_id = ' . $id .' AND YEAR(dataEntrega) = ' . $filterYear)         
                ->distinct()
                ->all();

        $adendaOutput = [["Adendas", "concluido"]];
        foreach($adendaDataSet as $row) {
              $adendaOutput[] = [$row['label'], $row['val']];
        }
        return json_encode($adendaOutput);
    }
}
