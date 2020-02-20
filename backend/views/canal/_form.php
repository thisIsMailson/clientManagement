<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Canal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="canal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'canal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
