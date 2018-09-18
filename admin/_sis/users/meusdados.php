<?php
if (!$DashboardLogin || !$_SESSION['userLogin']):
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
            &raquo; Home
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
                <form class="j_tab_home" name="user_manager" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="callback" value="Login"/>
                    <input type="hidden" name="callback_action" value="alterar_senha"/>
                    <input type="hidden" name="ID" value="<?= $_SESSION['userLogin']['ID']; ?>"/>
                    
                    <div class="label_50">
                        <label class="label">
                            <span class="legend">Digite a nova senha:</span>
                            <input value="" type="password" name="SENHA1" placeholder="Digite sua senha:" />
                        </label>
                    </div>
                    <div class="label_50">
                        <label class="label">
                            <span class="legend">Repita a senha:</span>
                            <input value="" type="password" name="SENHA2" placeholder="Repita sua senha:" />
                        </label>
                        <div class="clear"></div>
                    </div>

                    <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                    <button name="public" value="1" class="btn btn_green fl_left icon-share" style="margin-left: 5px;">Salvar!</button>
                    <div class="clear"></div>
                </form>
            </div>
        </article>
</div>