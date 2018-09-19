<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['CLIENTES_PARTICULARES'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;
?>
<style type="text/css">
  .panel_header{
     padding: 0px;
  padding-top: 12px;
}
</style>
<link rel="stylesheet" href="_css/clientes_particulares.css"/>
<header class="dashboard_header">
  <div class="dashboard_header_title">
    <p class="dashboard_header_breadcrumbs">
    &raquo;</span>
    <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/particulares">Clientes Particulares</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/home">Pequenos Orçamentos</a>

  </p>
</div>
</header>

<div class="dashboard_content custom_app dashboard_custom">
  <div class="box box33">
    <form>
     <div class="label_50" >
      <label class="label" >
        <form method="" action=""> 
          <select id="endereco" style="font-family: Arial;font-size: 11px;" class="j_select_endereco form_personalize" callback="Home" callback_action="consulta">
            <option value="t" class="j_option_endereco">>> BUSCAR ENDEREÇO <<</option>
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
        <select id="cliente" style="font-family: Arial;font-size: 11px;" class="j_select_cliente" callback="Home" callback_action="consulta">
          <option value="t" class='j_option_cliente'>>> BUSCAR CLIENTE <<</option>
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
  <div class="box_content" style="margin: 0px;padding-top: 5px;padding-bottom: 10px;height: 4.6%;">
   <label class="label" style="margin-bottom: 0px;text-align: center;">
      <h5 class="title_view" style="float: left;padding-top: 10px;padding-left: 45%;">MÊS</h5>
   <button class="btn btn_darkblue" onclick="filtro_mes('mes')" style="float: right;padding-right: 10px;outline: none;margin-top: 3px;"><span class="icon-filter">Filtrar por Mês</span></button>
   <select id="mes" style="font-family: Arial;font-size: 11px;width: 20%;display: none;margin-top: 2px;" callback="Home" callback_action="consulta"  class="target">
    <option value="01" id="meses">JANEIRO</option>
    <option value="02" id="meses">FEVEREIRO</option>
    <option value="03" id="meses">MARÇO</option>
    <option value="04" id="meses">ABRIL</option>
    <option value="05" id="meses">MAIO</option>
    <option value="06" id="meses">JUNHO</option>
    <option value="07" id="meses">JULHO</option>
    <option value="08" id="meses">AGOSTO</option>
    <option value="09" id="meses">SETEMBRO</option>
    <option value="10" id="meses">OUTUBRO</option>
    <option value="11" id="meses">NOVEMBRO</option>
    <option value="12" id="meses">DEZEMBRO</option>
  </select>
</label>
</div>
</div>
<div class="box box100">
  <div class="box box14 bbox">
    <div class="panel_header darkblue_gradient" style="text-align: center;">
      <h2 class="">Sem Contato</h2>
    </div>
    <div class="coluna j_coluna_1">

    </div>
  </div>
  <div class="box box14 bbox">
    <div class="panel_header darkblue_gradient" style="text-align: center;">
      <h2 class="">Visita Agendada</h2>
    </div>
    <div class="coluna j_coluna_2">

    </div>
  </div>
  <div class="box box14 bbox">
    <div class="panel_header darkblue_gradient" id="js_emAnalise" style="text-align: center;padding-top: 3px;">
      <h2 class='js_h2_emAnalise'><span class='icon-sort-numberic-desc' id="j_ordemEmAnalise" ordemAnalise="data" callback="Home" callback_action="consulta" style='font-size: 15px;float: right;color: white;'></span>Em Análise <p style="color: white;">(R$)0,00}</p><br></h2>
    </div>
    <div class="coluna j_coluna_3">

    </div>
  </div>
  <div class="box box14 bbox">
    <div class="panel_header darkblue_gradient" id="js_executando" style="text-align: center;padding-top: 3px;">
     <h2 class="js_h2_executando"><a href="#"><i class="icon-sort-numberic-desc" id="j_ordemExecutando" ordemExecutando="data" callback="Home" callback_action="consulta" style="font-size: 15px;float: right;color: white;"></i></a>Serviço Agendado (R$)0,00<br></h2>
   </div>
   <div class="coluna j_coluna_4">

   </div>
 </div>
 <!-- SEGUNDO BLOCO DE COLUNAS -->

 <div class="box box14 bbox">
  <div class="panel_header info_gradient" id="js_executado" style="text-align: center;padding-top: 3px;">
    <h2 class="js_h2_executado"><a href="#"><i class="" id="j_ordemExecutado" ordemExecutado="data" callback="Home" callback_action="consulta" style="font-size: 15px;float: right;color: white;"></i></a>Executado <p style="color: white;">(R$)0,00</p></h2>
  </div>
  <div class="coluna j_coluna_5">

  </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header info_gradient" id="js_cancelado" style="text-align: center;padding-top: 3px;">
    <h2 class="js_h2_cancelado"><a href="#"><i class="" id="j_ordemCancelado" ordemCancelado="data" callback="Home" callback_action="consulta" style="font-size: 15px;float: right;color: white;"></i></a>Cancelado <p style="color: white;">(R$)0,00</p></h2>
  </div>
  <div class="coluna j_coluna_6">

  </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header info_gradient" id="js_recusado" style="text-align: center;padding-top: 3px;">
    <h2 class="js_h2_recusado"><a href="#"><i class="" id="j_ordemrecusado" ordemRecusado="data" callback="Home" callback_action="consulta" style="font-size: 15px;float: right;color: white;"></i></a>Recusado <p style="color: white;">(R$)0,00</p></h2>
  </div>
  <div class="coluna j_coluna_7">

  </div>
</div>
</div>
<div id="ex1" class="modal" style="height: auto;">
  <div class="panel_header" style=" border-bottom: 1px solid #04182e;
  border-width: 2px;">
  <h2 class="icon-keyboard" style="text-align: center;font-size: 15px;"><b>CHAMADO DO CLIENTE</b></h2>
</div>
<br>
<div class="top-chamados">
  <div class="box box100">
    <div id="j_dados_clientes">
      <div class="dados_clientes">
       <h5>CINTIA LUÍZA MOURA MAILARD</h5>
       <ul class="cl_dados">
         <li style="padding-bottom: 0px;" class="dados_endereco"><span class="m_endereco"></span></li>
         <li  style="padding-bottom: 0px;">cintialuizamoura@gmail.com</li>
         <li  style="padding-bottom: 0px;"><a href="tel:021980564678" style="color: #004491">(21) 3046-8004</a></li>
       </ul>
       <br>
       <hr>
     </div>
   </div>
 </div><!-- BOX 100 -->
 <div class="box box100">
   <div class="formulario">
    <form method="post" action="" id="j_form">
      <input type="hidden" name="callback" value="Home"/>
      <input type="hidden" name="callback_action" value="salvachamado"/>
      <div class="label_33">

        <label class="label" style="width: 25%;">
          <span class="legend">STATUS:</span>
          <select id="j_statusOrcamento" class="j_status wc_value" name="STATUS" style="font-family: Arial;font-size: 11px;">

          </select>
        </label>
        <label class="label" style="width: 18.6666%;">
          <span class="legend">DATA AGENDAMENTO:</span>
          <input type="text" placeholder="" class="jwc_datepicker wc_value j_data" name="DATAAGENDAMENTO" readonly = "readonly" style="font-family: Arial;font-size: 11px;" required/>
        </label>

        <label class="label">
          <span class="legend">TÉCNICO:</span>

          <select name="TECNICO" id="j_select_tecnicos" class="j_tecnico wc_value" style="font-family: Arial;font-size: 11px;"> 
          </select>
        </label>
        

        <label class="label" style="width: 20.6%;">
          <span class="legend">VALOR:</span>
          <input class="input j_valor wc_value" style="font-family: Arial;font-size: 11px;" name="VALOR" type="text" size='10' value='' onkeypress='return SomenteNumeroVirgula(this,event)' id="valor" name="campo3" placeholder="R$" required/>
        </label>

        <label class="label" style="margin-left: 0px;">
          <span class="legend" >FORMA DE PAGAMENTO:</span>
          <select id="" class="j_forma wc_value" name="FORMAPAGAMENTO" style="font-family: Arial;font-size: 11px;">
            <?php 
            foreach (getFormaPagamento() as $key => $value) {
              echo "<option value='{$key}'>$value</option>";
            }
            ?>
          </select>
        </label>

        <label class="label">
          <span class="legend">QUANTIDADE DE PARCELAS:</span>

          <input class="input j_qnt wc_value" style="font-family: Arial;font-size: 11px;" name="QNTPARCELAS" type="text" size='2' value='' onkeypress='return SomenteNumero(this,event)' name="campo3" placeholder="" required/>
        </label>

        <label class="label">
          <span class="legend">OBSERVAÇÃO:</span>
          <input class="input j_obs wc_value" style="font-family: Arial;font-size: 11px;" name="OBS" type="text" name="campo3" placeholder="" required/>
        </label>

        <label class="label">
          <!--<span class="btn btn_blue icon-share fl_left" id="j_salva_chamado" onClick="salvarChamado();" callback="Home" callback_action="salvachamado">Cadastrar!</span>-->

          <span id="wc_pdt_stoc" name="public" value="1" class="btn btn_darkblue fl_left icon-share" style="margin-left: 5px;">Salvar</span>
        </label>
      </div>
    </form>
  </div>
</div>

</div>
<div  id="j_historico" class="coluna" style="height: 50%;margin-top: 3%;">
  <div class="box_content buttons_chamados" style="height: auto;">
    <ul>
      <div class="box box50" style="padding-bottom: 0px;">
        <li style="padding-bottom: 5px;"><h3><b><i class='icon-history'></i>&ensp;AGENDADO</b></h3></li>
        <li style="padding-bottom: 5px;font-size: 12px;">Data de Agendamento: 25/05/2018</li>
        <li style="padding-bottom: 5px;font-size: 12px;">Valor: R$ 100,00</li>
        <li style="padding-bottom: 5px;font-size: 12px;">Parcelas: 10</li>
      </div>
      <div class="box box50" style="padding-bottom: 0px;text-align: right;">
        <li style="padding-bottom: 5px;font-size: 12px;">Status: Em aberto</li>
        <li style="padding-bottom: 5px;font-size: 11px;color: gray;">Usuário: Cintia Mailard</li>
        <li style="padding-bottom: 5px;font-size: 11px;color: gray;">Registrado em: 25/05/2018</li>
      </div>
      <div class="box box100" style="padding-top: 0px;">
        <li style="padding-bottom: 5px;font-size: 12px;">OBS.: HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHaHHH</li>
      </div>

  </div>  


</div>
</div>

<!-- mascara para cobrir o site -->  
<div id="mascara"></div>
</div>
<script type="text/javascript">



</script>

<link rel="stylesheet" href="/resources/demos/style.css">
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="_js/clientes_particulares.js"></script>
<script src="_js/modal.js"></script>
