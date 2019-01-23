<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

require_once ("../_app/Helpers/ExcelExport.class.php");

$semana = null; 
$Tecnico = null;

//$clickExcel(new ExcelExport($semana, $Tecnico))

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;

if (empty($LatLng)):
  $LatLng = new Read;
endif;

$Day = filter_input(INPUT_GET, 'day', FILTER_VALIDATE_INT);
$Semana = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT);
?>
<link rel="stylesheet" type="text/css" href="_css/print.css" media="print" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<header class="dashboard_header no-print">
  <div class="dashboard_header_title">
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
  <article class="box box100 no-print">   
    <div class="box_content">
      <div class="box box40">
        <?php $Read->FullRead("SELECT ID FROM [60_OS] WHERE Latitude IS NULL AND Longitude IS NULL", " ");?>
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/osEndereco" class="btn btn_darkblue flt_left">(<?php echo count($Read->getResult());?>) - OS sem Endereço</a>
      </div>
      <div class="box box40">
        <?php $Read->FullRead("SELECT ID FROM [60_ClientesSemOT] WHERE IDOS IS NULL", " ");?>
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/clienteOT" class="btn btn_darkblue flt_lefts">(<?php echo count($Read->getResult());?>) - Clientes Sem OT / OS</a>        
      </div>
      <div class="box box50" style="width:31%;">
      </div>
      <div class="box box50" style="width:20%;padding-top: 15px; text-align: right;">
        <span class="legend "><b>Receber Os Manualmente:</b></span>
      </div>
      <div class="box box40">
      <form id="j_form_osManual" method="post" enctype="multipart/form-data">
       <input type="hidden" name="callback" value="Agendamentos"/>
       <input type="hidden" name="callback_action" value="importOs_manual"/>
        <input type="file" id="os_manual" name="os_manual"/>
      </form>
      </div>
      <div class="box box40">
        <span id="j_importar" class="btn btn_darkblue"><b>Importar</b></span>
      </div>
    </div>      
  </article>
    <article class="box box100">    
      <article class="box box50">
        <header class="no-print">
          <?php
          $Data = new DateTime();
          $Hoje = $Data->format('Ymd');
          $Amanha = $Data->modify('+1 day');
          $Amanha = $Amanha->format('Ymd');
          echo "<div class='box box40'><a title='Agendamentos Hoje' href='dashboard.php?wc=gns/agendamentos&day={$Hoje}' class='btn btn_green'>Agendamentos HOJE</a></div>";
          echo "<div class='box box40'><a title='Agendamentos Amanhã' href='dashboard.php?wc=gns/agendamentos&day={$Amanha}' class='btn btn_yellow'>Agendamentos AMANHÃ</a></div>";
          echo "<div class='box box40'><a title='Agendamentos Semana' href='dashboard.php?wc=gns/agendamentos&day={$Hoje}&s=1' class='btn btn_red'>Agendamentos FUTUROS</a></div> <br>";
          echo "<div class='box box40'><input type='text' id='Agend' name='Agend' placeholder='&raquo;&raquo;&ensp;SELECIONE DATA' class='jwc_datepicker' style='width: 163px;'></div>";
          echo "<div class='box box40'><a title='Filtrar Data' class='btn btn_blue icon-search' style='height: 37px;padding-top: 10px;'>Pesquisar</a></div>";
          ?>

        </header>
        <div class="box_content">

          <!--SELECT DO TÉCNICO-->
          <div class="label_50 no-print">
              <label class="label">
              <span class="legend"><b>Técnico:&nbsp;&nbsp;<span id="num_os" class="num_os"></span></b></span>
              <select id="Tecnico" name="tecnico" callback="Agendamentos" callback_action="consulta" rel="<?= $Day ?>" semana="<?= $Semana ?>" style="outline: none;">
                <option value="t">&raquo;&raquo;&ensp;TODOS OS TÉCNICOS</option>             
                <?php
                $Setor = 2;
                $Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME
                FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
                WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL ORDER BY NOME"," ");
                if ($Read->getResult()):
                  foreach ($Read->getResult() as $FUNC):
                    echo "<option value='{$FUNC['ID']}'>{$FUNC['NOME']}</option>";
                  endforeach;
                endif;
                ?>
              </select>
            </label>
                  <div class="label_25 no-print">
            <label class="label">
              <br>
              
              <a class="btn btn_darkblue no-print m_left" onclick="print()" style="height: 35px;padding-top: 10px;"><i class="icon-printer"></i>&ensp;Imprimir</a>
              <span title='Exportar para Excel' class='btn btn_green icon-file-excel' id="exportar" rel="<?= $Day ?>" semana="<?= $Semana ?>" callback="Agendamentos" callback_action="exportar_excel" style="height: 35px;padding-top: 10px;">Exportar</span>
            </label>  
          </div>
          </div>

          <?php

          $LatLng->FullRead("SELECT Id, Cep, Endereco, Bairro, Municipio FROM [60_OS] WHERE Latitude IS NUll AND Longitude IS NULL", " ");

          ?>
          <article class='box box100' style="padding: 0px;">
           <!--<h3 class="m_tp m_bottom">OS's Vinculadas</h3>-->
            <div class="tabela-responsivel no-print">
              <table id="dataTable" class="display cell-border compact">
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
                <tbody style="font-size: 11px;">
                  <tr class="j_tecnico"><td>Selecione o Técnico</td></tr>
                </tbody>
              </table>
            </div>
          </article>
        </div>
      </article>
      <article class="box box50 teste">
        <header class="no-print">
          <?php

          $url = $_SERVER['QUERY_STRING'];
          if($url == "wc=gns/agendamentos&day=".$Hoje){
            $url = $Hoje;
          } else if($url == "wc=gns/agendamentos&day=".$Amanha){
            $url = $Amanha;
          } else {
            $url = $Hoje .'&s=1';
          }

          $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, 
              [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio,
              [60_OS].Tecnico, [60_OS].turno as TURNO,
              [60_OS].Latitude, [60_OS].Longitude, [60_OT].ObsOT, [60_OT].NumOT FROM [60_Clientes]
              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
              inner join [60_OS] on [60_OT].Id = [60_OS].OT
              AND [60_OS].Tecnico <> 0 AND [DataAgendamento] = :day","day={$Day}");

          echo "<span class='flt_right m_left'><b>OS Vinculadas:</b>&ensp;<span class='qtd_OS_Vin'>". count($Read->getResult()) ."</span></span>";

          if($Semana == '1'):
            $Read->FullRead("SELECT DatePart(Week,GETDATE()) as SEMANA,
              NomeCliente, [60_OS].Id, [60_OS].[OSServico], [60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].ENDERECO,
              [60_OS].Tecnico, [60_OS].turno as TURNO,
              [60_OS].Latitude, [60_OS].Longitude, [60_OT].ObsOT, [60_OT].NumOT FROM [60_Clientes]
              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
              inner join [60_OS] on [60_OT].Id = [60_OS].OT
              WHERE [60_OS].DataAgendamento >= CONVERT(DATE, GETDATE(), 103) AND [60_OS].Tecnico = 0"," ");
          else:
            $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, 
              [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio,
              [60_OS].Tecnico, [60_OS].turno as TURNO,
              [60_OS].Latitude, [60_OS].Longitude, [60_OT].ObsOT, [60_OT].NumOT FROM [60_Clientes]
              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
              inner join [60_OS] on [60_OT].Id = [60_OS].OT
              AND [60_OS].Tecnico = 0 AND [DataAgendamento] = :day","day={$Day}");
          endif;

          echo "<span class='flt_right m_left'><b>OS Sem Vincular:</b>&ensp;<span class='qtd_OS'>". count($Read->getResult()) ."</span></span>";

          ?>           
        </header>
        <div class="box_content" id="mapa">
          <div id="map" class="no-print" style="height: 59.3%;"></div>
        </div>
      </article>
    </div>

  </article>
</div>

<!--Faz as requisições na API do Google Maps-->
<script>
  $(document).ready( function () {

    $('#Tecnico').change();

    <?php foreach ($LatLng->getResult() as $ENDERECOS): 
      extract($ENDERECOS);?>

      axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
        params:{
          address: '<?php echo "{$Endereco} {$Bairro} {$Municipio} - {$Cep}";?>',
          key:'AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0'
        }

      })
      .then(function(response){

        formattedAddress = [response.data.results[0].formatted_address];
        lat = response.data.results[0].geometry.location.lat; 
        lng = response.data.results[0].geometry.location.lng;

        console.log(lat, lng);

        var Callback = 'Agendamentos';
        var Callback_action = 'consultar_Os';
        var Id = '<?php echo "{$Id}";?>';
        $.post('_ajax/gns/'+ Callback +'.ajax.php', {callback: Callback, callback_action: Callback_action, Id: Id, Latitude: lat, Longitude: lng}, function (data) {

           //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
             if (data.trigger) {
                   Trigger(data.trigger);                
                 }
            }, 'json');
      });        

    <?php endforeach ?>

  } );

</script>

<!--inicia o Google Maps-->
<?php  $qtd_OS = count($Read->getResult()); ?>
<script>
  var marker, i;
  var map;
  var markers = [];
  function initMap() {
   var locations = [];
   
   <?php  for ($i = 0; $i < $qtd_OS; $i++) { ?>

    locations[<?php echo $i; ?>] = ['<div class="info-window"><div class="info-content"><p>Cliente: <b><?php echo $Read->getResult()[$i]["NomeCliente"]; ?></b></p><p>OT: <b><?php echo $Read->getResult()[$i]["NumOT"]; ?></b></p><p>OS: <b><?php echo $Read->getResult()[$i]["NumOS"]; ?><br/></b> Serviço: <b><?php echo $Read->getResult()[$i]["NomeOs"]; ?></b></p><p>Data: <b><?php echo date("d/m/Y", strtotime($Read->getResult()[$i]["DataAgendamento"])); ?></b></p><p>Período: <b><?php echo $Read->getResult()[$i]["TURNO"]; ?></b></p><p>Obs: <b><?php echo $Read->getResult()[$i]["ObsOT"]; ?></b></p><span rel="single_message" callback="Agendamentos" callback_action="addTecnico" class="j_add_tecnico icon-plus btn btn_darkblue" id="<?php echo $Read->getResult()[$i]["Id"];?>" num="<?php echo $i;?>" total="<?php echo $qtd_OS; ?>">Add</span></div></div>', <?php echo $Read->getResult()[$i]['Latitude']; ?>, <?php echo $Read->getResult()[$i]['Longitude']; ?>, <?php echo $Read->getResult()[$i]["Id"];?>]

  <?php }?>

  var image1 = './_img/marcador.png';

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(-22.9068467, -43.1728965),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();

  for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      icon: image1,
      map: map
    });
    markers[locations[i][3]] = marker;
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
  }
};

/*PEGA A DATA DO DATEPICKER E CRIA A URL PARA MOSTRAR OS's NO MAPA*/
$('html').on('click', '.btn_blue', function (e) {
  var agend = $('#Agend').val();

  var date = agend.split("/").reverse().join("");
  
  window.location.assign("dashboard.php?wc=gns/agendamentos&day="+ date);
});

$('#dataTable').DataTable({
      'searching': false,
      'paging': true,
      'info': false,
      'lengthChange': false,
      'paging': false
    });

</script>

<!--Chamada da API do Google Maps-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0&callback=initMap"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="_js/gns.js"></script>