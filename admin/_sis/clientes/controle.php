<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['CLIENTES_PARTICULARES'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

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
            OS Sem Endereço
        </p>
    </div>
</header>

<div class="dashboard_content custom_app">
    <article class="box box100">
        <header>
          <h3>OS sem Endereço</h3>
        </header> 
        <div class="box_content">

            <?php
                $LOG = 'RIO DE JANEIRO';
                $Read->FullRead("SELECT [E].[ID], [E].[BAIRRO], [E].[BAIRROB], [E].[ENDERECO], [E].[IDCOND], [E].[LOGRADOUROID], [E].[MUNICIPIO], [E].[MUNICIPIOB], [E].[NUMERO], [E].[PREFIXO], [E].[RUA]
                                          FROM [60_Enderecos] AS [E]
                                          WHERE [E].[LOGRADOUROID] IS NULL AND [E].[MUNICIPIO] = :log
                                          ORDER BY [E].[ID] DESC","log={$LOG}");
            ?>

            <article class='box box50'>
                <table id=""class="display">
                    <thead>
                        <tr>
                            <th>TIPO</th>
                            <th>ENDEREÇO</th>
                            <th>BAIRRO</th>
                            <th>LOGRADOURO</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td></td></tr>            
                    </tbody>
                </table>
            </article>
            <article class='box box50'>
                <table id=""class="display">
                    <thead>
                        <tr>
                            <th>ENDEREÇO</th>
                            <th>BAIRRO</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td></td></tr>            
                    </tbody>
                </table>
            </article>
        </div>
    </article>
</div>