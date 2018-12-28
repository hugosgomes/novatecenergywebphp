<?php
require '_app/Config.inc.php';
// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;

if (empty($LatLng)):
  $LatLng = new Read;
endif;



?>


    <script src="_cdn/jquery.js"></script>
    <script src="_cdn/jquery.form.js"></script>
    <script src="admin/_js/workcontrol.js"></script>
    <script src="admin/_js/jquery.maskMoney.js" type="text/javascript"></script>

    <script src="admin/_js/tinymce/tinymce.min.js"></script>
    <script src="admin/_js/maskinput.js"></script>
    <script src="admin/_js/workplugins.js"></script>

    <script src="_cdn/highcharts.js"></script>
    <script src="_cdn/datepicker/datepicker.min.js"></script>
    <script src="_cdn/datepicker/datepicker.pt-BR.js"></script>

    <!--Chamada do datatable-->
    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>



          <?php

          $LatLng->FullRead("SELECT Id, Endereco, Bairro, Municipio, Cep FROM [60_OS] WHERE Latitude IS NUll AND Longitude IS NULL", " ");

          ?>
         


          <div id="map" class="no-print" style="height: 59.3%;"></div>


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
        $.post('admin/_ajax/gns/'+ Callback +'.ajax.php', {callback: Callback, callback_action: Callback_action, Id: Id, Latitude: lat, Longitude: lng}, function (data) {

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
<?php  $qtd_OS = count($Read->getResult()); ?>
<script>
  var marker, i;
  var map;
  var markers = [];
  function initMap() {
   var locations = [];
   
   <?php  for ($i = 0; $i < $qtd_OS; $i++) { ?>

    locations[<?php echo $i; ?>] = ['<div class="info-window"><div class="info-content"><p>OS: <b><?php echo $Read->getResult()[$i]["NumOS"]; ?></b></p><p>Cliente: <b><?php echo $Read->getResult()[$i]["NomeCliente"]; ?></b></p><p>Serviço: <b><?php echo $Read->getResult()[$i]["NomeOs"]; ?></b></p><p>Data: <b><?php echo date("d/m/Y", strtotime($Read->getResult()[$i]["DataAgendamento"])); ?></b></p><span rel="single_message" callback="Agendamentos" callback_action="addTecnico" class="j_add_tecnico icon-plus btn btn_darkblue" id="<?php echo $Read->getResult()[$i]["Id"];?>" num="<?php echo $i;?>" total="<?php echo $qtd_OS; ?>">Add</span></div></div>', <?php echo $Read->getResult()[$i]['Latitude']; ?>, <?php echo $Read->getResult()[$i]['Longitude']; ?>, <?php echo $Read->getResult()[$i]["Id"];?>]

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

</script>

<!--Chamada da API do Google Maps-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0&callback=initMap"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
