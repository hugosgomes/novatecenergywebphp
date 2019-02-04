<?php
/*
 * BANCO DE DADOS
 */
if ($_SERVER['HTTP_HOST'] == 'localhost:83'):
    define('SIS_DB_HOST', 'NVTSERVERSQL'); //Link do banco de dados no localhost
    define('SIS_DB_USER', 'NVT'); //Usuário do banco de dados no localhost
    define('SIS_DB_PASS', '1'); //Senha  do banco de dados no localhost
    define('SIS_DB_DBSA', 'TESTE'); //Nome  do banco de dados no localhost
else:
    define('SIS_DB_HOST', 'NVTSERVERSQL'); //Link do banco de dados no servidor
    define('SIS_DB_USER', 'NVT'); //Usuário do banco de dados no servidor
    define('SIS_DB_PASS', '1'); //Senha  do banco de dados no servidor
    define('SIS_DB_DBSA', 'TESTE'); //Nome  do banco de dados no servidor
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


//FUNÇÃO DA TELA DE CLIENTES PARTICULARES
function getStatusOrcamento($Status = null)
{   

    if($Status <> "0"){

        $RealtyTransaction = [
            0 => 'SEM CONTATO',
            1 => 'VISITA AGENDADA',
            2 => 'EM ANÁLISE',
            3 => 'SERVIÇO AGENDADO',
            4 => 'EXECUTANDO',
            5 => 'EXECUTADO',
            6 => 'CANCELADO',
            7 => 'RECUSADO'
        ];
    }else{
    
        $RealtyTransaction = [
            0 => 'SEM CONTATO',
            1 => 'VISITA AGENDADA',
            6 => 'CANCELADO',
            7 => 'RECUSADO'
        ];
    }
    return $RealtyTransaction;
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


function getStatusOs($Transaction = null){
    $RealtyTransaction = [
        //0 => 'Não Associado',
        0 => 'Associado',
        1 => 'Atendido',
        2 => 'Cancelado',
        3 => 'Ausente',
        4 => 'Reagendado NVT',
        5 => 'Reagendado GNS',
        6 => 'Sem Atender'
    ];
    
    if ($Transaction!=null):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}

function getNovoStatusOs($Transaction = null){
    $RealtyTransaction = [
        1 => 'Atendido',
        2 => 'Cancelado',
        3 => 'Ausente',
        4 => 'Reagendado NVT',
        5 => 'Reagendado GNS',
        6 => 'Sem Atender'
    ];
    
    if ($Transaction!=null):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}

function getStatusContato($Transaction = null){
    $RealtyTransaction = [
        0 => 'RETORNAR DEPOIS',
        1 => 'CONTATO FEITO',
        2 => 'SEM CONTATO'
    ];
    
    if ($Transaction!=null):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}

function getStatusOrcamentoGNS($Transaction = null){
    $RealtyTransaction = [
        1 => 'APROVADO',
        2 => 'EXECUTADO',
        3 => 'RECUSADO',
        4 => 'RECUPERADO'
    ];
    
    if ($Transaction!=null):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}


//ARRAY DE ITENS DE INSPEÇÃO PARA A TELA DE DEFEITOS NO MÓDULO DE GNS
function getItemInspecao($Transaction = null){
    $RealtyTransaction = [
        //DISTRIBUIÇÃO INTERNA
        1 => 'Afastamentos de sistemas elétricos de potência em baixa tensão isolados em eletrodutos não metálicos e a ocorrência de interferências com as mesmas. Afastamentos quando em redes em paralelo maior ou igual a 30 mm e quando em cruzamentos maior ou igual a 10 mm (com material isolante aplicado:',

        2 => 'Afastamentos de sistemas elétricos de potência em baixa tensão isolados em eletrodutos metálicos ou sem eletrodutos e a ocorrência de interferências com as mesmas. Afastamentos maior ou igual a 50 mm para cada lado.',

        3 => 'Afastamentos e a ocorrência de interferências com tubulações de água quente ou fria. Afastamentos quando em redes em paralelo maior ou igual a 30 mm e quando em cruzamentos maior ou igual a 10 mm',

        4 => 'Afastamentos e a ocorrência de interferências com tubulação de vapor. Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 10 mm.',

        5 => 'Afastamentos e a ocorrência de interferências com chaminés. Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 50 mm.',

        6 => 'Afastamentos e a ocorrência de interferências com tubulação de gás. Afastamentos quando em redes em paralelo maior ou igual a 10 mm e quando em cruzamentos maior ou igual a 10 mm.',

        7 => 'Afastamentos e a ocorrência de interferências com as demais instalações (águas pluviais, esgoto). Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 10 mm.',

        8 => "Encaminhamento da tubulação da rede. Rede não passando por vazios, caixas d'água, caixa de escada ou poços de elevadores.",

        9 => 'Condições dos elementos de suportação. Suportes íntegros, com robustez compatível, adequadamente distanciados, bem fixados e protegidos contra corrosão.',

        10 => 'Identificação da tubulação de gás. Pintura na cor padrão ou de etiqueta com a palavra gás.',

        11 => '  Tipo de material utilizado na rede, inclusive tubos multicamada e PE x Aço. Utilização de materiais não contemplados na ABNT NBR 15526 e Nota Técnica da ABEGÁS.',

        12 => 'Integridade do material utilizado na rede. Inexistência de amassamentos, corrosão ou fissuras.',

        13 => 'Local de instalação dos materiais. Adequação dos materiais quanto a aspectos de proteção, conforme ABNT NBR 15526.',

        14 => 'Estanqueidade para a rede de distibuição interna. Vazamento após realização de ensaio entre 1 l/h e 5 l/h.',

        15 => 'Estanqueidade para a rede de distibuição interna. Vazamento após realização de ensaio maior que 5 l/h.',

        16 => 'Estanqueidade das conexões de ligação dos medidores. Conexões estanques.',

        17 => '  Condições de acesso ao abrigo. Desobstruído, permitindo a marcação, inspeção e manutenção dos medidores.',

        18 => 'Abertura para ventilação permanente no abrigo de medidores. Existência de abertura para ventilação permanente superior ou inferior do abrigo, conforme gás combustível utilizado na instalação.',

        19 => 'Abertura para ventilação permanente no abrigo de medidores. Área da ventilação permanente superior ou inferior equivalente a 1/10 da área da planta baixa.',

        20 => ' Condição de instalação de medidores localizados nos andares. Existência de ventilação permanente, para o exterior.',

        21 => 'Dispositivos no interior do abrigo. Ausência de dispositivos e/ou instalações elétricas no interior do abrigo, que possam produzir chama ou centelhamento.',

        22 => 'Dispositivos no interior do abrigo. Ausência de entulhos, botijões de GLP ou outros materiais no interior do abrigo.',

        23 => ' Dispositivos no interior do abrigo. Luminárias, interruptores, tomadas, e/ou outras instalações elétricas para uso da cabine com blindagem a prova de explosão.',
        //APARELHOS A GÁS
        24 => "Local de instalação dos aparelhos a gás de circuito aberto. Não devem ser instalados em dormitório e banheiro.",

        25 => "Volume do local de instalação de aparelho a gás de circuito aberto, com ou sem duto de exaustão natural. Volume mínimo do ambiente maior ou igual a 6 m³.",

        26 => "Cozinha apenas com fogão de até 216 kcal/min e com volume maior ou igual que 6 m³. Ventilação com área total útil e permanente de no mínimo 800 cm². (Superior –600 cm² (para uma área externa) e inferior – 200 cm²). Ambientes com aparelhos de potência superior 216kcal/min, será necessário multiplicar a potência por 1,5. Caso dê <= 800 manter ventilação acima, caso seja > 800, 33% desse valor é igual a ventilação inferior e 67% desse valor é igual a ventilação superior.",

        27 => "Aquecedor de circuito aberto com potência de até 200 Kcal/min instalados em banheiro, condicionado à conformidade das demais adequações e a aplicação de ações mitigadoras. Volume do ambiente maior ou igual a 6m³.",

        28 => "  Aquecedor de circuito aberto instalados em banheiro no interior de BOXE. Divisória acima de 1,80 m e vão da divisória ao teto menor que 0,40 m.",

        29 => "  Aparelho a gás de circuito aberto com exaustão mecânica. Exaustão mecânica ligada (condicionado à conformidade das demais adequações e a aplicação de ações mitigadoras).",

        30 => "Aquecedor instalado no interior de banheiro com exaustão mecânica (RJ).",

        31 => "Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Abertura para ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência.",

        32 => "Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Abertura para ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Insuficiência.",

        33 => "Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Instalação de duto de exaustão e terminal, conforme ABNT NBR 13103.",

        34 => "Ventilação permanente, superior e/ou inferior, no local de instalação do aparelho a gás de circuito aberto, sem duto de exaustão ou duto de exaustão natural. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência",

        35 => "Ventilação permanente, superior e/ou inferior, no local de instalação do aparelho a gás de circuito aberto, sem duto de exaustão ou duto de exaustão natural. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ².Insuficiência",

        36 => "Abertura permanente do local de instalação de aparelho a gás de circuito aberto, com exaustão forçada. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência",

        37 => "Abertura permanente do local de instalação de aparelho a gás de circuito aberto, com exaustão forçada. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Insuficiência",

        38 => "Aparelho de cocção único em cozinha. Existência de ventilação com área total útil e permanente de no mínimo 800 cm². (Superior – 600 cm² (para uma área externa) e inferior – 200 cm²)",

        39 => "Abertura de ventilação permanente indireta através de duto. Comprimento do duto até 3 metros, 1 vez a área mínima da abertura superior.",

        40 => "  Abertura de ventilação permanente indireta através de duto. Comprimento do duto de 3 até 10 metros, 1,5 vez a área mínima da abertura superior.",

        41 => "Abertura de ventilação permanente indireta através de duto. Comprimento do duto acima de 10 metros, 2 vezes a área mínima da abertura superior.",

        42 => "  Aparelho permanente superior indireta em comunicação com o exterior. Seção livre mínima de 1600 cm²até o comprimento de 4 m.",

        43 => "Ventilação permanente superior e inferior de um ambiente contíguo com área livre, mínima, de 1,5 m², com somatório dos volumes igual ou maior que 6 m³. Existência de ventilação permanente superior e inferior conforme ABNT NBR 13103. Inexistência",

        44 => "Ventilação permanente superior e inferior de um ambiente contíguo com área livre, mínima, de 1,5 m², com somatório dos volumes igual ou maior que 6 m³. Existência de ventilação permanente superior e inferior conforme ABNT NBR 13103. Insuficiência",

        45 => "Ventilação permanente superior e inferior de um ambiente contíguo com área livre menor que 1,5 m², porém maior ou igual a 1,2 m² e potência total igual ou menor que 216 kcal/min. Ventilação com área total útil e permanente de no mínimo 600 cm² para uma área externa.",

        46 => "Condições físicas dos aparelhos a gás. Inexistência de peças e componentes soltos ou danificados.",

        47 => "Estanqueidade de gás nos aparelhos. Aparelhos a gás estanques, sem vazamento de gás.",

        48 => "Estanqueidade de água nos aparelhos. Aparelhos a gás estanques, sem vazamento de água.",

        49 => "Condições de chama do queimador do aparelho. Chama do aparelho estável, sem variação de cor azul (em potência máxima e mínima).",

        50 => "Sistema de acendimento automático do aparelho. Sistema automático funcionando conforme as orientações do fabricante.",

        51 => "Dispositivo de segurança do aparelho. Dispositivo de segurança funcionando conforme as orientações do fabricante.",

        52 => "Botões de regulagem e elementos de controle. Funcionamento conforme manual do fabricante.",
        //LIGAÇÕES DOS APARELHOS A GÁS
        53 => "Estanqueidade nas ligações da rede com o aparelho. Ligação do aparelho com a rede estanque.",

        54 => "Material utilizado na ligação do aparelho. Tubos flexíveis conforme ABNT NBR 14177, ABNT NBR 113419, ABNT NBR 14745 ou ABNT NBR 14955.",

        55 => "Condições físicas do tubo flexível. Inexistência de danos físicos nos tubos flexíveis.",

        56 => "Estanqueidade na válvula de bloqueio do aparelho. Válvula de bloqueio estanque.",

        57 => "  Identificação do ponto de gás do aquecedor. Identificado na cor amarela e na posição central.",

        58 => "Localização da válvula de bloqueio do aparelho. Válvula de bloqueio em local de fácil acesso, com ventilação adequada e protegidas, de forma a se evitar acionamento acidental.",

        59 => "Pontos de espera sem uso. Tamponamento adequado com bujão ou tampa rosqueada de metal e estanque dos pontos.",

        60 => "Condições dimensionais das chaminés. Diâmetro do duto igual ao diâmetro da saída da chaminé do aparelho a gás. ( Ou com adaptador conforme Abegas)",

        61 => "Instalação da chaminé individual. Chaminé com encaixes firmes nas conexões com os aparelhos a gás, conforme ABNT NBR 13103.",
        //INDIVIDUAL DE EXAUSTÃO NATURAL E FORÇADA
        62 => "Condições do duto de exaustão em aquecedor de circuito aberto de exaustão natural ou forçada. Existência de dutos de exaustão, conforme ABNT NBR 13103.",

        63 => "  Compatibilidade da chaminé com o diâmetro da saída do defletor. Inexistência de estrangulamentos do duto em relação ao defletor do aparelho.",

        64 => "Altura vertical do duto do aquecedor de circuito aberto de exaustão natural. Altura inicial maior ou igual a 35 cm.",

        65 => "Declividade do sistema de exaustão. Duto do sistema de exaustão ascendente.",

        66 => "  Conexão da chaminé com o duto de exaustão e o terminal em aquecedor de circuito aberto de exaustão natural ou forçada. Conexão firme do duto com o aparelho e o terminal.",

        67 => "Condições físicas dos dutos de exaustão. Inexistência de rachadura, rasgos ou emendas indevidas no duto de exaustão.",

        68 => "Terminal no exterior da edificação para aquecedor de circuito aberto de exaustão natural ou forçada. Existência do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.",

        69 => "Instalação do terminal de chaminé. Instalação levando em consideração limites de distância, conforme ABNT NBR 13103. (10 cm da face da edificação e 40 cm de raio)",

        70 => "Quantidade de curvas e desvios do duto de exaustão em aquecedor de circuito aberto de exaustão natural ou forçada. Inexistência de excessos de curvas e desvios no duto de exaustão, conforme ABNT NBR 13103, ou conforme manual do fabricante.",

        71 => "Situação do ambiente de percurso do sistema de exaustão. Ventilação superior e inferior de no mínimo 200 cm². (Ventilação da Chaminé passando por gesso ou a própria chaminé passando por mais de um cômodo).",

        72 => "Integridade do material do duto de exaustão. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.",

        73 => "Condições de adequação e robustez dos suportes do duto de exaustão. Suportes adequados ao material do duto de exaustão e bem posicionados.",

        74 => "Saída dos condutos de exaustão de produtos da combustão em locais não considerados áreas externas. Saídas de produtos da combustão para área externa ou locais considerados áreas externas.",

        75 => "Aparelho de cocção em cozinhas com potência nominal igual ou maior que 360kcal/min, sem coifa exaustora de forma a conduzir os produtos da combustão para fora do ambiente. Existência de coifa exaustora.",
        //COLETIVO DE EXAUSTÃO NATURAL E FORÇADA
        76 => "Material das chaminés coletivas. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.",

        77 => "  Condições dimensionais da chaminé coletiva. Área da chaminé coletiva maior ou igual à maior seção da chaminé individual conectada a ela, e altura mínima de 5m do defletor do último aquecedor até o terminal da chaminé.",

        78 => "  Abertura inferior da chaminé coletiva. Abertura inferior na chaminé de, no mínimo, 100 cm² para limpeza, com possibilidade de acesso e de uma ligação para saída da água de condensação para o esgoto, feita através de tubo resistente à corrosão.",

        79 => "Interligação da chaminé individual com a chaminé coletiva. Existência de, no máximo, duas chaminés individuais por pavimento conectado à chaminé coletiva.",

        80 => "Interligação da chaminé individual com a chaminé coletiva. Ligação da chaminé individual na chaminé coletiva no sentido ascendente.",

        81 => "Terminal de chaminé. Existência e o correto posicionamento do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.",

        82 => "Condições de obstrução do terminal para uso da chaminé coletiva. Chaminé desobstruída.",
        //CARACTERÍSTICAS HIGIÊNICAS DA COMBUSTÃO
        83 => "Medição de COn das combustões nos aquecedores de circuito aberto. Nota: nos casos de chaminés coletivas considerar o funcionamento simultâneo de pelo menos 60% dos aparelhos a ela conectados. Gases de 2ª família: COn de 500 µmol/mol. Gases de 3ª família: COn menor que 1000 µmol/mol.",

        84 => "Medição de CO no ambiente com aquecedores de circuito aberto instalados. Nota: no caso de chaminés coletivas, considerar o funcionamento de pelo menos 60% dos aparelhos a ela conectados. CO menor que 15 µmol/mol. CO maior que 15 µmol/mol e menor que 50 µmol/mol",

        85 => "Fogão e/ou outros aparelhos de cocção (capacidade acima de 360 kcal/min). CO menor que 15 µmol/mol. CO maior que 15 µmol/mol e menor que 50 µmol/mol",
        //RECOMENDAÇÕES
        86 => "  Medidas ao alto invertidas, ou seja, medida ao alto do cliente à esquerda do medidor.",

        87 => "Instalação energizada.",

        88 => "Rede de distibuição interna sem plaquetas de identificação e/ou inadequadas. As plaquetas de identificação da instalação devem estar localizadas a direita do medidor (na rede de distibuição interna), em local visível e ter marcação de forma indelével, informando a unidade a que pertence a instalação.",

        89 => "Abrigo de medidores sem porta, sem visor, sem fechadura e/ou cadeado.",

        90 => "Abrigo de medidor inacabados e/ou em mal estado de conservação.",

        91 => "Aquecedor instalado em área considerada externa sem chaminé para melhorar a eficiência da combustão."
    ];
    if($Transaction!=null):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}