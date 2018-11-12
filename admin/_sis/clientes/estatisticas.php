<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['CLIENTES_PARTICULARES'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;
?>
<style type="text/css">
  .panel_header{
    padding: 0px;
    padding-top: 12px;
  }

  table {
    font-family: arial, sans-serif;
    font-size: 14px;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    text-align: left;
    padding: 2px;
  }

  #myBtn {
    display: none; 
    position: fixed; 
    bottom: 35px; 
    right: 20px; 
    z-index: 99; 
    border: none; 
    outline: none; 
    background-color:#05224299; 
    color: white; 
    cursor: pointer; 
    width:45px;
    height:45px;
    border-radius: 50%; 
    font-size: 18px; 
  }

  #myBtn:before{
    margin-right:0;
  }

  #myBtn:hover {
    background-color:#555; 
  }

</style>
<link rel="stylesheet" href="_css/clientes_particulares.css"/>
<header class="dashboard_header">
  <div class="dashboard_header_title">
    <p class="dashboard_header_breadcrumbs">
    &raquo;</span>
    <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/estatisticas">Estatísticas</a>

  </p>
</div>
</header>
<button class="icon-circle-up" onclick="topFunction()" id="myBtn" title="Top"></button>
<div class="dashboard_content">
    <article class="box box100">
        <div class="panel">
          <div class="listar-tecnicos">
            <input type="hidden" name="Callback" value="ReportTecnicos">
            <input type="hidden" name="Callback_action" value="listar-tecnicos">
          </div>
          <!-- Gráfico de técnicos -->
            <div class="wc_ead_chart_control" id="relatorio_tecnicos">
                <input type="hidden" name="callback" value="ReportTecnicos">
                <input type="hidden" name="callback_action" value="relatorio_padrao_tecnicos">
                <select id="j_ano_t" style="width: 110px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes_t" style="width: 140px;" name="mes_t">     
                  <option value="t" id="meses">TODOS OS MESES</option>
                  <option value="01" id="meses">JANEIRO</option>
                  <option value="02" id="meses">FEVEREIRO</option>
                  <option value="03" id="meses">MARÇO</option>
                  <option value="04" id="meses">ABRIL</option>
                  <option value="05" id="meses">MAIO</option>
                  <option value="06" id="meses">JUNHO</option>
                  <option value="07" id="meses">JULHO</option>
                  <option value="08" id="meses">AGOSTO</option>
                  <option value="09" id="meses">SETEMBRO</option>
                  <option value="10" id="meses">OUTUBRO</option>
                  <option value="11" id="meses">NOVEMBRO</option>
                  <option value="12" id="meses">DEZEMBRO</option>
                </select>
                <select id="j_semana_s" style="width: 150px;">
                  <option value="t">TODAS AS SEMANAS</option>
                  <option value="t">1º SEMANA</option>
                  <option value="t">2º SEMANA</option>
                  <option value="t">3º SEMANA</option>
                  <option value="t">4º SEMANA</option>
                  <option value="t">5º SEMANA</option>
                </select>
            </div>
            <div class="box box50">
              <div id="jwc_chart_container_orcamentos"></div>
                  <div class="box box100 ">
                      <div class="box_content">
                        <table style="max-width: 510px;margin: auto;">
                          <tr>
                            <td><b>Total: 200</b></td>
                            <td><b>Em Análise: 80</b></td>
                          </tr>
                          <tr>
                            <td><b>Agendados: 80</b></td>
                            <td><b>Executados: 80</b></td>
                          </tr>
                          <tr>
                            <td><b>Cancelados: 10</b></td>
                            <td><b>Recusados: 10</b></td>
                          </tr>
                        </table>
                      </div>
                  </div>
            </div>
            <div class="box box50">
              <div id="jwc_chart_container_clientes"></div>
                  <div class="box box100 ">
                      <div class="box_content">
                        <table style="max-width: 510px;margin: auto;">
                          <tr>
                            <td><b>Total: 100</b></td>
                            <td><b>Sem Atender: 40</b></td>
                          </tr>
                          <tr>
                            <td><b>Sem Agendar: 60</b></td>
                          </tr>
                        </table>
                      </div>
                  </div>
            </div>
            <div style="height:50px"></div>
            <!-- Gráfico de serviços -->
            <div class="box box100">
              <div class="wc_ead_chart_control">
                
            </div>
              <div id="jwc_chart_container_servicos"></div>
               <div class="box box100">
                  <div class="box_content">
                    <table style="max-width: 500px;margin: auto;">
                      <tr>
                        <td><b>Total Serviços: 35</b></td>
                        <td><b>Serviços Executados: 30</b></td>
                        <td><b>Serviços Faturados: 20</b></td>
                      </tr>
                    </table>
                  </div>
              </div>
            </div>

            <!-- Gráfico de serviços -->
            <div class="box box100">
              <div class="wc_ead_chart_control">
                
            </div>
              <div id="jwc_chart_container_servicos_s"></div>
            </div>
            <footer class="wc_ead_reports">
            </footer>
        </div>
    </article>
</div>
<script src="_js/estatisticas_clientes_particulares.js"></script>
<script>
  var dataAtual = new Date();
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
  $('#j_ano_t').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');

  document.getElementById('j_mes_t').selectedIndex = dataAtual.getMonth()+1;

  $(document).ready(function(){
    $('.icon-key').removeClass();
  })
</script>