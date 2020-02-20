<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Metas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metas-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="row">
    	<div class="form-group col-md-2 date-selection">
	    <?= $form->field($model, 'data')->widget(
	        DatePicker::className(), [
	        // inline too, not bad
	        'name' => 'data',
		    'template' => '{addon}{input}',
		    'value' => date('Y'),
        	'clientOptions' => [
        		'defaultDate' => date('Y'),
	            'autoclose' => true,
	            'format' => 'yyyy-m-d',
	            'startView'=>'year',
				'minViewMode'=>'years',
				'todayHighlight' => true
        	],  
	    ]);?>
	</div>
	<div class="col-md-2">
		
	    <?= $form->field($model, 'meta')->textInput(['type'=>'number', 'min'=>0]) ?>

	</div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
