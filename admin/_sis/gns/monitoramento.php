<?php
$AdminLevel = LEVEL_WC_USERS;
if (!$DashboardLogin):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;
?>

<header class="dashboard_header">
  <div class="dashboard_header_title">
    <h1 class="icon-hammer">GNS</h1>
    <p class="dashboard_header_breadcrumbs">
      &raquo;</span>
      <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
      <span class="crumb">/</span>
      Monitoramento
    </p>
  </div>
</header>
<div class="dashboard_content custom_app">
    <article class="box box50">
        <header>
          <h3>Monitoramento</h3>
        </header> 
        <div class="box_content">
                <label class="label">
                        <span class="legend">Técnico:</span>
                        <select id="Tecnico" name="tecnico" callback="Monitoramento" callback_action="consulta">
                            <option value="">Selecione um Técnico</option>
                            <option value="t">&raquo;&raquo;TODOS OS TÉCNICOS</option>
                            <?php
                            $Setor = 2;
                            $Read->FullRead("SELECT [p].[ID],  [p].[NOME COMPLETO], [p].[SETOR], [p].[TITULO (FUNÇÃO)]
                                              FROM [Funcionários] AS [p]
                                              WHERE [p].[DATA DE DEMISSÃO] IS NULL AND ([p].[TITULO (FUNÇÃO)] = 5) AND [p].[SETOR] = :setor
                                              ORDER BY [p].[NOME COMPLETO]","setor={$Setor}");
                            if ($Read->getResult()):
                                foreach ($Read->getResult() as $FUNC):
                                    echo "<option value='{$FUNC['ID']}'>{$FUNC['NOME COMPLETO']}</option>";
                                endforeach;
                            endif;

                            ?>
                        </select>
                </label>

            <?php
                  $Data = date('d/m/Y');
                  $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].Tecnico, [60_OS].turno as TURNO,
                                    [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                    inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                    inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                    inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                    inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID AND [60_OS].Tecnico = 0 AND [DataAgendamento] = :data","data={$Data}");

                  $ReadClientesAssoc = new Read();
                  $ReadClientesAssoc->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]", "");

            ?>
              <article class="box box50 datalist">
                <ul id="dataList">
                    <li>Cliente(s) Associado(s):</li>
                    <li>Cliente(s) Atendido(s):</li>
                    <li>Cliente(s) Cancelado(s):</li>
                    <li>Cliente(s) Ausente(s):</li>
                    <li>Reagendamento(s):</li>
                    <li>Reagendamentos GNS:</li>
                    <li>Cliente(s) sem atender:</li>
                  </ul>
              </article>

              <article class="box box50">
               <div class="lista-monitoramento">
                <h1>Orçamentos:</h1>
                <ul>
                  <li>Aprovados:</li>
                  <li>Executados:</li>
                  <li>Reprovados:</li>
                  <li><b>Total:</b></li>
                </ul>
              </div>
            </article>
            <div class="clear"></div>
      </div>
    </article>
        <!--MAPA-->
        <article class="box box50">
          <header>
            <?php
            echo "<span class='flt_right m_left'>Quantidade de OS:<b> ".count($Read->getResult())."</b></span>";
            ?>           
          </header>
          <div class="box_content">
            <div id="map"></div>
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
  var image2 = './_img/marcador2.png';
  var image3 = './_img/marcador3.png';
  var number = 5;

  <?php
  foreach ($Read->getResult() as $OS):
    extract($OS);                                
  echo "var marker".$Id." = new google.maps.Marker({
    position: myLatLng,
    map: map,";
    if($Status == "0"):
      echo"icon: image1,";
    elseif($Status == "1"):
      echo"icon: image2,";
    else:
      echo"icon: image3,";                      
    endif;       
    echo "animation: google.maps.Animation.DROP,
    position: {lat:".$LATITUDE.", lng: ".$LONGITUDE."},     
    title: 'Hello World!'});";

echo "var contentString = '<div class=\"info-window\"><h3 class=\"m_bottom\">".$OSServico."</h3><div class=\"info-content\"><p>OS: <b>".$NumOS."</b></p><p>Cliente: <b>".$NomeCliente."</b></p><p>Data: <b>". date('d/m/Y', strtotime($DataAgendamento)) ."</b></p></div></div>';";


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