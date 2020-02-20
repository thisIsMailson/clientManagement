<?php

namespace backend\controllers;

use Yii;
use backend\models\Contatos;
use backend\models\ContatosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use backend\models\Cedencias;
use backend\models\Produtos;
use backend\models\Clientes;
use backend\models\CedenciasSearch;
use backend\models\Model;
use backend\models\CedenciaEquipamentos;
use backend\models\Equipamentos;
use backend\models\Notification;
use yii\filters\AccessControl;
/**
 * ContatosController implements the CRUD actions for Contatos model.
 */
class ContatosController extends Controller
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
                            'roles' => ['contato/index'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['contato/create'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['contato/update'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['contato/delete'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['contato/view'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['cedencia'],
                            'roles' => ['contato/cedencia'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['angariacao'],
                            'roles' => ['contato/angariacao'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['list'],
                            'roles' => ['contato/list'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['total'],
                            'roles' => ['contato/total'],
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
     * Lists all Contatos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContatosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contatos model.
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
     * Creates a new Contatos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contatos();
        $notification = new Notification();
        $user_id = \Yii::$app->user->identity->id;
        $clientes = new Clientes();
        $client = $clientes::getClientes();
        $products = new Produtos();
        $product = $products::getProducts();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = $user_id;
            $interacoesPrecedenciaList = $_POST['Contatos']['interacoes1'];
            $interacoesProspectList = $_POST['Contatos']['interacoes2'];
            $interacoesUpsellCrossellciaList = $_POST['Contatos']['interacoes3'];
            $interacoesAlteracaoConsumoList = $_POST['Contatos']['interacoes4'];
            $interacoesRetencaoList = $_POST['Contatos']['interacoes5'];
            $clienteConcList = $_POST['Contatos']['clienteConcorrencia'];
            $nivelSatisfacao = $_POST['Contatos']['nivelSatisfacao'];
            $produtoConcorrenciaList = $_POST['Contatos']['produtoConcorrencia'];
            $produtosGCVT = $_POST['Contatos']['produtosGCVT'];

            $alertaList = $_POST['Contatos']['alertas'];
            $oportunidadeList = $_POST['Contatos']['oportunidades'];
            $acoesList = $_POST['Contatos']['acoes'];

            $model->nivelSatisfacao = $nivelSatisfacao;
            $servicosList = $_POST['Contatos']['servicos'];
            $motivoRecusaList = $_POST['Contatos']['motivoRecusa'];
            $razoesinsatisfacaoList = $_POST['Contatos']['razoesinsatisfacao'];


            $clienteConcList == "Sim" ? $model->clienteConcorrencia = "Sim" : $model->clienteConcorrencia = "Não";

            $model->interacoes1  = json_encode($interacoesPrecedenciaList);
            $model->alertas  = json_encode($alertaList);
            $model->oportunidades  = json_encode($oportunidadeList);
            $model->acoes  = json_encode($acoesList);
            $model->produtoConcorrencia = json_encode($produtoConcorrenciaList);

            $model->interacoes2  = $interacoesProspectList;
            $model->interacoes3  = $interacoesUpsellCrossellciaList;
            $model->interacoes4  = $interacoesAlteracaoConsumoList;
            $model->interacoes5  = $interacoesRetencaoList;
            $model->produtosGCVT  = json_encode($produtosGCVT);

            $model->servicos = json_encode($servicosList);
            $model->motivoRecusa = json_encode($motivoRecusaList);
            $model->razoesinsatisfacao = json_encode($razoesinsatisfacaoList);

            $model->save();

            $notification->contato_id = $model->id;
            $notification->user_id = $user_id;
            $notification->data = $model->dataNotificacao;
            $notification->observacao = $model->observacaoNotificacao;
            $notification->estado = $model->EstadoNotificacao;
            $notification->save();
            Yii::$app->session->setFlash('success', 'Contato registado com sucesso!');

            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model, 'client'=> $client, 'value'=>[], 'product'=>$product
        ]);
    }
    public function actionCedencia($id) {
        $user_id = \Yii::$app->user->identity->id;
        $contato = $this->findModel($id);
        $modelCedencia = new Cedencias();
        
        $modelCedencia->user_id = $user_id;
        $modelsEquipamento = [new CedenciaEquipamentos];

        if ($modelCedencia->load(Yii::$app->request->post())) {
            
            $modelCedencia->user_id = $user_id;
            $modelCedencia->contato_id = $contato->id;
            $servicoList = json_encode($_POST['Cedencias']['servicos']);
            $refedilizacao = $_POST['Cedencias']['refedilizacao'];
            $nomeCliente = $_POST['Cedencias']['nomeCliente'];

            $modelCedencia->servicos = $servicoList;
            $modelCedencia->nomeCliente = $nomeCliente;
            $modelCedencia->refedilizacao = $refedilizacao;
            $modelCedencia->save();
            
            $modelsEquipamento = Model::createMultiple(CedenciaEquipamentos::classname());
            Model::loadMultiple($modelsEquipamento, Yii::$app->request->post());

            // validate all models
            $valid = $modelCedencia->validate();
            $valid = Model::validateMultiple($modelsEquipamento) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction(); 
                try {
                    if ($flag = $modelCedencia->save(false)) {
                        
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
                        Yii::$app->session->setFlash('success', 'Cedencia registado com sucesso!');

                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            Yii::$app->session->setFlash('error', 'Erro ao registar cedencia!');

            return $this->redirect(['index']);
        }
        return $this->renderAjax('_cedenciaForm', [
            'model' => $modelCedencia,
            'modelsEquipamento' => (empty($modelsEquipamento)) ? [new Equipamentos] : $modelsEquipamento,
            'contato'=>$contato
        ]);

    }

    /**
     * Updates an existing Contatos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientes = new Clientes();
        $client = $clientes::getClientes();

        $products = new Produtos();
        $product = $products::getProducts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Contato atualizado com sucesso!');

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model, 'client'=> $client, 'value'=>[], 'product'=>$product
        ]);
    }

    /**
     * Deletes an existing Contatos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Contato apagado com sucesso!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contatos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Contatos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contatos::findOne($id)) !== null) {
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
        $currentMonth = date("m",strtotime($date));
        $currentYear = date("Y",strtotime($date));

        $contatoDataSet = (new \yii\db\Query())
                ->select('data as label, count(id) as val')
                ->from('contatos')
                ->where('user_id = ' . $id .' AND YEAR(data) = ' . $filterYear)                             
                ->distinct()
                ->all();

        $contatoOutput = [["data", "values"]];
        foreach($contatoDataSet as $row) {
            $contatoOutput[] = [$row['label'], $row['val']];
        }
        return json_encode($contatoOutput);
    }


    public function actionTotal($id, $date) { // total de contatos

        $user_id = \Yii::$app->user->identity->id;
        if ($id == "gestor") {
            $id = $user_id;
        }

        $filterYear = $date;

        $meta = (new \yii\db\Query())
                            ->select('meta as meta')
                            ->from('metas')
                            ->where('YEAR(data) = ' . $filterYear)
                            ->distinct()
                            ->all();
        foreach ($meta as $key) {
            $meta = intval($key['meta']);
        }

        
        $totalContatoCount = (new \yii\db\Query())
            ->select('COUNT(id) as val, MONTHNAME(data) as label')
            ->from('contatos')
            ->where('user_id = ' . $id .' AND YEAR(data) = ' . $filterYear) 
            //->groupby('MONTHNAME(data)') 
            //->orderby('data')
            ->distinct()
            ->count();

        if ($totalContatoCount > 0) {
            // $totalContatoDataSet = (new \yii\db\Query())
            //     ->select('COUNT(id) as val, MONTHNAME(data) as label')
            //     //->set('lc_time_names = pt_PT')
            //     ->from('contatos')
            //     ->where('user_id = '. $id .' AND YEAR(data) = ' . $filterYear) 
            //     ->groupby('MONTHNAME(data)') 
            //     ->orderby('data')
            //     ->distinct()->all();

            $totalContatoDataSet = (new \yii\db\Query())
                    ->select('MONTHNAME(data) as label, count(id) as val')
                    ->from('contatos')
                    ->where('user_id = ' . $id .' AND YEAR(data) = ' . $filterYear)                
                    ->distinct()
                    ->orderby('data')
                    ->groupby('MONTHNAME(data)') 
                    ->all();
        } else {
            $totalContatoDataSet = (new \yii\db\Query())
                    ->select('MONTHNAME(data) as label, count(id) as val')
                    ->from('contatos')
                    ->where('user_id = ' . $id .' AND YEAR(data) = ' . $filterYear)                
                    ->distinct()
                    ->orderby('data')
                    ->groupby('MONTHNAME(data)') 
                    ->all();
        }

        $totalContatoOutput = [["Contatos", "atual", "meta"]];
        foreach($totalContatoDataSet as $row) {
               $totalContatoOutput[] = [$row['label'], intval($row['val']), $meta];
        }

        return json_encode($totalContatoOutput);
    }

    public function actionAngariacao($id, $date) {
        $user_id = \Yii::$app->user->identity->id;
        if ($id == "gestor") {
            $id = $user_id;
        }
        $filterYear = $date;

        $angariacoesDataSet = (new \yii\db\Query())
                ->select('count(id) as val, data as label')
                ->from('contatos')
                ->where('clienteNovo = 1 AND propostaAceite = "sim" AND user_id = ' . $id .' AND YEAR(data) = ' . $filterYear)                             
                ->distinct()
                ->all();

        $angariacaoOutput = [["angariacao", "values"]];
        foreach($angariacoesDataSet as $row) {
            $angariacaoOutput[] = [$row['label'], $row['val']];
        }
        return json_encode($angariacaoOutput);
    }
}
