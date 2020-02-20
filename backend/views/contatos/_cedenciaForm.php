
<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use backend\models\Equipamentos;
use backend\models\Adendas;
use dosamigos\datepicker\DatePicker;
use backend\models\Clientes;

/* @var $this yii\web\View */
/* @var $model backend\models\Cedencias */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Adicionar Cedencia';
?>
    <div class="cedencias-form">

        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>



        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">Identificação do cliente</div>
                <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?php
                                $client = Clientes::findOne($contato->cliente_id);
                                echo $form->field($model, 'nomeCliente')->textInput(['readonly'=>true, 'value'=>$client->nome]) 
                            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'refedilizacao')->radioList([0=>'Sim', 1=>'Não']) ?>
                        </div>
                    </div>
                    <div class="form-group col-md-12"></div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'dataInicioContrato')->widget(
                                DatePicker::className(), [
                                    'inline' => false,
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-m-d',
                                        'todayHighlight' => true
                                    ]
                            ]);?>
                        </div>
                        <div class="form-group col-md-4">
                             <?= $form->field($model, 'dataFimContrato')->widget(
                                DatePicker::className(), [
                                // inline too, not bad
                                 'inline' => false, 
                                 // modify template for custom rendering
                               // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-m-d'
                                ]
                            ]);?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'periodoFidelizacao')->textInput(['type'=>'number', 'min'=>0]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group">
            <div class="panel panel-success">
              <div class="panel-heading">Cartões e serviços</div>
              <div class="panel-body">
                  
                   <div class="form-row">
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'cartoesPosPago')->textInput(['id'=>'cartoesPrePago', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'cartoesPrePago')->textInput(['id'=>'cartoesPosPago', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'totalCartoes')->textInput(['readonly'=>true, 'id'=>'totalCartoes', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'valorPosPago')->textInput(['id'=>'valorPosPago', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'valorPrePago')->textInput(['id'=>'valorPrePago', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'total')->textInput(['readonly'=>true, 'id'=>'totalValor', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'carregamentoFaturMini')->textInput(['type'=>'number', 'min'=>0]) ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'servicos')->checkboxList(['GP' => 'GP', 'GP TOP' => 'GP TOP', 'GPPP' => 'GPPP', 'GPPP TOP' => 'GPPP TOP', 'Pós-Pago' => 'Pós-Pago', 'CVT' => 'CVT', 'CVMM' => 'CVMM'], ['separator'=> '<br />', 'uncheckValue'=>'0','checkAll' => true]);
                            ?>
                        </div>
                    
                    </div>
              </div>
            </div>
        </div>
        <div class="row">

            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be added (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsEquipamento[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'Equipamento',
                    'Adenda',
                ],
            ]); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                             Equipamentos
                            <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Adicionar</button>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="container-items"><!-- widgetBody -->
                            <?php foreach ($modelsEquipamento as $i => $modelsEquipamento): ?>
                                    <div class="item panel panel-default"><!-- widgetItem -->
                                        <div class="panel-heading">
                                            <h3 class="panel-title pull-left">Equipamento</h3>
                                            <div class="pull-right">
                                                <button type="button" class="remove-item btn btn-danger btn-xs" onclick="subtractIt($(this))"><i class="glyphicon glyphicon-minus"></i></button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                                // necessary for update action.
                                                if (! $modelsEquipamento->isNewRecord) {
                                                    echo Html::activeHiddenInput($modelPoItem, "[{$i}]id");
                                                }
                                            ?>
                                            
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <?= $form->field($modelsEquipamento, "[{$i}]equipamento_id")->dropDownList(
                                                        ArrayHelper::map(Equipamentos::find()->orderby('nome asc')->all(), 'id', 'nome'), 
                                                        ['prompt'=>'Selecione um equipamento','onchange'=>'

                                                        $.ajax({
                                                            method: "POST",
                                                            url: "index.php?r=equipamentos/lists&id='.'"+$(this).val(),
                                                            invokedata: {
                                                                callingSelect: $(this)
                                                            }
                                                        })
                                                        .done(function( data ) {
                                                            var data = $.parseJSON(data);
                                                            if (data !== null) {

                                                                //if yes fill the form fields
                                                                $("#priceField").attr(id);

                                                                this.invokedata.callingSelect.parent().parent().next().find("input").val(data.preco);    

                                                            } else {
                                                                alert("Were sorry but we couldnt load the location data!"); 
                                                            }
                                                            $("select#models-contact" ).html(data);
                                                        });
                                                        ' ]) ?>

                                                </div>
                                                <div class="col-sm-3">
                                                    <?= $form->field($modelsEquipamento, "[{$i}]preco")->textInput(['readonly'=> true, 'maxlength' => 128, 'id'=>'price']) ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?= $form->field($modelsEquipamento, "[{$i}]quantidade")->textInput(['type'=>'number', 'maxlength' => 128, 'onchange'=>'
                                                            // Preço e preço total de cada equipamento

                                                            let preco = $(this).parent().parent().prev().find("input").val();
                                                            let total = $(this).parent().parent().next().find("input");
                                                            let primPrice = total.val();

                                                            total.val(preco * $(this).val());

                                                            // Quantidade total de todos os equipamentos

                                                            let quantidadeIni = $("#quantidadeTotal").val();
                                                            let quantidadeDada = $(this).val();

                                                            let precoIni = $("#precoTotal").val();


                                                            let oldPrice = total.val() - precoIni;

                                                            let precoDado = total.val();

                                                            if (!isNaN(quantidadeIni)) {
                                                                let somaQuantidade = parseInt(quantidadeIni) + parseInt(quantidadeDada);
                                                                $("#quantidadeTotal").val(somaQuantidade);
                                                               // $("#field1ID").val(0);
                                                               // $("#field1ID").val(somaQuantidade*500);
                                                            }

                                                            if (!isNaN(quantidadeIni)) {
                                                                let somaPreco = parseInt(precoIni) + parseInt(precoDado) - primPrice;
                                                                $("#precoTotal").val(somaPreco);
                                                            }
 
                                                        ', 'class'=>'quantidade', 'min'=>0, 'onclick'=>'quantityCheckChange($(this))']) 
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?= $form->field($modelsEquipamento, "[{$i}]PrecoTotal")->textInput(['readonly'=>true, 'type' => 'number',  'class'=>'precoTotProd']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                 <?= $form->field($model, 'quantidadeTotal')->textInput(['readonly'=>true, 'type'=>'number', 'id'=>'quantidadeTotal', 'min'=>0]) ?>
                            </div>
                            <div class="form-group col-md-4">
                                <?= $form->field($model, 'precoTotal')->textInput(['readonly'=>true, 'type'=>'number', 'id'=>'precoTotal', 'min'=>0]) ?>
                            </div>
                            <div class="form-group col-md-4">
                                <?= $form->field($model, 'dataEntrega')->widget(
                                DatePicker::className(), [
                                // inline too, not bad
                                 'inline' => false,
                                 // modify template for custom rendering
                               // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-m-d'
                                ]
                            ]);?>
                            </div>
                        </div>
                    </div>

                </div><!-- .panel -->
            <?php DynamicFormWidget::end(); ?>

        </div>
        <div class="panel-group">
            <div class="panel panel-danger">
              <div class="panel-heading">Proposta/Pagamento</div>
                <div class="panel-body">
                  
                    <div class="form-row">
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'valorMaximo')->textInput(['type'=>'number', 'min'=>0]) ?>
                        </div>
                    
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'valorPago')->textInput(['id'=>'field1ID', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= $form->field($model, 'valorAdicional')->textInput(['id'=>'field2ID', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= $form->field($model, 'totalPropostapagamento')->textInput(['readonly'=> true,'id'=>'resultFieldID', 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'guiaSaida')->textInput(['maxlength' => true, 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'numTalaoDeposito')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group col-md-3">
                           <?= $form->field($model, 'numRecibo')->textInput(['maxlength' => true, 'type'=>'number', 'min'=>0]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-warning">
              <div class="panel-heading">Taxa Esforço</div>
              <div class="panel-body">
                  
                <div class="form-row">
                    <div class="form-group col-md-6">
                         <?= $form->field($model, 'taxaEsforcoNegociavel')->textInput() ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($model, 'taxaEsforcoTotal')->textInput() ?>
                    </div>
                </div>
              </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php 
$script = <<< JS


    $(document).ready(function() {
        if ($("#quantidadeTotal").val("")) {
            $("#quantidadeTotal").val(0);
        }
        if ($("#precoTotal").val("")) {
            $("#precoTotal").val(0);
        }
    });
   $('#field1ID').on('change', function() {
        populateResult();
    }); 
    $(".dynamicform_wrapper").on("limitReached", function(e, item) {
        alert("Limit reached");
    });

    $('#field2ID').on('change', function() {
        populateResult();
    });


    $('#cartoesPrePago').on('change', function() {
        populateCartFields();
    }); 
    $("#cartoesPosPago").on("change", function() {
        populateCartFields();
    });

    $('#valorPosPago').on('change', function() {
        populateVaFields();
    }); 
    $("#valorPrePago").on("change", function() {
        populateVaFields();
    });

    function subtractIt(val) {
        var quantidade = val.parent().parent().parent().find('.quantidade').val();
        var prcoTotalProd = val.parent().parent().parent().find('.precoTotProd').val();

        var quantidadeTtl =  $("#quantidadeTotal").val();
        var precoTtl = $("#precoTotal").val();

        var subtratQuantidade = quantidadeTtl - quantidade; 
        var subtratPreco = precoTtl - prcoTotalProd;
        
        $("#quantidadeTotal").val(subtratQuantidade);
        $("#precoTotal").val(subtratPreco);

        $("#field1ID").val(0);
        $("#field1ID").val(subtratQuantidade*500);
    }
      
    // function that will collect values from both fields and populate result field
    function populateCartFields() {

        var cartoesPrePago = parseInt($('#cartoesPrePago').val());
        var cartoesPosPago = parseInt($('#cartoesPosPago').val());
        var totalCartoes = $('#totalCartoes');

        var somaCartoes = (cartoesPrePago + cartoesPosPago);
        
        totalCartoes.val(somaCartoes);

    }

    function quantityCheckChange(val) {
        let quantidadeTtl = parseInt($("#quantidadeTotal").val());
        let initVal = val.val();

        val.on("change", function(){
            let newVal = parseInt(val.val());
            let newQuantity = Math.abs(quantidadeTtl - initVal + newVal);

            $("#quantidadeTotal").val(newQuantity);

            $("#field1ID").val(0);
            $("#field1ID").val(newQuantity*500);

        });

    }

    function populateVaFields() {

        var valorPosPago = parseInt($('#valorPosPago').val());
        var valorPrePago = parseInt($('#valorPrePago').val());
        var totalValor = $('#totalValor');
        
        var somaValor = (valorPosPago + valorPrePago);

        totalValor.val(somaValor);
    
    }


    function populateResult(){

        var val1 = parseInt($('#field1ID').val());

        var val2 = parseInt($('#field2ID').val());

        // calculate

        var sum = (val1 + val2); 

        // populate result field
        
        $('#resultFieldID').val(sum);

    }

JS;
$this->registerJs($script);

 ?>