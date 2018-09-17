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
<style type="text/css">
.blocker{
    z-index: 98;
}
input{
    outline: none;
}
</style>
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
              <a href="http://www.mapcoordinates.net/pt" target="_blank" class="btn btn_darkblue"><i class="icon-search"></i>Buscar Coordenadas</a>
          </div>
          <div class="box box33">
            <center><h3>Endereços Sem Coordenadas</h3></center>
          </div>
          <div class="box box33"></div>
      </header> 
      <div class="box_content">
        <div class='box box100'>
           <div class="tabela-responsivel">
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
</div>
<script>
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
<!--Inicia o data table-->
<script src="_js/gns.js"></script>