<?php
ob_start();
session_start();
require '../_app/Config.inc.php';

if (isset($_SESSION['userLogin']) && isset($_SESSION['userLogin']['user_level']) && $_SESSION['userLogin']['user_level'] >= 6):
    header('Location: dashboard.php?wc=home');
exit;
endif;



$Cookie = filter_input(INPUT_COOKIE, 'workcontrol', FILTER_VALIDATE_EMAIL);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2018-06-05T15:19:26-03:00+19599">
    <title>Novatec Energy - Entrar!</title>
    <meta name="description" content="<?= ADMIN_DESC; ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"/>
    <meta name="robots" content="noindex, nofollow"/>

    <link rel="shortcut icon" href="_img/favicon.png" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Code+Pro:300,500' rel='stylesheet' type='text/css'>        

    <link rel="stylesheet" href="../_cdn/bootcss/fonticon.css"/>
    <link rel="base" href="<?= BASE; ?>/admin/">

    <link rel="stylesheet" href="_css/login.css"/>   
    <link rel="stylesheet" href="_css/reset.css"/>   
    <link rel="stylesheet" href="_css/workcontrol.css"/>

</head>
<body class="login">

    <div class="container login_container">

        <div class="box box100">
            <img class="logotipo img-responsive" alt="<?= ADMIN_NAME; ?>" title="<?= ADMIN_NAME; ?>" src="_img/logo.png"/>
            <form class="formulario" name="work_login" action="" method="post" enctype="multipart/form-data">
                <div class="callback_return m_botton">
                    <?php
                    if (!empty($_SESSION['trigger_login'])):
                        echo $_SESSION['trigger_login'];
                    unset($_SESSION['trigger_login']);
                    endif;
                    ?>
                </div>
                <input type="hidden" name="callback" value="Login">
                <input type="hidden" name="callback_action" value="admin_login">
                    <center>
                        <label class="label" style="padding-bottom: 10px;width: 318px;">
                            <input type="text" name="LOGIN" value="<?= $Cookie ? $Cookie : ''; ?>"  placeholder="Digite seu usuário "  required style="border: 0px;    width: 90%;"/>
                            <span class="input-group-addon" style="border-radius: 0px;background-color: rgba(231, 234, 239, 0.27);border: 0px;color: white;"><i class=" icon-user" style="float: right;padding-top: 8px;background-color: rgba(231, 234, 239, 0.24);height: 35px;width: 10%;padding-left: 7px;"></i></span>
                        </label>
                        <label class="label" style="width: 318px;">
                            <input type="password" name="SENHA" placeholder="Digite sua senha" required style="border: 0px;width: 90%;"/>
                            <span class="input-group-addon" style="border-radius: 0px;background-color: rgba(231, 234, 239, 0.27);border: 0px;color: white;"><i class=" icon-lock" style="float: right;padding-top: 8px;background-color: rgba(231, 234, 239, 0.24);height: 35px;width: 10%;padding-left: 7px;"></i></span>
                        </label>
                        <img class="form_load none" style="float: right; margin-top: 3px; margin-left: 10px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_w.gif"/>
                        <!--<a href="#" class="fl_left minhasenha">Esqueceu a senha?</a>-->
                        <button class="btn_default btn_white icon-enter ">Login</button></center>
                <div class="clear"></div>
            </form>
            <div class="container_center">
                <hr>
                <footer class="fl_left">
                    © <?php echo date("Y"); ?> Novatec Energy - Todos os Direitos Reservados
                </footer>
            </div>
        </div>
    </div>       
    <div class="login_bg"></div>
    <script src="../_cdn/jquery.js"></script>
    <script src="../_cdn/jquery.form.js"></script>
    <script src="_js/workcontrol.js"></script>
</body>
</html>
<?php
//ob_end_flush();
