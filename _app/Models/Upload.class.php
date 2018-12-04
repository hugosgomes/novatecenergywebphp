<?php

/**
 * Upload.class [ HELPER ]
 * Reponsável por executar upload de imagens, arquivos e mídias no sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class Upload {

    private $File;
    private $Name;
    private $Ext;
    private $Send;

    /** IMAGE UPLOAD */
    private $Width;
    private $Image;

    /** RESULTSET */
    private $Result;
    private $Error;

    /** DIRETÓRIOS */
    private $Folder;
    private static $BaseDir;

    /** TESTE */

    //public $d;

    /**
     * Verifica e cria o diretório padrão de uploads no sistema!<br>
     * <b>../uploads/</b>
     */
    function __construct($BaseDir = null) {
        self::$BaseDir = ( (string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
    endif;
}

    /*public function getD(){
        return $this->docRH;
    }
    public function setD($d){
        $this->d = $d;
    }*/

    /**
     * <b>Enviar Imagem:</b> Basta envelopar um $_FILES de uma imagem e caso queira um nome e uma largura personalizada.
     * Caso não informe a largura será 1024!
     * @param FILES $Image = Enviar envelope de $_FILES (JPG ou PNG)
     * @param STRING $Name = Nome da imagem ( ou do artigo )
     * @param INT $Width = Largura da imagem ( 1024 padrão )
     * @param STRING $Folder = Pasta personalizada
     */

    public function UploadRH(array $Image, $Name = null, $Folder = null) {
        $this->File = $Image;
        $this->Ext = mb_strtolower(strrchr($this->File["name"], "."));
        $this->Name = strtolower((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')) );
        $this->Folder = ( (string) $Folder ? $Folder : 'images' );

        $FileAcceptImage = [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'application/pdf'
        ];

        //VALID EXTENSION FOR IMAGES
        $Extension = ['.jpg', '.jpeg', '.png', '.pdf'];

        if (!in_array($this->Ext, $Extension) || !in_array($this->File["type"], $FileAcceptImage)):
            $this->Result = false;
        $this->Error = "Tipo de imagem não aceito. Extenções aceitas: " . mb_strtoupper(str_replace(".", "", implode(", ", $Extension))) . "!";
    else:
        $this->CheckFolderRH($this->Folder);
        $this->setFileNameRH();
        $this->UploadImageRH();
    endif;
}
/****************SPACE****************/

public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
    $this->File = $Image;
    $this->Ext = mb_strtolower(strrchr($this->File["name"], "."));
    $this->Name = strtolower((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')) );
    $this->Width = ( (int) $Width ? $Width : IMAGE_W );
    $this->Folder = ( (string) $Folder ? $Folder : 'images' );

        //VALID EXTENSION FOR IMAGES
    $Extension = ['.jpg', '.jpeg', '.png'];

    if (!in_array($this->Ext, $Extension) || !strstr($this->File["type"], 'image/')):
        $this->Result = false;
    $this->Error = "Tipo de imagem não aceito. Extenções aceitas: " . mb_strtoupper(str_replace(".", "", implode(", ", $Extension))) . "!";
else:
    $this->CheckFolder($this->Folder);
    $this->setFileName();
    $this->UploadImage();
endif;
}

    /**
     * <b>Enviar Arquivo:</b> Basta envelopar um $_FILES de um arquivo e caso queira um nome e um tamanho personalizado.
     * Caso não informe o tamanho será 2mb!
     * @param FILES $File = Enviar envelope de $_FILES (PDF ou DOCX)
     * @param STRING $Name = Nome do arquivo ( ou do artigo )
     * @param STRING $Folder = Pasta personalizada
     * @param STRING $MaxFileSize = Tamanho máximo do arquivo (50mb)
     */
    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Ext = mb_strtolower(strrchr($this->File["name"], "."));
        $this->Name = strtolower((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')) );
        $this->Folder = ( (string) $Folder ? $Folder : 'files' );
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 200 );

        $FileAccept = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/pdf',
            'application/x-rar-compressed',
            'application/x-zip-compressed',
            'application/octet-stream',
            'application/zip', 
            'text/xml'
        ];

        //VALID EXTENSION FOR FILES
        $Extension = ['.pdf', '.doc', '.docx', '.rar', '.zip', '.xml'];

        if (!in_array($this->Ext, $Extension) || !in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
        $this->Error = "Tipo de arquivo não aceito. Extenções aceitas: " . mb_strtoupper(str_replace(".", "", implode(", ", $Extension))) . "!";
    elseif ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
        $this->Result = false;
        $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
    else:
        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->MoveFile();
    endif;
}

    /**
     * <b>Enviar Mídia:</b> Basta envelopar um $_FILES de uma mídia e caso queira um nome e um tamanho personalizado.
     * Caso não informe o tamanho será 40mb!
     * @param FILES $Media = Enviar envelope de $_FILES (MP3 ou MP4)
     * @param STRING $Name = Nome do arquivo ( ou do artigo )
     * @param STRING $Folder = Pasta personalizada
     * @param STRING $MaxFileSize = Tamanho máximo do arquivo (50mb)
     */
    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Ext = mb_strtolower(strrchr($this->File["name"], "."));
        $this->Name = strtolower((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')) );
        $this->Folder = ( (string) $Folder ? $Folder : 'medias' );
        $MaxFileSize = ( (int) $MaxFileSize ? $MaxFileSize : 50 );

        $FileAccept = [
            'audio/mp3',
            'video/mp4'
        ];

        //VALID EXTENSION FOR MEDIAS
        $Extension = ['.mp3', '.mp4'];

        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb";
        elseif (!in_array($this->Ext, $Extension) || !in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
        $this->Error = "Tipo de arquivo não aceito. Extenções aceitas: " . mb_strtoupper(str_replace(".", "", implode(", ", $Extension))) . "!";
    else:
        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->MoveFile();
    endif;
}

    /**
     * <b>Verificar Upload:</b> Executando um getResult é possível verificar se o Upload foi executado ou não. Retorna
     * uma string com o caminho e nome do arquivo ou FALSE.
     * @return STRING  = Caminho e Nome do arquivo ou False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um code, um title, um erro e um tipo.
     * @return ARRAY $Error = Array associativo com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    private function CheckFolderRH($Folder) {

        list($Achilles, $nome, $tipo) = explode('/', $Folder);
        $this->CreateFolder("{$Achilles}");
        $this->CreateFolder("{$Achilles}/{$nome}");
        $this->CreateFolder("{$Achilles}/{$nome}/{$tipo}/");
        $this->Send = "{$Achilles}/{$nome}/{$tipo}/";
    }

    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    private function CheckFolder($Folder) {

        $SubFolder = explode('/', $Folder);
        if(count($SubFolder) > 1):
            foreach($SubFolder as $sub):
                $this->CreateFolder("{$sub}");
            endforeach;
        endif;
        
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }

    //Verifica e cria o diretório base!
    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
    endif;
}

private function setFileNameRH() {
  $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
  if (file_exists(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".pdf")):
    unlink(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".pdf");
elseif (file_exists(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".jpg")):
    unlink(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".jpg");
elseif (file_exists(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".jpeg")):
    unlink(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".jpeg");
elseif (file_exists(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".png")):
    unlink(self::$BaseDir . $this->Send . Check::Name($this->Name) . ".png");
endif;
$this->Name = strtolower($FileName);
          //unlink($Image);
}

    //Verifica e monta o nome dos arquivos tratando a string!
private function setFileName() {
    $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
    if (file_exists(self::$BaseDir . $this->Send . $FileName)):
        $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');
    endif;
    $this->Name = strtolower($FileName);
}

    //Realiza o upload de imagens redimensionando a mesma!
private function UploadImage() {
    switch ($this->File['type']):
        case 'image/jpg':
        case 'image/jpeg':
        case 'image/pjpeg':
        $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
        break;
        case 'image/png':
        case 'image/x-png':
        $this->Image = imagecreatefrompng($this->File['tmp_name']);
        break;
        default :
        $this->Image = null;
        break;
    endswitch;

    if (!$this->Image):
        $this->Result = false;
        $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
    else:
        $x = imagesx($this->Image);
        $y = imagesy($this->Image);
        $ImageX = ( $this->Width < $x ? $this->Width : $x );
        $ImageH = ($ImageX * $y) / $x;

        $NewImage = imagecreatetruecolor($ImageX, $ImageH);
        imagealphablending($NewImage, false);
        imagesavealpha($NewImage, true);
        imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
            imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
            break;
            case 'image/png':
            case 'image/x-png':
            imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
            break;
        endswitch;

        if (!$NewImage):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
        else:
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        endif;

        imagedestroy($this->Image);
        imagedestroy($NewImage);
    endif;
}

    //Envia arquivos e mídias
private function MoveFile() {
    if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
        $this->Result = $this->Send . $this->Name;
        $this->Error = null;
    else:
        $this->Result = false;
        $this->Error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
    endif;
}

private function UploadImageRH() {
    if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
        $this->Result = $this->Send . $this->Name;
        $this->Error = null;
    else:
        $this->Result = false;
        $this->Error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
    endif;
}

}
