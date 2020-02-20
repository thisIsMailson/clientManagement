<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Equipamentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'estado_equipamento')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
