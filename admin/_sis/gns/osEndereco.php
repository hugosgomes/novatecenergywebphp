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
        <h1 class="icon-hammer">GNS</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
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
            <div class='box box50'>
                <table id=""class="display">
                    <thead>
                        <tr>
                            <th>ENDEREÇO</th>
                            <th>BAIRRO</th>
                            <th>LOGRADOURO</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $Read->FullRead("SELECT [ID], [BAIRRO], [BAIRROB], [ENDERECO], [IDCOND], [LOGRADOUROID], [MUNICIPIO], [MUNICIPIOB], [NUMERO], [PREFIXO], [RUA]
                                                      FROM [60_Enderecos]
                                                      WHERE [LOGRADOUROID] IS NULL
                                                      ORDER BY [ID] DESC"," ");
                            if($Read->getResult()):
                                foreach ($Read->getResult() as $ENDERECO):
                                    extract($ENDERECO);
                                    echo "<tr id='{$ID}'>
                                            <th>{$ENDERECO}</th>
                                            <th>{$BAIRRO}</th>
                                            <th>{$MUNICIPIO}</th>
                                            <th><span rel='{$ENDERECO}' bairro='{$BAIRROB}' callback='Enderecos' callback_action='pesquisa' class='j_pesquisa_endereco btn btn_blue' id='{$ID}'>Pesquisar</span></th>
                                        </tr>";
                                endforeach;

                            else:
                                echo "<tr><th>Sem Endereço para apresentar</th></tr>";
                            endif;
                        ?>           
                    </tbody>
                </table>
            </div>    
            <!--ONDE SERÃO APRESENTADOS O RESULTADO DA PESQUISA DE ENDEÇO -->
            <div class='box box50'>
                <article>
                        <div class="enderecos"></div>
                </article>
            </div>
        </div>
    </article>
</div>

<!--Inicia o data table-->
<script>
    $(document).ready(function() {
      $('table.display').DataTable();
    });
</script>

<script src="_js/gns.js"></script>