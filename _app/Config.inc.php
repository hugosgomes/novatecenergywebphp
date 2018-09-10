<?php
/*
 * BANCO DE DADOS
 */
if ($_SERVER['HTTP_HOST'] == 'localhost:83'):
    define('SIS_DB_HOST', 'NVTSERVERSQL'); //Link do banco de dados no localhost
    define('SIS_DB_USER', 'NVT'); //Usuário do banco de dados no localhost
    define('SIS_DB_PASS', '1'); //Senha  do banco de dados no localhost
    define('SIS_DB_DBSA', 'BDNVT'); //Nome  do banco de dados no localhost
else:
    define('SIS_DB_HOST', 'NVTSERVERSQL'); //Link do banco de dados no servidor
    define('SIS_DB_USER', 'NVT'); //Usuário do banco de dados no servidor
    define('SIS_DB_PASS', '1'); //Senha  do banco de dados no servidor
    define('SIS_DB_DBSA', 'BDNVT'); //Nome  do banco de dados no servidor
endif;
/*
 * CACHE E CONFIG
 */
define('SIS_CACHE_TIME', 10); //Tempo em minutos de sessão
define('SIS_CONFIG_WC', 1); //Registrar configurações no banco para gerenciar pelo painel!
/*
 * AUTO MANAGER
 */
define('DB_AUTO_TRASH', 0); //Remove todos os itens não gerenciados do banco!
define('DB_AUTO_PING', 0); //Tenta enviar 1x por dia o sitemap e o RSS para o Google/Bing
/*
 * TABELAS
 */
define('DB_CONF', '[60_CONFIG]'); //Tabela de Configurações
define('DB_FUNCIONARIOS', '[Funcionários]'); //Tabela de Funcionários
define('DB_USERS_ADDR', 'ws_users_address'); //Tabela de endereço de usuários
define('DB_USERS_NOTES', 'ws_users_notes'); //Tabela de notas do usuário
define('DB_POSTS', 'ws_posts'); //Tabela de posts
define('DB_POSTS_IMAGE', 'ws_posts_images'); //Tabela de imagens de post
define('DB_CATEGORIES', 'ws_categories'); //Tabela de categorias de posts
define('DB_SEARCH', 'ws_search'); //Tabela de pesquisas
define('DB_PAGES', 'ws_pages'); //Tabela de páginas
define('DB_PAGES_IMAGE', 'ws_pages_images'); //Tabela de imagens da página
define('DB_COMMENTS', 'ws_comments'); //Tabela de Comentários
define('DB_COMMENTS_LIKES', 'ws_comments_likes'); //Tabela GOSTEI dos Comentários
define('DB_PDT', 'ws_products'); //Tabela de produtos
define('DB_PDT_STOCK', 'ws_products_stock'); //Tabela de estoque por variação
define('DB_PDT_IMAGE', 'ws_products_images'); //Tabela de imagem de produtos
define('DB_PDT_GALLERY', 'ws_products_gallery'); //Tabela de galeria de produtos
define('DB_PDT_CATS', 'ws_products_categories'); //Tabela de categorias de produtos
define('DB_PDT_BRANDS', 'ws_products_brands'); //Tabela de fabricantes/marcas de produtos
define('DB_PDT_COUPONS', 'ws_products_coupons'); //Tabela de Cupons de desconto
define('DB_ORDERS', 'ws_orders'); //Tabela de pedidos
define('DB_IMOBI', 'ws_properties'); //Tabela de imóveis WS IMOBI
define('DB_IMOBI_GALLERY', 'ws_properties_gallery'); //Tabela de galeria de imóveis
define('DB_SLIDES', 'ws_slides'); //Tabela de conteúdo em destaque
define('DB_ORDERS_ITEMS', 'ws_orders_items'); //Tabela de itens do pedido
define('DB_VIEWS_VIEWS', 'ws_siteviews_views'); //Controle de acesso ao site
define('DB_VIEWS_ONLINE', 'ws_siteviews_online'); //Controle de usuários online
define('DB_WC_API', 'workcontrol_api'); //Controle de api do WC
define('DB_WC_CODE', 'workcontrol_code'); //Controle de code de WC

/*
 * EAD DBSA
 */
define('DB_EAD_COURSES', 'ws_ead_courses'); //Tabela de cursos
define('DB_EAD_COURSES_BONUS', 'ws_ead_courses_bonus'); //Tabela de bônus para cursos
define('DB_EAD_COURSES_SEGMENTS', 'ws_ead_courses_segments'); //Tabela de segmentos de cursos
define('DB_EAD_MODULES', 'ws_ead_modules'); //Tabela de módulos
define('DB_EAD_CLASSES', 'ws_ead_classes'); //Tabela de aulas
define('DB_EAD_ENROLLMENTS', 'ws_ead_enrollments'); //Tabela de matrículas
define('DB_EAD_ORDERS', 'ws_ead_orders'); //Tabela de pedidos
define('DB_EAD_SUPPORT', 'ws_ead_support'); //Tabela de dúvidas
define('DB_EAD_SUPPORT_REPLY', 'ws_ead_support_reply'); //Tabela de respostas
define('DB_EAD_STUDENT_CLASSES', 'ws_ead_student_classes'); //Tabela de matrículas
define('DB_EAD_STUDENT_CERTIFICATES', 'ws_ead_student_certificates'); //Tabela de certificados
define('DB_EAD_STUDENT_DOWNLOADS', 'ws_ead_student_downloads'); //Tabela de downloads do curso


/*
  AUTO LOAD DE CLASSES
 */

function MyAutoLoad($Class)
{
    $cDir = ['Conn', 'Helpers', 'Models', 'WorkControl'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php')):
            include_once(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;
}

spl_autoload_register("MyAutoLoad");

/*
 * Define todas as constantes do banco dando sua devida preferência!
 */
$WorkControlDefineConf = null;
if (SIS_CONFIG_WC):
    $Read = new Read;
    $Read->FullRead("SELECT [KEY], [VALUE] FROM " . DB_CONF);
    if ($Read->getResult()):
        foreach ($Read->getResult() as $WorkControlDefineConf):
            if ($WorkControlDefineConf['KEY'] != 'THEME' || empty($_SESSION['WC_THEME'])):
                define("{$WorkControlDefineConf['KEY']}", "{$WorkControlDefineConf['VALUE']}");
            endif;
        endforeach;
        $WorkControlDefineConf = true;
    endif;
endif;

require 'Config/Config.inc.php';

/*
 * Exibe erros lançados
 */

function Erro($ErrMsg, $ErrNo = null)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? 'trigger_info' : ($ErrNo == E_USER_WARNING ? 'trigger_alert' : ($ErrNo == E_USER_ERROR ? 'trigger_error' : 'trigger_success')));
    echo "<div class='trigger {$CssClass}'>{$ErrMsg}<span class='ajax_close'></span></div>";
}

/*
 * Exibe erros lançados por ajax
 */

function AjaxErro($ErrMsg, $ErrNo = null)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? 'trigger_info' : ($ErrNo == E_USER_WARNING ? 'trigger_alert' : ($ErrNo == E_USER_ERROR ? 'trigger_error' : 'trigger_success')));
    return "<div class='trigger trigger_ajax {$CssClass}'>{$ErrMsg}<span class='ajax_close'></span></div>";
}

/*
 * personaliza o gatilho do PHP
 */

function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine)
{
    echo "<div class='trigger trigger_error'>";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class='ajax_close'></span></div>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');


/*
 * Descreve nivel de usuário
 */

function getWcLevel($Level = null)
{
    $UserLevel = [
        1 => 'Cliente (user)',
        2 => 'Assinante (user)',
        6 => 'Colaborador (adm)',
        7 => 'Suporte Geral (adm)',
        8 => 'Gerente Geral (adm)',
        9 => 'Administrador (adm)',
        10 => 'Super Admin (adm)'
    ];

    if (!empty($Level)):
        return $UserLevel[$Level];
    else:
        return $UserLevel;
    endif;
}

/*
* Descreve tipo de cliente
*/

function getWcTipoCliente()
{
   $tipoCliente = array(
       1 => 'Grandes Orçamentos',
       2 => 'Pequenos Orçamentos',
   );

  return $tipoCliente;
}

/*
* Descreve tipo de servico
*/


function getWcTipoServico()
{
   $tipoServico = array(
       1 => 'Aplicação de Resina',
       2 => 'Tubulação de Gás',
       3 => 'Adequação de Vistoria',
       4 => 'Remanejamento',
       5 => 'Síndico',
       6 => 'Desobstrução da Tubulação de Gás',
       7 => 'Teste de Estanqueidade',
       8 => 'Análise de Ambientes',
       9 => 'Outros',
   );

  return $tipoServico;
}



/*
 * Fator multiplicador PagSeguro
 * https://pagseguro.uol.com.br/para_seu_negocio/parcelamento_com_acrescimo.jhtml#rmcl
 * @author: Whallysson Avelino <whallyssonallain@gmail.com>
 */

function getFactor($Factor = null)
{
    $FactorMult = [
        1 => 1.00000,
        2 => 0.52255,
        3 => 0.35347,
        4 => 0.26898,
        5 => 0.21830,
        6 => 0.18453,
        7 => 0.16044,
        8 => 0.14240,
        9 => 0.12838,
        10 => 0.11717,
        11 => 0.10802,
        12 => 0.10040,
        13 => 0.09397,
        14 => 0.08846,
        15 => 0.08371,
        16 => 0.07955,
        17 => 0.07589,
        18 => 0.07265
    ];
    if (!empty($Factor)):
        return $FactorMult[$Factor];
    else:
        return $FactorMult;
    endif;
}




function getWcRealtyTransaction($Transaction = null)
{
    $RealtyTransaction = [
        1 => 'Alugar',
        2 => 'Comprar',
        3 => 'Temporada'
    ];
    if (!empty($Transaction)):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}





function getWcHotmartStatusClass($Status = null)
{
    $HotmartStatus = [
        'started' => 'blue icon-checkmark2',
        'billet_printed' => 'blue icon-barcode',
        'pending_analysis' => 'blue icon-history',
        'delayed' => 'yellow icon-alarm',
        'canceled' => 'red icon-cancel-circle',
        'approved' => 'green icon-checkmark',
        'completed' => 'green icon-checkbox-checked',
        'chargeback' => 'yellow icon-warning',
        'blocked' => 'red icon-lock',
        'refunded' => 'red icon-cross',
        'admin_free' => 'green icon-bell'
    ];
    if (!empty($Status)):
        return $HotmartStatus[$Status];
    else:
        return $HotmartStatus;
    endif;
}

function getMesAtual(){
    return date('M');
}


function getStatusOrcamento($Transaction = null)
{
    $RealtyTransaction = [
        0 =>  'SEM CONTATO',
        1 => 'VISITA AGENDADA',
        2 => 'EM ANÁLISE',
        3 => 'EXECUTANDO',
        4 => 'EXECUTADO',
        5 => 'CANCELADO',
        6 => 'RECUSADO'
    ];
    if (!empty($Transaction)):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}


function getFormaPagamento($Transaction = null)
{
    $RealtyTransaction = [
        0 => 'CARTÃO DE CRÉDITO',
        1 => 'DEPÓSITO/TRANSFERÊNCIA',
        2 => 'Á VISTA'
    ];
    
    if (!empty($Transaction)):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}