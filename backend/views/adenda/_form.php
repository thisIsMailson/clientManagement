<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use backend\models\Equipamentos;
use backend\models\Adendas;
use backend\models\Clientes;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Adendas */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Adenda';
?>
<div class="adendas-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="panel-group">
            <div class="panel panel-primary">
              <div class="panel-heading">Identificação do cliente</div>
              <div class="panel-body">
                  
                   <div class="form-row">
                    <div class="form-group col-md-12">
                        <?= $form->field($model, 'nomecli')->textInput(['readonly'=>true]) 
                        ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'dataInicioContrato')->textInput(['readonly'=>'true']) ?>
                    </div>
                    <div class="form-group col-md-4">
                         <?= $form->field($model, 'dataFimContrato')->textInput(['readonly'=>'true']) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($model, 'periodoFidelizacao')->textInput(['readonly'=>'true']) ?>
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
                            <?= $form->field($model, 'cartoesPosPago')->textInput(['readonly'=>'true']) ?>
                        </div>
                    
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'cartoesPrePago')->textInput(['readonly'=>'true']) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'totalCartoes')->textInput(['readonly'=>'true']) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'valorPosPago')->textInput(['readonly'=>'true']) ?>
                        </div>
                    
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'valorPrePago')->textInput(['readonly'=>'true']) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'total')->textInput(['readonly'=>'true']) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'carregamentoFaturMini')->textInput(['type'=>'number', 'min'=>0]) ?>
                        </div>
                        <div class="form-group col-md-8">
                           <?php

                                $model->servicos = json_decode($model->servicos);
                                echo $form->field($model, 'servicos')->checkboxList(['GP' => 'GP', 'GP TOP' => 'GP TOP', 'GPPP' => 'GPPP', 'GPPP TOP' => 'GPPP TOP', 'Pós-Pago' => 'Pós-Pago', 'CVT' => 'CVT', 'CVMM' => 'CVMM'], ['separator'=> '<br />', 'uncheckValue'=>'0','checkAll' => true]);
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
            ]);
             ?>
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
                                            echo Html::activeHiddenInput($modelsEquipamento, "[{$i}]id");
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

                                                            let quantidadeIni = $("#totalQuantidadelId").val();
                                                            let quantidadeDada = $(this).val();

                                                            let precoIni = $("#precoTotal").val();


                                                            let oldPrice = total.val() - precoIni;

                                                            let precoDado = total.val();

                                                            if (!isNaN(quantidadeIni)) {
                                                                let somaQuantidade = parseInt(quantidadeIni) + parseInt(quantidadeDada);
                                                                $("#totalQuantidadelId").val(somaQuantidade);
                                                               // $("#field1ID").val(0);
                                                               // $("#field1ID").val(somaQuantidade*500);
                                                            }

                                                            if (!isNaN(quantidadeIni)) {
                                                                let somaPreco = parseInt(precoIni) + parseInt(precoDado) - primPrice;
                                                                $("#precoTotal").val(somaPreco);
                                                            }
 
                                                        ', 'class'=>'quantidade', 'min'=>0, 'onclick'=>'quantityCheckChange($(this))'])  ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelsEquipamento, "[{$i}]PrecoTotal")->textInput(['readonly'=>true, 'type' => 'number', 'min'=>0]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>
                 <div class="form-row">
                <div class="form-group col-md-4">
                     <?php
                        $model->quantidadeTotal =  $model->quantidadeTotal;
                        echo $form->field($model, 'quantidadeTotal')->textInput(['type'=>'number', 'id'=>'totalQuantidadelId', 'min'=>0]) ?>
                </div>
                <div class="form-group col-md-4">
                    <?php
                        $model->precoTotal =  $model->precoTotal;
                        echo $form->field($model, 'precoTotal')->textInput(['type'=>'number', 'id'=>'precoTotal',  'min'=>0]) ?>
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
                             <?= $form->field($model, 'valorMaximo')->textInput() ?>
                        </div>
                    
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'valorPago')->textInput(['id'=>'field1ID']) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= $form->field($model, 'valorAdicional')->textInput(['id'=>'field2ID']) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= $form->field($model, 'totalPropostapagamento')->textInput(['readonly'=> true,'id'=>'resultFieldID']) ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'guiaSaida')->textInput(['maxlength' => true]) ?>
                        </div>
                    
                        <div class="form-group col-md-3">
                             <?= $form->field($model, 'numTalaoDeposito')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group col-md-3">
                           <?= $form->field($model, 'numRecibo')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= $form->field($model, 'simulador')->dropDownList(['Excede' => 'Excede', 'Ok'=> 'Ok'], ['prompt'=>'Escolha uma opção']) ?>
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
                         <?= $form->field($model, 'taxaEsforcoNegociavel')->textInput(['type'=>'number', 'min'=>0]) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($model, 'taxaEsforcoTotal')->textInput(['type'=>'number', 'min'=>0]) ?>
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

        // $.ajax({
        //     method: "POST",
        //     url: "index.php?r=cedencias/lists&id=" + $(this).val(),
        //     invokedata: {
        //         callingSelect: $(this)
        //     }
        // })
        // .done(function( data ) {
        //     var data = $.parseJSON(data);
        //     if (data !== null) {

        //         //if yes fill the form fields
        //         $("#priceField").attr(id);

        //         this.invokedata.callingSelect.parent().parent().next().find("input").val(data.preco);    

        //     } else {
        //         alert("Were sorry but we couldnt load the location data!"); 
        //     }
        //     $("select#models-contact" ).html(data);
        // });

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
   
    // function that will collect values from both fields and populate result field

    function populateResult(){

        var val1 = parseInt($('#field1ID').val());

        var val2 = parseInt($('#field2ID').val());

        // calculate

        var sum = (val1 + val2); 

        // populate result field

        $('#resultFieldID').val(sum);

    }

    function subtractIt(val) {
        var quantidade = val.parent().parent().parent().find('.quantidade').val();
        var prcoTotalProd = val.parent().parent().parent().find('.precoTotProd').val();

        var quantidadeTtl =  $("#totalQuantidadelId").val();
        var precoTtl = $("#precoTotal").val();

        var subtratQuantidade = quantidadeTtl - quantidade; 
        var subtratPreco = precoTtl - prcoTotalProd;
        
        $("#totalQuantidadelId").val(subtratQuantidade);
        $("#precoTotal").val(subtratPreco);

        $("#field1ID").val(0);
        $("#field1ID").val(subtratQuantidade*500);
    }

    function quantityCheckChange(val) {
        let quantidadeTtl = parseInt($("#totalQuantidadelId").val());
        let initVal = val.val();

        val.on("change", function(){
            let newVal = parseInt(val.val());
            let newQuantity = Math.abs(quantidadeTtl - initVal + newVal);

            $("#totalQuantidadelId").val(newQuantity);

            $("#field1ID").val(0);
            $("#field1ID").val(newQuantity*500);

        });

    }


JS;
$this->registerJs($script);

 ?>
