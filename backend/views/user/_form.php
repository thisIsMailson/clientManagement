<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use lo\widgets\Toggle;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = '';
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
            <div class="x_content">
                <div class="x_title">
                    <h2>User <small><?= ($model->isNewRecord ? 'Registar':'Atualizar'). ' User' ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <br />
                <?php $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'form-horizontal form-label-left'
                             ]
                            ]); ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Foto 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                         <?= $form->field($model, 'photo')->fileInput()->label(false) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true,'class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true,'class'=>'form-control col-md-7 col-xs-12'])->label(false) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Perfil <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model,'profile')->widget(Select2::classname(),[
                            'data' => $profile,
                            'value'=>$value,
                            'class'=>'form-control col-md-7 col-xs-12',
                            'maintainOrder' => true,
                            'toggleAllSettings' => [
                                'selectOptions' => ['class' => 'text-success'],
                                'unselectOptions' => ['class' => 'text-danger'],
                            ],
                            'options' => ['placeholder' => 'Associar Perfil', 'multiple' => true],
                            'pluginOptions' => [
                                'tags' => true,
                                'maximumInputLength' => 100
                            ]
                        ])->label(false); 
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Papel <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'role_id')->dropDownList([1 => 'Administrador', 0 => 'Gestor'], ['prompt' => 'Escolha um papel'])->label(false);?>
                    </div>
                </div>
                <?php 
                    if(!$model->isNewRecord ){ ?> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ver Tudo <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <?= $form->field($model, 'view_option')->widget(Toggle::className())->label(false); ?>
                            </div>
                        </div>
                <?php 
                    } 
                ?>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">
                      <?= Html::submitButton('<i class="fa fa-save"></i> '.($model->isNewRecord ? 'Registar' : 'Atualizar'), ['class' => 'btn btn-primary']) ?>              
                     <?= Html::a('<i class="fa fa-list"></i>'.' Ir para lista de user', ['index'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?> 
            </div>
        </div>
    </div>
</div>
