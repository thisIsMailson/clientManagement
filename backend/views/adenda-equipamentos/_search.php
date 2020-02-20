<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdendaEquipamentosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adenda-equipamentos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'equipamento_id') ?>

    <?= $form->field($model, 'adenda_id') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'preco') ?>

    <?php // echo $form->field($model, 'PrecoTotal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
