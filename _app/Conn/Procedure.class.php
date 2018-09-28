<?php

/**
 * <b>Read.class:</b>
 * Classe responsável por leituras genéricas no banco de dados!
 * 
 * @copyright (c) 2018, Robson V. Leite UPINSIDE TECNOLOGIA
 * @license http://pro.workcontrol.com.br?p=6533 Rodrigo Reis
 */
class Procedure {

        /** @var PDOStatement */
    private $Procedure;

    /** @var PDO */
    private $Conn;
    
    /* Obtém conexão do banco de dados Singleton */
    public function __construct() {
        $this->Conn = Conn::getConn();
    }

    
    

    public function getResult() {
        //return $this->Result;
    }

    
    public function getRowCount() {
        return $this->Procedure->rowCount();
    }

    public function FullRead($Query) {
        /*$this->Select = (string) $Query;        
        $this->Execute();*/

        $returnVariable = -1;
        $this->Procedure = $this->Conn->prepare($Query);
        //$this->Procedure->bindParam(1, $returnVariable, PDO::PARAM_STR, 100); 
        $this->Procedure->execute();
        $return = $this->Procedure->fetchAll(PDO::FETCH_ASSOC);
        return $return;

        
    }

    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->Execute();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    //Obtém o PDO e Prepara a query
    private function Connect() {
        
        $this->Procedure = $this->Conn->prepare($this->Select);
        $this->Procedure->setFetchMode(PDO::FETCH_ASSOC);
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSyntax() {
        if ($this->Places):
            foreach ($this->Places as $Vinculo => $Valor):
                if ($Vinculo == 'limit' || $Vinculo == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Procedure->bindValue(":{$Vinculo}", $Valor, ( is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            //$this->getSyntax();
            $this->Procedure->execute();
            $this->Result = $this->Procedure->fetchAll();
        } catch (PDOException $e) {
            $this->Result = null;
            Erro("<b>Erro ao Ler:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
