<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CedenciaEquipamentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cedencia-equipamentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipamento_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedencia_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'PrecoTotal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
