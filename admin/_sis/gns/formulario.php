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
?>
<style>
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

table input{
    width:auto !important;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
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
</style>
<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-user-plus">Novo Usuário</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=users/home">Usuários</a>
            <span class="crumb">/</span>
            Novo Usuário
        </p>
    </div>
</header>

<!-- CODIGO ADD LINHAS -->
<div class="dashboard_content custom_app">
   <div class="box box100">
       <div class="box box25">
          <!-- <button class="btn btn_green" style="outline: none;" id="target"><span class="icon-plus"></span>Adicionar</button>
            <button class="btn btn_red" style="outline: none;" id="target2"><span class="icon-cross"></span>Excluir</button>-->
       </div>
   <div class="box_content">
       <form method="post">
           <div class="box box70">
             <article class="wc_tab_target wc_active" id="testeEstanqueidade">
               <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                   <center><h1 class="tab_title" >Teste de Estanqueidade</h1></center>
                   <br>
               </div>
               <div class="panel">
                <?php include_once('tabEstanqueidade.php');?>
               </div>
           </article>
           <article class="wc_tab_target" id="defeitos" style="display: none;">
               <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                   <center><h1 class="tab_title" >Defeitos</h1></center>
                   <br>
               </div>
               <div class="panel">
                  <?php include_once('tabDefeitos.php'); ?>
              </div>
          </article>
          <article class="wc_tab_target" id="orcamento" style="display: none;">
           <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
               <center><h1 class="tab_title" >Orçamentos</h1></center>
               <br>
           </div>
           <div class="panel">
                <div id="orcamento"/>
        <h4 class="icon-user-plus">Orçamento</h4>
        <label class="label box box100">
             <div class="box box100">
                 <div class="box box33">
                     <label class="label">
                        <span class="legend">Descrição</span>
                         <select rel="0" id="Peca" name="peca">
                        <option value="">PESQUISA POR PEÇAS</option>             
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Peca] AS peca, [ValorFinal] AS valor FROM [60_Pecas]", " ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $PECAS):
                            echo "<option  id='{$PECAS['valor']}'' value='{$PECAS['id']}'>{$PECAS['peca']}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div> 
                 <div class="box box14">
                     <label class="label">
                        <span class="legend">Qtd.</span>
                        <input id="qtd-pecas" type="number" style="font-size: 1.0em;"  class="j_qtd_pecas" min="1" value=""  />
                    </label>    
                 </div>
                 <div class="box box14">

                     <span class="legend"></span>
                     <label>
                        <span class="j_add_pecas icon-plus btn btn_darkblue" callback="Dadostabela" callback_action="consulta">Add Peças</span>
                     </label>
                 </div>    
                 </div>

                  <!--<div class="box box100">
                 <div class="box box33">
                     <label class="label">
                        <span class="legend">Descrição</span>
                         <select rel="0" class="j_consulta" callback="Dadostabela" callback_action="consulta" >
                        <option value="">PESQUISA POR SERVIÇOS</option>             
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos]"," ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $SERVICOS):
                            echo "<option value='{$SERVICOS['id']}'>{$SERVICOS['descricao']}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div> 
                 <div class="box box14">
                     <label class="label">
                        <span class="legend">Qtd.</span>
                        <input type="number" style="font-size: 1.0em;" class="j_consulta" callback="Dadostabela" callback_action="consulta" value=""  />
                    </label>    
                 </div> 
                 <div class="box box14">

                     <span class="legend"></span>
                    <button class="btn btn_darkblue" style="height: 35px;margin-top: 14px;"><span class="icon-plus"></span>Add Serviços</button>
                 </div>    
                 </div>-->
                 <table id="tabela-pecas">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center">Tabela </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Descrição</th>
                            <th style="text-align: center;">Qtd</th>
                            <th style="text-align: center;">R$ unit</th>
                            <th style="text-align: center;">R$ total</th>
                        </tr>
                    </thead>
                        <!--- linhas adicionadas via Jquery --->
                    <tbody>
                    </tbody>
                </table>

            <br/>

            <div class="">
                <span class="legend">Orçamento Aprovado ?:</span>
                <span><input id="orc-aprovado" type="radio" name="status" value="1" style="width:5%">Sim</span>
                <span><input id="orc-reprovado" type="radio" name="status" value="2" style="width:5%">Não</span>
            </div>

            <div id="forma-pgt" style="display:none">
                <span class="legend">Forma de Pagamento:</span>
                <span><input id="form-pagt-1" type="radio" name="status" value="1" style="width:5%">á vista</span>
                <span><input id="form-pagt-2" type="radio" name="status" value="2" style="width:5%">3 parcelas</span>
                <span><input id="form-pagt-3" type="radio" name="status" value="3" style="width:5%">6 parcelas</span>
                <span><input id="form-pagt-4" type="radio" name="status" value="4" style="width:5%">12 parcelas</span>
                <label>
                    <input id="form-pagt-5" type="number" name="status" value="5" min="2" max="20" style="width:10%;height:20px">
                    <span><input id="form-pagt-5" type="radio" name="status" value="5" style="width:5%">Mais parcelas (autorização do supervisor)</span>  
                </label>
                <p>Valor das parcelas R$<span>200,00</span></p>
            </div>
    
           </div>
       </article>
   </div><!-- box70 -->
   <div class="box box30" style="width: 30%;padding-top: 0px;">
       <div class="panel">
           <div class="box_conf_menu" style="font-size: 15px;">
               <a class='conf_menu wc_tab wc_active' href='#testeEstanqueidade'>Teste de Estanqueidade</a>
               <a class='conf_menu wc_tab' href='#defeitos'>Defeitos</a>
               <a class='conf_menu wc_tab' href='#orcamento'>Orçamentos</a>
           </div>
       </div>
   </div> <!-- box30 -->
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