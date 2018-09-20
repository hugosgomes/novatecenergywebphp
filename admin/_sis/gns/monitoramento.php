<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;
?>
<style type="text/css">
  .nao-associado{
    background-color: red;
    width:10px; 
    height: 10px;

  }
    .associado{
    background-color: #ffd400;
    width:10px; 
    height: 10px;

  }
    .atendido{
    background-color: #0dbb0d;
    width:10px; 
    height: 10px;

  }
</style>
<header class="dashboard_header">
  <div class="dashboard_header_title">
    <p class="dashboard_header_breadcrumbs">
    &raquo;</span>
    <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
    <span class="crumb">/</span>
    Monitoramento
  </p>
</div>
</header>
<div class="dashboard_content custom_app">
  <article class="box box33" style="width: 33%;">
    <header>
      <h3>Monitoramento</h3>
    </header> 
    <div class="box_content" style="height:77.2%;">
      <label class="label">
        <span class="legend">Técnico:</span>
        <select id="Tecnico" name="tecnico" callback="Monitoramento" callback_action="consulta">
          <option value="">Selecione um Técnico</option>
          <option value="t">&raquo;&raquo;TODOS OS TÉCNICOS</option>
          <?php
                $Setor = 2;
                $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários
                        WHERE [Funcionários].GNSMOBILE = 1 AND Funcionários.[DATA DE DEMISSÃO] IS NULL
                        ORDER BY [NOME COMPLETO]"," ");
                if ($Read->getResult()):
                  foreach ($Read->getResult() as $FUNC):
                    echo "<option value='{$FUNC['id']}'>{$FUNC['nome']}</option>";
                  endforeach;
                endif;
                ?>
        </select>
      </label>

      <?php
      $Data = date('d/m/Y');
      $Read->FullRead("SELECT  NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio,
        [60_OS].Tecnico, [60_OS].turno as TURNO,
        [60_OS].Latitude, [60_OS].Longitude FROM [60_Clientes]
        inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
        inner join [60_OS] on [60_OT].Id = [60_OS].OT
        AND [DataAgendamento] = :day","day={$Data}");

      $ReadClientesAssoc = new Read();
      $ReadClientesAssoc->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]", "");

      ?>
      <article class="box box50 datalist">
        <table id="dataList" class="cell-border compact stripe table" style="width: 100%;font-size: 15px;">
          <tr>
            <td>Não Associado(s):</td>
          </tr>
          <tr>
            <td>Associado(s):</td>
          </tr>
          <tr>
            <td>Atendido(s):</td>
          </tr>
          <tr>
            <td>Cancelado(s):</td>
          </tr>
          <tr>
            <td>Ausente(s):</td>
          </tr>
          <tr>
            <td>Reagend.(s) NVT:</td>
          </tr>
          <tr>
            <td>Reagend.(s) GNS:</td>
          </tr>
          <tr>
            <td>Sem Atender:</td>
          </tr>
        </table>
      </article>
      <article class="box box50 orcamento-list">
       <table id='orcamento-list' class="cell-border compact stripe table" style="font-size: 15px;">
        <h1>Orçamentos</h1>
        <tr>
          <td>Aprovado(s):</td>
        </tr>
        <tr>
          <td>Executado(s):</td>
        </tr>
        <tr>
          <td>Reprovado(s):</td>
        </tr>
        <tr>
          <td><b>Total:</b></td>
        </tr>
      </table>
      <!--<div id="orcamento-list">
        <h1>Orçamentos:</h1>
        <ul>
          <li>Aprovados:</li>
          <li>Executados:</li>
          <li>Reprovados:</li>
          <li><b>Total:</b></li>
        </ul>
      </div>-->
    </article>
    <div class="clear"></div>
  </div>
</article>
<!--MAPA-->
<article class="box box50" style="width:67%;">
  <header>
    <?php
    echo "<div class='box box25'><span class='flt_right m_left'>Quantidade de OS:<b> ".count($Read->getResult())."</b></span></div>
    <div class='box box50'>
    <table>
    <tr>
    <td><div class='nao-associado'></div></td><td>&ensp;Não Associado&ensp;</td>
    <td><div class='associado'></div></td><td>&ensp;Associado&ensp;</td>
    <td><div class='Atendido'></div></td><td>&ensp;Atendido</td>
    </tr></table></div>";
    ?>           
  </header>
  <div class="box_content">
    <div id="map" style="height: 72%;"></div>
  </div>
</article>
</div>

<!--inicia o Google Maps-->
<script>
  function initMap() {
    var myLatLng = {lat: -22.9068467, lng: -43.1728965};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: myLatLng
    });
    var image1 = './_img/marcador.png';
    var image2 = './_img/marcador3.png';
    var image3 = './_img/marcador2.png';
    var number = 5;

    <?php
    foreach ($Read->getResult() as $OS):
      extract($OS);                                
      echo "var marker".$Id." = new google.maps.Marker({
        position: myLatLng,
        map: map,"; 
        if($Status == 0):       
          echo"icon: image1,"; 
        elseif($Status == 1):
          echo"icon: image2,"; 
        else:
          echo"icon: image3,"; 
        endif;

        echo "animation: google.maps.Animation.DROP,
        position: {lat:".$Latitude.", lng: ".$Longitude."},     
        title: ''});";

        echo "var contentString = '<div class=\"info-window\"><h3 class=\"m_bottom\">".$OSServico."</h3><div class=\"info-content\"><p>OS: <b>".$NumOS."</b></p><p>Cliente: <b>".$NomeCliente."</b></p></p><p>Nome Os: <b>".$NomeOs."</b></p><p>Data: <b>". date('d/m/Y', strtotime($DataAgendamento)) ."</b></p><!--<span rel=\"single_message\" callback=\"Agendamentos\" callback_action=\"addTecnico\" class=\"j_add_tecnico icon-plus btn btn_green\" id=\"{$Id}\"></span>--></div></div>';";

        echo "var infowindow".$Id." = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 400
        });";

        echo "marker".$Id.".addListener('click', function () {
          infowindow".$Id.".open(map, marker".$Id.");
        });";     

      endforeach;
      ?>            
    };

  </script>

  <!--Chamada da API do Google Maps-->
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0&callback=initMap"></script>
  <script src="_js/gns.js"></script>
