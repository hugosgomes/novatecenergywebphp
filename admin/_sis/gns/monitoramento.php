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
                $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS nome, SUB.PRODUTO,
                  CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.ID ELSE TERC.ID END AS id, SUB.IDPROD,
                  CASE WHEN FUNC.ID IS NOT NULL THEN 'FUNCIONÁRIO' ELSE 'TERCEIRIZADO' END AS TIPOFUNC FROM [40_Interna_ID]
                  LEFT JOIN Funcionários FUNC ON [40_Interna_ID].USUARIO_PORTADOR = FUNC.ID
                  LEFT JOIN FuncionariosTerceirizados TERC ON [40_Interna_ID].USUARIO_PORTADOR_TERCEIRIZADO = TERC.ID
                  INNER JOIN [00_NivelAcesso] ON FUNC.ID = [00_NivelAcesso].IDFUNCIONARIO OR TERC.ID = [00_NivelAcesso].IDTERCEIRIZADO
                  INNER JOIN(
                  SELECT max([40_Interna].INTERNA) ULTMOV, [40_Produtos].PRODUTO, [40_Produtos].Id IDPROD FROM [40_Produtos]
                  INNER JOIN [40_Interna] ON [40_Produtos].Id = [40_Interna].PRODUTO
                  WHERE [40_Produtos].PRODUTO LIKE 'MANÔMETRO%'
                  GROUP BY [40_Produtos].PRODUTO, [40_Produtos].Id) SUB
                  ON [40_Interna_ID].ID = SUB.ULTMOV
                  WHERE [40_Interna_ID].TIPO_MOVIMENTO = 244 AND MOBILE_GNS = 1
                  ORDER BY NOME"," ");
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
        AND [DataAgendamento] = :day AND [60_OS].Status <> 0","day={$Data}");

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
    echo "<div class='box box25'><span class='flt_right m_left qtdOs'>Quantidade de OS:<b> ".count($Read->getResult())."</b></span></div>
    <div class='box box50'>
    <table>
    <tr>
    <td><div class='nao-atendido'></div></td><td>&ensp;Não Atendido&ensp;</td>
   <!-- <td><div class='associado'></div></td><td>&ensp;Associado&ensp;</td>-->
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
    var image2 = './_img/marcador2.png';
    //var image3 = './_img/marcador3.png';
    var number = 5;

    <?php

    foreach ($Read->getResult() as $OS):
      extract($OS);     
     // $Cliente = str_replace("'", " ", $NomeCliente); // RETIRANDO APÓSTROFO
                         
      echo "var marker".$Id." = new google.maps.Marker({
        position: myLatLng,
        map: map,"; 
        if($Status == 1):       
          echo"icon: image1,"; 
        elseif($Status > 1):
          echo"icon: image2,"; 
        else:
         // echo"icon: image3,"; 
        endif;
 
        echo "animation: google.maps.Animation.DROP,
        position: {lat:".$Latitude.", lng: ".$Longitude."},     
        title: ''});";
?>
        var contentString = "<div class='info-window'><h3 class='m_bottom'><?php echo $OSServico; ?></h3><div class='info-content'><p>OS: <b><?php echo $NumOS;?></b></p><p>Cliente: <b><?php echo $NomeCliente; ?></b></p></p><p>Nome Os: <b><?php echo $NomeOs; ?></b></p><p>Data: <b><?php echo date('d/m/Y', strtotime($DataAgendamento)); ?></b></p></div></div>";

<?php
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
  <script>

      var tempoInicial = 0;
      //SE TEMPO INICIAL FOR IGUAL 60 REALIZA REFRESH NA PÁGINA
      setInterval(function(){
        tempoInicial++;
        if(tempoInicial === 60){
           document.location.reload(true);
        }
        console.log(tempoInicial);
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
