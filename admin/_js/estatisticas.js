$(document).ready(function(){
  iniciaPagina();
  atualiza();
});

$('#j_ano_t, #j_mes_t, #j_semana_s').change(atualiza);

function atualiza(){

  var Callback = $("input[name='callback']").val();
  var ano = $('#j_ano_t').val();
  var mes = $('#j_mes_t').val();
  var semana = $('#j_semana_s').val();

  $.post('_ajax/gns/'+Callback+'.ajax.php',{ano: ano, mes: mes, semana: semana, callback: Callback},function(data){
    
    if(data){
      carregaGraficos(data);
      $('#j_totalTecnicos tr').replaceWith(data.LegendaTecnicos);
      $('#j_estat_orcamento tr').remove();
      $('#j_estat_orcamento').append(data.LegendaEstarOrcam);
      $('#j_estat_orcamentoAprov tr').remove();
      $('#j_estat_orcamentoAprov').append(data.LegendaOrcamAprov);
      $('#j_estat_clientes').replaceWith(data.LegendaEstatClientes);
      $('#j_estat_clientes_line *').replaceWith(data.SomaLinhaClienteLine);
    }
  }, 'json');
}


function carregaGraficos(data){

  //CONVERTENDO OS VALORES JSON PARA INTEIRO PARA O GRÁFICO DE ESTATÍSTICAS TÉCNICOS
  data.Atendimentos.forEach(function(element, index, array){
    data.Atendimentos[index] = parseInt(data.Atendimentos[index]);
    data.Aprovados[index] = parseInt(data.Aprovados[index]);
    data.Reprovados[index] = parseInt(data.Reprovados[index]);
  });

  data.GraficoServicoSerie.forEach(function(element, index, array){
    data.GraficoServicoSerie[index] = parseInt(data.GraficoServicoSerie[index]);
  });

  data.LinhaClienteLineGreen.forEach(function(element, index, array){
    data.LinhaClienteLineGreen[index] = parseInt(data.LinhaClienteLineGreen[index]);
  });

  data.LinhaClienteLineBlue.forEach(function(element, index, array){
    data.LinhaClienteLineBlue[index] = parseInt(data.LinhaClienteLineBlue[index]);
  });

  data.LinhaClienteLineRed.forEach(function(element, index, array){
    data.LinhaClienteLineRed[index] = parseInt(data.LinhaClienteLineRed[index]);
  });

  //ESTATÍSTICAS TÉCNICOS *****************************************
  var wc_chart = Highcharts.chart('jwc_chart_container_tecnicos', {
    chart: {
    type:'column',//DETERMINA O FORMATO DO GRÁFICO
    spacingBottom: 0,
    spacingTop: 5,
    spacingLeft: 0,
    spacingRight: 20
  },
  title: {
    text: 'Estatística Técnicos',
    style: {
      fontWeight: 'bold'
    }
  },
  subtitle: {
    text: null
  },
  yAxis: {
    allowDecimals: false,
    title: {
      text: 'Estatística Técnicos'
    }
  },
  tooltip: {
    useHTML: true,
    shadow: false,
    headerFormat: '<p class="al_center" style="color:white">{point.key}</p><p class="al_center" style="font-size: 2em; color:white;">{point.y}</p>',
    pointFormat: '<p class="al_center" style="color:white">{series.name}</p><p class="al_center"></p>',
    backgroundColor: 'rgba(87, 125, 216, 0.60)',
    borderWidth: 0,
    padding: 20,
    style: {
     color:'#fff',
     fontWeight:'bold',
     color:'#fff',
   }
 },
 xAxis: {
    categories: data.Tecnicos,//NOME DO TÉCNICO ABAIXO DO GRÁFICO  
    minTickInterval: 1 //ESPAÇO ENTRE AS DATAS EXIBIDAS ABAIXO DO GRÁFICO
  },
  series: [
  {
    name: 'Atendimentos',
      data: data.Atendimentos,//EXIBE QTD DE ATENDIMENTOS REALIZADOS PELO TÉCNICO
      color: '#415B76',
      lineColor: '#B25900'
    },
    {
      name: 'Orçamentos Aprovados',
      data: data.Aprovados,//EXIBE QTD DE ORÇAMNTOS APROVADOS
      color: '#579C87',
      lineColor: '#006699'
    },
    {
      name: 'Orçamentos Reprovados',
      data: data.Reprovados,//EXIBE QTD DE ORÇAMENTOS REPROVADOS
      color: '#F23C50',
      lineColor: '#008068'
    }
    ]
  });

        //ESTATÍSTICAS ORÇAMENTOS
        var wc_chart = Highcharts.chart('jwc_chart_container_orcamentos', {
          chart: {
        type:'pie',//DETERMINA O FORMATO DO GRÁFICO
        spacingBottom: 0,
        spacingTop: 5,
        spacingLeft: 0,
        spacingRight: 20
      },
      title: {
        text: 'Estatística Orçamentos',
        style: {
          fontWeight: 'bold'
        }
      },
      subtitle: {
        text: false
      },
      yAxis: {
        allowDecimals: false,
        title: {
          text: 'Estatísticas Técnicos'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: false
          },
          showInLegend: true
        }
      },
      tooltip: {
        useHTML: true,
        shadow: false,
        headerFormat: '<p class="al_center" style="color:white">{point.key}</p><p class="al_center" style="font-size: 2em; color:white;">{point.y}</p>',
        pointFormat: '<p class="al_center" style="color:white">{series.name}</p><p class="al_center"></p>',
        backgroundColor: 'rgba(87, 125, 216, 0.60)',
        borderWidth: 0,
        padding: 20,
        style: {
         color:'#fff',
         fontWeight:'bold',
         color:'#fff',
       }
     },
     "series": [
     {
      "name": "Orçamentos",
      "colorByPoint": true,
      "data": [
      {
        "name": "Aprovados",
        "y": parseInt(data.PizzaOrcamentosAprov),
        color: '#579C87',
      },
      {
        "name": "Recuperados",
        "y": parseInt(data.PizzaOrcamentosRecup),
        color: '#F2B134',
      },
      {
        "name": "Executados",
        "y": parseInt(data.PizzaOrcamentosExec),
        color: '#415B76'
      },
      {
        "name": "Recusados",
        "y": parseInt(data.PizzaOrcamentosReprov),
        color: '#F23C50'
      }
      ]
    }
    ]
  });

  //ESTATÍSTICAS ORÇAMENTOS APROVADOS***************************************
  var wc_chart = Highcharts.chart('jwc_chart_container_orcamentos_aprovados', {
    chart: {
        type:'pie',//DETERMINA O FORMATO DO GRÁFICO
        spacingBottom: 0,
        spacingTop: 5,
        spacingLeft: 0,
        spacingRight: 20
      },
      title: {
        text: 'Orçamentos Aprovados',
        style: {
          fontWeight: 'bold'
        }
      },
      subtitle: {
        text: false
      },
      yAxis: {
        allowDecimals: false,
        title: {
          text: 'Estatísticas Técnicos'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: false
          },
          showInLegend: true
        }
      },
      tooltip: {
        useHTML: true,
        shadow: false,
        headerFormat: '<p class="al_center" style="color:white">{point.key}</p><p class="al_center" style="font-size: 2em; color:white;">{point.y}</p>',
        pointFormat: '<p class="al_center" style="color:white">{series.name}</p><p class="al_center"></p>',
        backgroundColor: 'rgba(87, 125, 216, 0.60)',
        borderWidth: 0,
        padding: 20,
        style: {
         color:'#fff',
         fontWeight:'bold',
         color:'#fff',
       }
     },
     "series": [
     {
      "name": "Orçamentos",
      "colorByPoint": true,
      "data": [
      {
        "name": "Executados",
        "y": parseInt(data.PizzaOrcamentosExec),
        color: '#415B76',
      },
      {
        "name": "Recuperados",
        "y": parseInt(data.PizzaOrcamentosRecup),
        color: '#F2B134',
      },
      {
        "name": "Aprovados",
        "y": parseInt(data.PizzaOrcamentosAprov),
        color: '#579C87'
      },
      ]
    }
    ]
  });

      //ESTATÍSTICAS CLIENTES
      var wc_chart = Highcharts.chart('jwc_chart_container_clientes', {
        chart: {
        type:'pie',//DETERMINA O FORMATO DO GRÁFICO
        spacingBottom: 0,
        spacingTop: 5,
        spacingLeft: 0,
        spacingRight: 20
      },
      title: {
        text: 'Estatística Clientes',
        style: {
          fontWeight: 'bold'
        }
      },
      subtitle: {
        text: false
      },
      yAxis: {
        allowDecimals: false,
        title: {
          text: 'Estatísticas Técnicos'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: false
          },
          showInLegend: true
        }
      },
      tooltip: {
        useHTML: true,
        shadow: false,
        headerFormat: '<p class="al_center" style="color:white">{point.key}</p><p class="al_center" style="font-size: 2em; color:white;">{point.y}</p>',
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
        backgroundColor: 'rgba(87, 125, 216, 0.60)',
        borderWidth: 0,
        padding: 20,
        style: {
         color:'#fff',
         fontWeight:'bold',
         color:'#fff',
       }
     },
     "series": [
     {
      "name": "Clientes",
      "colorByPoint": true,
      "data": [
      {
        "name": "Atendidos",
        "y": parseInt(data.PizzaEstatClientesAtend),
        color: '#415B76',
      },
      {
        "name": "Cancelados",
        "y": parseInt(data.PizzaEstatClientesCanc),
        color: '#F2B134',
      },
      {
        "name": "Ausentes",
        "y": parseInt(data.PizzaEstatClientesAus),
        color: '#D76880'
      },
      {
        "name": "Reagendados NVT",
        "y": parseInt(data.PizzaEstatClientesReagNVT),
        color: '#0695AB'
      },
      {
        "name": "Reagendados GNS",
        "y": parseInt(data.PizzaEstatClientesReagGNS),
        color: '#88D89E'
      },
      {
        "name": "Sem Atender",
        "y": parseInt(data.PizzaEstatClientesSemAtender),
      }
      ]
    }
    ]
  });

  //GRÁFICO CLIENTES

  var wc_chart = Highcharts.chart('jwc_chart_container_servicos', {
    chart: {
      type: 'line',
      spacingBottom: 0,
      spacingTop: 5,
      spacingLeft: 0,
      spacingRight: 20
    },
    title: {
      text: 'Estatística Clientes',
      style: {
        fontWeight: 'bold'
      }
    },
    subtitle: {
      text: ''
    },
    yAxis: {
      allowDecimals: false,
      title: {
        text: ''
      }
    },
    tooltip: {
      useHTML: true,
      shadow: false,
      headerFormat: '<p class="al_center" style="color:white">{point.key}</p><p class="al_center" style="font-size: 2em; color:white;">{point.y}</p>',
      pointFormat: '<p class="al_center" style="color:white">{series.name}</p><p class="al_center"></p>',
      backgroundColor: 'rgba(87, 125, 216, 0.60)',
      borderWidth: 0,
      padding: 20,
      style: {
        padding: 20,
        color: '#fff'
      }
    },
    xAxis: {
      categories: data.LinhaClienteEixoX,
      minTickInterval: 1
    },
    series: [
    {
      name: 'Clientes Recebidos',
      data: data.LinhaClienteLineGreen,
      color: '#579C87',
      lineColor: '#579C87'
    },
    {
      name: 'Clientes Atendidos',
      data: data.LinhaClienteLineBlue,
      color: '#0E96E5',
      lineColor: '#0E96E5'
    },
    {
      name: 'Clientes Orçados',
      data: data.LinhaClienteLineRed,
      color: '#F23C50',
      lineColor: '#F23C50'
    },
    ]
  });

 //GRÁFICO DE SERVIÇOS
 Highcharts.chart('jwc_chart_container_servicos_s', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Gráfico serviços',
    style: {
      fontWeight: 'bold'
    }
  },
  subtitle: {
    text: ''
  },
  xAxis: {
    categories: data.GraficoServico,
    tickPositioner: function () {
      var positions = [];
      for (var i = 0; i <= data.GraficoServico.length; i++) {
        positions.push(i);
      }
      return positions;
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Quantidade'
    }
  },
  tooltip: {
    valueSuffix: '',
    useHTML: true,
    shadow: false,
    headerFormat: '<p class="al_center" style="color:white">{point.key}</p><p class="al_center" style="font-size: 2em; color:white;">{point.y}</p>',
    pointFormat: '<p class="al_center" style="color:white">{series.name}</p><p class="al_center"></p>',
    backgroundColor: 'rgba(87, 125, 216, 0.60)',
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: 0,
    y: 0,
    floating: true,
    borderWidth: 1,
    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: '2018',
    data: data.GraficoServicoSerie,
    color: '#415B76'
  }]
});
}

function iniciaPagina(){
  var dataAtual = new Date();
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');

  document.getElementById('j_mes_t').selectedIndex = dataAtual.getMonth()+1;

}
