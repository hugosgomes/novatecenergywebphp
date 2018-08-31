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
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>Clientes Particulares
    </div>
</header>

<div class="dashboard_content custom_app">
    <article class="box box70">
        <header>
          <h3>Cadastro de Clientes e Orçamentos</h3>
        </header> 
        <div class="box_content">
            <form  class="j_tab_home tab_create" name="user_manager" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="callback" value="Clientes"/><!--- doumento ajax.php -->
                    <input type="hidden" name="callback_action" value="cadCliente"/><!--ação que será adicionada no ajax.php-->
                <div class="label_50">
                    <!--PESQUISA AUTOMATICAMENTE NO BANCO O CPF DIGITADO AO MUDAR DE CAMPO DE FORMULARIO-->
                     <label class="label">
                        <span class="legend">CPF:</span>
                        <input type="text" style="font-size: 1.0em;" name="CPF" class="wc_cpf  j_consulta_cliente formCpf" callback="Clientes" callback_action="consulta" value="" placeholder="CPF:" />
                    </label>    
                    <!--PESQUISA AUTOMATICAMENTE NO BANCO O CNPJ DIGITADO AO MUDAR DE CAMPO DE FORMULARIO-->
                    <label class="label">
                        <span class="legend">CNPJ:</span>
                        <input type="text" style="font-size: 1.0em;" name="CNPJ" class="j_consulta_cliente wc_cnpj wc_value formCnpj" callback="Clientes" callback_action="consulta" value="" placeholder="Digite CNPJ"/>
                    </label>
                    <div class="clear"></div>
                </div>
                <div class="label_50">
                    <label class="label">
                        <span class="legend">Nome:</span>
                        <input class="wc_nome wc_value" style="font-size: 1.0em;" type="text" name="NOME" placeholder="Nome Completo" required/>
                    </label>
                    <label class="label">
                        <span class="legend">Cliente:</span>
                            <?php $campos = getWctipoCliente()?>
                            <select name="CLIENTE" class="wc_tipo wc_value" style="font-size: 1.0em;" type="text" required>
                                <option selected disabled value="">Selecione o tipo de cliente:</option>
                            <?php
                                foreach ($campos as $key=>$value) {?>
                                <option value="<?php echo $key?>"><?php echo $value;?></option>
                            <?php } ?>
                            </select>
                    </label>
                    <div class="clear"></div>
                </div>               

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Telefone:</span>
                        <input class="formPhone wc_telefone wc_value" style="font-size: 1.0em;" type="tel" name="TELEFONE" placeholder="Telefone" required/>
                    </label>
                    <label class="label">
                        <span class="legend">E-mail:</span>
                        <input class="wc_email wc_value" style="font-size: 1.0em;" type="email" name="EMAIL" placeholder="E-mail" required/>
                    </label>                    
                </div>
                <div class="label_50">
                    <label class="label">
                        <span class="legend">Tipo:</span>
                       <!-- <input class="wc_value" style="font-size: 1.4em;" type="text" name="TIPO" placeholder="Tipo de Serviço" required/>-->
                        <?php $campos = getWctipoServico()?>
                        <select name="TIPOSERVICO" class="wc_value" style="font-size: 1.0em;" type="text" required>
                            <option selected disabled value="">Selecione o tipo de serviço:</option>
                        <?php
                            foreach ($campos as $key=>$value) {?>
                            <option value="<?php echo $key?>"><?php echo $value;?></option>
                        <?php } ?>
                        </select>
                    </label>
                    <label class="label">
                        <span class="legend">Data:</span>
                        <!--<input class="wc_value" style="font-size: 1.4em;" type="text" name="DATASOLICITACAO" placeholder="Data Solicitação" required/>-->
                        <input style="font-size: 1.0em;" class="jwc_datepicker wc_value" readonly="readonly" type="text" name="DATACADASTRO" placeholder="Data Solicitação" />
                    </label>
                    <div class="clear"></div>
                </div>
                <div class="label_100">
                    <label class="label">
                        <span  class="legend">OBS:</span>
                        <textarea class="wc_value" style="font-size: 1.0em;" type="text" name="OBS" placeholder="Observações" required></textarea>
                    </label>
                    <div class="clear"></div>
                </div>

                <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                <button name="public" value="1" class="btn btn_green fl_left icon-share" style="margin-left: 5px;">Cadastrar!</button>
                <div class="clear"></div>
            </form>
        </div>
    </article>
    <article class="box box30">
        <header>
            <h3>Cadastro de Endereços</h3>
        </header> 
        <div class="box_content">
            <form  class="" name="user_manager" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="callback" value="Clientes"/><!--- doumento ajax.php -->
                <input type="hidden" name="callback_action" value="endereco"/><!--ação que será adicionada no ajax.php-->
                
                <div class="label_50">
                    <label class="label">
                        <span class="legend">CEP:</span>
                        <input class="wc_getCep wc_cep wc_value" style="font-size: 1.0em;" type="text" name="CEP" placeholder="Digite para " required/>
                    </label>
                    <label class="label">
                        <span class="legend">Logradouro:</span>
                        <input class="wc_logradouro wc_value" style="font-size: 1.0em;" type="text" name="LOGRADOURO" placeholder="Nome Completo" required/>
                    </label>
                    <div class="clear"></div>
                </div>
                <div class="label_50">    
                    <label class="label">
                        <span class="legend">Número:</span>
                        <input class="wc_numero wc_value" style="font-size: 1.0em;" type="text" name="NUMERO" placeholder="Endereço Completo" required/>
                    </label>
                    <label class="label">
                        <span class="legend">Bairro:</span>
                        <input class="wc_bairro wc_value" style="font-size: 1.0em;" type="text" name="BAIRRO" placeholder="Endereço Completo" required/>
                    </label>
                    <div class="clear"></div>
                </div>
                <div class="label_50"> 
                    <label class="label">
                        <span class="legend">Cidade:</span>
                        <input class="wc_localidade wc_value" style="font-size: 1.0em;" type="text" name="CIDADE" placeholder="Endereço Completo" required/>
                    </label>
                    <label class="label">
                        <span class="legend">UF:</span>
                        <input class="wc_uf wc_value" style="font-size: 1.0em;" type="text" name="UF" placeholder="Endereço Completo" required/>
                    </label>
                    <div class="clear"></div>
                </div>
                <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                <button name="public" value="1" class="btn btn_green fl_left icon-share" style="margin-left: 5px;">Cadastrar!</button>
                <div class="clear"></div>
            </form>

            <div class="panel">
                <?php
                /*$Read->ExeRead(DB_USERS_ADDR, "WHERE user_id = :user ORDER BY addr_key DESC, addr_name ASC", "user={$user_id}");
                if (!$Read->getResult()):
                    echo "<div class='trigger trigger_info trigger_none al_center'>{$user_name} ainda não possui endereços de entrega cadastrados!</span></div><div class='clear'></div>";
                else:
                    foreach ($Read->getResult() as $Addr):
                        $Addr['addr_complement'] = ($Addr['addr_complement'] ? " - {$Addr['addr_complement']}" : null);
                        $Primary = ($Addr['addr_key'] ? ' - Principal' : null);
                        echo "<div class='single_user_addr' id='{$Addr['addr_id']}'>
                            <h1 class='icon-location'>{$Addr['addr_name']}{$Primary}</h1>
                            <p>{$Addr['addr_street']}, {$Addr['addr_number']}{$Addr['addr_complement']}</p>
                            <p>B. {$Addr['addr_district']}, {$Addr['addr_city']}/{$Addr['addr_state']}, {$Addr['addr_country']}</p>
                            <p>CEP: {$Addr['addr_zipcode']}</p>

                            <div class='single_user_addr_actions'>
                                <a title='Editar endereço' href='dashboard.php?wc=users/address&id={$Addr['addr_id']}' class='post_single_center icon-notext icon-truck btn btn_blue'></a>
                                <span rel='single_user_addr' class='j_delete_action icon-notext icon-cancel-circle btn btn_red' id='{$Addr['addr_id']}'></span>
                                <span rel='single_user_addr' callback='Users' callback_action='addr_delete' class='j_delete_action_confirm icon-warning btn btn_yellow' style='display: none' id='{$Addr['addr_id']}'>Deletar Endereço?</span>
                            </div>
                        </div>";
                    endforeach;
                endif;*/
                ?>
                <div class="clear"></div>
            </div>
        </div>
    </article>
</div>