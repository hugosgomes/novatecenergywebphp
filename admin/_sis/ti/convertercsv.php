<span class="btn btn_darkblue" onclick="Teste()">Importar CSV</span>

<script type="text/javascript">
    
function Teste(){
    $.post('_sis/ti/relatorioestadoportas.php', function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

    }, 'json');
}

</script>
