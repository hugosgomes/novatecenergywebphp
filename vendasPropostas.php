<?php include('_app/Config.inc.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>
<body>
    <!-- 
CANAL SLACK : alinhamento_diretoria
https://hooks.slack.com/services/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

    -->
    <!-- CODIGO ADD LINHAS -->
    <?php  $Read->FullRead("SELECT ROW_NUMBER() over(order by DATAHORA desc) as Id, CONVERT(varchar, DATAHORA, 103) AS DataVenda, 
        replace([00_Delegação].DELEGACAO,'FLUMINENSE ','') AS Delegacao, TIPO.ITEM AS Servico,
        PROD.PRODUTO as Produto, DATEDIFF(day, DATAHORA, Getdate()) -1 as Dias, count(PROD.PRODUTO) as Total
        FROM [11_CondVisitas]  INNER JOIN Funcionários
        ON [11_CondVisitas].IDUSUARIO = Funcionários.ID INNER JOIN [11_CondEstrutura]
        ON [11_CondVisitas].IDCONDESTRUTURA = [11_CondEstrutura].ID INNER JOIN [11_Condominios]
        ON [11_CondEstrutura].IDCOND = [11_Condominios].ID INNER JOIN [00_Logradouro]
        ON [11_Condominios].LOGRADOURO = [00_Logradouro].ID INNER JOIN [00_Bairro]
        ON [00_Logradouro].BAIRRO = [00_Bairro].ID INNER JOIN [00_Areas]
        ON [00_Bairro].AREA = [00_Areas].ID INNER JOIN [00_Delegação]
        ON [00_Areas].DELEGACAO = [00_Delegação].ID inner join [00_TabelasItems] TIPO
        ON [11_CondVisitas].TIPO = TIPO.ID inner join [00_TipoLog2]
        ON [00_Logradouro].TIPO2 = [00_TipoLog2].ID LEFT JOIN [10_PropostaRecebimento] PROPOSTA
        ON [11_CondVisitas].ID = PROPOSTA.IDVISITA INNER JOIN [00_Produtos] PROD
        ON [11_Condominios].PRODUTO = PROD.ID
        WHERE DATAHORA between ('1/06/2018 00:00:00') 
        and (Getdate()-2) and
        (VENDA = 87) AND 
        (MOTIVOVISITA = 113) AND
        ([11_CondVisitas].STATUS <> 93) and
        PROPOSTA.STATUS IS NULL
        group by  DATAHORA, [00_Delegação].DELEGACAO, TIPO.ITEM, PROD.PRODUTO
        ORDER BY DATAHORA DESC
        ", " ");?>
                
        <?php 
        $t = 0;
        foreach ($Read->getResult() as $teste) {
            extract($teste); 
            $t = $t + $Total;
        }
        $totalLinhas = count($Read->getResult());
        ?>
        <script type="text/javascript">

    // TOTAL DE VENDAS COM PROPOSTAS NÃO RECEBIDAS
    var url = "https://hooks.slack.com/services/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";
    var totalLinhas = <?php echo  $totalLinhas; ?>;
    var totalProp = <?php echo  $t;?>;
    var titulo = "*Vendas com propostas não recebidas* ("+totalProp+")";
    var payload =    
    {
        "text": "*Vendas com propostas não recebidas* ("+totalProp+")",
        "attachments": [ {
            "pretext": "<!channel>",
            "color": "#36a64f",
            "title_link": "https://api.slack.com/",
            "text": "<?php  foreach ($Read->getResult() as $colunas) {  extract($colunas);  echo $Delegacao . ' | ' . $Produto . ' | ' . $Dias .' dia | ' . $Total .' prop \n';  } ?>",
        }]
    };
    $.post(url, JSON.stringify(payload), function(data){
        $('#result').text(data);
    });

</script>

<?php  

$Read->FullRead("SELECT ROW_NUMBER() over(order by replace([00_Delegação].DELEGACAO,'FLUMINENSE ','')) as Id, replace([00_Delegação].DELEGACAO,'FLUMINENSE ','') AS Delegacao, PROD.PRODUTO as Produto, TIPO.ITEM AS Tipo,count(PROD.PRODUTO) as Vendas
    FROM [11_CondVisitas]  INNER JOIN Funcionários
    ON [11_CondVisitas].IDUSUARIO = Funcionários.ID INNER JOIN [11_CondEstrutura]
    ON [11_CondVisitas].IDCONDESTRUTURA = [11_CondEstrutura].ID INNER JOIN [11_Condominios]
    ON [11_CondEstrutura].IDCOND = [11_Condominios].ID INNER JOIN [00_Logradouro]
    ON [11_Condominios].LOGRADOURO = [00_Logradouro].ID INNER JOIN [00_Bairro]
    ON [00_Logradouro].BAIRRO = [00_Bairro].ID INNER JOIN [00_Areas]
    ON [00_Bairro].AREA = [00_Areas].ID INNER JOIN [00_Delegação]
    ON [00_Areas].DELEGACAO = [00_Delegação].ID inner join [00_TabelasItems] TIPO
    ON [11_CondVisitas].TIPO = TIPO.ID inner join [00_TipoLog2]
    ON [00_Logradouro].TIPO2 = [00_TipoLog2].ID LEFT JOIN [10_PropostaRecebimento] PROPOSTA
    ON [11_CondVisitas].ID = PROPOSTA.IDVISITA INNER JOIN [00_Produtos] PROD
    ON [11_Condominios].PRODUTO = PROD.ID
    WHERE CONVERT(varchar, DATAHORA, 103) = CONVERT(varchar, Getdate(), 103) and
    (VENDA = 87) AND 
    (MOTIVOVISITA = 113) AND
    ([11_CondVisitas].STATUS <> 93)
    group by replace([00_Delegação].DELEGACAO,'FLUMINENSE ',''), TIPO.ITEM, PROD.PRODUTO
    ORDER BY DELEGACAO DESC", " ");

    ?>

<div id="result"></div>
<?php 
$totHoje = 0;
foreach ($Read->getResult() as $hojeTotal) {
    extract($hojeTotal); 
    $totHoje = $totHoje + $Vendas;
}

?>
<script type="text/javascript">

// VENDAS HOJE COM PROPOSTAS NÃO RECEBIDAS
  var url = "https://hooks.slack.com/services/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";
      var hojeTotalProp = <?php echo  $totHoje;?>;
      var payload =    
      {
        "text": "*Vendas hoje - Detalhado* ("+hojeTotalProp+")",
        "attachments": [ {
            "pretext": "<!channel>",
            "color": "#36a64f",
            "title_link": "https://api.slack.com/",
            "text": "<?php  foreach ($Read->getResult() as $propostasHoje) {  extract($propostasHoje);  echo $Delegacao . ' | ' . $Produto . ' | ' . $Tipo .' | ' . $Vendas .' Vendas \n';  } ?>",
        }]
    };
   $.post(url, JSON.stringify(payload), function(data){
    $('#result').text(data);
});

</script>
<script src="admin/_js/workcontrol.js"></script>


</body>
</html>