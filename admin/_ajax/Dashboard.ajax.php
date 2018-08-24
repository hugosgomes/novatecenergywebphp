<?php

session_start();
require '../../_app/Config.inc.php';

if (empty($_SESSION['userLogin'])):
    $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPPSSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
    echo json_encode($jSON);
    die;
endif;

usleep(100000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Dashboard';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
    if (empty($Read)):
        $Read = new Read;
    endif;

    // AUTO INSTANCE OBJECT CREATE
    if (empty($Create)):
        $Create = new Create;
    endif;

    // AUTO INSTANCE OBJECT UPDATE
    if (empty($Update)):
        $Update = new Update;
    endif;

    // AUTO INSTANCE OBJECT DELETE
    if (empty($Delete)):
        $Delete = new Delete;
    endif;

    //LICENCE CHECK
    if (file_exists("../dashboard.json")):
        $LicenseFile = file_get_contents("../dashboard.json");
        $LicenseDomain = json_decode($LicenseFile);

        if (empty($LicenseDomain->license_auth_date) || empty($LicenseDomain->license_hash)):
            unlink("../dashboard.json");
            exit;
        endif;

        if (!empty($LicenseDomain->license_auth_date)):
            $DateNow = new DateTime();
            $DatePing = new DateTime($LicenseDomain->license_auth_date);
            $DateDiff = $DateNow->diff($DatePing)->days;

            if ($DateDiff >= 5):
                set_error_handler(create_function('$severity, $message, $file, $line', 'throw new ErrorException($message, $severity, $severity, $file, $line);'));
                try {
                    $PostLicence = file_get_contents("https://download.workcontrol.com.br?h={$LicenseDomain->license_hash}&d=" . urlencode(BASE));
                    $resultLicence = json_decode($PostLicence);

                    if (!empty($resultLicence->trigger)):
                        $_SESSION['trigger_controll'] = $resultLicence->trigger;
                        unlink("../dashboard.json");
                    else:
                        //UPDATE LICENSE
                        $LicenseUpdate = str_replace('"license_auth_date":"' . $LicenseDomain->license_auth_date . '"', '"license_auth_date":"' . date("Y-m-d H:i:s") . '"', $LicenseFile);
                        chmod("../dashboard.json", 0755);
                        $LicenseFile = fopen("../dashboard.json", "w+");
                        fwrite($LicenseFile, $LicenseUpdate);
                        fclose($LicenseFile);
                        chmod("../dashboard.json", 0644);
                    endif;
                } catch (Exception $e) {
                    //ERROR HANDLER
                }
                restore_error_handler();
            endif;
        endif;
    endif;

    //SELECIONA AÇÃO
    switch ($Case):
        //WC LOGIN FIX
        case 'wc_login_fix':
            if (!empty($_SESSION['userLogin'])):
                $Read->ExeRead("[Funcionários]", "WHERE [ID] = :user", "user={$_SESSION['userLogin']['user_id']}");
                if ($Read->getResult()):
                    $_SESSION['userLogin'] = $Read->getResult()[0];
                    $jSON['login'] = true;
                else:
                    unset($_SESSION['userLogin']);
                    $_SESSION['trigger_login'] = AjaxErro("<div class='al_center icon-warning'>Sua sessão expirou ou você não tem permissão para acessar o painel!</div>", E_USER_ERROR);
                    $jSON['redirect'] = BASE . "/admin";
                endif;
            else:
                unset($_SESSION['userLogin']);
                $_SESSION['trigger_login'] = AjaxErro("<div class='al_center icon-warning'>Sua sessão expirou ou você não tem permissão para acessar o painel!</div>", E_USER_ERROR);
                $jSON['redirect'] = BASE . "/admin";
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
