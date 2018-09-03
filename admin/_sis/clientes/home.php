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
          <select id="" style="font-family: Arial;font-size: 11px;">
            <option>RUA CONDE DE AGROLONGO</option>
            <option>RUA ANA LIMA</option>
            <option>RUA FERNANDO VASCONCELOS</option>
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
        <select id="" style="font-family: Arial;font-size: 11px;">
          <option>CINTIA MAILARD</option>
          <option>RODRIGO DIAS</option>
          <option>HUGO GOMES</option>
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
    <select id="" style="font-family: Arial;font-size: 11px;width: 30%;">
      <option>JANEIRO</option>
      <option>FEVEREIRO</option>
      <option>MARÇO</option>
      <option>ABRIL</option>
      <option>MAIO</option>
      <option>JUNHO</option>
      <option>JULHO</option>
      <option>AGOSTO</option>
      <option>SETEMBRO</option>
      <option>OUTUBRO</option>
      <option>NOVEMBRO</option>
      <option>DEZEMBRO</option>
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
      <?php 
      $Read->FullRead("SELECT [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                      [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO FROM [80_Orcamentos]
                      INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                      INNER JOIN [80_Enderecos] ON [80_ClientesParticulares].ID = [80_Enderecos].IDCLIENTE
                      WHERE [80_Orcamentos].STATUS = 0 
                      ORDER BY [80_Orcamentos].DATASOLICITACAO"," ");
      if ($Read->getResult()){
        foreach ($Read->getResult() as $enderecos){
          extract($enderecos);
          ?>
          <div class="box_content buttons_clientes clientes_sem_contato">
           <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
             <span  style="color: #bdbdbd;"></span>
           </div></a>
             <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b><?php echo $ENDERECO ?></b></span></a></li></ul>
           </div>

         <?php
        }
      }
     ?>       
   </div>
 </div>
 <div class="box box14 bbox">
  <div class="panel_header darkblue">
    <h2 class="">Visita Agendada</h2>
  </div>
  <br>
  <div class="coluna">
    <?php 
    $contador = 0;
    while($contador < 10){

      ?>
         <div class="box_content buttons_clientes">
         <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
           <span class="icon-circle-down" style="color: #bdbdbd;"></span>
         </div></a>
         <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b>Rua Conde de Agrolongo, 362 - Penha</b></span></a></li></ul>
       </div>

     <?php
     $contador ++;
   }
   ?>       
 </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header darkblue">
    <h2 class=""><a href="#"><i class="icon-sort-numberic-desc" style="font-size: 15px;float: right;color: white;"></i></a>Em Análise (R$)<br></h2>
  </div>
  <br>
  <div class="coluna">
    <?php 
    $contador = 0;
    while($contador < 10){

      ?>
        <div class="box_content buttons_clientes">
         <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
           <span class="icon-circle-down" style="color: #bdbdbd;"></span>
         </div></a>
         <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b>Rua Conde de Agrolongo, 362 - Penha</b></span></a></li></ul>
       </div>
     <?php
     $contador ++;
   }
   ?>       
 </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header darkblue">
   <h2 class=""><a href="#"><i class="icon-sort-numberic-desc" style="font-size: 15px;float: right;color: white;"></i></a>Executando (R$)<br></h2>
 </div>
 <br>
 <div class="coluna">
  <?php 
  $contador = 0;
  while($contador < 10){

    ?>
       <div class="box_content buttons_clientes">
         <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
           <span class="icon-circle-down" style="color: #bdbdbd;"></span>
         </div></a>
         <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b>Rua Conde de Agrolongo, 362 - Penha</b></span></a></li></ul>
       </div>
   <?php
   $contador ++;
 }
 ?>       
</div>
</div>
<!-- SEGUNDO BLOCO DE COLUNAS -->

<div class="box box14 bbox">
  <div class="panel_header info" style="text-align: center;">
    <h2 class="">Executado</h2>
  </div>
  <br>
  <div class="coluna">
   <?php 
   $contador = 0;
   while($contador < 10){

    ?>
        <div class="box_content buttons_clientes">
         <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
           <span class="icon-circle-down" style="color: #bdbdbd;"></span>
         </div></a>
         <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b>Rua Conde de Agrolongo, 362 - Penha</b></span></a></li></ul>
       </div>
   <?php
   $contador ++;
 }
 ?>      
</div>
</div>
<div class="box box14 bbox">
  <div class="panel_header info" style="text-align: center;">
    <h2 class="">Cancelado</h2>
  </div>
  <br>
  <div class="coluna">
    <?php 
    $contador = 0;
    while($contador < 10){

      ?>
<<<<<<< HEAD
      <div class="box_content buttons_clientes" style="height: 9%;">
       <ul><li><span class='icon-calendar'></span><span><b>30/08/2018</b></span></li></ul>
     </div>
=======
         <div class="box_content buttons_clientes">
         <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
           <span class="icon-circle-down" style="color: #bdbdbd;"></span>
         </div></a>
         <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b>Rua Conde de Agrolongo, 362 - Penha</b></span></a></li></ul>
       </div>
>>>>>>> front
     <?php
     $contador ++;
   }
   ?>       
 </div>
</div>
<div class="box box14 bbox">
  <div class="panel_header info" style="text-align: center;">
    <h2 class="">Recusado</h2>
  </div>
  <br>
  <div class="coluna">
    <?php 
    $contador = 0;
    while($contador < 10){

      ?>
          <div class="box_content buttons_clientes">
         <a href="#"><div class="panel_header" style="padding: 0px;border: none;">
           <span class="icon-circle-down" style="color: #bdbdbd;"></span>
         </div></a>
         <ul><li class="endereco_txt"><a class="link" href=".chamados" rel="modal"><span><b>Rua Conde de Agrolongo, 362 - Penha</b></span></a></li></ul>
       </div>
     <?php
     $contador ++;
   }
   ?>       
 </div>
</div>
</div>
<div class="window chamados">
  <a href="#" class="fechar"><span class="icon-cross" style="list-style-type: none; color: black;"><span></a>
    <div class="panel_header" style=" border-bottom: 1px solid #04182e;
    border-width: 2px;">
    <h2 class="icon-keyboard" style="text-align: center;font-size: 15px;"><b>CHAMADO DO CLIENTE</b></h2>
  </div>
  <br>
  <div class="top-chamados">
    <div class="dados_clientes">
     <h5>CINTIA LUÍZA MOURA MAILARD</h5>
     <ul class="cl_dados">
       <li style="padding-bottom: 0px;">Rua Conde de Agrolongo, 362 - Penha, Rio de Janeiro - RJ, 21020-190</li>
       <li  style="padding-bottom: 0px;">cintialuizamoura@gmail.com</li>
       <li  style="padding-bottom: 0px;">21980564678</li>
       <br>
       <hr>
     </div>
     <div class="formulario">
      <form method="post" action="">
       <div class="label_33">
        <label class="label">
          <span class="legend" >DATA AGENDAMENTO:</span>
          <input type="text" placeholder="<?php echo date('d/m/Y'); ?>" id="datepicker" style="font-family: Arial;font-size: 11px;">
        </label>

        <label class="label">
          <span class="legend">TÉCNICO:</span>
          <select id="" style="font-family: Arial;font-size: 11px;">
            <option>CINTIA LUÍZA MOURA MAILARD</option>
            <option>CINTIA LUÍZA MOURA MAILARD</option>
          </select>
        </label>

        <label class="label">
          <span class="legend">STATUS:</span>
          <select id="" style="font-family: Arial;font-size: 11px;">
            <option>EM ABERTO</option>
            <option>AGENDADO</option>
            <option>EM EXECUÇÃO</option>
            <option>EXECUTADO</option>
          </select>
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
         <button type="submit" name="titulo" class="btn btn_darkblue" style="font-size: 15px;margin-top: 10px;"><span class="icon-floppy-disk"></span>&ensp;Salvar</button>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="_js/clientes_particulares.js"></script>