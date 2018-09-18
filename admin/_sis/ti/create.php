<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['TI'] == 0)):
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

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=users/home">Usuários</a>
            <span class="crumb">/</span>
            Dados de Usuário
        </p>
    </div>
</header>

<div class="dashboard_content dashboard_users">
    <div class="box box70">
        <article class="wc_tab_target wc_active" id="profile">

            <div class="panel">
                <!--SELECT DO TÉCNICO-->
                <div class="label_50">
                    <label class="label">
                        <select id="Usuario" name="tecnico" callback="Agendamentos" callback_action="consulta" rel="<?= $Day ?>" semana="<?= $Semana ?>">
                            <option value="t">Selecione o Usuário</option>             
                            <?php
                            $Setor = 2;
                            $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários ORDER BY [NOME COMPLETO]"," ");
                            if ($Read->getResult()):
                              foreach ($Read->getResult() as $FUNC):
                                echo "<option value='{$FUNC['id']}'>{$FUNC['nome']}</option>";
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>       
            </div>

            <form class="j_tab_home tab_create" name="user_manager" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="callback" value="Ti"/>
                <input type="hidden" name="callback_action" value="manager"/>

                <label class="label">
                    <span class="legend">Nome:</span>
                    <input value="" type="text" name="user_name" placeholder="Nome:" required />
                </label>
                <div class="label_50">
                    <label class="label">
                        <span class="legend">E-mail:</span>
                        <input value="" type="email" name="user_email" placeholder="E-mail:" required />
                    </label>
                    <label class="label">
                        <span class="legend">Senha:</span>
                        <input value="" type="password" name="user_password" placeholder="Senha:" />
                    </label>
                </div>
                
                <h2 class="m_botton">Permissões de Usuários</h2>
                <label class="label">
                    <input name="GNS" type="checkbox" value="1"> GNS
                    <input name="CLIENTES_PARTICULARES" type="checkbox" value="1"> Clientes Particulares
                    <input name="TI" type="checkbox" value="1" checked> TI
                </label>

                <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                <button name="public" value="1" class="btn btn_green fl_right icon-share" style="margin-left: 5px;">Atualizar Usuário!</button>
                <div class="clear"></div>
            </form>
        </div>
    </article>
</div>
</div>