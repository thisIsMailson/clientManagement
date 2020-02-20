<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;
use yii\helpers\URL;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContatosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contatos';
?>
<div class="contatos-index">

    

    <?php
        Modal::begin([
            'id' => 'modal-id-indicador',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContentInd'></div>";
        Modal::end()
    ?>
    <?php
        Modal::begin([
         'id'=>'modal',
         'size'=>'modal-lg',
            ]);
        echo "<div id='modalContent'></div>";
        Modal::end()
    ?>

    <div class="box">
        <div class="box-body">

        <div class="modelSearch"> <?php echo $this->render('_search', ['model' => $searchModel]); ?></div>
        <p style="float: left; margin-bottom: 0px">
                <?= Html::button('Adicionar', ['value'=>URL::to('index.php?r=contatos/create'), 'class' => 'btn btn-primary', 'id'=>'contatoButton']) ?>
        </p>
        <br>
        <br>
        <br>
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
                        'attribute'=>'cliente',
                        'value' => 'cliente.nome', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'cliente.cod_cliente', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'canal.canal', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'nubCartoesAngariados',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'valorPrestacao',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'valorServicoTotal',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'hidden'=>true,
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'tipo_id',
                        'value'=>'tipo.nome',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'hidden'=>true,
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'alertas',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'oportunidades',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'acoes',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'observacao5',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'data',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute' => 'clienteNovo',
                        'value' => function($model)
                        {
                            return $model->clienteNovo == 1 ? 'Sim' : 'Não';
                        },
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute' => 'FocalPoint',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    [
                        'attribute' => 'user_id',
                        'value'=>'user.name',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'hidden'=>true,
                        'pageSummary'=>true
                    ],
                    ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{update}{cedencia}',
                        'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open" style="margin-right: 10px;""></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Ver']);
                                },
                                'update' => function ($url, $model) {
                                    return  \Yii::$app->user->identity->role_id == 1 ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Editar']) : '';
                                },
                                'cedencia' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus" style="margin-left: 10px"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'adicionar cedencia']);
                                    
                                },
                            
                            
                        ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                        'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                    ],
            ]);
            ?>
        </div>
    </div>
</div>
