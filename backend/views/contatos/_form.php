<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Tipo;
use backend\models\Concelho;
use backend\models\Canal;
use backend\models\Clientes;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Contatos */
/* @var $form yii\widgets\ActiveForm */
$this->title = '';
?>
<style type="text/css">

</style>
    <div class="contatos-form">
         <?php $form = ActiveForm::begin(); ?>

            <div class="panel-group">
                <div class="panel panel-primary">
                  <div class="panel-heading">Dados do cliente</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            

                            <?= $form->field($model,'cliente_id')->widget(Select2::classname(),[
                                'data' => $client,
                                'class'=>'form-control col-md-7 col-xs-12',
                                'maintainOrder' => true,
                                'toggleAllSettings' => [
                                    'selectOptions' => ['class' => 'text-success'],
                                    'unselectOptions' => ['class' => 'text-danger'],
                                ],
                                'options' => ['placeholder' => 'Escolha um cliente', 'multiple' => false],
                                'pluginOptions' => [
                                    'tags' => false,
                                    'maximumInputLength' => 100
                                ]
                            ])->label(false); 
                        ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                                $model->clienteNovo = $model->clienteNovo;
                                echo $form->field($model, 'clienteNovo')->radioList([0=>'Sim', 1 => 'Não']);
                            ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="panel-group cliNovo">
                <div class="panel panel-success">
                  <div class="panel-heading">Dados do cliente</div>
                  <div class="panel-body">
                      
                       <div class="form-row">
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'FocalPoint')->textInput(['maxlength' => true]) ?>
                            </div>
                        
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'concelho_id')->dropDownList(
                                ArrayHelper::map(Concelho::find()->all(), 'id', 'nome'),['prompt'=>'--Selecione um concelho--']
                            );?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'contato')->textInput(['maxlength' => true]) ?>
                            </div>
                        
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'type'=>'email']) ?>
                            </div>
                        </div>
                  </div>
                </div>
            </div>

            <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">Detalhes do contato</div>
                  <div class="panel-body">
                      
                       <div class="form-row">
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'canal_id')->dropDownList(
                                    ArrayHelper::map(Canal::find()->all(), 'id', 'canal'),['prompt'=>'--Selecione um canal--']
                                );?>
                            </div>
                        
                            <div class="form-group col-md-3">
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
                            </div>
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'tipo_id')->dropDownList(
                                    ArrayHelper::map(Tipo::find()->all(), 'id', 'nome'),['prompt'=>'--Selecione um tipo--','onchange'=>'
                                                var selectedOpt = this.value;

                                                    if (selectedOpt == "1") { 
                                                        $("div.interacao-periodica").show();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.interacao-upsell-crossell").hide();
                                                        $("div.interacao-aleter-consumo").hide();
                                                        $("div.interacao-retecao").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.proposta").hide(); 
                                                        $("div.produtosGCVT").hide();
                                                    } else if (selectedOpt == "2") {
                                                        $("div.interacao-periodica").hide();
                                                        $("div.interacao-upsell-crossell").hide();
                                                        $("div.interacao-aleter-consumo").hide();
                                                        $("div.interacao-retecao").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.proposta").show();
                                                        $("div.produtosGCVT").show();
                                                        $("div.produto-concorrencia").hide();
                                                        $("div.clienteConcorrencia").show();
                                                    }else if (selectedOpt == "3") {
                                                        $("div.interacao-periodica").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.interacao-upsell-crossell").show();
                                                        $("div.interacao-aleter-consumo").hide();
                                                        $("div.interacao-retecao").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.proposta").show();
                                                        $("div.produtosGCVT").hide();
                                                    }else if (selectedOpt == "4") {
                                                        $("div.interacao-periodica").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.interacao-upsell-crossell").hide();
                                                        $("div.interacao-aleter-consumo").show();
                                                        $("div.interacao-retecao").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.proposta").show();
                                                        $("div.produtosGCVT").hide();
                                                    }else if (selectedOpt == "5") {
                                                        $("div.interacao-periodica").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.interacao-upsell-crossell").hide();
                                                        $("div.interacao-aleter-consumo").hide();
                                                        $("div.interacao-retecao").show();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.proposta").show();
                                                        $("div.produtosGCVT").hide();
                                                    } else if (selectedOpt == "6") {
                                                        $("div.interacao-periodica").hide();
                                                        $("div.interacao-analise-credito").hide();
                                                        $("div.interacao-upsell-crossell").hide();
                                                        $("div.interacao-aleter-consumo").hide();
                                                        $("div.interacao-retecao").hide();
                                                        $("div.interacao-analise-credito").show();
                                                        $("div.proposta").show();
                                                        $("div.produtosGCVT").hide();
                                                    }
                                                ']
                                );?>
                            </div>
                        
                        </div>
                  </div>
                </div>
            </div>


            <div class="panel-group interacao-periodica">
                <div class="panel panel-primary">
                  <div class="panel-heading">Interação Periódica</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6 custom-control custom-checkbox">

                            <?= $form->field($model, 'interacoes1')->checkboxList(
                                ['Contato Charme' => 'Contato Charme', 'Contato CharmePV' => 'Contato charme pós-venda',
                                'Apresentacao Servico' => 'Apresentação serviços', 'Esclarecimento Servico' => 'Esclarecimento serviço',
                                'Esclareciemto Fatura' => 'Esclarecimento fatura', 'Equipamento Avariado' => 'Equipamento avariado',
                                'Contrato Cedencia' => 'Contrato cedência', 'Reclamacao' => 'Reclamação', 'Outros' => 'Outros'], ['class'=> 'custom-control-input','id'=>'defaultUnchecked','separator'=>'<br />', 'prompt' => '--Escolha a interação--']) ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'observacao')->textarea(['rows' => '3']) ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="panel-group interacao-analise-credito">
                <div class="panel panel-primary">
                  <div class="panel-heading">Interação Análise de credito</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'interacoes2')->dropDownList(
                                ['cliente ativo divida' => 'Cliente ativo com divida', 'cliente inativo divida' => 'Cliente inativo com divida'], ['prompt' => '--Escolha a interação--']) ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="panel-group interacao-upsell-crossell">
                <div class="panel panel-primary">
                  <div class="panel-heading">Interação Upsell/Crossell</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'interacoes3')->dropDownList(
                                ['Upsell' => 'Upsell', 'Crossell' => 'Crossell'], ['prompt' => '--Escolha a interação--']) ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="panel-group interacao-aleter-consumo">
                <div class="panel panel-primary">
                  <div class="panel-heading">Interação alteração de consumo</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'interacoes4')->dropDownList(
                                ['Aumento Consumo' => 'Aumento Consumo', 'Reducao Consumo' => 'Redução Consumo'], ['prompt' => '--Escolha a interação--']) ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="panel-group interacao-retecao">
                <div class="panel panel-primary">
                  <div class="panel-heading">Interação de Retenção</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?= $form->field($model, 'interacoes5')->dropDownList(
                                ['Cancelamento Servico' => 'Pedido de Cancelamento Serviço', 'Deixou Consumir' => 'Cliente Deixou de Consumir'], ['prompt' => '--Escolha a interação--']) ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="panel-group produtosGCVT">
                <div class="panel panel-primary">
                  <div class="panel-heading">Produtos GCVT</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <?php  
                                     $model->produtosGCVT = json_decode($model->produtosGCVT);
                                     echo $form->field($model,'produtosGCVT')->widget(Select2::classname(),[
                                        'data' => $product,
                                        'value'=>$value,
                                        'class'=>'form-control col-md-7 col-xs-12',
                                        'maintainOrder' => true,
                                        'toggleAllSettings' => [
                                            'selectOptions' => ['class' => 'text-success'],
                                            'unselectOptions' => ['class' => 'text-danger'],
                                        ],
                                        'options' => ['placeholder' => 'Produtos', 'multiple' => true],
                                        'pluginOptions' => [
                                            'tags' => true,
                                            'maximumInputLength' => 100
                                        ]
                                    ])->label(false); 
                                ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="panel-group clienteConcorrencia">
                <div class="panel panel-success">
                  <div class="panel-heading">Cliente Concorrência</div>
                  <div class="panel-body">
                      
                       <div class="form-row">
                        
                            <div class="form-group col-md-3">
                                <?php
                                    $model->clienteConcorrencia = $model->clienteConcorrencia;
                                    echo $form->field($model, 'clienteConcorrencia')->radioList([2=> 'Sim', 3 => 'Não']);
                                ?>
                            </div>
                            <div class="form-group col-md-3 produto-concorrencia">
                                <?php
                                    $produtosConcorrencia = ['movel' => 'Móvel', 'internet' => 'Internet', 'fixo' => 'Fixo', 'acessoDedicado' => 'Acesso Dedicado', 'mkonekta'=>'Mkonekta'];
                                    $model->produtoConcorrencia = json_decode($model->produtoConcorrencia);
                                    echo $form->field($model, 'produtoConcorrencia')->checkboxList($produtosConcorrencia
                                , ['prompt' => '--Escolhe um produto--', 'separator'=>'</br>']) ?>
                            </div>
                        
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'informacaoAdicional')->textarea(['rows' => '3']) ?>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
            
            <div class="panel-group proposta">
                <div class="panel panel-warning">
                  <div class="panel-heading">Proposta</div>
                  <div class="panel-body">
                      
                       <div class="form-row">
                            <div class="form-group col-md-12">
                                <?= $form->field($model, 'propostaAceite')->dropDownList(
                                    ['sim' => 'Sim', 'nao' => 'Não', 'na'=>'N/A'], ['prompt' => '--Escolha uma opção--', 'onchange'=>'
                                    var estadoPorp = this.value;
                                    if (estadoPorp == "sim"){
                                        $("div.prop-sim").show();
                                        $("div.prop-nao").hide();
                                        $("div.prop-na").hide();
                                    } 
                                    if (estadoPorp == "nao") {
                                        $("div.prop-na").hide();
                                        $("div.prop-nao").show();
                                        $("div.prop-sim").hide();
                                    }
                                    if (estadoPorp == "na") {
                                        $("div.prop-na").show();
                                        $("div.prop-nao").hide();
                                        $("div.prop-sim").hide();
                                    }
                                    if (estadoPorp == "na") $("div.prop-sim").hide();
                                    if (estadoPorp == "nao") $("div.prop-nao").show();
                                    ']) ?>
                            </div>
                        </div>
                        <div class="form-row prop-sim col-md-12">
                            <div class="form-group col-md-3">
                               <?php
                                    $model->servicos = json_decode($model->servicos);
                                    echo $form->field($model, 'servicos')->checkboxList(
                                    ['gp' => 'GP', 'gppp' => 'GPPP', 'posPago'=>'Pós-Pago'], ['separator'=>'<br />', 'prompt' => '--Escolha uma opção--']) 
                                ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'valorServicoTotal')->textInput(['type' => 'number', 'min'=>0]) ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'valorPrestacao')->textInput(['type' => 'number', 'min'=>0]) ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'nubCartoesAngariados')->textInput(['type' => 'number', 'min'=>0]) ?>
                            </div>
                            <div class="form-group col-md-4">
                                <?= $form->field($model, 'observacao2')->textarea(['rows' => '3']) ?>
                            </div>
                        </div>

                        <div class="form-row prop-nao col-md-12">
                            <div class="form-group col-md-3">                                
                                <?php
                                    $model->motivoRecusa = json_decode($model->motivoRecusa);
                                    echo $form->field($model, 'motivoRecusa')->checkboxList(
                                    ['Preço' => 'Preço', 'Oferta' => 'Oferta'], ['prompt' => '--Escolha uma opção--']) ?>
                            </div>
                            <div class="form-group col-md-4">
                                <?= $form->field($model, 'observacao3')->textarea(['rows' => '3']) ?>
                            </div>
                        </div>
                        <div class="form-row prop-na col-md-12">
                            <div class="form-group col-md-4">
                                <?= $form->field($model, 'observacao4')->textarea(['rows' => '3']) ?>
                            </div>
                        </div>
                  </div>
                </div>
            </div>

            <div class="panel-group nivel-satisfacao">
                <div class="panel panel-success">
                  <div class="panel-heading">Nivel de Satisfação</div>
                  <div class="panel-body">
                      
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <?= $form->field($model, 'nivelSatisfacao')->dropDownList(
                                    ['satisfeito' => 'Satisfeito', 'Muito Satisfeito' => 'Muito Satisfeito',
                                    'insatisfeito' => 'Insatisfeito', 'Muito Insatisfeito' => 'Muito Insatisfeito',
                                    ], ['prompt' => '--Nível de Satisfação--', 'onchange'=>'
                                        var option = this.value;
                                        if (option == "satisfeito" || option == "Muito Satisfeito" ) $("div.razao-insatisfacao").hide();

                                        if (option == "insatisfeito" || option == "Muito Insatisfeito" ) $("div.razao-insatisfacao").show();

                                    ']) ?>
                            </div>
                        
                            <div class="form-group col-md-6 razao-insatisfacao">
                                <?php
                                    $model->razoesinsatisfacao = json_decode($model->razoesinsatisfacao);
                                    echo $form->field($model, 'razoesinsatisfacao')->checkboxList(
                                        ['gestor' => 'Gestor', 'linhaApoio' => 'Linha de Apoio',
                                        'servico' => 'Servico', 'qualidadeAtendimento' => 'Qualidade Atendimento',
                                        'qualidadeServico' => 'Qualidade Serviço', 'incidente' => 'Incidente'], ['separator'=>'<br/>', 'prompt' => '--Escolhe um produto GCVT--']);
                                ?>
                            </div>
                        </div>
                  </div>
                </div>
            </div>

            <div class="panel-group alerta">
                <div class="panel panel-danger">
                  <div class="panel-heading">Alerta, Oportunidade e Ações</div>
                  <div class="panel-body">
                      
                       <div class="form-row">
                            <div class="form-group col-md-3">
                                <?php
                                    $alertas = ["contactCenter"=>"Contact Center", "rede"=>"Rede", "concorrencia"=>"Concorrência", "acampamentoComercial"=>"Acampamento Comercial", "nenhum"=>"Nenhum"]; 
                                ?>
                                <?php 
                                    $model->alertas = json_decode($model->alertas);
                                    echo $form->field($model, 'alertas')->checkboxList($alertas,['separator'=>'<br/>']);
                                ?>
                            </div>
                       
                            <div class="form-group col-md-3">
                                <?php
                                    $oportunidades = ["melhoria"=>"Melhoria", "venda"=>"Venda", "nenhum"=>"Nenhum"]; 
                                ?>
                                <?php 
                                    $model->oportunidades = json_decode($model->oportunidades);
                                    echo $form->field($model, 'oportunidades')->checkboxList($oportunidades,['separator'=>'<br/>']);
                                ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?php
                                    $acoes = ["informarAreaCompetente"=>"Informar Área Competente", "aoresentarProposta"=>"Apresentar Proposta", "nenhum"=>"Nenhum"]; 
                                ?>
                                <?php
                                    $model->acoes = json_decode($model->acoes);
                                    echo $form->field($model, 'acoes')->checkboxList($acoes,['separator'=>'<br/>']);
                                ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= $form->field($model, 'observacao5')->textarea(['rows' => '3']) ?>
                            </div>
                        </div>
                  </div>
                </div>
            </div>

             <div class="panel-group dados-notifcação">
                <div class="panel panel-primary">
                  <div class="panel-heading">Dados Notificação</div>
                  <div class="panel-body">
                      
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?= $form->field($model, 'dataNotificacao')->widget(
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
                                <?= $form->field($model, 'EstadoNotificacao')->dropDownList(
                                    ['ativo' => 'Ativo', 'inativo' => 'Inativo'], ['prompt' => '--Escolhe uma opção--']) ?>
                            </div>
                    </div>
                    <div class="form-group col-md-3">
                                <?= $form->field($model, 'observacaoNotificacao')->textarea(['rows' => '3']) ?>
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
        $("div.clienteConcorrencia").hide();
        $("div.interacao-periodica").hide();
        $("div.produtosGCVT").hide();
        $("div.interacao-analise-credito").hide();
        $("div.interacao-upsell-crossell").hide();
        $("div.interacao-aleter-consumo").hide();
        $("div.interacao-retecao").hide();
        $("div.interacao-analise-credito").hide();

        $("div.proposta").hide();

        $('div.desc').hide();
        $('div.cliNovo').hide();

        $("div.prop-nao").hide();
        $("div.prop-na").hide();
        $("div.prop-sim").hide();
        $("div.razao-insatisfacao").hide();

        $("div.interacao-periodica").hide();
        $("div.interacao-analise-credito").hide();
        $("div.interacao-upsell-crossell").hide();
        $("div.interacao-aleter-consumo").hide();
        $("div.interacao-retecao").hide();
        $("div.interacao-analise-credito").hide();
        $("div.produto-concorrencia").hide();


    });
        $("input[type=radio]").on( "change", function() {

            var opt = $(this).val();
            if (opt == "0") { // 0 -> cliente novo sim
                $('div.desc').hide();
                $('div.cliNovo').show();

            } else if (opt == "1") { // 1 -> cliente novo nao
                $("div.prop-nao").hide();
                $("div.prop-na").hide();
                $("div.prop-sim").hide();
                $("div.razao-insatisfacao").hide();

                $("div.clienteConcorrencia").hide();
                $('div.cliNovo').hide();
                $('div.desc').show();
                $("div.interacao-analise-credito").hide();
                $("div.interacao-upsell-crossell").hide();
                $("div.interacao-aleter-consumo").hide();
                $("div.interacao-retecao").hide();
                $("div.interacao-analise-credito").hide();
            }

            if (opt == "2") {} $("div.produto-concorrencia").show();
            if (opt == "3") $("div.produto-concorrencia").hide();
        });

JS;
$this->registerJs($script);

 ?>