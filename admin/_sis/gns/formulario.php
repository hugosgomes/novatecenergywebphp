<?php
$AdminLevel = LEVEL_WC_USERS;
if (!$DashboardLogin):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Create)):
    $Create = new Create;
endif;

$IdOS = filter_input(INPUT_GET, 'IdOS', FILTER_VALIDATE_INT);
$IdTecnico = filter_input(INPUT_GET, 'IdTecnico', FILTER_VALIDATE_INT);



?>
<style>
.dashboard_sidebar{
    height: 69px;
}
.blocker{
    z-index: 98;
}
.scroll-modal{
    overflow: auto;
    max-height:600px;
}

.modal{
    max-width: 1400px;
}

.btn_darkblue{
    margin-bottom: 15px;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}



td, th {
    border: 1px solid #dddddd;
    padding: 8px;
}

tr:hover {
  background-color: #ddd;
}

tr:nth-child(even) {
    background-color:  #f2f2f2;;
}

.panel_header.default{
    background: #FFF !important;
    border-top: 5px solid #092b50 !important;
    border-bottom: 1px solid #EEE !important;
    color: #555;
}
.box_conf_menu a{
    color: #092b50;
}
    .box_conf_menu a.wc_active{
        background: #092b50;
        color: #fff;
    }
    .tab_title{
        font-size: 15px;
        font-weight: bold;
        text-transform: uppercase;
        color: #092b50;
    }
    th{
        width: auto;
    }

    #o_tabela-pecasEservicos input{
      border:none;
      text-align:left;
      background:transparent;
    }

</style>
<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=gns/historico">Histórico de Clientes</a>
            <span class="crumb">/</span>
            Orçamento
        </p>
    </div>
</header>

<!-- CODIGO ADD LINHAS -->
<div class="dashboard_content custom_app">
   <div class="box box100">
       <!--<div class="box box25">
          <button class="btn btn_green" style="outline: none;" id="target"><span class="icon-plus"></span>Adicionar</button>
            <button class="btn btn_red" style="outline: none;" id="target2"><span class="icon-cross"></span>Excluir</button>
       </div>-->
   <div class="box_content">
       <form method="post" id="j_form" enctype="multipart/form-data">
        <?php 
          echo "<input type='hidden' name='IdOS' value='{$IdOS}'>";
          echo "<input type='hidden' name='IdTecnico' value='{$IdTecnico}'>";
        ?>
        <input type="hidden" name="callback" value="Dadostabela"/>
                            <input type="hidden" name="callback_action" value="dados_formulario"/>
           <div class="box box70">
             <article class="wc_tab_target wc_active" id="testeEstanqueidade">
               <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                   <center><h1 class="tab_title" >Teste de Estanqueidade</h1></center>
                   <br>
               </div>
               <div class="panel">
                <?php include_once('tabEstanqueidade.php');?>
                <?php include_once('tabDefeitos.php'); ?>
               </div>
           </article>
          <article class="wc_tab_target" id="observacoes" style="display: none;">
               <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                   <center><h1 class="tab_title" >Observações</h1></center>
                   <br>
               </div>
               <div class="panel">
                  <?php require_once('tabObservacoes.php'); ?>
              </div>
          </article>
          <article class="wc_tab_target" id="orcamento" style="display: none;">
           <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
               <center><h1 class="tab_title" >Orçamentos</h1></center>
               <br>
           </div>
            <div class="panel">
              <?php require_once('tabOrcamento.php');?>
            </div>
       </article>
   </div><!-- box70 -->
   <div class="box box30" style="width:30%;padding-top:0px;">
       <div class="panel">
           <div class="box_conf_menu" style="font-size: 15px;">
               <a class='conf_menu wc_tab wc_active' href='#testeEstanqueidade'>Informações Gerais do Cliente</a>
               <!--<a class='conf_menu wc_tab' href='#defeitos'>Defeitos</a>-->
               <a class='conf_menu wc_tab' href='#observacoes'>Observações</a>
               <a class='conf_menu wc_tab' href='#orcamento'>Orçamentos</a>
           </div>
       </div>
   </div>

</form>
   </div>
</div>
</div>
<script type="text/javascript">
   var max = 10;
   var id = 1;
   var i = 1;


   $('#target').click(function(){

       $('#myTable > tbody:last-child').append('<tr id="'+(id++)+'""><td>'+(i++)+'</td><td><input type="text" placeholder="Nome" name="nome" id="nome"/></td><td><select id=""><option value="1">OK</option><option value="2">ABERTO</option></select></td></tr>');
   });

   $('#target2').click(function(){
       $('#myTable > tbody > tr:last-child').remove();
   });
</script>
<script src="_js/formulario.js"></script>