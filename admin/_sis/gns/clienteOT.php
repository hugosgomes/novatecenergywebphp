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
            <a title="Novatec Energy" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Novatec Energy" href="dashboard.php?wc=gns/agendamentos">Agendamentos</a>
            <span class="crumb">/</span>
            Cliente Sem OT/OS
        </p>
    </div>
</header>

<!--MODAL QUE ABRE PARA SELECIONAR O -->
<div class="workcontrol_pdt_size">
        <form name="pdt_size" action="" method="post">
            <p class="icon-folder-plus">Estoque por variação:</p>
            <input type="hidden" name="callback" value="Products"/>
            <input type="hidden" name="callback_action" value="pdt_stock"/>
            <input type="hidden" name="pdt_id" value="<?= $PdtId; ?>"/>

            <div class="inputs jwc_product_stock_target">
                <div class="callback_return"></div>
                <div class="clear"></div>
                <?php
                $CatSizes = E_PDT_SIZE;
                if ($pdt_subcategory):
                    $Read->FullRead("SELECT cat_sizes FROM " . DB_PDT_CATS . " WHERE cat_id = :id", "id={$pdt_subcategory}");
                    if ($Read->getResult() && !empty($Read->getResult()[0]['cat_sizes'])):
                        $CatSizes = $Read->getResult()[0]['cat_sizes'];
                    endif;
                endif;
                $WcPdtSize = explode(',', $CatSizes);
                foreach ($WcPdtSize as $Size):
                    $Size = trim(rtrim($Size));
                    $Read->FullRead("SELECT stock_inventory, stock_sold FROM " . DB_PDT_STOCK . " WHERE pdt_id = :pdt AND stock_code = :key", "pdt={$PdtId}&key={$Size}");
                    if ($Read->getResult()):
                        echo "<label><span class='size'>{$Size}:</span><input name='{$Size}' type='number' min='0' value='{$Read->getResult()[0]['stock_inventory']}'><span class='cart'><b class='icon-cart'>" . str_pad($Read->getResult()[0]['stock_sold'], 2, 0, 0) . "</b></span></label>";
                    else:
                        echo "<label><span class='size'>{$Size}:</span><input name='{$Size}' type='number' min='0' value='0'><span class='cart'><b class='icon-cart'>00</b></span></label>";
                    endif;
                endforeach;
                ?>
            </div>
            <button class="btn btn_green icon-ungroup">Atualizar Estoque!</button>
            <img class="form_load" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
            <div class="workcontrol_pdt_size_close">X</div>
            <div class="clear"></div>
        </form>
    </div>



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
        </div>
    </article>
</div>