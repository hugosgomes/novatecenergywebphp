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
            Histórico de Clientes
        </p>
    </div>
</header>

<div class="dashboard_content custom_app">

    <article class="box box100">
      <div class="box_content">
        <div class="box box33">
          <div class="label_33">
            <label class="label">Nº do Cliente
              <input type="text" id="j_selectNum" placeholder="Nº CLIENTE">
            </label>
            <label class="label">Nome do Cliente
              <input type="text" id="j_selectClientes" placeholder="NOME DO CLIENTE">
            </label>
            <label class="label">Data de Agendamento
              <input type="text" id="j_selectData" placeholder="DATA AGENDAMENTO" class="jwc_datepicker">
            </label>            
          </div>
        </div>

        <div class="box box33">
          <div class="label_33">
            <label class="label">CPF/CNPJ
              <input type="text" id="j_selectCpf" placeholder="CPF/CNPJ">
            </label>
            <label class="label">Status da OS
              <select id="j_selectStatus" placeholder="STATUS">
                <option value="t">TODOS OS STATUS</option>
                <option value="0" selected="true">ASSOCIADO</option>
                <option value="1">ATENDIDO</option>
                <option value="2">CANCELADO</option>
                <option value="3">AUSENTE</option>
                <option value="4">REAGEND NVT</option>
                <option value="5">REAGEND GNS</option>
              </select>
            </label>
            <label class="label">CEP
              <input type="text" id="j_selectCep" placeholder="CEP">
            </label>            
          </div>
        </div>

        <div class="box box33">
          <div class="label_33">
          <label class="label">Endereço
              <input type="text" id="j_selectEndereco" placeholder="ENDEREÇO">
            </label>
            <label class="label">Bairro
              <input type="text" id="j_selectBairro" placeholder="BAIRRO"> 
            </label>
            <label class="label">Município
              <input type="text" id="j_selectMunicipio" placeholder="MUNICÍPIO">
            </label>
          </div>
        </div>
      </div>
    </article>

    <article class="box box70">
        <header>
          <h3 style="text-align: center;">Histórico de Clientes</h3>
        </header> 
        <div class="box_content">
          <div class="tabela-responsivel" style=" height: 60%;">
          <table id="dataTable"class="cell-border compact stripe table" callback="Historico" callback_action="Carregar">
            <thead>
       <tr style="font-size: 12px;">
                <!--<th>Status</th>-->
                <th>Número Cliente</th>
                <th>Nome Cliente</th>
                
                <th>Telefone</th>
                <th>Telefone</th>
                <th>Telefone</th>
                <th>Telefone Zeus</th>
                
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Município</th> 
                <th>CEP</th>
                          
                
                <th>Zona</th>
                <th>SubZona</th>
        
                <th>CPF/CNPJ</th>
                <th>E-Mail GNS</th>

              </tr>
            </thead>
            <tbody style="font-size: 12px;">
            
              <tr class="j_table"><td></td></tr>  
            </tbody>
          </table>
          <center>
              <img class="spinner" style="margin-left: 10px; margin-top: 2px; block-size: 10%;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_spinner.gif"/>
          </center>
        </div>
        </div>        
    </article>

    <article class="box box30">

      <header>
        <h3 style="text-align: center;">Dados do Cliente</h3>
      </header> 
      <div class="box_content scroll-historico">
      <div class="box_content">    
        <div class="sample_tab_nav">
              <a class='conf_menu wc_tab wc_active' href='#dados'><span class="icon-stack">Dados</span></a>
              <a class='conf_menu wc_tab' href='#docs'><span class="icon-codepen">Documentos</span></a>
        </div>   
        <div class="tab_contents">
            <div class='wc_tab_target wc_active' id='dados'>
              <ul id = "j_dadosCli">
                <span>****SELECIONE UM CLIENTE****</span>
              </ul>
            </div>
            <div class='wc_tab_target ds_none' id='docs'>
              <ul id = "j_docsCli">
                <span>****SELECIONE UM CLIENTE****</span>
              </ul>
            </div>              
        </div>
      </div>
    
      <header>
        <h3 style="text-align: center;">Histórico de OT's</h3>
      </header> 
      <div class="box_content">
        <ul id = "j_numot">
        <ul id = "j_historicosOs">
          <hr><hr>
          <span>****SELECIONE UM CLIENTE****</span>
        </ul>
        <hr><hr>
      </div>
    </div>
    </article>

</div>

<!--Inicia o data table-->
<script src="_js/gns.js"></script>
<script>
    $(document).ready(carregaDados);
    $('#dataTable').DataTable({
          paging: false,
          compact: false,
          hover: true,
          searching: true,
          info: false
        });
</script>

<style type="text/css">
  .s_filtros *{
    font-family: Arial;font-size: 11px;
  }

</style>