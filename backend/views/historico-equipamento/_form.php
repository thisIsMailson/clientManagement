<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HistoricoEquipamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historico-equipamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_alteracao')->textInput() ?>

    <?= $form->field($model, 'equipamento_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'utilizador_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
