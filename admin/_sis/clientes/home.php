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
.window{
    display:none;
    width:40%;
    height:90%;
    position:absolute;
    left:0;
    top:0;
    background:#FFF;
    z-index:9900;
    padding:10px;
    border-radius:10px;
}

#mascara{
    display:none;
    position:absolute;
    left:0;
    top:0;
    z-index:9000;
    background-color:#000;
}

.fechar{display:block; text-align:right;}
li{
    padding-bottom: 12px;
}
li a{
    color: black;
}
.buttons_clientes{
    border-radius: 5%;
    -webkit-transition: width 2s; /* Safari */
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    margin-bottom: 15px;
}
.buttons_clientes:hover{
    border-radius: 5%;
    box-shadow: 0 5px 20px rgba(0,0,0,.09);
}
.coluna{
    background-color: transparent;
    overflow-y: scroll;
    height: 55%;

}
.top-chamados{
   height: 30%;
   box-shadow: 0 5px 10px rgba(0,0,0,.09);

}
.formulario{
    padding: 20px;
    font-size: 10px;
}
.label .legend { 
    font-size: 10px;
    font-weight: bold;

}
input{
    outline: none;
}
a:link{
    text-decoration:none; 
}
</style>
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-users">Clientes Particulares</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            <a title="Novatec Energy" href="dashboard.php?wc=clientes/particulares">Clientes Particulares</a>

        </p>
    </div>
</header>

<div class="dashboard_content custom_app">
    <div class="" style="border-top: solid; border-color: #052242;">
        <div class="box box50"><div class="panel_header">
            <h2 class="icon-calendar" style="text-align: center;font-size: 15px;"><b>GERAL</b></h2>
        </div></div>
        <div class="box box50">
            <div class="panel_header" >
                <h2 class="icon-calendar" style="text-align: center;font-size: 15px;"><b>MÊS EM CURSO</b></h2>
            </div>
        </div>
        <div class="box box50">
            <div class="">
             <div class="box box25">
                <div class="panel_header warning">
                    <h2 class="icon-arrow-up">Sem Contato</h2>
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
                           <ul><li><a href="#janela1" rel="modal"><span class='icon-user'></span><span><b>Cintia Luíza Moura Mailard</b></span></a></li></ul>
                       </div>

                       <?php
                       $contador ++;
                   }
                   ?>       
               </div>
           </div>
           <div class="box box25">
            <div class="panel_header success">
                <h2 class="icon-arrow-up">Visita Agendada</h2>
            </div>
            <br>
            <div class="coluna">
                <?php 
                $contador = 0;
                while($contador < 10){

                    ?>
                    <div class="box_content buttons_clientes">
                       <ul><li><span class='icon-calendar'></span><span><b>30/08/2018</b></span></li></ul>
                   </div>

                   <?php
                   $contador ++;
               }
               ?>       
           </div>
       </div>
       <div class="box box25">
        <div class="panel_header alert">
            <h2 class="icon-arrow-up">R$ Tot. em Análise</h2>
        </div>
        <br>
        <div class="coluna">
            <?php 
            $contador = 0;
            while($contador < 10){

                ?>
                <div class="box_content buttons_clientes">
                   <ul><li><span class='icon-calendar'></span><span><b>R$ 8.000,00</b></span></li></ul>
               </div>

               <?php
               $contador ++;
           }
           ?>       
       </div>
   </div>
   <div class="box box25">
    <div class="panel_header info">
        <h2 class="icon-arrow-up">R$ Tot. Executando</h2>
    </div>
    <br>
    <div class="coluna">
        <?php 
        $contador = 0;
        while($contador < 10){

            ?>
            <div class="box_content buttons_clientes">
               <ul><li><span class='icon-calendar'></span><span><b>R$ 5.000,00</b></span></li></ul>
           </div>

           <?php
           $contador ++;
       }
       ?>       
   </div>
</div>
</div>
</div>
<div class="box box50">
    <div class="box box33">
        <div class="panel_header success">
            <h2 class="icon-arrow-up">R$ Total (Executado)</h2>
        </div>
        <div class="box_content">
          <ul>
            <script type="text/javascript">
            var cont = 0;
            while(cont <= 10){
                document.write("<li><span class='icon-calendar'></span><span><b>R$ 7.000,00</b></span></li>");
                cont ++;
            }
            </script>             
        </ul>
    </div>
</div>
<div class="box box33">
    <div class="panel_header warning">
        <h2 class="icon-arrow-up">Cancelado</h2>

    </div>
    <div class="box_content">
      <ul>
        <script type="text/javascript">
        var cont = 0;
        while(cont <= 10){
            document.write("<li><span class='icon-user'></span><span><b>Luiz Fernando de Brito</b></span></li>");
            cont ++;
        }
        </script>               
    </ul>
</div>
</div>
<div class="box box33">
    <div class="panel_header alert">
        <h2 class="icon-arrow-up">Orçamento Recusado</h2>

    </div>
    <div class="box_content">
       <ul>
        <script type="text/javascript">
        var cont = 0;
        while(cont <= 10){
            document.write("<li><span class='icon-user'></span><span><b>Joana Ferreira</b></span></li>");
            cont ++;
        }
        </script>               
    </ul>
</div>
</div>
<div class="window" id="janela1">
    <a href="#" class="fechar"><span class="icon-cross" style="list-style-type: none; color: black;"><span></a>
    <div class="panel_header" style=" border-bottom: 1px solid #04182e;
        border-width: 2px;">
        <h2 class="icon-keyboard" style="text-align: center;font-size: 15px;"><b>CHAMADO DO CLIENTE</b></h2>
    </div>
    <br>
    <div class="top-chamados">
        <div class="formulario">
            <form method="post" action="">
               <div class="label_33">
                <label class="label">
                    <span class="legend">DATA AGENDAMENTO:</span>
                    <input style="font-size: 1.4em;" type="text" name="campo1" placeholder="" required/>
                </label>
                <label class="label">
                    <span class="legend">USER SISTEMA:</span>
                    <input style="font-size: 1.4em;" type="text" name="campo2" placeholder="" required/>
                </label>

                <label class="label">
                    <span class="legend">TÉCNICO:</span>
                    <input style="font-size: 1.4em;" type="text" name="campo3" placeholder="" required/>
                </label>

                <label class="label" style="margin-left: 0px;">
                    <span class="legend">STATUS:</span>
                    <input style="font-size: 1.4em;" type="text" name="campo3" placeholder="" required/>
                </label>

                <label class="label">
                    <span class="legend">OBSERVAÇÃO:</span>
                    <input style="font-size: 1.4em;" type="text" name="campo3" placeholder="" required/>
                </label>
            </div>

            <label class="label">
                <button type="submit" name="titulo" class="btn btn_darkblue" style="font-size: 15px;margin-left:45%;margin-top: 3%;"><span class="icon-floppy-disk"></span>&ensp;Salvar</button>
                
            </label>

        </form>

    </div>
</div>
<br>
<div class="coluna">
    <?php 
    $contador = 0;
    while($contador < 10){

        ?>
        <div class="box_content buttons_clientes" style="height: 15%;">
              <ul><li><a href="#janela1" rel="modal"><span class='icon-history'></span><span><b>AGENDAMENTO REALIZADO</b></span><p class="subtitle">30/08/2018</p></a></li></ul>
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
</div>
<script>
$(document).ready(function(){
    $("a[rel=modal]").click( function(ev){
        ev.preventDefault();

        var id = $(this).attr("href");

        var alturaTela = $(document).height();
        var larguraTela = $(window).width();

        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(100); 
        $('#mascara').fadeTo("fast",0.3);

        var left = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );

        $(id).css({'top':top,'left':left});
        $(id).show();   
    });

    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });

    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});
</script>
