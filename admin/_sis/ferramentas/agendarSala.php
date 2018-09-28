<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
$ID = 0;

?>

<style type="text/css">
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
        <p class="dashboard_header_breadcrumbs">
        &raquo;</span>
        <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
        <span class="crumb">/</span>
        <a title="Novatec Energy" href="#">Ferramentas</a>
        <span class="crumb">/</span>
        Agendamento de Sala
    </p>
</div>
</header>
<div class="dashboard_content custom_app">
    <div class="box box100">
        <div class="box box25">
            <button class="btn btn_green" style="outline: none;" id="target"><span class="icon-plus"></span>Adicionar</button>
             <button class="btn btn_red" style="outline: none;" id="target2"><span class="icon-cross"></span>Excluir</button>
        </div>
    <div class="box_content">
        <form method="post">
            <div class="box box70">
              <article class="wc_tab_target wc_active" id="testeEstanqueidade">
                <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                    <center><h1 class="tab_title" >Teste de Estanqueidade</h1></center>
                   <!--   <button class="btn btn_darkblue" style="outline: none;" id="salvar"><span class="icon-floppy-disk"></span>Salvar</button>-->
                    <br>
                </div>
                <div class="panel">
                   <table  id="myTable" class="table condensed" style="text-align: center;">
                       <thead>
                           <th>ID</th>
                           <th>QTD</th>
                           <th>VALOR</th>
                           <th>TOTAL</th>
                       </thead>
                       <tbody>
                          
                       </tbody>
                   </table>

                </div>
            </article>
            <article class="wc_tab_target" id="defeitos" style="display: none;">
                <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                    <center><h1 class="tab_title" >Defeitos</h1></center>
                    <br>
                </div>
                <div class="panel">
                                  
                    <input type="text" name="nome" id="nome" />
                
               </div>
           </article>
           <article class="wc_tab_target" id="orcamentos" style="display: none;">
            <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
                <center><h1 class="tab_title" >Orçamentos</h1></center>
                <br>
            </div>
            <div class="panel">
                adasd1213aw32412
            </div>
        </article>
    </div><!-- box70 -->
    <div class="box box30" style="width: 30%;padding-top: 0px;">
        <div class="panel">
            <div class="box_conf_menu" style="font-size: 15px;">
                <a class='conf_menu wc_tab wc_active' href='#testeEstanqueidade'>Teste de Estanqueidade</a>
                <a class='conf_menu wc_tab' href='#defeitos'>Defeitos</a>
                <a class='conf_menu wc_tab' href='#orcamentos'>Orçamentos</a>
            </div>
        </div>
    </div> <!-- box30 -->
</form>
    </div>
</div>
</div>
<script>
  //var input = "Cintia Luiza";
 

$("#nome").change(function(){
   var $nome = $("#nome").val();
  if(regex = /[a-z]+\s[a-z]+/gi.exec($nome)){
    alert("Nome Válido: "+regex[0]);
  }
 else{
  alert("Nome Inválido");
 }
});
</script>
<script type="text/javascript">

   max = 10;
   id = 1;
   i = 1;

   qtd = 1;
   valor = 1;
   total =1;

 id_qtd = "#qtd";
 id_valor = "#valor";
 id_total = "#total"; 



    $('#target').click(function(){  
          $('#myTable > tbody:last-child').append('<tr id="'+(id)+'">' +
            '<td>'+(id)+'</td>'+
            '<td><input type="number" name="qtd'+(qtd)+'" id="qtd'+(qtd)+'" value=""/></td>'+
            '<td><input type="text"  name="valor'+(valor)+'" id="valor'+(valor)+'" value="0" /></td>'+ 
            '<td><input type="text"  name="total'+(total)+'" id="total'+(total)+'" value="" readonly="readonly"/></td>'+
            '</tr>');


  $(id_qtd.concat(qtd)).keyup(calc);
    $(id_valor.concat(valor)).keyup(calc);

   function calc() {

        $(id_total.concat(total)).val(
            parseFloat($(id_qtd.concat(qtd)).val(), 10) + parseFloat($(id_valor.concat(valor)).val(), 10)
            );     
    }
    alert(id_valor.concat(valor));

id++;
i++;
qtd++;
valor++;
total++;

    });


      /*  valor.focusout( function(){
            alert(total);
        });*/

 
/*
 $("#qtd" + qtd).change(function(){
        alert($("#qtd" + qtd).val());
    
});*/

    /*$('#target').click(function(){

        $('#myTable > tbody:last-child').append('<tr id="'+(id++)+'""><td>'+(i++)+'</td><td><input type="text" placeholder="Nome" name="nome" id="nome"/></td><td><select id=""><option value="1">OK</option><option value="2">ABERTO</option></select></td></tr>');
    });*/


    $('#target2').click(function(){
        $('#myTable > tbody > tr:last-child').remove();
         id = id - 1;
        i = i - 1;
        qtd = qtd - 1;
        valor = valor - 1;
        total = total - 1;
    });
</script>

<script src="_js/ferramentas.js"></script>
