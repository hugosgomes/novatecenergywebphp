<?php

class ItensOrcamento extends Orcamento{

	public $Id;
	private $IdOrcamento;
	private $Nome;
	private $Qtd;
	private $Valor;
	private $ValorTotal;
	private $NumeroParcelas;

	// MÉTODO DE LEITURA ID ITENS
	public function getId($Id){

		if(isset($Id)):
			return $this->Id  = $Id;
		endif;
	}
	// MÉTODO DE LEITURA NOME ITENS
	public function getNome($Nome){

		return $this->Nome = $Nome;
	}

	// MÉTODO DE LEITRUA IDORCAMENTO
	public function getIdOrcamento($IdOrcamento){

		return $this->IdOrcamento = $IdOrcamento;
	}

	// MÉTODO DE LEITURA QTD ITENS
	public function getQtd($Qtd){

		return $this->Qtd = $Qtd;
	}

	// MÉTODO DE LEITURA VALOR TOTAL CADA ITEM
	public function getValorTotal($Qtd,$Valor){

		$ValorTotal = $Qtd * $Valor;
        $ValorTotal = number_format($ValorTotal,2,',','.');

        return $this->ValorTotal = $ValorTotal;
	}

	// MÉTODO DE LEITRUA NÚMERO DE PARCELAS
	public function getNParcelas($NumeroParcelas){

		return $this->NumeroParcelas = $NumeroParcelas;
	}

	// MÉTODO DE LEITURA VALOR CADA PARCELA FORMATADO PARA MOEDA
	public function getValorParcelas($NumeroParcelas,$ValorOrcamento){

		if($NumeroParcelas == 0 || $NumeroParcelas == NULL):
            unset($NumeroParcelas);
            $NumeroParcelas = 1;

            $ValorParcelas = $ValorOrcamento / $NumeroParcelas;
	        $ValorParcelas = number_format($ValorParcelas,2,',','.');
        else:
	        $ValorParcelas = $ValorOrcamento / $NumeroParcelas;
	        $ValorParcelas = number_format($ValorParcelas,2,',','.');
        endif;

        return $this->ValorParcelas = $ValorParcelas;

	}


}