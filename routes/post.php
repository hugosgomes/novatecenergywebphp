<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\UploadedFile;


$app->post('/atendimentos/finalizados/', function (Request $request, Response $response, array $args) {
    $Create = new Create();
    $Update = new Update();
    $Read = new Read();
    
    $body = $request->getParsedBody();  

    $Retorno = null;

    for ($i=0; $i < count($body); $i++) { 

        //TRATAMENTO DOS DADOS DE ATENDIMENTO
        $atendimentoFinalizado[$i]['IdOS'] = intval($body[$i]['idAtendimento']);
        $atendimentoFinalizado[$i]['idTecnico'] = intval($body[$i]['idTecnico']);
        $atendimentoFinalizado[$i]['Status'] = intval($body[$i]['Status']);
        $atendimentoFinalizado[$i]['NumManometro'] = ($body[$i]['NumManometro'] == "null" ? 0 : $body[$i]['NumManometro']);
        $atendimentoFinalizado[$i]['DataAtendimento'] = $body[$i]['DataAtendimento'];
        $atendimentoFinalizado[$i]['PressaoInicial'] = ($body[$i]['PressaoInicial'] == "null" ? 0 : floatval($body[$i]['PressaoInicial']));
        $atendimentoFinalizado[$i]['PressaoFinal'] = ($body[$i]['PressaoFinal'] == "null" ? 0 : floatval($body[$i]['PressaoFinal']));
        $atendimentoFinalizado[$i]['TempoTeste'] = ($body[$i]['TempoTeste'] == "null" ? 0 : intval($body[$i]['TempoTeste']));
        $atendimentoFinalizado[$i]['StatusTeste'] = ($body[$i]['StatusTeste'] == "null" ? NULL : $body[$i]['StatusTeste']);
        $atendimentoFinalizado[$i]['NumOcorrencia'] = ($body[$i]['NumOcorrencia'] == "null" || $body[$i]['statusVazamento'] == "" ? NULL : $body[$i]['NumOcorrencia']);
        $atendimentoFinalizado[$i]['Defeito'] = ($body[$i]['statusVazamento'] == "null" || $body[$i]['statusVazamento'] == "" ? NULL : $body[$i]['statusVazamento']);
        $atendimentoFinalizado[$i]['Obs'] = ($body[$i]['obs'] == "null" || $body[$i]['obs'] == ""? NULL : $body[$i]['obs']);
        $atendimentoFinalizado[$i]['NomeContato'] = ($body[$i]['nomeContato'] == "null" || $body[$i]['nomeContato'] == ""? NULL : $body[$i]['nomeContato']);
        $atendimentoFinalizado[$i]['TelefoneContato'] = ($body[$i]['telefoneContato'] == "null" || $body[$i]['telefoneContato'] == ""? NULL : $body[$i]['telefoneContato']);
        $Read->FullRead("SELECT Id FROM [60_Atendimentos] WHERE IdOS = :id","id={$atendimentoFinalizado[$i]['IdOS']}");
        if(!$Read->getResult()){
            $Create->ExeCreate("[60_Atendimentos]", $atendimentoFinalizado[$i]);
                if($Create->getResult()){
                    $Os['Status'] = $atendimentoFinalizado[$i]['Status'];
                    //$Update->ExeUpdate("[60_OS]", $Os, "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
                    $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "sucess1";
                    //enviaEmail("2-4546187", "Rodrigo", "reis756004@gmail.com");
                }else{
                     $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "error";
                }
        }else{
            $Update->ExeUpdate("[60_Atendimentos]", $atendimentoFinalizado[$i], "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
            if($Update->getResult()){
                $Os['Status'] = $atendimentoFinalizado[$i]['Status'];
                //$Update->ExeUpdate("[60_OS]", $Os, "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
                $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "sucess2";
                //enviaEmail("2-4546187", "Rodrigo", "reis756004@gmail.com");
            }else{
                 $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "error";
            }
        }   

        //TRATAMENTO DO ORÇAMENTO, PEÇAS E SERVIÇOS
        if ($body[$i]['orcamento']['item'] != NULL){
            $orcamento[$i]['IdOS'] = intval($body[$i]['orcamento']['idAtendimento']);
            $orcamento[$i]['DataEnt'] = $body[$i]['orcamento']['DataEnt'];
            $orcamento[$i]['TecnicoEnt'] = intval($body[$i]['orcamento']['idTecnico']);
            $orcamento[$i]['FormaPagamento'] = intval($body[$i]['orcamento']['FormaPagamento']);
            $orcamento[$i]['NumParcelas'] = intval($body[$i]['orcamento']['NumParcelas']);

            if($body[$i]['orcamento']['Status'] == "null" || $body[$i]['orcamento']['Status'] == "Não"){
                $orcamento[$i]['Status'] = 3;
            }else{
                $orcamento[$i]['Status'] = 1;
            }
            $Read->FullRead("SELECT ID, Status FROM [60_Orcamentos] WHERE IdOS = :idos AND Status = :st","idos={$orcamento[$i]['IdOS']}&st={$orcamento[$i]['Status']}");
            if(!$Read->getResult()){
                $Create->ExeCreate("[60_Orcamentos]", $orcamento[$i]);
                $IdOrcamento = $Create->getResult();
                for($o=0; $o < count($body[$i]['orcamento']['item']); $o++){
                    if($body[$i]['orcamento']['item'][$o]['tipo'] == "1" && $orcamento[$i]['Status'] == intval($body[$i]['orcamento']['item'][$o]['aprovado'])){
                        $ItemServicos[$o]['IDOrcamento'] = $IdOrcamento;
                        $ItemServicos[$o]['ID_Pecas'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                        $ItemServicos[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                        $ItemServicos[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                        $Create->ExeCreate("[60_OS_PecasAPP]", $ItemServicos[$o]);
                    }else{                       
                        $ItemPecas[$o]['IDOrcamento'] = $IdOrcamento;
                        $ItemPecas[$o]['ID_servico'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                        $ItemPecas[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                        $ItemPecas[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                        $Create->ExeCreate("[60_OS_ServicosAPP]", $ItemPecas[$o]);
                    }                
                }
            }else{
                $IdOrcamento = $Read->getResult()[0]['ID'];
                for($o=0; $o < count($body[$i]['orcamento']['item']); $o++){
                    if($body[$i]['orcamento']['item'][$o]['tipo'] == "1" && $Read->getResult()[0]['Status'] == intval($body[$i]['orcamento']['item'][$o]['aprovado'])){
                        $ItemPecas[$o]['IDOrcamento'] = $IdOrcamento;
                        $ItemPecas[$o]['ID_Pecas'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                        $ItemPecas[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                        $ItemPecas[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                        $Create->ExeCreate("[60_OS_PecasAPP]", $ItemPecas[$o]);
                    }else{                       
                        $ItemServicos[$o]['IDOrcamento'] = $IdOrcamento;
                        $ItemServicos[$o]['ID_servico'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                        $ItemServicos[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                        $ItemServicos[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                        $Create->ExeCreate("[60_OS_ServicosAPP]", $ItemServicos[$o]);
                    }                
                }
            }          
        }      
    }
        
    //return $response->withJson($Retorno);
    return $response->withJson($body);

});

//PASTA PADRÃO PARA ENVIO DAS IMAGENS
$container = $app->getContainer();
$container['upload_directory'] = "../uploads/images/".date("Y")."/".date("m");

//POST DE ENVIO DE IMAGENS E CADASTRO NO BANCO
$app->post('/atendimentos/fotos/', function(Request $request, Response $response) {

    $parsedBody = $request->getParsedBody();
    $files = $request->getUploadedFiles();
    $retorno['msg'] = true;
      
    $uploadedFile = $files['image'];
    $directory = $this->get('upload_directory');
    $uploadedFiles = $request->getUploadedFiles();

    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['image'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

        //UPLOAD DA IMAGEM
        $filename = moveUploadedFile($directory, $uploadedFile, $parsedBody['idAtendimento'], $parsedBody['tipo']);

        //CADASTRO DO CAMINHO DA IMAGEM NO BANCO DE DADOS
        $Fotos['OS'] =  $parsedBody['idAtendimento'];
        $Fotos['Arquivo'] = "images/".date("Y")."/".date("m")."/". $filename;

        switch ($parsedBody['tipo']) {
            case 'Medidor':
                $Fotos['Tipo'] = 1;
                break;
            case 'Situação Serviço':
                $Fotos['Tipo'] = 2;
                break;
            case 'Defeitos':
                $Fotos['Tipo'] = 3;
                break;
            case 'Assinatura':
                $Fotos['Tipo'] = 4;
                break;
            case 'Local':
                $Fotos['Tipo'] = 5;
                break;
        }
        $Create = new Create;
        $Create->ExeCreate("[60_OS_Fotos]", $Fotos);

        //RETORNO AO CLIENT
        $retorno['msg'] = true;
        return $response->withJson($retorno);
    }else{
        $retorno['msg'] = false;
        return $response->withJson($retorno);
    }



});

/**
 * Moves the uploaded file to the upload directory and assigns it a unique name
 * to avoid overwriting an existing uploaded file.
 *
 * @param string $directory directory to which the file is moved
 * @param UploadedFile $uploaded file uploaded file to move
 * @return string filename of moved file
 */
function moveUploadedFile($directory, UploadedFile $uploadedFile, $idAtendimento, $tipo)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $filename = sprintf($idAtendimento . "_" . $tipo . "_" . time().".".$extension);

    $uploadedFile->moveTo($directory . "/" . $filename);

    return $filename;
}

function enviaEmail($NumOs, $Cliente, $EmailCliente){
    $Email = new Email;
    $MailContent = '<table width="550" style="font-family: "Trebuchet MS", sans-serif;">
                        <tr><td>
                            <font face="Trebuchet MS" size="3">#mail_body#</font>
                        </td></tr>
                    </table>
                    <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';

    $ToCliente = "  <p style='font-size: 1.2em;'>Prezado(a) {$Cliente}</p>
                    <p>Este e-mail é refente ao atendimento realizado pela Novatec Energy</p>
                    <p><em>Atenciosamente,</em></p>
                    <p><em>Novatec Energy</em></p>
                    <p><em>(21)3046-8004</em></p>";

    $MailMensage = str_replace("#mail_body#", $ToCliente, $MailContent);
    
    $Email->EnviarMontando("Comprovante de atendimento Novatec Energy. OS: ".$NumOs." ", $MailMensage, "Novatec Energy", "gns@novatecenergy.com.br", $Cliente, $EmailCliente);

    $ToAdmin = "<p>Este e-mail é uma cópia de envio ao cliente.</p>
                <p>Cliente: {$Cliente}</p>
                <p>OS: {$NumOs}</p>
                <p>E-mail: {$EmailCliente}</p>
                <p style='font-size: 0.9em;'>Sistema GNS App</p>";

    $CopyMensage = str_replace("#mail_body#", $ToAdmin, $MailContent);

    $Email->EnviarMontando("Comprovante de envio. OS: ".$NumOs." ", $CopyMensage, $Cliente, $EmailCliente, "Novatec Energy", "gns@novatecenergy.com.br");
}