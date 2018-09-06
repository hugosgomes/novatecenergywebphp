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
<link rel="stylesheet" href="_css/clientes_particulares.css"/>

<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />



<header class="dashboard_header">
  <div class="dashboard_header_title">
    <h1 class="icon-users">Clientes Residenciais</h1>
    <p class="dashboard_header_breadcrumbs">
    &raquo;</span>
    <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/particulares">Clientes Particulares</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/particulares">Residenciais</a>

  </p>
</div>
</header>

<div class="dashboard_content custom_app dashboard_custom">
  <div class="box box33">
    <form>
     <div class="label_50" >
      <label class="label">
        <form method="" action="">
          <span class="legend">Buscar Endereço:</span>
          <select id="endereco" style="font-family: Arial;font-size: 11px;" class="j_select_endereco" callback="Home" callback_action="consulta">
            <option value="t" class="j_option_endereco">>> TODOS <<</option>
          </select>
        </form>
      </label>

    </div>
  </form>
</div>
<div class="box box33">
  <form>
   <div class="label_50" >
    <label class="label">
      <form method="" action="">
        <span class="legend">Buscar Cliente:</span>
        <select id="cliente" style="font-family: Arial;font-size: 11px;" class="j_select_cliente" callback="Home" callback_action="consulta">
          <option value="t" class='j_option_cliente'>>>> TODOS <<</option>
        </select>
      </form>
    </label>
  </div>
</form>
</div>
<div class="top_border" style="border-top: solid; border-color: #052242;"></div>
<div class="box box57">
  <div class="box_content" style="margin: 0px;">
    <h5 class="title_view">GERAL</h5>
  </div>
</div>
<div class="box box42">
  <div class="box_content" style="margin: 0px;padding-top: 5px;padding-bottom: 10px;">
   <label class="label" style="margin-bottom: 0px;text-align: center;">
    <span><b>MÊS:</b></span>
    <select id="mes" style="font-family: Arial;font-size: 11px;width: 30%;" callback="Home" callback_action="consulta">
      <option value="1">JANEIRO</option>
      <option value="2">FEVEREIRO</option>
      <option value="3">MARÇO</option>
      <option value="4">ABRIL</option>
      <option value="5">MAIO</option>
      <option value="6">JUNHO</option>
      <option value="7">JULHO</option>
      <option value="8">AGOSTO</option>
      <option value="9">SETEMBRO</option>
      <option value="10">OUTUBRO</option>
      <option value="11">NOVEMBRO</option>
      <option value="12">DEZEMBRO</option>
    </select>
  </label>
</div>
</div>
<div class="box box100">
  <div class="box box14 bbox">
    <div class="panel_header darkblue">
      <h2 class="">Sem Contato</h2>
    </div>
    <br>
    <div class="coluna j_coluna_1">
      
   </div>
 </div>
 <div class="box box14 bbox">
  <div class="panel_header darkblue">
    <h2 class="">Visita Agendada</h2>
  </div>
  <br>
  <div class="coluna j_coluna_2">
          
 </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header darkblue" id="js_emAnalise">
    <h2 class='js_h2_emAnalise'><span class='icon-sort-numberic-desc' id="j_ordemEmAnalise" ordemAnalise="data" callback="Home" callback_action="consulta" style='font-size: 15px;float: right;color: white;'></span>Em Análise (R$)0,00}<br></h2>
  </div>
  <br>
  <div class="coluna j_coluna_3">
          
 </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header darkblue" id="js_executando">
   <h2 class="js_h2_executando"><a href="#"><i class="icon-sort-numberic-desc" id="j_ordemExecutando" ordemExecutando="data" callback="Home" callback_action="consulta" style="font-size: 15px;float: right;color: white;"></i></a>Executando (R$)0,00<br></h2>
 </div>
 <br>
 <div class="coluna j_coluna_4">
     
</div>
</div>
<!-- SEGUNDO BLOCO DE COLUNAS -->

<div class="box box14 bbox">
  <div class="panel_header info" style="text-align: center;">
    <h2 class="">Executado</h2>
  </div>
  <br>
  <div class="coluna j_coluna_5">
     
</div>
</div>
<div class="box box14 bbox">
  <div class="panel_header info" style="text-align: center;">
    <h2 class="">Cancelado</h2>
  </div>
  <br>
  <div class="coluna j_coluna_6">
          
 </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header info" style="text-align: center;">
    <h2 class="">Recusado</h2>
  </div>
  <br>
  <div class="coluna j_coluna_7">
          
 </div>
</div>
</div>

<div class="testeModal">
  

</div>

<div class="window chamados">
  <a href="#" class="fechar"><span class="icon-cross" style="list-style-type: none; color: black;"><span></a>
    <div class="panel_header" style=" border-bottom: 1px solid #04182e;
    border-width: 2px;">
    <h2 class="icon-keyboard" style="text-align: center;font-size: 15px;"><b>CHAMADO DO CLIENTE</b></h2>
  </div>
  <br>
  <div class="top-chamados">
    <div id="j_dados_clientes">
      <div class="dados_clientes">
       <h5>CINTIA LUÍZA MOURA MAILARD</h5>
       <ul class="cl_dados">
         <li style="padding-bottom: 0px;" class="dados_endereco"><span class="m_endereco"></span></li>
         <li  style="padding-bottom: 0px;">cintialuizamoura@gmail.com</li>
         <li  style="padding-bottom: 0px;"><a href="tel:021980564678" style="color: #004491">(21) 3046-8004</a></li>
         <br>
         <hr>
       </div>
     </div>
     <div class="formulario">
      <form method="post" action="">
       <div class="label_33">
        <label class="label" style="width: 18.6666%;">
          <span class="legend" >DATA AGENDAMENTO:</span>
          <input type="text" placeholder="<?php echo date('d/m/Y'); ?>" class="jwc_datepicker" style="font-family: Arial;font-size: 11px;">
        </label>

        <label class="label">
          <span class="legend">TÉCNICO:</span>
          <select id="" style="font-family: Arial;font-size: 11px;">
            <option>CINTIA LUÍZA MOURA MAILARD</option>
            <option>CINTIA LUÍZA MOURA MAILARD</option>
          </select>
        </label>

        <label class="label" style="width: 25%;">
          <span class="legend">STATUS:</span>
          <select id="j_statusOrcamento" style="font-family: Arial;font-size: 11px;">
              <?php 
                foreach (getStatusOrcamento() as $key => $value) {
                  echo "<option>$value</option>";
                }
              ?>
          </select>
        </label>
      <label class="label" style="width: 20.6%;">
          <span class="legend">VALOR:</span>
          <input class="input" style="font-family: Arial;font-size: 11px;" type="text" name="campo3" placeholder="R$" required/>
        </label>

        <label class="label" style="margin-left: 0px;">
          <span class="legend">FORMA DE PAGAMENTO:</span>
          <select id="" style="font-family: Arial;font-size: 11px;">
            <option>CARTÃO DE CRÉDITO</option>
            <option>DEPÓSITO/TRANSFERÊNCIA</option>
            <option>Á VISTA</option>
          </select>
        </label>


        <label class="label">
          <span class="legend">QUANTIDADE DE PARCELAS:</span>
          <input class="input" style="font-family: Arial;font-size: 11px;" type="text" name="campo3" placeholder="" required/>
        </label>

        <label class="label">
          <span class="legend">OBSERVAÇÃO:</span>
          <input class="input" style="font-family: Arial;font-size: 11px;" type="text" name="campo3" placeholder="" required/>
        </label>


        <label class="label">
         <button onclick="salvarChamado();" name="titulo" class="btn btn_darkblue" style="font-size: 15px;"><span class="icon-floppy-disk"></span>&ensp;Salvar</button>
       </label>

     </div>
   </form>

 </div>
</div>
<br>
<div class="coluna" style="height: 50%;">
  <?php 
  $contador = 0;
  while($contador < 10){

    ?>
    <div class="box_content buttons_clientes" style="height: 15%;">
      <ul>
        <li style="padding-bottom: 0px;"><a class="link" rel="modal"><span style="float: right;">Usuário Sistema: Cintia Mailard<p><b>Tipo Serviço: Remanejamento</b></p></span></a></li>
        <li style="padding-bottom: 0px;"><a class="link" rel="modal"><span class='icon-history'></span><span><b>AGENDAMENTO REALIZADO</b><p>Data: 30/08/2018</p></span></a></li>
      </ul>
    </div>

    <?php
    $contador ++;
  }
  ?>       
</div>
</div>
<!-- mascara para cobrir o site -->  
<div id="mascara"></div>
</div>

<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>


<script src="_js/clientes_particulares.js"></script>
<script src="_js/modal.js"></script>