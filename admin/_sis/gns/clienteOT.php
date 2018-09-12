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
    <div id="cad_clientes_semOTOS" class="modal" style="height: auto;">
   <article class="box box100">
        <header>
          <h3 style="text-align: center;">Cadastro de Clientes sem OT/OS</h3>
      </header>
      <div class="box_content">
        <article class='box box100'>
            <label class="label_100">
                <label class="label">
                    <span class="legend">Cliente:</span>
                    <select style="font-size: 1.2em;" id="cliente" name="IDCLIENTE">
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
                    <input style="font-size: 1.2em;" class="jwc_datepicker" readonly="readonly" type="text" name="DATAAGENDAMENTO" placeholder="Data Agendamento" id="data" required/>
                </label>

                <div class="clear"></div>
            </label>
            <span name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;" id="clientesOT" callback="ClientesOT" callback_action="addCliente">Enviar</span>
            <div class="clear"></div>

        </article>
    </div>
</article>
</div>
<article class="box box100">
    <div class="box box50">
        <a class="btn btn_darkblue" href="#cad_clientes_semOTOS" rel="modal:open"><i class="icon-share"></i> Cadastrar</a>
    </div>
    <header>
      <h3 style="text-align: center;">Relação de Clientes sem OT/OS</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <!--APRESENTA OS CLIENTES SEM OT VINCULADA -->
        <article class="box box50">
            <div class="j_cliente_semOT">
               <table class='table' style="width: 100%;">
                <?php
                $Read->FullRead("SELECT ID, IDCLIENTE, DATAAGENDAMENTO FROM [60_ClientesSemOT]
                    WHERE [IDOT] IS NULL ORDER BY [DATAAGENDAMENTO] ASC"," ");

                if ($Read->getResult()):
                    foreach ($Read->getResult() as $CLI):
                        extract($CLI);

                        $Read->FullRead("SELECT NomeCliente FROM [60_Clientes] WHERE [Id] = :id","id={$IDCLIENTE}");
                        echo "
                        <tr>
                        <td id='{$IDCLIENTE}'>{$Read->getResult()[0]['NomeCliente']}</td>
                        <td>" . date('d/m/Y', strtotime($DATAAGENDAMENTO)) . "</td>
                        <td><span class='j_pesquisa_ot icon-search btn btn_darkblue' rel='{$IDCLIENTE}' callback='ClientesOT' callback_action='consulta'>&ensp;Consultar OT/OS</span></td>
                        </tr>";


                    endforeach;
                endif;
                ?>
            </table>

        </div>
    </article>
    <!--LOCAL ONDE É APRESENTADO AS SUGESTÕES DE OT PARA VINCULAR-->
    <article class="box box_50">
        <table class="ot" style="font-size: 0.9em;">           
        </table>
    </article>
</div>
</article>
</div>
<script src="_js/gns.js"></script>