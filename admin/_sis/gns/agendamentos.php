<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

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
<div class="dashboard_content custom_app" >
  <!--BOTÕES SUPERIORES-->
  <article class="box box100 no-print">   
    <div class="box_content">
      <div class="box box40">
        <?php $Read->FullRead("SELECT ID FROM [60_OS] WHERE Latitude IS NULL AND Longitude IS NULL", " ");?>
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/osEndereco" class="btn btn_darkblue flt_left">(<?php echo count($Read->getResult());?>) - OS sem Endereço</a>
      </div>
      <div class="box box40">
        <?php $Read->FullRead("SELECT ID FROM [60_ClientesSemOT] WHERE IDOT IS NULL", " ");?>
        <a title="OS Sem Endereço" href="dashboard.php?wc=gns/clienteOT" class="btn btn_darkblue flt_lefts">(<?php echo count($Read->getResult());?>) - Clientes Sem OT / OS</a>
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
          echo "<div class='box box40'><a title='Recarregar Comentários' href='dashboard.php?wc=gns/agendamentos&day={$Hoje}' class='btn btn_green'>Agendamentos HOJE</a></div>";
          echo "<div class='box box40'><a title='Recarregar Comentários' href='dashboard.php?wc=gns/agendamentos&day={$Amanha}' class='btn btn_yellow'>Agendamentos AMANHÃ</a></div>";
          echo "<div class='box box40'><a title='Recarregar Comentários' href='dashboard.php?wc=gns/agendamentos&day={$Hoje}&s=1' class='btn btn_red'>Agendamentos da SEMANA</a></div>";
          ?>
        </header>
        <div class="box_content">

          <!--SELECT DO TÉCNICO-->
          <div class="label_50 no-print">
              <label class="label">
              <span class="legend"><b>Técnico:</b></span>
              <select id="Tecnico" name="tecnico" callback="Agendamentos" callback_action="consulta" rel="<?= $Day ?>" semana="<?= $Semana ?>">
                <option value="t">&raquo;&raquo;&ensp;TODOS OS TÉCNICOS</option>             
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
                  <div class="label_25 no-print">
            <label class="label">
              <br>
              <a class="btn btn_darkblue no-print m_left" onclick="print()" style="height: 35px;padding-top: 10px;"><i class="icon-printer"></i>&ensp;Imprimir</a>
            </label>  
          </div>
          </div>


          <?php

          $LatLng->FullRead("SELECT Id, Endereco, Bairro, Municipio, Cep FROM [60_OS] WHERE Latitude IS NUll AND Longitude IS NULL", " ");

          ?>
          <article class='box box100' style="padding: 0px;">
            <h3 class="m_tp m_bottom">OS's Vinculadas</h3>
            <div class="tabela-responsivel no-print"  style="overflow-x: hidden;height: 50%;">
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
          }else {
            $url = $Hoje .'&s=1';
          }

          ?>
          <a title="Recarregar Comentários" href="dashboard.php?wc=gns/agendamentos&day=<?= $url; ?>" class="btn btn_blue icon-spinner11">Recarregar Mapa</a>
          <?php

          if($Semana == '1'):
            $Read->FullRead("SELECT DatePart(Week,GETDATE()) as SEMANA,
              NomeCliente, [60_OS].Id, [60_OS].[OSServico], [60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].ENDERECO,
              [60_OS].Tecnico, [60_OS].turno as TURNO,
              [60_OS].Latitude, [60_OS].Longitude FROM [60_Clientes]
              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
              inner join [60_OS] on [60_OT].Id = [60_OS].OT
              WHERE DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE()) AND [60_OS].Tecnico = 0"," ");
          else:
            $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, 
              [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio,
              [60_OS].Tecnico, [60_OS].turno as TURNO,
              [60_OS].Latitude, [60_OS].Longitude FROM [60_Clientes]
              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
              inner join [60_OS] on [60_OT].Id = [60_OS].OT
              AND [60_OS].Tecnico = 0 AND [DataAgendamento] = :day","day={$Day}");
          endif;

          echo "<span class='flt_right m_left'><b>Quantidade de OS Sem vincular:</b> ".count($Read->getResult())."</span>";
          ?>           
        </header>
        <div class="box_content mapa">
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
      echo "marker".$Id." = new google.maps.Marker({
        position: myLatLng,
        map: map,";        
        echo"icon: image1,";     
        echo "animation: google.maps.Animation.DROP,
        position: {lat:".$Latitude.", lng: ".$Longitude."},     
        title: ''});";
?>
        var contentString = "<div class='info-window'><h3 class='m_bottom'><?php echo $OSServico; ?></h3><div class='info-content'><p>OS: <b><?php echo $NumOS; ?></b></p><p>Cliente: <b><?php echo $NomeCliente; ?></b></p><p>Serviço: <b><?php echo $NomeOs; ?></b></p><p>Data: <b><?php echo date('d/m/Y', strtotime($DataAgendamento)); ?></b></p><span rel='single_message' callback='Agendamentos' callback_action='addTecnico' class='j_add_tecnico icon-plus btn btn_darkblue' id='<?php echo $Id;?>' >Add</span></div></div>";
<?php
        echo "infowindow".$Id." = new google.maps.InfoWindow({
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
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="_js/gns.js"></script>

