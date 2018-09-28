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
                  <div id="servicos-defeitos"/>
                <h4 class="icon-user-plus">Instalação com Defeito?</h4>
                <label class="label box box100">
                    <span class="legend">Instalação:</span>
                    <span><input id="instalacao-ok" type="radio" name="status" value="1" style="width:5%">Sim</span>
                    <span><input id="instalacao-defeito" type="radio" name="status" value="2" style="width:5%">Não</span>
                    <div id="dados-do-def">
                        <label id="foto-defeito" class="label box box50" style="display:none">
                            <span class="legend">Foto Defeitos:</span>
                            <input type="file" name="user_thumb" class="wc_loadimage" multiple/>
                        </label>
                        <label class="label box box100">
                            <a class="btn btn_darkblue" href="#dist-interna" rel="modal:open"><i class="icon-share"></i>Distribuição interna</a>
                            <a class="btn btn_darkblue" href="#Ap-gas" rel="modal:open"><i class="icon-share"></i>Aparelhos a Gás</a>
                            <a class="btn btn_darkblue" href="#liga-ap" rel="modal:open"><i class="icon-share"></i>Ligações dos Aparelhos a Gás</a>
                            <a class="btn btn_darkblue" href="#ind-exaust" rel="modal:open"><i class="icon-share"></i>Individual de Exautão Natural e Forçada</a>
                            <a class="btn btn_darkblue" href="#cole-exaust" rel="modal:open"><i class="icon-share"></i>Coletivo de Exautão Natural e Forçada</a>
                            <a class="btn btn_darkblue" href="#caract-h" rel="modal:open"><i class="icon-share"></i>Características Higiênicas da Combustão</a>
                            <a class="btn btn_darkblue" href="#reco" rel="modal:open"><i class="icon-share"></i>Recomendações</a>
                        </label>
                    </div>
                </label>
            </div>

            <div id="dist-interna" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Rede de Distribuição Interna:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal" style="">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Afastamentos de sistemas elétricos de potência em baixa tensão isolados em eletrodutos não metálicos e a ocorrência de interferências com as mesmas. Afastamentos quando em redes em paralelo maior ou igual a 30 mm e quando em cruzamentos maior ou igual a 10 mm (com material isolante aplicado:</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Afastamentos de sistemas elétricos de potência em baixa tensão isolados em eletrodutos metálicos ou sem eletrodutos e a ocorrência de interferências com as mesmas. Afastamentos maior ou igual a 50 mm para cada lado.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Afastamentos e a ocorrência de interferências com tubulações de água quente ou fria. Afastamentos quando em redes em paralelo maior ou igual a 30 mm e quando em cruzamentos maior ou igual a 10 mm</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Afastamentos e a ocorrência de interferências com tubulação de vapor. Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 10 mm.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Afastamentos e a ocorrência de interferências com chaminés. Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 50 mm.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Afastamentos e a ocorrência de interferências com tubulação de gás. Afastamentos quando em redes em paralelo maior ou igual a 10 mm e quando em cruzamentos maior ou igual a 10 mm.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="legend">Afastamentos e a ocorrência de interferências com as demais instalações (águas pluviais, esgoto). Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 10 mm.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="legend">Encaminhamento da tubulação da rede. Rede não passando por vazios, caixas d'água, caixa de escada ou poços de elevadores.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><span class="legend">Condições dos elementos de suportação. Suportes íntegros, com robustez compatível, adequadamente distanciados, bem fixados e protegidos contra corrosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td>10</td>
                                    <td><span class="legend">Identificação da tubulação de gás. Pintura na cor padrão ou de etiqueta com a palavra gás.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td><span class="legend">Tipo de material utilizado na rede, inclusive tubos multicamada e PE x Aço. Utilização de materiais não contemplados na ABNT NBR 15526 e Nota Técnica da ABEGÁS.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td><span class="legend">Integridade do material utilizado na rede. Inexistência de amassamentos, corrosão ou fissuras.</span></td>
                                    <td></td>
                                   <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td><span class="legend">Local de instalação dos materiais. Adequação dos materiais quanto a aspectos de proteção, conforme ABNT NBR 15526.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td><span class="legend">Estanqueidade para a rede de distribuição interna. Vazamento após realização de ensaio entre 1 l/h e 5 l/h.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td><span class="legend">Estanqueidade para a rede de distribuição interna. Vazamento após realização de ensaio maior que 5 l/h.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td><span class="legend">Estanqueidade das conexões de ligação dos medidores. Conexões estanques.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td><span class="legend">Condições de acesso ao abrigo. Desobstruído, permitindo a marcação, inspeção e manutenção dos medidores.</span></td>
                                    <td></td>
                                   <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td><span class="legend">Abertura para ventilação permanente no abrigo de medidores. Existência de abertura para ventilação permanente superior ou inferior do abrigo, conforme gás combustível utilizado na instalação.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td><span class="legend">Abertura para ventilação permanente no abrigo de medidores. Área da ventilação permanente superior ou inferior equivalente a 1/10 da área da planta baixa.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td><span class="legend">Condição de instalação de medidores localizados nos andares. Existência de ventilação permanente, para o exterior.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td><span class="legend">Dispositivos no interior do abrigo. Ausência de dispositivos e/ou instalações elétricas no interior do abrigo, que possam produzir chama ou centelhamento.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td>22</td>
                                    <td><span class="legend">Dispositivos no interior do abrigo. Ausência de entulhos, botijões de GLP ou outros materiais no interior do abrigo.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td>23</td>
                                    <td><span class="legend">Dispositivos no interior do abrigo. Luminárias, interruptores, tomadas, e/ou outras instalações elétricas para uso da cabine com blindagem a prova de explosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>

                            </table>
                        </div>
                        
                        
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Rede de Distribuição Interna --->

    <div id="Ap-gas" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Aparelhos a Gás:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Local de instalação dos aparelhos a gás de circuito aberto. Não devem ser instalados em dormitório e banheiro.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Volume do local de instalação de aparelho a gás de circuito aberto, com ou sem duto de exaustão natural. Volume mínimo do ambiente maior ou igual a 6 m³.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Cozinha apenas com fogão de até 216 kcal/min  e com volume maior ou igual que 6 m³. Ventilação com área total útil e permanente de no mínimo 800 cm². (Superior –600 cm² (para uma área externa) e inferior – 200 cm²). Ambientes com aparelhos de potência superior  216kcal/min, será necessário multiplicar a potência por 1,5. Caso dê <= 800 manter ventilação acima, caso seja > 800, 33% desse valor é igual a ventilação inferior e 67% desse valor é igual a ventilação superior.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Aquecedor de circuito aberto com potência de até 200 Kcal/min instalados em banheiro, condicionado à conformidade das demais adequações e a aplicação de ações mitigadoras. Volume do ambiente maior ou igual a 6m³.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Aquecedor de circuito aberto instalados em banheiro no interior de BOXE. Divisória acima de 1,80 m e vão da divisória ao teto menor que 0,40 m.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Aparelho a gás de circuito aberto com exaustão mecânica. Exaustão mecânica ligada (condicionado à conformidade das demais adequações e a aplicação de ações mitigadoras).</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="legend">Aquecedor instalado no interior de banheiro com exaustão mecânica (RJ).</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="legend">Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Abertura para ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><span class="legend">Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Abertura para ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Insuficiência.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td>10</td>
                                    <td><span class="legend">Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Instalação de duto de exaustão e terminal, conforme ABNT NBR 13103.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td><span class="legend">Ventilação permanente, superior e/ou inferior, no local de instalação do aparelho a gás de circuito aberto, sem duto de exaustão ou duto de exaustão natural. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td><span class="legend">Ventilação permanente, superior e/ou inferior, no local de instalação do aparelho a gás de circuito aberto, sem duto de exaustão ou duto de exaustão natural. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ².Insuficiência</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td><span class="legend">Abertura permanente do local de instalação de aparelho a gás de circuito aberto, com exaustão forçada. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td><span class="legend">Abertura permanente do local de instalação de aparelho a gás de circuito aberto, com exaustão forçada. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Insuficiência</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td><span class="legend">Aparelho de cocção único em cozinha. Existência de ventilação com área total útil e permanente de no mínimo 800 cm². (Superior – 600 cm² (para uma área externa) e inferior – 200 cm²)</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td><span class="legend">Abertura de ventilação permanente indireta através de duto. Comprimento do duto até 3 metros, 1 vez a área mínima da abertura superior.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td><span class="legend">Abertura de ventilação permanente indireta através de duto.  Comprimento do duto de 3 até 10 metros, 1,5 vez a área mínima da abertura superior.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td><span class="legend">Abertura de ventilação permanente indireta através de duto. Comprimento do duto acima de 10 metros, 2 vezes a área mínima da abertura superior.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td><span class="legend">Aparelho permanente superior indireta em comunicação com o exterior. Seção livre mínima de 1600 cm²até o comprimento de 4 m.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td><span class="legend">Ventilação permanente superior e inferior de um ambiente contíguo com área livre, mínima, de 1,5 m², com somatório dos volumes igual ou maior que 6 m³. Existência de ventilação permanente superior e inferior conforme ABNT NBR 13103. Inexistência</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td><span class="legend">Ventilação permanente superior e inferior de um ambiente contíguo com área livre, mínima, de 1,5 m², com somatório dos volumes igual ou maior que 6 m³. Existência de ventilação permanente superior e inferior conforme ABNT NBR 13103. Insuficiência</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                 <tr>
                                    <td>22</td>
                                    <td><span class="legend">Ventilação permanente superior e inferior de um ambiente contíguo com área livre menor que 1,5 m², porém maior ou igual a 1,2 m² e potência total igual ou menor que 216 kcal/min. Ventilação com área total útil e permanente de no mínimo 600 cm² para uma área externa.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td><span class="legend">Condições físicas dos aparelhos a gás. Inexistência de peças e componentes soltos ou danificados.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td><span class="legend">Estanqueidade de gás nos aparelhos. Aparelhos a gás estanques, sem vazamento de gás.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td><span class="legend">Estanqueidade de água nos aparelhos. Aparelhos a gás estanques, sem vazamento de água.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>26</td>
                                    <td><span class="legend">Condições de chama do queimador do aparelho. Chama do aparelho estável, sem variação de cor azul (em potência máxima e mínima).</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>27</td>
                                    <td><span class="legend">Sistema de acendimento automático do aparelho. Sistema automático funcionando conforme as orientações do fabricante.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>28</td>
                                    <td><span class="legend">Dispositivo de segurança do aparelho. Dispositivo de segurança funcionando conforme as orientações do fabricante.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>29</td>
                                    <td><span class="legend">Botões de regulagem e elementos de controle. Funcionamento conforme manual do fabricante.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>

                            </table>
                        </div>
                        
                        
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Aparelhos a Gás --->

    <div id="liga-ap" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Ligações dos Aparelhos a Gás:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Estanqueidade nas ligações da rede com o aparelho. Ligação do aparelho com a rede estanque.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Material utilizado na ligação do aparelho. Tubos flexíveis conforme ABNT NBR 14177, ABNT NBR 113419, ABNT NBR 14745 ou ABNT NBR 14955.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Condições físicas do tubo flexível. Inexistência de danos físicos nos tubos flexíveis.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Estanqueidade na válvula de bloqueio do aparelho. Válvula de bloqueio estanque.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Identificação do ponto de gás do aquecedor. Identificado na cor amarela e na posição central.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Localização da válvula de bloqueio do aparelho. Válvula de bloqueio em local de fácil acesso, com ventilação adequada e protegidas, de forma a se evitar acionamento acidental.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="legend">Pontos de espera sem uso. Tamponamento adequado com bujão ou tampa rosqueada de metal e estanque dos pontos.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="legend">Condições dimensionais das chaminés. Diâmetro do duto igual ao diâmetro da saída da chaminé do aparelho a gás. ( Ou com adaptador conforme Abegas)</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><span class="legend">Instalação da chaminé individual. Chaminé com encaixes firmes nas conexões com os aparelhos a gás, conforme ABNT NBR 13103.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Aparelhos a Gás --->

    <div id="ind-exaust" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Individual de Exaustão Natural e Forçada:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Condições do duto de exaustão em aquecedor de circuito aberto de exaustão natural ou forçada. Existência de dutos de exaustão, conforme ABNT NBR 13103.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Compatibilidade da chaminé com o diâmetro da saída do defletor. Inexistência de estrangulamentos do duto em relação ao defletor do aparelho.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Altura vertical do duto do aquecedor de circuito aberto de exaustão natural. Altura inicial maior ou igual a 35 cm.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Declividade do sistema de exaustão. Duto do sistema de exaustão ascendente.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Conexão da chaminé com o duto de exaustão e o terminal em aquecedor de circuito aberto de exaustão natural ou forçada. Conexão firme do duto com o aparelho e o terminal.</span></td>
                                    <td></td>
                                   <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Condições físicas dos dutos de exaustão. Inexistência de rachadura, rasgos ou emendas indevidas no duto de exaustão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="legend">Terminal no exterior da edificação para aquecedor de circuito aberto de exaustão natural ou forçada. Existência do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="legend">Instalação do terminal de chaminé. Instalação levando em consideração limites de distância, conforme ABNT NBR 13103. (10 cm da face da edificação e 40 cm de raio)</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><span class="legend">Quantidade de curvas e desvios do duto de exaustão em aquecedor de circuito aberto de exaustão natural ou forçada. Inexistência de excessos de curvas e desvios no duto de exaustão, conforme ABNT NBR 13103, ou conforme manual do fabricante.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td><span class="legend">Situação do ambiente de percurso do sistema de exaustão. Ventilação superior e inferior de no mínimo 200 cm². (Ventilação da Chaminé passando por gesso ou a própria chaminé passando por mais de um cômodo).</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td><span class="legend">Integridade do material do duto de exaustão. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td><span class="legend">Condições de adequação e robustez dos suportes do duto de exaustão. Suportes adequados ao material do duto de exaustão e bem posicionados.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td><span class="legend">Saída dos condutos de exaustão de produtos da combustão em locais não considerados áreas externas. Saídas de produtos da combustão para área externa ou locais considerados áreas externas.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td><span class="legend">Aparelho de cocção em cozinhas com potência nominal igual ou maior que 360kcal/min, sem coifa exaustora de forma a conduzir os produtos da combustão para fora do ambiente. Existência de coifa exaustora.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>


                            </table>
                        </div>
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Individual de Exaustão Natural e Forçada --->

    <div id="cole-exaust" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Coletivo de Exaustão Natural e Forçada:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Material das chaminés coletivas. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Condições dimensionais da chaminé coletiva. Área da chaminé coletiva maior ou igual à maior seção da chaminé individual conectada a ela, e altura mínima de 5m do defletor do último aquecedor até o terminal da chaminé.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Abertura inferior da chaminé coletiva. Abertura inferior na chaminé de, no mínimo, 100 cm² para limpeza, com possibilidade de acesso e de uma ligação para saída da água de condensação para o esgoto, feita através de tubo resistente à corrosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Interligação da chaminé individual com a chaminé coletiva. Existência de, no máximo, duas chaminés individuais por pavimento conectado à chaminé coletiva.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Interligação da chaminé individual com a chaminé coletiva. Ligação da chaminé individual na chaminé coletiva no sentido ascendente.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Terminal de chaminé. Existência e o correto posicionamento do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="legend">Condições de obstrução do terminal para uso da chaminé coletiva. Chaminé desobstruída.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Coletivo de Exaustão Natural e Forçada --->

    <div id="caract-h" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Características Higiênicas da Combustão:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Material das chaminés coletivas. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Condições dimensionais da chaminé coletiva. Área da chaminé coletiva maior ou igual à maior seção da chaminé individual conectada a ela, e altura mínima de 5m do defletor do último aquecedor até o terminal da chaminé.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Abertura inferior da chaminé coletiva. Abertura inferior na chaminé de, no mínimo, 100 cm² para limpeza, com possibilidade de acesso e de uma ligação para saída da água de condensação para o esgoto, feita através de tubo resistente à corrosão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Interligação da chaminé individual com a chaminé coletiva. Existência de, no máximo, duas chaminés individuais por pavimento conectado à chaminé coletiva.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Interligação da chaminé individual com a chaminé coletiva. Ligação da chaminé individual na chaminé coletiva no sentido ascendente.</span></td>
                                    <td></td>
                                   <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Terminal de chaminé. Existência e o correto posicionamento do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="legend">Condições de obstrução do terminal para uso da chaminé coletiva. Chaminé desobstruída.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Características Higiênicas da Combustão --->

    <div id="reco" class="modal" style="height: auto;">
               <article class="box box100">
                    <header>
                      <h3 style="text-align: center;">Recomendações:</h3>
                    </header>
                    <div class="box_content">
                    <article class='box box100'>
                        <div class="scroll-modal">
                            <table>
                                <tr>
                                    <th>Nº</th>
                                    <th>Item de Inspeção</th>
                                    <th>Instalação Interna</th>
                                    <th colspan="3">Aparelhos</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><span class="legend">Medidas ao alto invertidas, ou seja, medida ao alto do cliente à esquerda do medidor.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="legend">Instalação energizada.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="legend">Rede de distribuição interna sem plaquetas de identificação e/ou inadequadas. As plaquetas de identificação da instalação devem estar localizadas a direita do medidor (na rede de distribuição interna), em local visível e ter marcação de forma indelével, informando a unidade a que pertence a instalação.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="legend">Abrigo de medidores sem porta, sem visor, sem fechadura e/ou cadeado.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="legend">Abrigo de medidor inacabados e/ou em mal estado de conservação.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="legend">Aquecedor instalado em área considerada externa sem chaminé para melhorar a eficiência da combustão.</span></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="caract-1" value="1" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-2" value="2" />
                                    </td>
                                    <td>
                                        <input type="checkbox" name="caract-3" value="3" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <span id="salvar-cozinha" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;">Enviar</span>
                        <div class="clear"></div>

                    </article>
                    </div>
                </article>
    </div><!--- Fim modal Recomendações --->
              </div>
          </article>
          <article class="wc_tab_target" id="orcamento" style="display: none;">
           <div class="panel_header default" style="border-bottom: 2px solid #EEE !important;">
               <center><h1 class="tab_title" >Orçamentos</h1></center>
               <br>
           </div>
           <div class="panel">
           <?php require_once('tabOrcamento.php');?>
       </article>
   </div><!-- box70 -->
   <div class="box box30" style="width:30%;padding-top:0px;">
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