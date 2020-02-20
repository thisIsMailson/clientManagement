<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Adendas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="adendas-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'cidencia_id',
            'nomecli',
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
