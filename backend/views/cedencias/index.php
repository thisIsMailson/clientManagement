<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContatosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */




$this->title = 'Cedencias';
?>
<div class="cedencias-index">


    <?php
        Modal::begin([
            'id' => 'modal-id-indicador',
            'header'=>'<h4><b></b></h4>',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContentInd'></div>";
        Modal::end()
    ?>

    <div class="box">
        <div class="box-body">

        <div class="modelSearch"> <?php echo $this->render('_search', ['model' => $searchModel]); ?></div>

                
            <?= DynaGrid::widget([
                'storage'=>DynaGrid::TYPE_COOKIE,
                'theme'=>'panel-default',
                'showPersonalize'=>true,
                'storage'=>'cookie',
                'gridOptions'=>[
                    'dataProvider'=>$dataProvider,
                   // 'filterModel'=>$searchModel,
                    'rowOptions'=>function($model){

                            return ['class'=>'success'];
                         

                    },
                    'showPageSummary'=>false,
                    'floatHeader'=>true,
                    'pjax'=>true,
                    'panel'=>[
                        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.$this->title.'</h3>',
                        'after' => false
                    ],        
                    'toolbar' =>  [
                        /*['content'=>
                            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Adicionar', 'class'=>'btn btn-success', 
                                         'data-keyboard'=>'false','data-backdrop'=>'static','data-toggle'=>'modal','data-target'=>".bs-modal-contacto-tp",'href'=>"index.php?r=sgm-pr-contacto-tp/create"]) . ' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Atualiar Tabela'])
                        ],*/
                        '{export}',
                        '{toggleData}',
                        ['content' => '{dynagrid}']
                    ]
                ],
                'options'=>['id'=>'dynagrid-contacto-tp'], // a unique identifier is important
                'columns' => [
                    [
                        'attribute'=>'id', 
                        'hAlign'=>'center', 
                        'vAlign'=>'middle',
                        'width'=>'15px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'nomeCliente', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'carregamentoFaturMini', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'user.name', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'carregamentoFaturMini', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'valorPago', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'valorAdicional', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'guiaSaida', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'numTalaoDeposito', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'numRecibo', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'quantidadeTotal', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true,
                    ],
                    [
                        'attribute'=>'precoTotal', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true,
                    ],
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
                    [
                        'attribute'=>'periodoFidelizacao', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true,
                    ],
                    [
                        'attribute'=>'dataInicioContrato',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'dataFimContrato',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'dataEntrega',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'taxaEsforcoNegociavel',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'hidden'=>true,
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'taxaEsforcoTotal',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'hidden'=>true,
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],                
                    ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{update}{adenda}',
                        'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open" style="margin-right: 10px;""></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Ver']);
                                },
                                'update' => function ($url, $model) {
                                    return  \Yii::$app->user->identity->role_id == 1 ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Editar']) : '';
                                },
                                'adenda' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus" style="margin-left: 10px"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'adicionar adenda']);
                                    
                                },
                            
                            
                        ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                        'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                    ],
            ]);
            ?>
        </div>
    </div>
</div>
