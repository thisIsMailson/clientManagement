<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;
use yii\helpers\URL;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">
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
                <?= Html::button('Adicionar', ['value'=>URL::to('index.php?r=clientes/create'), 'class' => 'btn btn-primary', 'id'=>'contatoButton']) ?>
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
                    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                    [
                        'attribute'=>'cod_cliente',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'nome', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'tipo_cliente', 
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'gestor',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                    [
                        'attribute'=>'estado',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],[
                        'attribute'=>'cod_gp',
                        'hAlign'=>'left', 
                        'vAlign'=>'middle',
                        'width'=>'150px',
                        'pageSummary'=>true
                    ],
                
                    ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{update}',
                        'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Ver']);
                                },

                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil" style="padding: 10px;"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Adicionar adenda']);
                                    
                                },
                            
                            
                        ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                        'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                    ],
            ]);
            ?>
        </div>
    </div>
</div>