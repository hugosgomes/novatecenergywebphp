
//ESTATÍSTICAS TÉCNICOS
$(function() {

        //CHART CONFIG
        var wc_chart = Highcharts.chart('jwc_chart_container_tecnicos', {
            chart: {
                type:'column',//DETERMINA O FORMATO DO GRÁFICO
                spacingBottom: 0,
                spacingTop: 5,
                spacingLeft: 0,
                spacingRight: 20
            },
            title: {
                text: 'Estatística Técnicos'
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
            },
            series: [
                {
                    name: 'Atendimentos',
                    data: [20,15,30,15,20,15],//EXIBE QTD DE ATENDIMENTOS REALIZADOS PELO TÉCNICO
                    color: '#105187',
                    lineColor: '#B25900'
                },
                {
                    name: 'Orçamentos Aprovados',
                    data: [15,13,15,10,15,13],//EXIBE QTD DE ORÇAMNTOS APROVADOS
                    color: '#0E96E5',
                    lineColor: '#006699'
                },
                {
                    name: 'Orçamentos Reprovados',
                    data: [5,2,5,15,5,2],//EXIBE QTD DE ORÇAMENTOS REPROVADOS
                    color: 'red',
                    lineColor: '#008068'
                }
            ]
        });
    });

//ESTATÍSTICAS ORÇAMENTOS
$(function() {

        //CHART CONFIG
        var wc_chart = Highcharts.chart('jwc_chart_container_orcamentos', {
            chart: {
                type:'pie',//DETERMINA O FORMATO DO GRÁFICO
                spacingBottom: 0,
                spacingTop: 5,
                spacingLeft: 0,
                spacingRight: 20
            },
            title: {
                text: 'Estatística Orçamentos'
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
                      color: '#0E96E5',
                    },
                    {
                      "name": "Recuperados",
                      "y": 10,
                      color: '#259A77',
                    },
                    {
                      "name": "Executados",
                      "y": 30,
                      color: '#006699'
                    },
                    {
                      "name": "Recusados",
                      "y": 20,
                      color: 'red'
                    }
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
                text: 'Estatística Clientes'
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
                  "name": "Clientes",
                  "colorByPoint": true,
                  "data": [
                    {
                      "name": "Atendidos",
                      "y": 30,
                      color: '#105187',
                    },
                    {
                      "name": "Cancelados",
                      "y": 10,
                      color: '#c33325',
                    },
                    {
                      "name": "Ausentes",
                      "y": 20,
                      color: '#f0f1d5'
                    },
                    {
                      "name": "Reagendados NVT",
                      "y": 20,
                      color: '#259A77'
                    },
                    {
                      "name": "Reagendados GNS",
                      "y": 10,
                      color: '#88D89E'
                    },
                    {
                      "name": "Sem Atender",
                      "y": 10,
                      color: '#f19722'
                    }
                  ]
                }
              ]
        });
    });