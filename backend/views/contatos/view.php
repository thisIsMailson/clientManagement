<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contatos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contatos-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cliente.nome',
            [
                'attribute' => 'clienteNovo',
                'value' => function($model)
                {
                    return $model->clienteNovo == 1 ? 'Sim' : 'Não';
                }
            ],
            'FocalPoint',
            'concelho.nome',                
            'contato',
            'email:email',
            'canal.canal',
            'data',
            'tipo.nome',
            'interacoes1',
            'observacao',
            'interacoes2',
            'interacoes3',
            'interacoes4',
            'interacoes5',
            'produtosGCVT',
            'clienteConcorrencia',
            'produtoConcorrencia',
            'informacaoAdicional',
            'propostaAceite',
            'servicos',
            'valorServicoTotal',
            'valorPrestacao',
            'nubCartoesAngariados',
            'observacao2',
            'motivoRecusa',
            'observacao3',
            'observacao4',
            'nivelSatisfacao',
            'razoesinsatisfacao',
            'alertas',
            'oportunidades',
            'acoes',
            'observacao5',
            'dataNotificacao',
            'EstadoNotificacao',
            'observacaoNotificacao',
            'user.name',
        ],
    ]) ?>

</div>
