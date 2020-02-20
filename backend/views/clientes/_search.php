<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

     <div class="row" style="margin-right:0; margin-bottom:10px; margin-left:0">
        <?= $form->field($model, 'globalSearch',['template' =>'
        <div class="input-group col-sm-4 pull-right">
            {input}
             <span class="input-group-addon">
                      <span id="openPopup" class="fa fa-search"></span>
            </span>
        </div>'])->label(false) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
