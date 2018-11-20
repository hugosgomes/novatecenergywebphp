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
.blocker{
    z-index: 98;
}
</style>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
        &raquo;</span>
        <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
        <span class="crumb">/</span>
        <a title="Novatec Energy" href="dashboard.php?wc=gns/agendamentos&day=<?= $Data->format('Ymd');?>">Agendamentos</a>
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
                    <select style="font-size: 0.9em;" id="cliente" name="IDCLIENTE">
                        <option value="">Selecione um Cliente</option>
                        <?php
                        $Read->FullRead("SELECT [Id],[NomeCliente] FROM [60_Clientes] ORDER BY [NomeCliente] ASC"," ");
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
                    <input style="font-size: 0.9em;" class="jwc_datepicker" readonly="readonly" type="text" name="DATAAGENDAMENTO" placeholder="Data Agendamento" id="data" required/>
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
    <header>
      <h3 style="text-align: center;">Relação de Clientes sem OT/OS</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <!--APRESENTA OS CLIENTES SEM OT VINCULADA -->
        <article class="box" style="width:60%">
            <div class="tabela-responsivel" style="height: 62%;font-size:13px;">
               <table  class='table' style="width: 100%;font-size:13px;">
                    <thead>
                        <tr>
                            <th>Nº Cliente</th>
                            <th>Nome Cliente</th>
                            <th>Data Agend.</th>
                            <th>Consultar OT/OS</th>
                        </tr>
                    </thead>
                    <tbody id='j_cliente_semOT'>
                        
                    </tbody>
                <!--LOCAL ONDE CARREGA OS DADOS DOS CLIENTES VINDOS DO AJAX-->
                </table>
        </div>
    </article>
    <!--LOCAL ONDE É APRESENTADO AS SUGESTÕES DE OT PARA VINCULAR-->
    <article class="box" style="width:40%">
        <div class="tabela-responsivel" style="height: 62%;">
            <table class="ot" style="font-size: 0.9em;width:100%">           
            </table>
        </div>
    </article>
</article>
</div>
</article>
</div>
<script src="_js/gns.js"></script>
<script>
    $(document).ready(carregarTabela);
</script>