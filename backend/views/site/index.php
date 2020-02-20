<?php
use backend\models\User;
use yii\helpers\Html;
use yii\helpers\ArrayHelper; 
use dosamigos\datepicker\DatePicker;

/* @let $this yii\web\View */

$this->title = ' Dashboard';

?>

<div class="site-index">
		<div class="body-content">
				<?php 

					$user_id = \Yii::$app->user->identity->id;
					$user_role = \Yii::$app->user->identity->role_id;
					$currentDate = date("Y-m-d");
			        $currentMonth = date("m",strtotime($currentDate));
			        $currentYear = date("Y",strtotime($currentDate));

			        $meta = (new \yii\db\Query())
								->select('meta as meta')
								->from('metas')
								->where('YEAR(data) = ' . $currentYear)
								->all();
								foreach ($meta as $key) {
									$meta = intval($key['meta']);
								}

			        if ($user_role != 1){ 
						$angariacoesDataSet = (new \yii\db\Query())
								->select('count(id) as val, data as label')
								->from('contatos')
								->where('clienteNovo = 1 and propostaAceite = "sim" AND user_id = ' . $user_id .' AND YEAR(data) = ' . $currentYear)
								->distinct()
								->all();

						$totalCartoesCedencia = (new \yii\db\Query())
								->select('dataInicioContrato as label, sum(totalCartoes) as val')
								->from('cedencias')
								->where('user_id = '. $user_id . ' AND YEAR(dataInicioContrato) = ' . $currentYear)
								->distinct()
								->all();
									        
				        $contatoDataSet = (new \yii\db\Query())
				                ->select('data as label, count(id) as val')
				                ->from('contatos')
				                ->where('user_id = ' . $user_id .' AND YEAR(data) = ' . $currentYear)                
				                ->distinct()
				                ->orderby('data')
				                ->all();
				        
				        $cedenciaDataSet = (new \yii\db\Query())
				                ->select('dataInicioContrato as label, count(id) as val')
				                ->from('cedencias')
				                ->where('user_id = ' . $user_id .' AND YEAR(dataInicioContrato) = ' . $currentYear )                      
				                ->distinct()
				                ->all();

				        $adendaDataSet = (new \yii\db\Query())
				                ->select('dataEntrega as label, count(id) as val')
				                ->from('adendas')
				                ->where('user_id = ' . $user_id .' AND YEAR(dataEntrega) = ' . $currentYear)         
				                ->distinct()
				                ->all();

				        $totalContatoCount = (new \yii\db\Query())
		                        ->select('COUNT(id) as val')
		                        ->from('contatos')
		                        ->where('user_id = ' . $user_id .' AND YEAR(data) = ' . $currentYear)
		                        ->distinct()
		                        ->count();

                        if ($totalContatoCount > 0) {
                        	$totalContatoDataSet = (new \yii\db\Query())
		                        ->select('COUNT(id) as val, MONTHNAME(data) as label')
		                        ->from('contatos')
		                        ->where('user_id = ' . $user_id .' AND YEAR(data) = ' . $currentYear) 
		                        ->groupby('MONTHNAME(data)') 
		                        ->orderby('data')
		                        ->distinct()
		                        ->all();
                        } else {
                        	$totalContatoDataSet = (new \yii\db\Query())
		                        ->select('COUNT(id) as val, MONTHNAME(data) as label')
		                        ->from('contatos')
		                        ->where('user_id = ' . $user_id .' AND YEAR(data) = ' . $currentYear)
		                        ->all();
                        }
				        
		            } else if ($user_role == 1) {
		            	$angariacoesDataSet = (new \yii\db\Query())
								->select('count(id) as val, data as label')
								->from('contatos')
								->where('clienteNovo = 1 and propostaAceite = "sim" AND YEAR(data) = ' . $currentYear)
								->distinct()
								->all();

						$totalCartoesCedencia = (new \yii\db\Query())
								->select('dataInicioContrato as label, sum(totalCartoes) as val')
								->from('cedencias')
								->where('YEAR(dataInicioContrato) = ' . $currentYear)
								->distinct()
								->all();
									        
				        $contatoDataSet = (new \yii\db\Query())
				                ->select('data as label, count(id) as val')
				                ->from('contatos')
				                ->where('YEAR(data) = ' . $currentYear)                             
				                ->distinct()
				                ->orderby('data')
				                ->all();
				        
				        $cedenciaDataSet = (new \yii\db\Query())
				                ->select('dataInicioContrato as label, count(id) as val')
				                ->from('cedencias')
				                ->where('YEAR(dataInicioContrato) = ' . $currentYear)                      
				                ->distinct()
				                ->all();

				        $adendaDataSet = (new \yii\db\Query())
				                ->select('dataEntrega as label, count(id) as val')
				                ->from('adendas')
				                ->where('YEAR(dataEntrega) = ' . $currentYear)         
				                ->distinct()
				                ->all();

				        $totalContatoCount = (new \yii\db\Query())
		                        ->select('COUNT(id) as val, MONTHNAME(data) as label')
		                        //->set('lc_time_names = pt_PT')
		                        ->from('contatos')
		                        ->where('YEAR(data) = ' . $currentYear) 
		                        ->groupby('MONTHNAME(data)') 
		                        ->orderby('data')
		                        ->distinct()
		                        ->count();
		                        if ($totalContatoCount > 0) {
		                        	$totalContatoDataSet = (new \yii\db\Query())
				                        ->select('COUNT(id) as val, MONTHNAME(data) as label')
				                        //->set('lc_time_names = pt_PT')
				                        ->from('contatos')
				                        ->where('YEAR(data) = ' . $currentYear) 
				                        ->groupby('MONTHNAME(data)') 
				                        ->orderby('data')
				                        ->distinct()
				                        ->all();
		                        } else {
		                        	$totalContatoDataSet = (new \yii\db\Query())
				                        ->select('COUNT(id) as val, MONTHNAME(data) as label')
				                        //->set('lc_time_names = pt_PT')
				                        ->from('contatos')
				                        ->where('YEAR(data) = ' . $currentYear)
				                        ->orderby('data')
				                        ->distinct()
				                        ->all();
		                        }

				       
		                        
		            }

			        $totalContatoOutput = [["Contatos", "atual", "meta"]];
			        foreach($totalContatoDataSet as $row) {
			               $totalContatoOutput[] = [$row['label'], intval($row['val']), $meta];
					}


			        $adendaOutput = [["Adendas", "concluido"]];
			        foreach($adendaDataSet as $row) {
			              $adendaOutput[] = [$row['label'], $row['val']];
			        }

			        $cedenciaOutput = [["Cedencias", "concluido"]];
			        foreach($cedenciaDataSet as $row) {
		                	$cedenciaOutput[] = [$row['label'], $row['val']];
			        }

			        $contatoOutput = [["data", "values"]];
			        foreach($contatoDataSet as $row) {
			            $contatoOutput[] = [$row['label'], $row['val']];
			        }
					
					$angariacoesOutput = [["Cedencias", "Angariacoes"]];
					$CartoesCedenciaOutput = [["Cartoes", "total"]];
					

					foreach($angariacoesDataSet as $row) {
							$angariacoesOutput[] = [$row['label'], $row['val']];
					} 
					
					foreach($totalCartoesCedencia as $row) {
							$CartoesCedenciaOutput[] = [$row['label'], $row['val']];
					}


					$userNotification = (new \yii\db\Query())
		                        ->select('observacao')
		                        ->from('notification')
		                        ->where('(gestor_id = '. $user_id .' OR alvo = 1) AND estado = "ativo"')
		                        ->all();
		                        
		            if (count($userNotification) > 0) {
						foreach ($userNotification as $key) {
							$userNotification = $key['observacao'];
							Yii::$app->session->setFlash('success', $userNotification);
						}
		            } 
					
					
				?>
			<div class="container">
				<div class="panel-group">
	                <div class="panel panel-default">
		                <div class="panel-heading">
		                	<div class="row">
		                		<div class="col-md-8">
		                			<h3 class="panel-title">Performance de Contato</h3>
		                		</div>
	                		 	<div class="form-group col-md-2 date-selection">
	                                <?= DatePicker::widget([
										    'name' => 'generated_date',
										    'template' => '{addon}{input}',
										    'value' => date('Y'),
								        	'clientOptions' => [
								        		'defaultDate' => date('Y'),
									            'autoclose' => true,
									            'startView'=>'year',
												'minViewMode'=>'years',
												'format' => 'yyyy',
												'todayHighlight' => true
								        	], 
								        	'options' => ['onchange'=>'
								        		let year = $(this).val();

									        	$("div.doughnut-charts").show();
											    $("div.total-contato").show();

										        let user = $(this).parent().parent().next().find(":selected").val();
										        if(user) {
										        	js:display(user, year);
										        } else {
										        	js:display("gestor", year); // null se user for gestor
										        }
      										'],
										]);
									?>
	                        	</div>
		                		<div class="col-md-2 user-selection" >
		                			<?= Html::dropDownList('id', null,
		      										ArrayHelper::map(User::find()->all(), 'id', 'name'),['name'=>'name', 'prompt'=>'Selecione um Gestor', 'style' => 'width: 100%; height: 34px;', 'onchange'=>'
														    $("div.doughnut-charts").show();
														    $("div.total-contato").show();
																 
		      												let date = $(this).parent().prev().find("input").val();

		      												js:display($(this).val(), date);
		      										'],['visible' => \Yii::$app->user->identity->role_id == 0] )?>
		                		</div>
		                	</div>
		                </div>
	                <div class="panel-body">
	                	<div class="row">
							<div class="col-md-12">

							<div id="chart_div" style="width: auto; height: 500px; padding: 25px; display: block"></div>
								
								<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
								<script type="text/javascript">
							      google.charts.load('current', {'packages':['corechart']});
							      google.charts.setOnLoadCallback(drawVisualization);

							      function drawVisualization() {
							        // Some raw data (not necessarily accurate)
							        var data = google.visualization.arrayToDataTable(<?= json_encode($totalContatoOutput)?>);

							        var options = {
						         	 	title : 'Número de contatos por mês',
							          	titleTextStyle: {
												color:'#8e8e8e',
												fontSize: 18,
										},
										colors: ['#09F4F6', '#048aff'],
										vAxis: {title: 'Contatos'},
          								hAxis: {title: 'Mês'},
							          	visibleInLegend: false, 
							          	seriesType: 'bars',
							          	series: {12: {type: 'line'}},
								      	animation: {
				                        	"startup": true,
				                        	duration: 1500,
				                        	easing: 'out'
				                      	}
							        };

							        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
							        chart.draw(data, options);
							      }
							    </script>
							</div> 

						</div>


						<div class="row align-items-center doughnut-charts">
							<div class="col-md-4">
								<div id="contatoChart" style="width: auto; height: 100%; margin-top: 10%; display: block">
								</div>
								 <script type="text/javascript">
								 	google.charts.load('current', {'packages':['corechart', 'controls']});
									google.charts.setOnLoadCallback(drawContatoChart);

									 function drawContatoChart() {
										  const data = new google.visualization.arrayToDataTable(<?= json_encode($contatoOutput) ?>);

										  let options = {
										      title: 'Contatos',
										      pieHole: 0.3,
										      legend:'none',
										      pieSliceTextStyle: {
										        color: '#8e8e8e',
										        fontSize:18,
										      },
										       titleTextStyle: {
										        color:'#8e8e8e',
										        fontSize: 18,
										       },
										      tooltip: {
										        trigger:'none'
										      },
										      pieSliceText: 'value',
										      colors: ['#16e9af'],
										    };
										  let chart = new google.visualization.PieChart(document.getElementById('contatoChart'));
										  chart.draw(data, options);

										      function resizeHandler () {
										          chart.draw(data, options);
										      }
										      if (window.addEventListener) {
										          window.addEventListener('resize', resizeHandler, false);
										      }
										      else if (window.attachEvent) {
										          window.attachEvent('onresize', resizeHandler);
										      }
										}
									</script>
							</div>

							<div class="col-md-4 ">
								<div id="cedenciaChart" style="width: auto; height: 100%; margin-top: 10%; display: block">
								</div>
									<script type="text/javascript">
										google.charts.load('current', {'packages':['corechart', 'controls']});
										google.charts.setOnLoadCallback(drawCedenciaChart);

										function drawCedenciaChart() {
											const data = new google.visualization.arrayToDataTable(<?= json_encode($cedenciaOutput) ?>);

											let options = {
											  title: 'Cedências',
											  titleTextStyle: {
											      color:'#8e8e8e',
											      fontSize: 18,
											  },
											  pieHole: 0.3,
											  legend:'none',
											  pieSliceTextStyle: {
											    color: '#8e8e8e',
											    fontSize:18,
											  },
											  tooltip: {
											      trigger:'none'
											  },     
											  pieSliceText: 'value',
											  colors: ['#1ecbe1'],
											};


											let chart = new google.visualization.PieChart(document.getElementById('cedenciaChart'));
											chart.draw(data, options);

											function resizeHandler () {
											  chart.draw(data, options);
											}
											if (window.addEventListener) {
											  window.addEventListener('resize', resizeHandler, false);
											}
											else if (window.attachEvent) {
											  window.attachEvent('onresize', resizeHandler);
											}
											}

									</script>
							</div> 

							<div class="col-md-4">
								<div id="adendaChart" style="width: auto; height: 100%; margin-top: 10%; display: block">
								</div>
									<script type="text/javascript">
										google.charts.load('current', {'packages':['corechart', 'controls']});
										google.charts.setOnLoadCallback(drawAdendaChart);
										function drawAdendaChart() {

										    const data = new google.visualization.arrayToDataTable(<?= json_encode($adendaOutput)?>);

										    let options = {
									          	title: 'Adendas',
									          	pieHole: 0.3,
									          	titleTextStyle: {
									          	  	color:'#8e8e8e',
								           			fontSize: 18,
									          	},
									          	legend:'none',
									          	pieSliceTextStyle: {
									            	color: '#8e8e8e',
									            	fontSize:18,
									         	},
										        tooltip: {
										               trigger:'none'
										        },
									         	pieSliceText: 'value',
									         	colors: ['#1aa0e5'],
										     };

									      	let donutRangeSlider = new google.visualization.ControlWrapper({
									            'controlType': 'NumberRangeFilter',
									            'containerId': 'filter_div',
									            'options': {
									              'filterColumnLabel': 'Donuts eaten'
									            }
									        });
									      	let chart = new google.visualization.PieChart(document.getElementById('adendaChart'));
									      	chart.draw(data, options);

									        function resizeHandler () {
									            chart.draw(data, options);
									        }
								          	if (window.addEventListener) {
						        			    window.addEventListener('resize', resizeHandler, false);
									        }
									        else if (window.attachEvent) {
									            window.attachEvent('onresize', resizeHandler);
									        }
										}		
									</script>
								
							</div>          
						</div>

						
						<div class="col-md-6">
								<div id="angariacoesChart" style="width: auto; height: 100%; margin-top: 10%; display: block">
								</div>
									 <script type="text/javascript">
											google.charts.load('current', {'packages':['corechart', 'controls']});
											google.charts.setOnLoadCallback(drawChar);

											function drawChar() {

											const data = new google.visualization.arrayToDataTable(<?=json_encode($angariacoesOutput)?>);

											let options = {
													title: 'Angariações',
													titleTextStyle: {
															color:'#8e8e8e',
															fontSize: 18,
													},
													pieHole: 0.3,
													legend:'none',
													pieSliceTextStyle: {
														color: '#8e8e8e',
														fontSize:18,
													},
													tooltip: {
															trigger:'none'
													},     
													pieSliceText: 'value',
													colors: ['#17d0e8'],
												};

											let donutRangeSlider = new google.visualization.ControlWrapper({
														'controlType': 'NumberRangeFilter',
														'containerId': 'filter_div',
														'options': {
															'filterColumnLabel': 'Donuts eaten'
														}
													});
											let chart = new google.visualization.PieChart(document.getElementById('angariacoesChart'));
											chart.draw(data, options);

													function resizeHandler () {
															chart.draw(data, options);
													}
													if (window.addEventListener) {
															window.addEventListener('resize', resizeHandler, false);
													}
													else if (window.attachEvent) {
															window.attachEvent('onresize', resizeHandler);
													}
										}
									</script>
						</div>

						<div class="col-md-6">
								<div id="totalCartoesChart" style="width: auto; height: 100%; margin-top: 10%;">
								</div>
									 <script type="text/javascript">
											google.charts.load('current', {'packages':['corechart', 'controls']});
											google.charts.setOnLoadCallback(drawChar);

											function drawChar() {

											const data = new google.visualization.arrayToDataTable(<?=json_encode($CartoesCedenciaOutput)?>);

											let options = {
													title: 'Número de Cartões',
													titleTextStyle: {
															color:'#8e8e8e',
															fontSize: 18,
													},
													pieHole: 0.3,
													legend:'none',
													pieSliceTextStyle: {
														color: '#8e8e8e',
														fontSize:18,
													},
													tooltip: {
															trigger:'none'
													},     
													pieSliceText: 'value',
													colors: ['#11afee'],
												};

											let chart = new google.visualization.PieChart(document.getElementById('totalCartoesChart'));
											chart.draw(data, options);

													function resizeHandler () {
															chart.draw(data, options);
													}
													if (window.addEventListener) {
															window.addEventListener('resize', resizeHandler, false);
													}
													else if (window.attachEvent) {
															window.attachEvent('onresize', resizeHandler);
													}
										}
									</script>
								</div> 
			
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
$script = <<< JS
	$(document).ready(function() {
		$.getScript('https://www.gstatic.com/charts/loader.js');
		//$("div.doughnut-charts").hide();
		//$("div.total-contato").hide();
		
		//js:display(0, 0);
	});
	function hideThem(){
		$("div.user-selection").hide();
	}

JS;
$this->registerJs($script);

?>


<?php 
	if (\Yii::$app->user->identity->role_id == 0) { 

		$script2 = <<< JS
		 $(document).ready(function() {
					
					$("div.user-selection").hide();
					$('div.date-selection').css('float','right');

			});
			function hideThem(){
				
			}

JS;
$this->registerJs($script2);
	}
?>