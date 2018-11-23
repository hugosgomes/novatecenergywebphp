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
.blocker{
    z-index: 98;
}
input{
    outline: none;
}
</style>
    <link rel="stylesheet" href="_css/mapaGns.css"/>   
<header class="dashboard_header">
    <div class="dashboard_header_title">
         <p class="dashboard_header_breadcrumbs">
        &raquo;</span>
        <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
        <span class="crumb">/</span>
        <a title="Novatec Energy" href="dashboard.php?wc=gns/agendamentos&day=<?= $Data->format('Ymd');?>">Agendamentos</a>
        <span class="crumb">/</span>
        OS Sem Endereço
    </p>
</div>
</header>

<div class="dashboard_content custom_app">
    <article class="box box100">
        <header>
            <div class="box box33">
              <!--<a href="dashboard.php?wc=gns/mapaGns" target="_blank" class="btn btn_darkblue"><i class="icon-search"></i>Buscar Coordenadas</a>-->
          </div>
          <div class="box box33">
            <center><h3>Endereços Sem Coordenadas</h3></center>
          </div>
          <div class="box box33"></div>
      </header> 
      <div class="box_content">
        <div class='box box100'>
           <div class="tabela-responsivel" style="height: 25%;overflow-y: scroll;">
              <table id="dataTable" class="cell-border compact stripe table" callback="Agendamentos" callback_action="os_s_end">
                <thead>
                  <tr>
                     <th>Endereço</th>
                     <th>Bairro</th>
                     <th>Município</th>
                     <th>CEP</th>
                     <th>Latitude</th>
                     <th>Longitude</th>
                     <th>Inserir Coordenadas</th>
                 </tr>
             </thead>
             <tbody id="j_table_S_END" style="font-size: 12px;">
                <tr class="j_table_S_END">
                </tr>  
            </tbody>
        </table>
    </div>
</div>    
<!--ONDE SERÃO APRESENTADOS O RESULTADO DA PESQUISA DE ENDEÇO -->
<div class='box box50'>
    <article>
        <div class="enderecos"></div>
    </article>
</div>
</div>
</article>
    <article class="box box100">
        <header>
            <div class="box box33">
              <input id="pac-input" class="controls pac-input" type="text" placeholder="Buscar com Endereço - Bairro - Município - Cep" style="margin-top: 10px;padding: 10px;display: none;">
          </div>
          <div class="box box33">
            <center><h3>Buscar Coordenadas</h3></center>
             <center><h6 style="color: red;">*Digite o endereço no campo de busca para encontrar suas respectivas coordenadas!</h6></center>
          </div>
      </header> 
          <div class="box_content">

    <div id="map" style="height: 25%;"></div>
  </div>
</article>
</div>
   
<script>

      function initAutocomplete() {
        setTimeout(function(){   $('.pac-input').fadeIn(); }, 800);
      
         var uluru = {lat: -22.9068467, lng: -43.1728965};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -22.9068467, lng: -43.1728965},
         zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;

            }
             
           var contentString = '<span style="font-size: 15px;"><b>Latitude: </b>'+ place.geometry.location.lat() + '<br><b>Longitude: </b>'+ place.geometry.location.lng() + '</span>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
        });

            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

             infowindow.open(map, marker);

           if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    $(document).ready(function() {

        os_SemEnd();

        $('#dataTable').DataTable({
          paging: false,
          compact: false,
          hover: true,
          searching: false,
          info: false
      });


    });
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0&libraries=places&callback=initAutocomplete"
         async defer></script>
<!--Inicia o data table-->
<script src="_js/gns.js"></script>