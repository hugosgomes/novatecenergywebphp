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
            <a title="Novatec Energy" href="dashboard.php?wc=gns/agendamentos">Agendamentos</a>
            <span class="crumb">/</span>
            Histórico de Clientes
        </p>
    </div>
</header>

<div class="dashboard_content custom_app">

    <article class="box box100">
      <div class="box_content">
        <select id="j_selectClientes" style="font-family: Arial;font-size: 11px; width: 400px;">
          <option value="t">TODOS OS CLIENTES</option>
        </select>
      </div>
    </article>

    <article class="box box70">
        <header>
          <h3>Histórico de Clientes</h3>
        </header> 
        <div class="box_content">
          <table id="dataTable"class="cell-border compact stripe table" callback="Historico" callback_action="Carregar">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Município</th>
              </tr>
            </thead>
            <tbody>
              <tr class="j_table"><td></td></tr>  
            </tbody>
          </table>
        </div>        
    </article>

    <article class="box box30">
      <header>
        <h3>Histórico de OS's</h3>
      </header> 
      <div class="box_content">
        <ul id = "j_historicosOs">
          <hr><hr>
          <span>****SELECIONE UM CLIENTE****</span>
        </ul>
        <hr><hr>
      </div>
    </article>

</div>

<!--Inicia o data table-->
<script src="_js/gns.js"></script>
<script>
    $(document).ready(carregaDados);
    $('#dataTable').DataTable({
          paging: true,
          compact: true,
          hover: true,
          searching: true,
          info: false
        });
</script>