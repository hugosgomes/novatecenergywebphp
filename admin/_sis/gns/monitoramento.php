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

      <?php      

      $ReadClientesAssoc = new Read();
      $ReadClientesAssoc->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]", "");

      ?>
      <article class="box box50 datalist">
        <table id="dataList" class="cell-border compact stripe table" style="width: 100%;font-size: 15px;">
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
    </article>
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
    </tr></table></div>";
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

  if(locations){
    locations.forEach(function(element, index, array){
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

      var contentString = "<h3 class='m_bottom'>"+locations[index]['NomeOs']+"</h3><div class='info-content'><p>OS: <b>"+locations[index]['NumOS']+"</b></p><p>Cliente: <b>"+locations[index]['NomeCliente']+"</b></p></p><p>Data: <b>"+dataFormatada+"</b></p>";

      var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 400
      });
      marker.addListener('click', function () {
        infowindow.open(map, marker);
      });
    });
  }
}

$(document).ready(function(){
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
         document.location.reload(true);
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
