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

        $atendimentoFinalizado[$i]['IdOS'] = intval($body[$i]['idAtendimento']);
        $atendimentoFinalizado[$i]['idTecnico'] = intval($body[$i]['idTecnico']);
        $atendimentoFinalizado[$i]['Status'] = intval($body[$i]['Status']);
        $atendimentoFinalizado[$i]['NumManometro'] = ($body[$i]['NumManometro'] == "null" ? 0 : $body[$i]['NumManometro']);
        $atendimentoFinalizado[$i]['DataAtendimento'] = ($body[$i]['DataAtendimento'] == "null" ? NULL : $body[$i]['DataAtendimento']);
        $atendimentoFinalizado[$i]['PressaoInicial'] = ($body[$i]['PressaoInicial'] == "null" ? 0 : floatval($body[$i]['PressaoInicial']));
        $atendimentoFinalizado[$i]['PressaoFinal'] = ($body[$i]['PressaoFinal'] == "null" ? 0 : floatval($body[$i]['PressaoFinal']));
        $atendimentoFinalizado[$i]['TempoTeste'] = ($body[$i]['TempoTeste'] == "null" ? 0 : intval($body[$i]['TempoTeste']));
        $atendimentoFinalizado[$i]['StatusTeste'] = ($body[$i]['StatusTeste'] == "null" ? NULL : $body[$i]['StatusTeste']);
        $atendimentoFinalizado[$i]['NumOcorrencia'] = ($body[$i]['NumOcorrencia'] == "null" ? NULL : $body[$i]['NumOcorrencia']);
        $atendimentoFinalizado[$i]['Defeito'] = ($body[$i]['Defeito'] == "null" ? NULL : $body[$i]['Defeito']);
        $atendimentoFinalizado[$i]['Obs'] = ($body[$i]['obs'] == "null" ? NULL : $body[$i]['obs']);

        
        $Read->FullRead("SELECT Id FROM [60_Atendimentos] WHERE Id = :id","id={$atendimentoFinalizado[$i]['IdOS']}");
        if($Read->getResult()){
            $Create->ExeCreate("[60_Atendimentos]", $atendimentoFinalizado[$i]);
                if($Create->getResult()){
                    $Os['Status'] = $atendimentoFinalizado[$i]['Status'];
                    $Update->ExeUpdate("[60_OS]", $Os, "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
                    $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "sucess";
                    //enviaEmail();
                }else{
                     $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "error";
                }
        }else{
            $Update->ExeUpdate("[60_Atendimentos]", $atendimentoFinalizado[$i], "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
            if($Update->getResult()){
                $Os['Status'] = $atendimentoFinalizado[$i]['Status'];
                $Update->ExeUpdate("[60_OS]", $Os, "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
                $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "sucess";
                //enviaEmail();
            }else{
                 $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "error";
            }
        }      
    }
        
    return $response->withJson($Retorno);

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

function enviaEmail(){
    $Email = new Email;
    $MailContent = '
                <table width="550" style="font-family: "Trebuchet MS", sans-serif;">
                 <tr><td>
                  <font face="Trebuchet MS" size="3">
                   #mail_body#
                  </font>
                  <p style="font-size: 0.875em;">Teste de email
                  </p>
                  </td></tr>
                </table>
                <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';

    $ToCliente = "
                    <p style='font-size: 1.2em;'>Prezado(a) </p>
                    <p><b>Rodrigo</b></p>
                    <p>Este e-mail é refente ao atendimento realizado pela Novatec Energy</p>
                    <p><em>Atenciosamente</em></p>
            ";
            $MailMensage = str_replace("#mail_body#", $ToCliente, $MailContent);
            $Email->EnviarMontando("Recebemos sua mensagem", $MailMensage, "GNS", "rdias@novatecenergy.com.br", "Rodrigo", "reis756004@gmail.com");

            //SEND TO ADMIN
            $ToAdmin = "
                    <p>Teste</p>
                    <p style='font-size: 0.9em;'>
                        Novatec Energy
                    </p>
            ";
//            $Email = new Email;
            $CopyMensage = str_replace("#mail_body#", $ToAdmin, $MailContent);
            $Email->EnviarMontando("Nova mensagem do site", $CopyMensage, "Rodrigo", "reis756004@gmail.com", "GNS", "rdias@novatecenergy.com.br");

}