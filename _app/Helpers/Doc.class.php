<?php

class Doc{

	private $variavelSwitch;


	public function exibir($a){

		$array = [];

		switch ($a) {

			case "Certificado Empresarial de Informação de Riscos Laborais - Distribuição de Gás":
				$nomeT = "certificado-empresarial-de-informacao-de-riscos-laborais-distribuicao-de-gas";
				$valor = 1;
				$array = [ $nomeT, $valor ];
			break;

			case "Certificado Empresarial de Informação de Riscos Laborais - Recursos e Serviços":
			$nomeT = "cert-inf-riscos-recursos-e-servicos";
			$valor = 2;
			$array = [ $nomeT, $valor ];
			break;

			case "Entrega de EPIs":
			$valor = 3;
			$nomeT = "entrega-de-epis";
			$array = [ $nomeT, $valor ];
			break;

			case "Certificado Empresarial de Formação":
			$valor = 4;
			$nomeT = "certificado-empresarial-de-formacao";
			$array = [ $nomeT, $valor ];
			break;

			case "Carteira Nacional de Habilitação":
			$valor = 5;
			$nomeT = "carteira-nacional-de-habilitacao";
			$array = [ $nomeT, $valor ];
			break;

			case "Carteira de Trabalho ASSINADA, Inclusive página que consta o cargo/função":
			$valor = 6;
			$nomeT = "carteira-de-trabalho-assinada-inclusive-pagina-que-consta-o-cargo-funcao";
			$array = [ $nomeT, $valor ];
			break;

			case "Termo de Rescisão do Contrato de Trabalho (TRCT)":
			$valor = 7;
			$nomeT = "termo-de-rescisao-do-contrato-de-trabalho-trct";
			$array = [ $nomeT, $valor ];
			break;

			case "Guia de Recolhimento da Receita Federal":
			$valor = 8;
			$nomeT = "guia-de-recolhimento-da-receita-federal";
			$array = [ $nomeT, $valor ];
			break;

			case "Folha de Ponto assinada pelo empregado":
			$valor = 9;
			$nomeT = "folha-de-ponto-assinada-pelo-empregado";
			$array = [ $nomeT, $valor ];
			break;

			case "Aviso de Férias assinado e comprovante de pagamento do terço constitucional":
			$valor = 10;
			$nomeT = "aviso-de-ferias-assinado-e-comprovante-de-pagamento-do-terco-constitucional";
			$array = [ $nomeT, $valor ];
			break;

			case "Contrato de Trabalho":
			$valor = 11;
			$nomeT = "contrato-de-trabalho";
			$array = [ $nomeT, $valor ];
			break;

			case "Atestado de Saúde Ocupacional - ASO (admissional, periódico e demissional)":
			$valor = 12;
			$nomeT = "atestado-de-saude-ocupacional-aso-admissional-periodico-e-demissional";
			$array = [ $nomeT, $valor ];
			break;

			case "Registro Técnico do Responsável Técnico da empresa - Pessoa Física":
			$nomeT = "registro-tecnico-do-responsavel-tecnico-da-empresa-pessoa-fisica";
			$valor = 13;
			$array = [ $nomeT, $valor ];
			break;

			case "Certificação de JO":
			$valor = 14;
			$nomeT = "certificacao-de-jo";
			$array = [ $nomeT, $valor ];
			break;

			case "Certificação de Desenhista de campo":
			$valor = 15;
			$nomeT = "certificacao-de-desenhista-de-campo";
			$array = [ $nomeT, $valor ];
			break;

			case "Certificação/Qualificação de Soldadores de Aço":
			$valor = 16;
			$nomeT = "certificacao-qualificacao-de-soldadores-de-aco";
			$array = [ $nomeT, $valor ];
			break;

			case "Certificação de Inspetores de Solda de Aço":
			$valor = 17;
			$nomeT = "certificacao-de-inspetores-de-solda-de-aco";
			$array = [ $nomeT, $valor ];
			break;

			case "Certificação de Soldadores de PE":
			$valor = 18;
			$nomeT = "certificacao-de-soldadores-de-pe";
			$array = [ $nomeT, $valor ];
			break;

			case "Certificação de Inspetores de Alta":
			$valor = 19;
			$nomeT = "certificacao-de-inspetores-de-alta";
			$array = [ $nomeT, $valor ];
			break;

			case "Navegador de MND":
			$valor = 20;
			$nomeT = "navegador-de-mnd";
			$array = [ $nomeT, $valor ];
			break;

			case "Operador MND":
			$valor = 21;
			$nomeT = "operador-mnd";
			$array = [ $nomeT, $valor ];
			break;

			case "Título de Certificado de Operador de Medidor":
			$valor = 22;
			$nomeT = "titulo-de-certificado-de-operador-de-medidor";
			$array = [ $nomeT, $valor ];
			break;

			case "Titulo de Certificado de Inspetor de Vistoria e Alta":
			$valor = 23;
			$nomeT = "titulo-de-certificado-de-inspetor-de-vistoria-e-alta";
			$array = [ $nomeT, $valor ];
			break;

			case "Título de Certificado de Instalador Predial de Tubulações de gás":
			$valor = 24;
			$nomeT = "titulo-de-certificado-de-instalador-predial-de-tubulacoes-de-gas";
			$array = [ $nomeT, $valor ];
			break;

			case "Trabalhos em Altura":
			$valor = 25;
			$nomeT = "trabalhos-em-altura";
			$array = [ $nomeT, $valor ];
			break;

			case "Registro de capacitação específica para vigia e trabalhadores de entrada em espaço confinado":
			$valor = 26;
			$nomeT = "registro-de-capacitacao-especifica-para-vigia-e-trabalhadores-de-entrada-em-espaco-confinado";
			$array = [ $nomeT, $valor ];
			break;

			case "Registro de capacitação específica para Supervisores de Entrada em espaços confinados":
			$valor = 27;
			$nomeT = "registro-de-capacitacao-especifica-para-supervisores-de-entrada-em-espacos-confinados";
			$array = [ $nomeT, $valor ];
			break;

			case "Seguridade na Manipulação de Produtos Químicos":
			$valor = 28;
			$nomeT = "seguridade-na-manipulacao-de-produtos-quimicos";
			$array = [ $nomeT, $valor ];
			break;

			case "Motorista de Transporte de Produtos Perigosos":
			$valor = 29;
			$nomeT = "motorista-de-transporte-de-produtos-perigosos";
			$array = [ $nomeT, $valor ];
			break;

			case "Registro de treinamento dos colaboradores em Prevenção contra incêndios":
			$valor = 30;
			$nomeT = "registro-de-treinamento-dos-colaboradores-em-prevencao-contra-incendios";
			$array = [ $nomeT, $valor ];
			break;

			case "Oficina de Liderança de Segurança e Saúde":
			$valor = 31;
			$nomeT = "oficina-de-lideranca-de-seguranca-e-saude";
			$array = [ $nomeT, $valor ];
			break;

		}

		return $this->variavelSwitch = $array;
	}

}