<?php

class Orcamento{
	protected $Id;
	protected $IdOs;
	protected $Status;
	protected $Valor;
	protected $Obs;
	protected $FormaPgt;

	// TRANSFORMA VALORES VINDOS DO BANCO EM NOMES DE STATUS
	public function getStatus($Status){

		if($Status == 1){
        	$Status = "APROVADO";
        }else if($Status == 2){
        	$Status = "EXECUTADO";
        }else if($Status == 3){
        	$Status = "RECUSADO";
        }else if($Status == 4){
        	$Status = "RECUPERADO";
        }

        return $this->Status = $Status;
	}

	// TRANSFORMA NOMES DE STATUS EM VALORES PARA INSERIR NO BANCO
	public function setStatus($Status){

		if($Status == "APROVADO"){
        	$Status = 1;
        }else if($Status == "EXECUTADO"){
        	$Status = 2;
        }else if($Status == "RECUSADO"){
        	$Status = 3;
        }else if($Status == "RECUPERADO"){
        	$Status = 4;
        }
        return $this->Status = $Status;
	}

	// FORMATA O VALOR DO ORÇAMENTO PARA REAL

	public function getValor($Valor){

		$Valor = number_format($Valor,2,',','.');

		return $this->Valor = $Valor;
	}

	// REMOVER VIRGULA DO VALOR

	public function setValor($Valor){

		$Valor = str_replace("." , "" , $Valor); // Primeiro tira os pontos
        $Valor = str_replace("," , "." , $Valor); // Substitui a vírgula pelo ponto

        return $this->Valor = $Valor;
	}

	// MÉTODO PARA LISTAR FORMA DE PAGAMENTO
	function getFormaPagamento(){

	    $FormaPgt = [

	        0 => 'CARTÃO DE CRÉDITO',
	        1 => 'DEPÓSITO/TRANSFERÊNCIA',
	        2 => 'Á VISTA'
	    ];

	    return $this->FormaPgt = $FormaPgt;
	   
	}


}