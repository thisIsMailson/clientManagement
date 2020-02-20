<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

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

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
