<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['TI'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;
?>

<span class="btn btn_darkblue" onclick="Importar(this)">Importação de Lote</span>-
<span class="btn btn_darkblue" onclick="Importar(this)">Importação de Visitas</span>-
<span class="btn btn_darkblue" onclick="Importar(this)">Importação de Lotes Fechados</span>

<script type="text/javascript">
    
function Importar(obj){
	var text = $(obj).text();
    $.post('_sis/ti/proceduresrobo.php', {text}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

    }, 'json');
}

</script>