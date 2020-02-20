<?php

namespace backend\controllers;

use Yii;
use backend\models\Cedencias;
use backend\models\CedenciasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use backend\models\CedenciaEquipamentos;
use backend\models\Equipamentos;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use backend\models\Adendas;
use backend\models\AdendaEquipamentos;
/**
 * CedenciasController implements the CRUD actions for Cedencias model.
 */
class CedenciasController extends Controller
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
                            'roles' => ['cedencia/index'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['cedencia/create'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['cedencia/update'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['cedencia/delete'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['cedencia/view'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['adenda'],
                            'roles' => ['cedencia/adenda'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['list'],
                            'roles' => ['cedencia/list'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['cartao'],
                            'roles' => ['cedencia/cartao'],
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
     * Lists all Cedencias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CedenciasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cedencias model.
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
     * Creates a new Cedencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    }

    public function actionAdenda($id) {

        $cedencia = $this->findModel($id);

        $modelAdenda = new Adendas();
        $modelAdenda->user_id = Yii::$app->user->identity->id;
        $modelsEquipamento = [new AdendaEquipamentos];

        if ($modelAdenda->load(Yii::$app->request->post())) {
            
            $modelAdenda->user_id = \Yii::$app->user->identity->id;
            $modelAdenda->cidencia_id = $cedencia->id;
            $servicoList = json_encode($_POST['Adendas']['servicos']);
            //$simulador = $_POST['Adendas']['simulador'];

            $modelAdenda->servicos = $servicoList;
            $modelAdenda->save();
            
            $modelsEquipamento = Model::createMultiple(AdendaEquipamentos::classname());
            Model::loadMultiple($modelsEquipamento, Yii::$app->request->post());

            // validate all models
            $valid = $modelAdenda->validate();
            $valid = Model::validateMultiple($modelsEquipamento) && $valid;
            if ($valid) {
                
                $transaction = \Yii::$app->db->beginTransaction(); 
                try {
                    if ($flag = $modelAdenda->save(false)) {
                        
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
                        Yii::$app->session->setFlash('success', 'Adenda registado com sucesso!');
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            return $this->redirect(['index']);
        }
        return $this->renderAjax('_adendaForm', [
            'model' => $modelAdenda,
            'modelsEquipamento' => (empty($modelsEquipamento)) ? [new Equipamentos] : $modelsEquipamento,
            'cedencia'=> $cedencia
        ]);

    }

    public function actionLists($id) {
        $cedenciaCount = Cedencias::find()->where(['id' => $id])->count(); 

        $cedencia = Cedencias::find()->where(['id' => $id])->all(); 
        if ($cedenciaCount > 0) {
               return json_encode(['cedencia'=>$cedencia]);
        } else {
            return json_encode(['cedencia'=>'']);
        }
    }

    /**
     * Updates an existing Cedencias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelCedencia = $this->findModel($id);
        $modelsEquipamento = CedenciaEquipamentos::find()->where(['cedencia_id'=>$id])->all();
        if ($modelCedencia->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsEquipamento, 'id', 'id');
            $modelsEquipamento = Model::createMultiple(CedenciaEquipamentos::classname());
            Model::loadMultiple($modelsEquipamento, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEquipamento, 'id', 'id')));

            // validate all models
            $valid = $modelCedencia->validate();
            $valid = Model::validateMultiple($modelsEquipamento) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCedencia->save(false)) {
                        if (! empty($deletedIDs)) {
                            CedenciaEquipamentos::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsEquipamento as $modelEquipamento) {
                            $modelEquipamento->cedencia_id = $modelCedencia->id;
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
            'model' => $modelCedencia,
            'modelsEquipamento' => (empty($modelsEquipamento)) ? [new CedenciaEquipamentos] : $modelsEquipamento
        ]);
    }

    /**
     * Deletes an existing Cedencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Cedencia apagado com sucesso!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cedencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cedencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cedencias::findOne($id)) !== null) {
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
        
        $cedenciaDataSet = (new \yii\db\Query())
                ->select('dataInicioContrato as label, count(id) as val')
                ->from('cedencias')
                ->where('user_id = ' . $id .' AND YEAR(dataInicioContrato) = ' . $filterYear)                      
                ->distinct()
                ->all();

        $cedenciaOutput = [["Cedencias", "concluido"]];
        foreach($cedenciaDataSet as $row) {
                $cedenciaOutput[] = [$row['label'], $row['val']];
        }
        return json_encode($cedenciaOutput);
    }

    public function actionCartao($id, $date) {
        $user_id = \Yii::$app->user->identity->id;
        if ($id == "gestor") {
            $id = $user_id;
        }
        $filterYear = $date;

        $totalCartoesCedencia = (new \yii\db\Query())
                ->select('dataInicioContrato as label, sum(totalCartoes) as val')
                ->from('cedencias')
                ->where('user_id = '. $id . ' AND YEAR(dataInicioContrato) = ' . $filterYear)
                ->distinct()
                ->all();

        $CartoesCedenciaOutput = [["cartao", "values"]];
        foreach($totalCartoesCedencia as $row) {
            $CartoesCedenciaOutput[] = [$row['label'], $row['val']];
        }
        return json_encode($CartoesCedenciaOutput);
    }
}