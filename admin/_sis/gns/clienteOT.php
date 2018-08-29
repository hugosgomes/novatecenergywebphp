<?php
$AdminLevel = LEVEL_WC_USERS;
if (!$DashboardLogin):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
$ID = 0;

?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-hammer">GNS</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            <a title="Novatec Energy" href="dashboard.php?wc=gns/agendamentos">Agendamentos</a>
            <span class="crumb">/</span>
            Cliente Sem OT/OS
        </p>
    </div>
</header>

<div class="dashboard_content custom_app">
    <article class="box box100">
        <header>
          <h3>Clientes sem OT/OS</h3>
        </header>
        <div class="box_content">
            <article class='box box100'>
                <form name="user_manager" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="callback" value="ClientesOT"/>
                    <input type="hidden" name="callback_action" value="addCliente"/>

                    <label class="label_50">
                            <label class="label">
                                <span class="legend">Cliente:</span>
                                <select style="font-size: 1.2em;" id="Cliente" name="IDCLIENTE">
                                    <option value="">Selecione um Cliente</option>
                                    <?php
                                    $Read->FullRead("SELECT [Id],[EnderecoId],[NumCliente],[NomeCliente],[Telefone1],[Telefone2],[Telefone3],[Criadoem] ,[UsuarioColetivo],[CPFCNPJ],[SituacaoCliente],[Mercado],[SituacaoFornecimento],[AreaAgendamento],[AreaOrigem] 
                                            FROM [60_Clientes]
                                            WHERE [SituacaoCliente] = :situacao ORDER BY [NomeCliente] ASC","situacao=1");
                                    if ($Read->getResult()):
                                        foreach ($Read->getResult() as $CLI):
                                            echo "<option value='{$CLI['Id']}'>{$CLI['NomeCliente']}</option>";
                                        endforeach;
                                    endif;

                                    ?>
                                </select>
                            </label> 

                            <label class="label">
                                <span class="legend">Data de Agendamento:</span>
                                <input style="font-size: 1.2em;" class="jwc_datepicker" readonly="readonly" type="text" name="DATAAGENDAMENTO" placeholder="Data Agendamento" required/>
                            </label>

                            <div class="clear"></div>
                    </label>

                    <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                    <button name="public" value="1" class="btn btn_green fl_right icon-share" style="margin-left: 5px;">Enviar</button>
                    <div class="clear"></div>
                </form>
            </article>
            
            <!--APRESENTA OS CLIENTES SEM OT VINCULADA -->
            <article class="box box100">
                <div class="j_cliente_semOT">
                    <?php
                        $Read->FullRead("SELECT ID, IDCLIENTE, DATAAGENDAMENTO FROM [60_ClientesSemOT]
                                WHERE [IDOT] IS NULL ORDER BY [DATAAGENDAMENTO] ASC"," ");

                        if ($Read->getResult()):
                            foreach ($Read->getResult() as $CLI):
                                extract($CLI);
                                
                                $Read->FullRead("SELECT NomeCliente FROM [60_Clientes] WHERE [Id] = :id","id={$IDCLIENTE}");
                                echo "<span class='wc_pdt_stock' id='{$ID}'>{$Read->getResult()[0]['NomeCliente']}</a></h1>
                                       <p>Data: " . date('d/m/Y', strtotime($DATAAGENDAMENTO)) . "</p>";
                            endforeach;
                        endif;
                    ?>
                </div>
            </article>

        <!--MODAL QUE ABRE PARA SELECIONAR O -->
        <div class="workcontrol_pdt_size">
            <form name="pdt_size" action="" method="post">
                <p class="icon-hammer">OT's sugeridas:</p>

                <div class="inputs jwc_product_stock_target">
                    <div class="callback_return"></div>
                    <div class="clear"></div>
                    <?php
                        $Read->FullRead("SELECT [Id], [NumOT] FROM [60_OT] WHERE  [Cliente] = :cliente", "cliente={$IDCLIENTE}");
                        if ($Read->getResult()):
                            foreach ($Read->getResult() as $OT):
                                extract($OT);
                                echo "<label><span id='{$Id}'>{$NumOT}</span><span rel='agendamentos' callback='ClientesOT' callback_action='atualizaCliente' class='j_vinculaOT icon-checkmark btn btn_blue' id='{$Id}'></span></label>";
                            endforeach;
                        else:
                            echo "<label><span class='size'><b>Sem OT para vincular</b></span></label>";
                        endif;
                    ?>
                </div>
                <div class="workcontrol_pdt_size_close">X</div>
                <div class="clear"></div>
            </form>
        </div>

        </div>
    </article>
</div>