<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContatosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contatos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

 <div class="row" style="margin-right:0; margin-bottom:10px; margin-left:0">
    <?= $form->field($model, 'globalSearch', [
            'template' => '
            <div class="input-group col-md-4 pull-right">
                {input}
                <span class="input-group-btn">' .
                Html::submitButton('GO', ['class' => 'btn btn-default']) .
            '</span></div>',
        ])->textInput(['placeholder' => 'Search']);
    ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>
