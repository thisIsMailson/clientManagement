<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Cedencias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cedencias-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'contato_id',
            'nomeCliente',
            [
                'attribute'=>'refedilizacao', 
                'hAlign'=>'left', 
                'vAlign'=>'middle',
                'width'=>'150px',
                'pageSummary'=>true,
                'value' => function ($model){
                    return $model->refedilizacao == 1 ?'Não':'Sim';
                },
            ],
            'dataInicioContrato',
            'dataFimContrato',
            'periodoFidelizacao',
            'cartoesPosPago',
            'cartoesPrePago',
            'totalCartoes',
            'valorPosPago',
            'valorPrePago',
            'total',
            'carregamentoFaturMini',
            'servicos',
            'quantidadeTotal',
            'precoTotal',
            'dataEntrega',
            'valorMaximo',
            'valorPago',
            'valorAdicional',
            'totalPropostapagamento',
            'guiaSaida',
            'numTalaoDeposito',
            'numRecibo',
            'simulador',
            'taxaEsforcoNegociavel',
            'taxaEsforcoTotal',
        ],
    ]) ?>

</div>
