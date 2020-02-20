$(function(){
	$('#contatoButton').click(function(){
		$('#modal').modal('show')
		.find('#modalContent')
		.load($(this).attr('value'));
	});
});

function openPopUpVer(obj){
         $('#modal-id-ver').modal('show')
            .find('#modalContentVer')
            .load($(obj).attr('value'));
}

function openPopUpEditar(obj){
         $('#modal-id-editar').modal('show')
            .find('#modalContentEditar')
            .load($(obj).attr('value'));
}

function openPopUp(obj){
         $('#modal-id-indicador').modal('show')
            .find('#modalContentInd')
            .load($(obj).attr('value'));
            console.log(obj);
}

function display(userId, date) {
  getContato(userId, date);
  getCedencia(userId, date);
  getAdenda(userId, date);
  getAngariacao(userId, date);
  getCartao(userId, date);
  getTotalContato(userId, date);
  getTotalCartaoChart(userId, date);

}

// The data fetch happens here

function getContato(userId, date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=contatos/list&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawContatoChart(data);
  });

}

function getCedencia(userId, date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=cedencias/list&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawCedenciaChart(data);
  });

}

function getAdenda(userId, date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=adenda/list&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawAdendaChart(data);
  });

}

function getAngariacao(userId, date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=contatos/angariacao&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawAngariacaoChart(data);
  });

}

function getCartao(userId, date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=contatos/list&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawChar(data);
  });

}
function getTotalContato(userId, date) {
   $.ajax({
        method: "POST",
        url: "index.php?r=contatos/total&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawTotalContatoChart(data);
  });
}

function getTotalCartaoChart(userId, date) {
   
   $.ajax({
        method: "POST",
        url: "index.php?r=cedencias/cartao&id="+userId+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
     console.log(data);
      drawTotalCartaoChart(data);
  });
}

// The charts drawing happens here

google.charts.load('current', {'packages':['corechart', 'controls']});
google.charts.setOnLoadCallback();
function drawContatoChart(dat) {
  const data = new google.visualization.arrayToDataTable(dat);

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

  let donutRangeSlider = new google.visualization.ControlWrapper({
        'controlType': 'NumberRangeFilter',
        'containerId': 'filter_div',
      });
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

function drawCedenciaChart(dat) {
      const data = new google.visualization.arrayToDataTable(dat);

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


function drawAdendaChart(dat) {

      const data = new google.visualization.arrayToDataTable(dat);

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

function drawAngariacaoChart(dat) {

      const data = new google.visualization.arrayToDataTable(dat);

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

function drawTotalCartaoChart(dat) {

      const data = new google.visualization.arrayToDataTable(dat);
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
          animation: {
            "startup": true,
            duration: 1500,
            easing: 'out'
          },     
          pieSliceText: 'value',
          colors: ['#11afee'],
        };

      let donutRangeSlider = new google.visualization.ControlWrapper({
            'controlType': 'NumberRangeFilter',
            'containerId': 'filter_div',
            'options': {
              'filterColumnLabel': 'Donuts eaten'
            }
          });
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

function drawTotalContatoChart(dat) {
      let data = google.visualization.arrayToDataTable(dat);

      let options = {
        title : 'Número de contatos por mês',
        titleTextStyle: {
            color:'#8e8e8e',
            fontSize: 18,
        },
        colors: ['#09F4F6', '#048aff'],
        animation: {
          "startup": true,
          duration: 1500,
          easing: 'out'
        },
        visibleInLegend: false, 
        seriesType: 'bars',
        series: {12: {type: 'line'}}        
      };

      let chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
      chart.draw(data, options);
}