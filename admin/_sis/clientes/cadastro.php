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

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-hammer">Clientes Particulares</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Novatec Energy" href="dashboard.php?wc=gns/agendamentos">Agendamentos</a>
            <span class="crumb">/</span>
            OS Sem Endereço
        </p>
    </div>
</header>

<div class="dashboard_content custom_app">
    <article class="box box100">
        <header>
          <h3>Cadastro de Clientes</h3>
        </header> 

        <form  class="j_tab_home tab_create" name="user_manager" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="callback" value="Clientes"/><!--- doumento ajax.php -->
            <input type="hidden" name="callback_action" value="cadCliente"/><!--documento nome.php-->
        <label class="label">
            <span class="legend">nome</span>
            <input style="font-size: 1.4em;" type="text" name="NOME" placeholder="Nome Completo" required/>
        </label>

        <div class="label_50">
            <label class="label">
                <span class="legend">telefone</span>
                <input style="font-size: 1.4em;" type="tel" name="TELEFONE" placeholder="Telefone" required/>
            </label>
            <label class="label">
                <span class="legend">endereco</span>
                <input style="font-size: 1.4em;" type="text" name="ENDERECO" placeholder="Endereço Completo" required/>
            </label>
            <div class="clear"></div>
        </div>

        <div class="label_33">
            <label class="label">
                <span class="legend">email</span>
                <input style="font-size: 1.4em;" type="text" name="EMAIL" placeholder="Email" required/>
            </label>
            <label class="label">
                <span class="legend">assunto</span>
                <input style="font-size: 1.4em;" type="text" name="ASSUNTO" placeholder="Assunto" required/>
            </label>

            <label class="label">
                <span class="legend">cliente</span>
                <input style="font-size: 1.4em;" type="text" name="CLIENTE" placeholder="Cliente" required/>
            </label>
        </div>
         <div class="label_50">
            <label class="label">
                <span class="legend">tipo</span>
                <input style="font-size: 1.4em;" type="text" name="TIPO" placeholder="Tipo" required/>
            </label>
            <label class="label">
                <span class="legend">data</span>
                <input style="font-size: 1.4em;" type="text" name="DATASOLICITACAO" placeholder="Data Solicitação" required/>
            </label>
            <div class="clear"></div>
        </div>
        <div class="label_50">
            <label class="label">
                <span class="legend">OBS:</span>
                <textarea style="font-size: 1.4em;" type="text" name="OBS" placeholder="Observações" required></textarea>
            </label>
            <div class="clear"></div>
        </div>

        <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
        <button name="public" value="1" class="btn btn_green fl_right icon-share" style="margin-left: 5px;">Cadastrar Cliente!</button>
        <div class="clear"></div>
    </form>
        </div>
    
</article>
</div>
<script>
    
</script>