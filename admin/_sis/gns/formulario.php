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
                    <h4 class="icon-user-plus">Teste de Estanquidade</h4>
                    <input type="hidden" name="callback" value="Users"/>
                    <input type="hidden" name="callback_action" value="manager"/>
                    <div id="tipo-servico">
                        <label class="label box box100">
                            <span class="legend">Nº do Manometro:</span>
                            <select value="" type="text" name="" >
                                <option selected disabled value="">Selecione o Nº do Manometro:</option>
                            </select>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Pressão Inicial:</span>
                            <input value="" type="text" name="user_email" placeholder="Inicial:" />
                        </label>
                        <label class="label box box50">
                            <span class="legend">Pressão Final:</span>
                            <input value="" type="text" name="user_email" placeholder="Final:" />
                        </label>
                        <label class="label box box100">
                            <span class="legend">Tempo do teste:</span>
                            <input value="" type="text" name="user_email" placeholder="Tempo:" />
                        </label>
                        <label class="label box box100">
                            <span class="legend">Status:</span>
                            <span><input id="ok" type="radio" name="status" value="1" style="width:5%" checked />Ok</span>
                            <span><input id="vazamento" type="radio" name="status" value="2" style="width:5%">Vazamento</span>
                            <span class="vazamento-L" style="width:5%;display:none"><input id="menor-5L" type="radio" name="status" value="3">Menor 5L</span>
                            <span class="vazamento-L" style="width:5%;display:none"><input id="maior-5L" type="radio" name="status" value="4">Maior 5L</span>
                        </label>
                        <label id="status-ocorrencia" class="label box box100" style="display:none">
                            <span class="legend">Nº Ocorrência:</span>
                            <input type="text" name="user_email" placeholder="ocorrência:" />
                        </label>
                        <label class="label box box50">
                            <span class="legend">Dados do Medidor:</span>
                            <input type="file" name="user_thumb" class="wc_loadimage" multiple/>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Foto Situação do Serviço:</span>
                            <input type="file" name="user_thumb" class="wc_loadimage" multiple/>
                        </label>

                        <label class="label box box100">
                            <span class="legend">Aparelhos no Local:</span>
                            <a class="btn btn_darkblue" href="#aparelho-1" rel="modal:open"><i class="icon-share"></i>Cozinha</a>
                            <a class="btn btn_darkblue" href="#aparelho-2" rel="modal:open"><i class="icon-share"></i> Banheiro Social</a>
                            <a class="btn btn_darkblue" href="#aparelho-3" rel="modal:open"><i class="icon-share"></i>Banheiro Suíte</a>
                            <a class="btn btn_darkblue" href="#aparelho-4" rel="modal:open"><i class="icon-share"></i>Banheiro Serviço</a>
                            <a class="btn btn_darkblue" href="#aparelho-5" rel="modal:open"><i class="icon-share"></i>Área Serviço</a>
                            <a class="btn btn_darkblue" href="#aparelho-6" rel="modal:open"><i class="icon-share"></i>Outros</a>
                        </label>

                        <div id="aparelho-1" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Aparelho 1 Local:</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <input id="tipo-1" value="" type="text" name="" placeholder="Tipo:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input id="marca-1" value="" type="text" name="" placeholder="Marca:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input id="modelo-1" value="" type="text" name="" placeholder="Modelo:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input id="pot-1" value="" type="text" name="" placeholder="Pot nominal:" required/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="cozinha1" value="1" style="width:5%" checked/>Bom
                                        <input type="radio" name="cozinha1" value="2" style="width:5%"/>Ruim
                                        <input type="radio" name="cozinha1" value="3" style="width:5%">Fora de uso
                                    </label>
                                    <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                                    <div class="clear"></div>

                                </article>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-1 --->

                        <div id="aparelho-2" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Aparelho 2 Local:</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Tipo:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input value="" type="text" name="user_email" placeholder="Marca:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Modelo:"/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input value="" type="text" name="user_email" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="tiragem1" value="1" style="width:5%"/>Natural
                                        <input type="radio" name="tiragem1" value="2" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="combustao1" value="1" style="width:5%"/>Aberta
                                        <input type="radio" name="combustao1" value="2" style="width:5%">Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="funcionamento1" value="1" style="width:5%" checked/>Bom
                                        <input type="radio" name="funcionamento1" value="2" style="width:5%"/>Ruim
                                        <input type="radio" name="funcionamento1" value="3" style="width:5%">Fora de uso
                                    </label>

                                    <div class="scroll-modal" style="height:300px;">
                                        <header>
                                          <h3 style="text-align: center;">Higiene da Combustão:</h3>
                                        </header>
                                        <label class="label box box100">
                                            <span class="legend">Tiragem:</span>
                                            <input value="" type="text" name="user_email" placeholder="Tiragem:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">COn:</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">CO amb:</span>
                                            <input value="" type="text" name="user_email" placeholder="CO amb:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Tempo (min):</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Analisador:</span>
                                            <input value="" type="text" name="user_email" placeholder="Analisador:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Número de série:</span>
                                            <input value="" type="text" name="user_email" placeholder="número de série:"/>
                                        </label>
                                        <span name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;" id="clientesOT" callback="ClientesOT" callback_action="addCliente">Enviar</span>
                                        <div class="clear"></div>
                                    </div>

                                </article>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-2 --->

                        <div id="aparelho-3" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Aparelho 3 Local:</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Tipo:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input value="" type="text" name="user_email" placeholder="Marca:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Modelo:"/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input value="" type="text" name="user_email" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="tiragem3" value="1" style="width:5%"/>Natural
                                        <input type="radio" name="tiragem3" value="2" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="combustao3" value="1" style="width:5%"/>Aberta
                                        <input type="radio" name="combustao3" value="2" style="width:5%">Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="funcionamento3" value="1" style="width:5%" checked/>Bom
                                        <input type="radio" name="funcionamento3" value="2" style="width:5%"/>Ruim
                                        <input type="radio" name="funcionamento3" value="3" style="width:5%">Fora de uso
                                    </label>

                                    <div class="scroll-modal" style="height:300px;">
                                        <header>
                                          <h3 style="text-align: center;">Higiene da Combustão:</h3>
                                        </header>
                                        <label class="label box box100">
                                            <span class="legend">Tiragem:</span>
                                            <input value="" type="text" name="user_email" placeholder="Tiragem:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">COn:</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">CO amb:</span>
                                            <input value="" type="text" name="user_email" placeholder="CO amb:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Tempo (min):</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Analisador:</span>
                                            <input value="" type="text" name="user_email" placeholder="Analisador:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Número de série:</span>
                                            <input value="" type="text" name="user_email" placeholder="número de série:"/>
                                        </label>
                                        <span name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;" id="clientesOT" callback="ClientesOT" callback_action="addCliente">Enviar</span>
                                        <div class="clear"></div>
                                    </div>

                                </article>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-3 --->

                        <div id="aparelho-4" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Aparelho 4 Local:</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Tipo:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input value="" type="text" name="user_email" placeholder="Marca:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Modelo:"/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input value="" type="text" name="user_email" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="tiragem" value="1" style="width:5%"/>Natural
                                        <input type="radio" name="tiragem" value="2" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="combustao" value="1" style="width:5%"/>Aberta
                                        <input type="radio" name="combustao" value="2" style="width:5%">Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="funcionamento" value="1" style="width:5%" checked/>Bom
                                        <input type="radio" name="funcionamento" value="2" style="width:5%"/>Ruim
                                        <input type="radio" name="funcionamento" value="3" style="width:5%">Fora de uso
                                    </label>

                                    <div class="scroll-modal" style="height:300px;">
                                        <header>
                                          <h3 style="text-align: center;">Higiene da Combustão:</h3>
                                        </header>
                                        <label class="label box box100">
                                            <span class="legend">Tiragem:</span>
                                            <input value="" type="text" name="user_email" placeholder="Tiragem:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">COn:</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">CO amb:</span>
                                            <input value="" type="text" name="user_email" placeholder="CO amb:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Tempo (min):</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Analisador:</span>
                                            <input value="" type="text" name="user_email" placeholder="Analisador:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Número de série:</span>
                                            <input value="" type="text" name="user_email" placeholder="número de série:"/>
                                        </label>
                                        <span name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;" id="clientesOT" callback="ClientesOT" callback_action="addCliente">Enviar</span>
                                        <div class="clear"></div>
                                    </div>

                                </article>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-4 --->

                        <div id="aparelho-5" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Aparelho 5 Local:</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Tipo:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input value="" type="text" name="user_email" placeholder="Marca:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Modelo:"/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input value="" type="text" name="user_email" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="tiragem" value="1" style="width:5%"/>Natural
                                        <input type="radio" name="tiragem" value="2" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="combustao" value="1" style="width:5%"/>Aberta
                                        <input type="radio" name="combustao" value="2" style="width:5%">Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="funcionamento" value="1" style="width:5%" checked/>Bom
                                        <input type="radio" name="funcionamento" value="2" style="width:5%"/>Ruim
                                        <input type="radio" name="funcionamento" value="3" style="width:5%">Fora de uso
                                    </label>

                                    <div class="scroll-modal" style="height:300px;">
                                        <header>
                                          <h3 style="text-align: center;">Higiene da Combustão:</h3>
                                        </header>
                                        <label class="label box box100">
                                            <span class="legend">Tiragem:</span>
                                            <input value="" type="text" name="user_email" placeholder="Tiragem:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">COn:</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">CO amb:</span>
                                            <input value="" type="text" name="user_email" placeholder="CO amb:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Tempo (min):</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Analisador:</span>
                                            <input value="" type="text" name="user_email" placeholder="Analisador:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Número de série:</span>
                                            <input value="" type="text" name="user_email" placeholder="número de série:"/>
                                        </label>
                                        <span name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;" id="clientesOT" callback="ClientesOT" callback_action="addCliente">Enviar</span>
                                        <div class="clear"></div>
                                    </div>

                                </article>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-5 --->
                        <div id="aparelho-6" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Outros:</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Tipo:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input value="" type="text" name="user_email" placeholder="Marca:" />
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input value="" type="text" name="user_email" placeholder="Modelo:"/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input value="" type="text" name="user_email" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="tiragem" value="1" style="width:5%"/>Natural
                                        <input type="radio" name="tiragem" value="2" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="combustao" value="1" style="width:5%"/>Aberta
                                        <input type="radio" name="combustao" value="2" style="width:5%">Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="funcionamento" value="1" style="width:5%" checked/>Bom
                                        <input type="radio" name="funcionamento" value="2" style="width:5%"/>Ruim
                                        <input type="radio" name="funcionamento" value="3" style="width:5%">Fora de uso
                                    </label>

                                    <div class="scroll-modal" style="height:300px;">
                                        <header>
                                          <h3 style="text-align: center;">Higiene da Combustão:</h3>
                                        </header>
                                        <label class="label box box100">
                                            <span class="legend">Tiragem:</span>
                                            <input value="" type="text" name="user_email" placeholder="Tiragem:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">COn:</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">CO amb:</span>
                                            <input value="" type="text" name="user_email" placeholder="CO amb:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Tempo (min):</span>
                                            <input value="" type="text" name="user_email" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Analisador:</span>
                                            <input value="" type="text" name="user_email" placeholder="Analisador:"/>
                                        </label>
                                        <label class="label box box100">
                                            <span class="legend">Número de série:</span>
                                            <input value="" type="text" name="user_email" placeholder="número de série:"/>
                                        </label>
                                        <span name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;" id="salvar">Enviar</span>
                                        <div class="clear"></div>
                                    </div>

                                </article>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-6 --->
            </div><!---- Final da div id="tipo-servico" ---->
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