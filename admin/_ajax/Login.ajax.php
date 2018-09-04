<?php

session_start();
require '../../_app/Config.inc.php';

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Login';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    //ELIMINA CÓDIGOS
    $PostData = array_map('strip_tags', $PostData);

    //SELECIONA AÇÃO
    switch ($Case):
        //LOGIN
        case 'admin_login':

        //VERIFICA O PRENCHIMENTO CORRETO DO FORMULÁRIO
            if (in_array('', $PostData)):

                $jSON['trigger'] = AjaxErro('<b>OPPSSS:</b> Informe seu login e senha!', E_USER_NOTICE);
            else:
                    $LOGIN = $PostData['LOGIN'] . "@novatecenergy.com.br";
                    $SENHA = $PostData['SENHA'];

                    $Read = new Read;

                    $Read->FullRead("SELECT ID FROM [Funcionários] WHERE [E-MAIL CORPORATIVO] = :login", "login={$LOGIN}");
                    if (!$Read->getResult()):
                        $jSON['trigger'] = AjaxErro('<b>ERRO:</b> Login informado não está cadastrado!', E_USER_WARNING);
                    else:
                        //CRIPTIGRAFA A SENHA INFORMADA PARA COMPARAÇÃO NO BANCO
                        $SENHA = hash('sha1', $SENHA);
                        

                        //COMPARAÇÃO DO QUE FOI INFORMADO COM O QUE TEM NO BD
                        $Read->FullRead("SELECT ID FROM " . DB_FUNCIONARIOS . " WHERE [E-MAIL CORPORATIVO] = :login AND [SENHA] = :senha", "login={$LOGIN}&senha={$SENHA}");
                        if (!$Read->getResult()):
                            $jSON['trigger'] = AjaxErro('<b>ERRO:</b> Login e senha não conferem!', E_USER_ERROR);
                        else:
                            $_SESSION['userLogin'] = $Read->getResult()[0];
                            $jSON['trigger'] = AjaxErro("<b>Bbem-vindo(a) ao Sistema Novatec!");
                            $jSON['redirect'] = 'dashboard.php?wc=home';                           
                        endif;
                    endif;
            endif;
            break;

        case 'admin_recover':
            if (isset($PostData['user_email']) && Check::Email($PostData['user_email']) && filter_var($PostData['user_email'], FILTER_VALIDATE_EMAIL)):
                $Read = new Read;
                $Read->FullRead("SELECT user_id, user_name, user_email, user_password FROM " . DB_FUNCIONARIOS . " WHERE user_email = :email AND user_level >= :level", "email={$PostData['user_email']}&level=6");
                if (!$Read->getResult()):
                    $jSON['trigger'] = AjaxErro('<b>OPPSSS:</b> E-mail não cadastrado ou não tem permissão para o painel!', E_USER_WARNING);
                else:
                    $CodeReset = "user_id={$Read->getResult()[0]['user_id']}&user_email={$Read->getResult()[0]['user_email']}&user_password={$Read->getResult()[0]['user_password']}";
                    $CodePass = base64_encode($CodeReset);

                    require '../_tpl/Mail.email.php';
                    $BodyMail = "
                    <p style='font-size: 1.5em;'>Olá {$Read->getResult()[0]['user_name']}, recupere sua senha do " . ADMIN_NAME . "!</p>
                    <p>Caso não tenha feito essa solicitação. Por favor ignore esse e-mail e nenhuma ação será tomada quanto aos dados de acesso!</p>
                    <p>Ou para criar uma nova senha de acesso <a title='Criar Nova Senha' href='" . BASE . "/admin/newpass.php?key={$CodePass}'>CLIQUE AQUI!</a>!</p>
                    <p>Você será redirecionado para uma página onde poderá definir uma nova senha de acesso ao painel! Cuide bem dos seus dados.</p>
                    ";
                    $Mensagem = str_replace('#mail_body#', $BodyMail, $MailContent);

                    $Email = new Email;
                    $Email->EnviarMontando('Recupere sua Senha', $Mensagem, ADMIN_NAME, MAIL_USER, $Read->getResult()[0]['user_name'], $Read->getResult()[0]['user_email']);

                    $_SESSION['trigger_login'] = AjaxErro("<b>SUCESSO:</b> Olá {$Read->getResult()[0]['user_name']}, confira o link enviado em seu e-mail para recuperar sua senha!");
                    $jSON['trigger'] = AjaxErro('<b>SUCESSO:</b> O link foi enviado para seu e-mail!');
                    $jSON['redirect'] = './';
                endif;
            else:
                $jSON['trigger'] = AjaxErro('<b>OPPSSS:</b> Infor seu e-mail para recuperar a senha!', E_USER_WARNING);
            endif;
            break;

        case 'admin_newpass':
            if (empty($_SESSION['RecoverPass'])):
            else:
                if (in_array('', $PostData)):
                    $jSON['trigger'] = AjaxErro('<b>OPPSSS:</b> Para redefinir uma nova senha, você deve informar e repetir a mesma logo abaixo!', E_USER_NOTICE);
                elseif (strlen($PostData['user_password']) < 5):
                    $jSON['trigger'] = AjaxErro('<b>ALERTA:</b> Informe uma senha com no mínimo 5 caracteres!', E_USER_WARNING);
                elseif ($PostData['user_password'] != $PostData['user_password_re']):
                    $jSON['trigger'] = AjaxErro('<b>ALERTA:</b> Você deve informar e repetir a mesma senha. Você informou senhas diferentes!', E_USER_WARNING);
                else:
                    $DecodeValidate = base64_decode($_SESSION['RecoverPass']);
                    parse_str($DecodeValidate, $Validate);

                    $Read = new Read;
                    $Read->FullRead("SELECT user_name, user_id FROM " . DB_FUNCIONARIOS . " WHERE user_id = :id AND user_email = :email AND user_password = :pass", "id={$Validate['user_id']}&email={$Validate['user_email']}&pass={$Validate['user_password']}");
                    if ($Read->getResult()):
                        $UpdatePass = ['user_password' => hash('sha512', $PostData['user_password'])];
                        $Update = new Update;
                        $Update->ExeUpdate(DB_FUNCIONARIOS, $UpdatePass, "WHERE user_id = :id", "id={$Read->getResult()[0]['user_id']}");

                        $_SESSION['trigger_login'] = AjaxErro("<b>INFO:</b> Olá {$Read->getResult()[0]['user_name']}, para logar informe seu e-mail e sua NOVA SENHA de acesso!");
                        $jSON['trigger'] = AjaxErro('<b>SUCESSO:</b> Sua senha foi redefinida!');
                        $jSON['redirect'] = './';
                    else:
                        $_SESSION['trigger_login'] = AjaxErro("<b>OPPSSS:</b> Você tentou recuperar sua senha com um código de acesso expirado!", E_USER_ERROR);
                        $jSON['trigger'] = AjaxErro('<b>ERRO:</b> Não foi possível redefinir!', E_USER_WARNING);
                        $jSON['redirect'] = './';
                    endif;
                endif;
            endif;
            break;
    endswitch;

    //RETORNA O CALLBACK
    if ($jSON):
        echo json_encode($jSON);
    else:
        $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
        echo json_encode($jSON);
    endif;
else:
    //ACESSO DIRETO
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
endif;
