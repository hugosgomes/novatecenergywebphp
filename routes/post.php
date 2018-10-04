<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\UploadedFile;

//PASTA PADRÃO PARA ENVIO DAS IMAGENS
$container = $app->getContainer();
$container['upload_directory'] = "../uploads/images/".date("Y")."/".date("m");

$app->post('/atendimentos/finalizados/', function (Request $request, Response $response, array $args) {
    
    $body = $request->getParsedBody();
    $Create = new Create();
    $Retorno = null;
    /*var_dump($body[0]['IdAtendimento'], count($body));

    for ($i=0; $i < count($body); $i++) { 

        $atendimentoFinalizado[$i]['IdOS'] = $body[$i]['IdAtendimento'];
        $atendimentoFinalizado[$i]['idTecnico'] = $body[$i]['idTecnico'];
        $atendimentoFinalizado[$i]['Status'] = intval($body[$i]['Status']);
        $atendimentoFinalizado[$i]['DataAtendimento'] = $body[$i]['DataAtendimento'];
        $atendimentoFinalizado[$i]['NumManometro'] = $body[$i]['NumManometro'];
        $atendimentoFinalizado[$i]['PressaoInicial'] = $body[$i]['PressaoInicial'];
        $atendimentoFinalizado[$i]['PressaoFinal'] = $body[$i]['PressaoFinal'];
        $atendimentoFinalizado[$i]['TempoTeste'] = $body[$i]['TempoTeste'];
        $atendimentoFinalizado[$i]['StatusTeste'] = $body[$i]['StatusTeste'];
        $atendimentoFinalizado[$i]['NumOcorrencia'] = $body[$i]['NumOcorrencia'];
        $atendimentoFinalizado[$i]['Defeito'] = $body[$i]['Defeito'];
        $atendimentoFinalizado[$i]['Obs'] = $body[$i]['obs'];

        $Create->ExeCreate("[60_Atendimentos]", $atendimentoFinalizado[$i]);
        if($Create->getResult()){
            $Retorno[$i] = "Atendimento: ". $atendimentoFinalizado['IdOs'] . "salvo com sucesso!";
        }else{
            $Retorno[$i] = "Atendimento: ". $atendimentoFinalizado['IdOs'] . " ocorreu erro ao salvar! Contacte seu supervisor.";
        }
    }*/
        
    return $response->withJson($Retorno);

});

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

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

//ENVIO DE EMAIL TESTES
$app->post('/email/', function(Request $request, Response $response) {
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
                    <p><b>Obrigado por entrar em contato conosco.</b></p>
                    <p>Este e-mail é para informar que recebemos sua mensagem, e que estaremos respondendo o mais breve possível.</p>
                    <p><em>Atenciosamente</em></p>
            ";
            $MailMensage = str_replace("#mail_body#", $ToCliente, $MailContent);
            $Email->EnviarMontando("Recebemos sua mensagem", $MailMensage, "GNS", "rdias@novatecenergy.com.br", "Rodrigo", "reis756004@gmail.com");

            //SEND TO ADMIN
            $ToAdmin = "
                    <p>Teste</p>
                    <p style='font-size: 0.9em;'>
                        teste
                    </p>
            ";
//            $Email = new Email;
            $CopyMensage = str_replace("#mail_body#", $ToAdmin, $MailContent);
            $Email->EnviarMontando("Nova mensagem do site", $CopyMensage, "Rodrigo", "reis756004@gmail.com", "GNS", "rdias@novatecenergy.com.br");

            var_dump($Email->getResult(), $Email->getError());

return $response->withJson($Email->getResult());




/* Inicia a classe PHPMailer
//$Email = new PHPMailer(true);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$Email->IsSMTP(); // Define que a mensagem será SMTP
 
try {
     $Email->Host = 'email-ssl.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     $Email->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     $Email->Port       = 587; //  Usar 587 porta SMTP
     $Email->Username = 'rdias@novatecenergy.com.br'; // Usuário do servidor SMTP (endereço de email)
     $Email->Password = 'G@G@040788'; // Senha do servidor SMTP (senha do email usado)
 
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
     $Email->SetFrom('rdias@novatecenergy.com.br', 'Rodrigo'); //Seu e-mail
     $Email->AddReplyTo('rdias@novatecenergy.com.br', 'Rodrigo'); //Seu e-mail
     $Email->Subject = 'Teste de email';//Assunto do e-mail
 
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $Email->AddAddress('reis756004@gmail.com', 'Teste Locaweb');
 
     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$Email->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
     //$Email->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
     //$Email->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
 
 
     //Define o corpo do email
     $Email->MsgHTML('corpo do email'); 
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$Email->MsgHTML(file_get_contents('arquivo.html'));
 
     $Email->Send();
     echo "Mensagem enviada com sucesso</p>\n";
 
    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}*/
    
});
