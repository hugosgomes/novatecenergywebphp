<?php
$AdminLevel = LEVEL_WC_USERS;
if (!$DashboardLogin):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;

$Day = filter_input(INPUT_GET, 'day', FILTER_VALIDATE_INT);
$Semana = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT);
?>

<header class="dashboard_header">
  <div class="dashboard_header_title">
    <h1 class="icon-hammer">GNS</h1>
    <p class="dashboard_header_breadcrumbs">
      &raquo;</span>
      <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
      <span class="crumb">/</span>
      Agendamentos
    </p>
  </div>
</header>

<div class="dashboard_content custom_app">
  <!--BOTÕES SUPERIORES-->
  <article class="box box100">   
    <div class="box_content">
      <div class="box box40">
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/osEndereco" class="btn btn_darkblue flt_left icon-plus">OS sem Endereço</a>
      </div>
      <div class="box box40">
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/relatorioDiario" class="btn btn_darkblue flt_left icon-plus">Relatório Exp. Diário</a>
      </div>
      <div class="box box40">
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/clienteOT" class="btn btn_darkblue flt_left icon-plus">Clientes Sem OT / OS</a>
      </div>
  </article>

  <article class="box box100">    
      <article class="box box50">
        <header>
          <?php
          $Data = new DateTime();
          $Hoje = $Data->format('Ymd');
          $Amanha = $Data->modify('+1 day');
          $Amanha = $Amanha->format('Ymd');
          echo "<div class='box box40'><a title='Recarregar Comentários' href='dashboard.php?wc=gns/agendamentos&day={$Hoje}' class='btn btn_green'>Agendamentos HOJE</a></div>";
          echo "<div class='box box40'><a title='Recarregar Comentários' href='dashboard.php?wc=gns/agendamentos&day={$Amanha}' class='btn btn_yellow'>Agendamentos AMANHÃ</a></div>";
          echo "<div class='box box40'><a title='Recarregar Comentários' href='dashboard.php?wc=gns/agendamentos&day={$Hoje}&s=1' class='btn btn_red'>Agendamentos da SEMANA</a></div>";
          ?>
        </header>
        <div class="box_content">
          
          <!--SELECT DO TÉCNICO-->
          <article class='box box50'>
            <label class="label">
              <span class="legend"><b>Técnico:</b></span>
              <select id="Tecnico" name="tecnico" callback="Agendamentos" callback_action="consulta" rel="<?= $Day ?>" semana="<?= $Semana ?>">
                <option value="t">&raquo;&raquo;&ensp;TODOS OS TÉCNICOS</option>
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
          </article>

            <?php
                if($Semana == '1'):
                  $Read->FullRead("SELECT DatePart(Week,GETDATE()) as SEMANA,
                                    NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO,
                                    [60_OS].Tecnico, [60_OS].turno as TURNO,
                                    [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                    inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                    inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                    inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                    inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID
                                    WHERE DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE())"," ");
                else:
                  $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].Tecnico, [60_OS].turno as TURNO,
                                    [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                    inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                    inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                    inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                    inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID AND [60_OS].Tecnico = 0 AND [DataAgendamento] = :data","data={$Day}");
                endif;
            ?>
            <article class='box box100'>
              <div class="table-responsive">
                <table id="dataTable"class="cell-border compact stripe table">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>OS</th>
                      <th>Nome OS</th>
                      <th>Endereço</th>
                      <th>Data</th>
                      <th>Técnico</th>
                      <th>Período</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="j_tecnico"><td>Selecione o Técnico</td></tr>            
                  </tbody>
                </table>
              </div>
            </article>
          </div>
        </article>
        <article class="box box50">
          <header>
            <a title="Recarregar Comentários" href="dashboard.php?wc=gns/agendamentos&day=<?= $Hoje; ?>" class="btn btn_blue icon-spinner11">Recarregar Mapa</a>
            <?php
            echo "<span class='flt_right m_left'>Quantidade de OS:<b> ".count($Read->getResult())."</b></span>";
            ?>           
          </header>
          <div class="box_content">
            <div id="map"></div>
          </div>
        </article>
      </div>
    </article>
  </div>

  <!--Inicia o data table-->
  <script>
  $(document).ready( function () {
    $('#dataTable').DataTable({
      paging: true,
      compact: true,
      hover: true,
      searching: true,
      info: false
    });
  } );
  </script>


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

echo "var contentString = '<div class=\"info-window\"><h3 class=\"m_bottom\">".$OSServico."</h3><div class=\"info-content\"><p>OS: <b>".$NumOS."</b></p><p>Cliente: <b>".$NomeCliente."</b></p><p>Data: <b>". date('d/m/Y', strtotime($DataAgendamento)) ."</b></p><span rel=\"single_message\" callback=\"Agendamentos\" callback_action=\"addTecnico\" class=\"j_add_tecnico icon-plus btn btn_green\" id=\"{$Id}\"></span></div></div>';";


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