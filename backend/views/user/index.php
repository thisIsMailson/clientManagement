<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Url;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
?>
<div class="user-index">

    <div class="box">
        <div class="box-body">

        <?php
            Modal::begin([
             'header'=>'<h4><b>Novo Utilizador</b></h4>',
             'id'=>'modal',
             'size'=>'modal-lg',
                ]);
            echo "<div id='modalContent'></div>";
            Modal::end()
        ?>

        <?php
            Modal::begin([
                'id' => 'modal-id-indicador',
                'header'=>'<h4><b>Utilizador</b></h4>',
                'size' => 'modal-lg',
            ]);
            echo "<div id='modalContentInd'></div>";
            Modal::end()
        ?>
           <!--  <div class="modelSearch"> <?php echo $this->render('_search', ['model' => $searchModel]); ?></div> -->
            <?= DynaGrid::widget([
                'storage'=>DynaGrid::TYPE_COOKIE,
                'theme'=>'panel-default',
                'showPersonalize'=>true,
                'storage'=>'cookie',
                'gridOptions'=>[
                    'dataProvider'=>$dataProvider,
                
                    'showPageSummary'=>true,
                    'floatHeader'=>true,
                    'pjax'=>true,
                    'panel'=>[
                        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.$this->title.'</h3>',
                        'after' => false
                    ],        
                    'toolbar' =>  [
                        '{export}',
                        '{toggleData}',
                        ['content' => '{dynagrid}']
                    ]
                ],
                'options'=>['id'=>'dynagrid-contacto-tp'], // a unique identifier is important
                'columns' => [
                    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
                    
                    ['attribute' => 'photo',
                    'format' => ['html'],
                    'filter' => false,
                    'value' => function ($data) {

                        if (!empty($data['photo'])) {

                            return Html::img(Yii::getAlias($data['photo']), ['width' => '30px']);
                        }
                        return "Not choosen";
                    },

                    ],
                    'name',
                    'username',
                    'email:email',
                    [
                        'attribute' => 'role_id',
                        'label' => 'Perfil',
                        'value' => function ($model){
                        return $model->role_id == 1 ?'Administrador':'Gestor';
                        },
                        'filter'=>array(),
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'value' => function ($model){
                        return $model->status == 10 ?'Ativo':'Inativo';
                        },
                        'filter'=>array(),
                    ],
                    [
                        'attribute' => 'view_option',
                        'label' => 'Vê Tudo',
                        'value' => function ($model){
                        return $model->view_option == 1 ?'Sim':'Não';
                        },
                        'filter'=>array(),
                    ],
                    ['class'=>'kartik\grid\ActionColumn','template'=> '{view}{update}',
                        'buttons' => [
                            
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Ver']);
                                },

                                    'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil" style="padding: 10px;"></span>', FALSE, 
                                 ['value' => $url, 'onclick' => 'js:openPopUp(this);', 'title' => 'Atualiar']);
                                    
                                },
                            
                            
                        ],'header'=>'', 'contentOptions' => ['style' => 'width:90px;'],
                        'dropdown'=>false,'order'=>DynaGrid::ORDER_FIX_RIGHT],
                ],
            ]);
            ?>
        </div>
    </div>
</div>