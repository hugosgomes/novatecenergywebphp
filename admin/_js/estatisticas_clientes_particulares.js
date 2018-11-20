//ESTATÍSTICAS ORÇAMENTOS
        var wc_chart = Highcharts.chart('jwc_chart_container_orcamentos', {
          chart: {
                type:'pie',
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
                "name": "Em Análise",
                "y": 10,
                color: '#579C87'
              },
              {
                "name": "Agendados",
                "y": 10,
                color: ''
              },
              {
                "name": "Executados",
                "y": 10,
                color: '#415B76'
              },
              {
                "name": "Cancelados",
                "y": 10,
                color: ''
              },
              {
                "name": "Recusados",
                "y": 10,
                color: '#F23C50'
              }
              ]
            }
            ]
          });

//ESTATÍSTICAS ORÇAMENTOS
var wc_chart = Highcharts.chart('jwc_chart_container_clientes', {
  chart: {
        type:'pie',
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
          text: ''
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
      "name": "Clientes",
      "colorByPoint": true,
      "data": [
      {
        "name": "Desatendidos",
        "y": 40,
        color: '#579C87'
      },
      {
        "name": "Sem Agendar",
        "y": 10,
        color: '#F2B134'
      }
      ]
    }
    ]
  });

//GRÁFICO SERVIÇOS
 var wc_chart = Highcharts.chart('jwc_chart_container_servicos', {
  chart: {
    type: 'line',
    spacingBottom: 0,
    spacingTop: 5,
    spacingLeft: 0,
    spacingRight: 20
  },
  title: {
    text: 'Estatística Serviços',
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
      text: 'Serviços Realizados'
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
    categories: ['01/2018','02/2018','03/2018','04/2018','05/2018','06/2018','07/2018','08/2018','09/2018','10/2018','11/2018','12/2018'],
    minTickInterval: 1
  },
  series: [
  {
    name: 'Serviços',
    data: [100,80,110,150,130,120,100,110,140,115,130,120],
    color: '#579C87',
    lineColor: '#579C87'
  },
  {
    name: 'Executados',
    data: [30,10,20,30,40,35,20,20,20,22,30,35],
  },
  {
    name: 'Serviços Faturados',
    data: [15,10,10,20,25,22,25,15,18,20,30,30],
    color: '#0E96E5',
    lineColor: '#0E96E5'
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
    categories: ['Aplicação de Resina','Tubulação de Gás','Adequação de Vistoria','Remanejamento','Síndico','Desobstrução da Tubulação de Gás',
    'Teste de Estanqueidade','Análise de Ambientes','Outros'],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'quantidade',
      align: 'high'
    },
    labels: {
      overflow: 'justify'
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
    data: [100, 90, 50, 60,100,150,130,150,120],
    color: '#415B76'
  }]
});


function iniciaPagina(){
  var dataAtual = new Date();
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');

  document.getElementById('j_mes_t').selectedIndex = dataAtual.getMonth()+1;
}

//BUTTON UP
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}