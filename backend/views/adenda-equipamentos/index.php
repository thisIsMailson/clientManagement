<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContatosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */




$this->title = 'Adenda Equipamentos';
?>
<div class="cedencias-index">

    <div class="box">
        <div class="box-body">
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
                        'attribute'=>'equipamento_id', 
                        'hAlign'=>'center', 
                        'vAlign'=>'middle',
                        'width'=>'15px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'adenda_id', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],         
                    [
                        'attribute'=>'quantidade', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],    
                    [
                        'attribute'=>'preco', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],   
                    ['class'=>'kartik\grid\ActionColumn',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                    return;
                            },
                            'update' => function ($url, $model) {
                                return;
                            },
                            'delete' => function ($url, $model) {
                                return;
                                
                            }
                        ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                        'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                    ],
            ]);
            ?>
        </div>
    </div>
</div>
