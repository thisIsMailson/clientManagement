<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use lo\widgets\Toggle;


/* @var $this yii\web\View */
/* @var $model backend\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model,'gestor_id')->widget(Select2::classname(),[
                                'data' => $user,
                                'class'=>'form-control col-md-7 col-xs-12',
                                'maintainOrder' => true,
                                'toggleAllSettings' => [
                                    'selectOptions' => ['class' => 'text-success'],
                                    'unselectOptions' => ['class' => 'text-danger'],
                                ],
                                'options' => ['placeholder' => 'Escolha um gestor', 'multiple' => false],
                                'pluginOptions' => [
                                    'tags' => false,
                                    'maximumInputLength' => 100
                                ]
                            ]); 
                        ?>

    <?= $form->field($model, 'observacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->widget(
                                        DatePicker::className(), [
                                        // inline too, not bad
                                         'inline' => false, 
                                         // modify template for custom rendering
                                       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-m-d',
                                            'todayHighlight' => true
                                        ]
    ]);?>

    <?= $form->field($model, 'estado')->dropDownList(
                                ['ativo' => 'Ativar', 'inativo' => 'Desativar'], ['prompt' => 'Escolha uma opção']) ?>

    <?= $form->field($model, 'alvo')->widget(Toggle::className()); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
