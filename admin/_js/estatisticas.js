/*

$('#j_ano_t').change(atualiza);

atualiza();

function atualiza(){
  //ESTATÍSTICAS TÉCNICOS
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
  categories: ['ADHEMAR DA SILVA FARIAS NETO','ALEXANDRE VITOR DE OLIVEIRA E SILVA','BRUNO PEREIRA MARQUES','CARLOS HENRIQUE FREITAS DE CASTILHO','CASSIO ANTONIO DE ALMEIDA','EDUARDO JOSÉ VALENTIM CORREA','FABIANO FERREIRA DOS SANTOS','FABIO RODRIGUES PEREIRA','FELIPE LUIZ FERREIRA DA SILVA LOUZADA','JACKSON COSME CESCON FERREIRA','LUCIO CESAR MARÇAL E SILVA','LUIZ CARLOS DA SILVA JUNIOR','MARCELO DA SILVA NEVES','RENATO BOLDRINO CAVALCANTI','UANDERSON RAMOS ALVEZ','WASHINGTON SANTOS PINTO','WEDSON THIAGO BAIENSE DA SILVA'],//NOME DO TÉCNICO ABAIXO DO GRÁFICO  
  minTickInterval: 1 //SPAÇO ENTRE AS DATAS EXIBIDAS ABAIXO DO GRÁFICO
*/
$(document).ready(function(){
    iniciaPagina();
    atualiza();
});

$('#j_ano_t').change(atualiza);

var tecnicos = ['Teste','Teste2'];

function atualiza(){

  var Callback = $("input[name='callback']").val();
  var ano = $('#j_ano_t').val();  

  $.post('_ajax/gns/'+Callback+'.ajax.php',{ano: ano, callback: Callback},function(data){
    
    if(data.Tecnicos){
      tecnicos = data.Tecnicos;
    }    

  }, 'json');

  alert(tecnicos);

  //ESTATÍSTICAS TÉCNICOS
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
    categories: tecnicos,//NOME DO TÉCNICO ABAIXO DO GRÁFICO  
    minTickInterval: 1 //SPAÇO ENTRE AS DATAS EXIBIDAS ABAIXO DO GRÁFICO
  },
  series: [
  {
  name: 'Atendimentos',
      data: [20,15,30,15,20,15,10],//EXIBE QTD DE ATENDIMENTOS REALIZADOS PELO TÉCNICO
      color: '#415B76',
      lineColor: '#B25900'
    },
    {
      name: 'Orçamentos Aprovados',
      data: [15,13,15,10,15,13,10],//EXIBE QTD DE ORÇAMNTOS APROVADOS
      color: '#579C87',
      lineColor: '#006699'
    },
    {
      name: 'Orçamentos Reprovados',
      data: [5,2,5,15,5,2,10],//EXIBE QTD DE ORÇAMENTOS REPROVADOS
      color: '#F23C50',
      lineColor: '#008068'
    }
    ]
  });

  //ESTATÍSTICAS ORÇAMENTOS
<<<<<<< HEAD
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
                "y": 40,
                color: '#579C87',
              },
              {
                "name": "Recuperados",
                "y": 10,
                color: '#F2B134',
              },
              {
                "name": "Executados",
                "y": 30,
                color: '#415B76'
              },
              {
                "name": "Recusados",
                "y": 20,
                color: '#F23C50'
              }
              ]
            }
            ]
          });
}



//ESTATÍSTICAS ORÇAMENTOS
$(function() {

        
      });

//ESTATÍSTICAS ORÇAMENTOS APROVADOS
$(function() {

        //CHART CONFIG
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
                "y": 40,
                color: '#415B76',
              },
              {
                "name": "Agendados",
                "y": 10,
                color: '#F2B134',
              },
              {
                "name": "Recusados",
                "y": 30,
                color: '#F23C50'
              },
              ]
            }
            ]
          });
      });

//ESTATÍSTICAS CLIENTES
$(function() {

        //CHART CONFIG
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
                "y": 30,
                color: '#415B76',
              },
              {
                "name": "Cancelados",
                "y": 10,
                color: '#F23C50',
              },
              {
                "name": "Ausentes",
                "y": 20,
                color: '#D76880'
              },
              {
                "name": "Reagendados NVT",
                "y": 20,
                color: '#0695AB'
              },
              {
                "name": "Reagendados GNS",
                "y": 10,
                color: '#88D89E'
              },
              {
                "name": "Sem Atender",
                "y": 10,
                color: '#F2B134'
              }
              ]
            }
            ]
          });
      });

 //GRÁFICO SERVIÇOS
=======
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
        "y": 40,
        color: '#579C87',
      },
      {
        "name": "Recuperados",
        "y": 10,
        color: '#F2B134',
      },
      {
        "name": "Executados",
        "y": 30,
        color: '#415B76'
      },
      {
        "name": "Recusados",
        "y": 20,
        color: '#F23C50'
      }
      ]
    }
    ]
  });

  //ESTATÍSTICAS ORÇAMENTOS APROVADOS
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
        "y": 40,
        color: '#415B76',
      },
      {
        "name": "Agendados",
        "y": 10,
        color: '#F2B134',
      },
      {
        "name": "Recusados",
        "y": 30,
        color: '#F23C50'
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
        "y": 30,
        color: '#415B76',
      },
      {
        "name": "Cancelados",
        "y": 10,
        color: '#F23C50',
      },
      {
        "name": "Ausentes",
        "y": 20,
        color: '#D76880'
      },
      {
        "name": "Reagendados NVT",
        "y": 20,
        color: '#0695AB'
      },
      {
        "name": "Reagendados GNS",
        "y": 10,
        color: '#88D89E'
      },
      {
        "name": "Sem Atender",
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
    data: [40,30,35,35,30,30,28,25,25,27,35,45],
    color: '#579C87',
    lineColor: '#579C87'
  },
  {
    name: 'Serviços Realizados',
    data: [20,20,25,30,28,25,25,20,20,22,30,35],
    color: '#415B76',
    lineColor: '#415B76'
  },
  {
    name: 'Serviços Faturados',
    data: [15,15,20,20,25,22,25,15,18,20,30,30],
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
    categories: ['Visita orcamento Exigencias IPG Complet','Manutencao de equipamento','Adequacoes de ambiente', 'Assistencia domiciliar gas', 'Instalacao de aquecedor', 'Remanej/Construcao de ponto',
    'Certificado de rede de distribuicao interna'],
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
    data: [141, 114, 227, 110,200,150,130],
    color: '#415B76'
  }]
});



/*function iniciaPagina(){
  var dataAtual = new Date();
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');

  document.getElementById('j_mes_t').selectedIndex = dataAtual.getMonth()+1;
}*/
