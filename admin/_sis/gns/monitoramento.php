<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;
?>

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
      <h3>Monitoramento de OS</h3>
    </header> 
    <div class="box_content" style="height:77.2%;">
      <label class="label">
        <span class="legend">Técnico:</span>
        <select id="Tecnico" name="tecnico" callback="Monitoramento" callback_action="consulta">
          <option value="">Selecione um Técnico</option>
          <option value="t">&raquo;&raquo;TODOS OS TÉCNICOS</option>
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
      <center>
		    <img class="spinner" style="margin-left: 10px; margin-top: 2px; block-size: 10%;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_spinner.gif"/>
      </center>

      <?php      

      $ReadClientesAssoc = new Read();
      $ReadClientesAssoc->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]", "");

      ?>
      <article class="box datalist" style="width:40%">
        <!--codigo OS's -->
      </article>

      <article class="box orcamento-list" style="width:60%">
        <!-- código orçamentos -->
      </article>
      <article class="box media-list" style="width:100%; padding-top: 35px;">
        <!-- código médias -->
      </article>
      
      <article class="box" style="width:100%; padding-top: 35px;overflow:auto;height:auto;max-height:390px">
        <table style="overflow:auto;height:100px">
          <thead>
            <tr>
              <th style="text-align: center;">Técnico</th>
              <th style="text-align: center;">Status</th>
              <th style="text-align: center;">Últ. Atend.</th>
            </tr>
          </thead>
        <tbody class="ociosidade-list monitoramentoGns">
          <tr><td><!-- código médias --></td></tr> 
        </tbody>
        </table>
        
      </article>
      <center>
		    <img class="spinner" style="margin-left: 10px; margin-top: 2px; block-size: 10%;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_spinner.gif"/>
      </center>

    <div class="clear"></div>
  </div>
</article>
<!--MAPA-->
<article class="box box50" style="width:67%;">
  <header>
    <div class='box box25'><span class='flt_right m_left qtdOs'>Quantidade de OS:<b> </b></span></div>
    <div class='box box50'>
    <table>
    <tr>
    <td><div class='nao-atendido'></div></td><td>&ensp;Não Atendido&ensp;</td>
   <!-- <td><div class='associado'></div></td><td>&ensp;Associado&ensp;</td>-->
    <td><div class='Atendido'></div></td><td>&ensp;Atendido</td>
    </tr></table></div>
  </header>
  <div class="box_content">
    <div id="map" style="height: 72%;"></div>
  </div>
</article>
</div>

<script src="_js/gns.js"></script>

<!--inicia o Google Maps-->
<script>

function initMap(locations) {
  var myLatLng = {lat: -22.9068467, lng: -43.1728965};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: myLatLng
  });
  var image1 = './_img/marcador.png';
  var image2 = './_img/marcador2.png';
  var image4 = './_img/marcador4.png';

  if(locations){
    locations.forEach(function(element, index, array){
      if (!locations[index]['IDCARRO']) {
        var latitude = parseFloat(locations[index]['Latitude']);
        var longitude = parseFloat(locations[index]['Longitude']);
        var image = locations[index]['Status'] == 0 ? image1 : image2;

        var dataOs = new Date();
        var dataFormatada = dataOs.getDate()+"/"+dataOs.getMonth()+"/"+dataOs.getFullYear();
        var marker = new google.maps.Marker({
        map: map,
        icon: image,
        animation: google.maps.Animation.DROP,
        position: {lat: latitude, lng: longitude},     
        title: ''});

        //VERIFICA SE CADA TELEFONE EXISTE E SÓ EXIBE NO WINDOW CASO EXISTA
       var tel1 = locations[index]['Telefone1'] ? `<p>1º Tel. Cliente: <b><a href="tel:0${locations[index]['Telefone1']}">${locations[index]['Telefone1']}</a></b></p>` : "";
       var tel2 = locations[index]['Telefone2'] ? `<p>2º Tel. Cliente: <b><a href="tel:0${locations[index]['Telefone2']}">${locations[index]['Telefone2']}</a></b></p>` : "";
       var tel3 = locations[index]['Telefone3'] ? `<p>3º Tel. Cliente: <b><a href="tel:0${locations[index]['Telefone3']}">${locations[index]['Telefone3']}</a></b></p>` : "";

       //VERIFICA E SÓ EXIBE SE PERÍODO EXISTIR
       var periodo = locations[index]['PeriodoAgendamento'] ? `<p>Período: <b>${locations[index]['PeriodoAgendamento']}</b></p>` : "";

       //VERIFICA E SÓ EXIBE SE OBS EXISTIR
       var Obs = locations[index]['ObsOT'] ? `<p>OBS: <b>${locations[index]['ObsOT']}</b></p>` : ""; 

       //INFORMAÇÕES EXIBIDAS NO WINDOW
       var contentString = `<div class='info-content'><p>OT: <b>${locations[index]['NumOT']}</b></p><p>OS: <b>${locations[index]['NumOS']}</b></p><p class='m_bottom'>Serviço: <b>${locations[index]['NomeOs']}</b></p>${periodo}${Obs}${tel1}${tel2}${tel3}`;

      }else{
        var latitude = parseFloat(locations[index]['LATITUDE']);
        var longitude = parseFloat(locations[index]['LONGITUDE']);
        var image = image4;

        var marker = new google.maps.Marker({
        map: map,
        icon: image,
        animation: google.maps.Animation.DROP,
        position: {lat: latitude, lng: longitude},     
        title: ''});

        var contentString = `<div class='info-content'><p>TÉCNICO: <b>${locations[index]['NOME']}</b></p><p>CARRO: <b>${locations[index]['CARRO']}</b></p><p class='m_bottom'>ÚLTIMA ATUALIZAÇÃO: <b>${locations[index]['DATAHORA']}</b></p>`;        
      }
      
      var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 600
      });
      marker.addListener('click', function () {
        //FECHA TODAS AS JANELAS ABERTAS
        $('.gm-ui-hover-effect').trigger('click');

        //ABRE NOVA JANELA
        infowindow.open(map, marker);
      });

      //FECHA O INFOWINDOW QUANDO OCORRE CLICK NO MAPS
      google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
      });
    });
  }
}

$(document).ready(function(){
  $('.spinner').show();
  $('#Tecnico').val('t');
  $('#Tecnico').change();
});

</script>

<!--Chamada da API do Google Maps-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0&callback=initMap"></script>

<script>

    var tempoInicial = 0;
    //SE TEMPO INICIAL FOR IGUAL 60 REALIZA REFRESH NA PÁGINA
    setInterval(function(){
      tempoInicial++;
      if(tempoInicial === 60){
         $('#Tecnico').change();
      }
    },1000);

    //SE OCORRER UM DOS EVENTOS ABAIXO TEMPO INICIAL RECEBE (0)
    $(document).on({
        click: function(){
          tempoInicial = 0;
        },
        mousemove: function(){
          tempoInicial = 0;
        }
      });

</script>
<style>

  /* tabela monitoramento GNS */
.monitoramentoGns {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}



.monitoramentoGns td, .monitoramentoGns th {
    
    padding: 8px;
}

.monitoramentoGns>tbody tr:nth-child(even) {
    background-color:  #dddddd61;
}
</style>
