<?php
$AdminLevel = LEVEL_WC_USERS;
if (!$DashboardLogin):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

?>
<style type="text/css">
.container_small{
    background-color: black;
}
.box33{
    width: 50.2%;
}
textarea, input, select{
    resize: none;
    outline: none;
}
</style>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
        &raquo;</span>
        <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
        <span class="crumb">/</span>
        <a title="Novatec Energy" href="dashboard.php?wc=clientes/cadastro">Clientes Particulares</a>
        <span class="crumb">/</span>
        <a title="Novatec Energy" href="dashboard.php?wc=clientes/cadastro">Cadastro</a>
    </div>
</header>
<div class="dashboard_content custom_app">
    <article class="box box70">
        <header>
          <h3 style="text-align: center;">Cadastro de Clientes e Orçamentos</h3>
      </header> 
      <div class="box_content">
        <form  class="j_tab_home tab_create" name="user_manager" action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="callback" value="Clientes"/><!--- doumento ajax.php -->
         <input type="hidden" name="callback_action" value="cadCliente"/><!--ação que será adicionada no ajax.php-->
         <div class="box box25"></div>
         <div class="box box33">
            <div class="container_small">
                <div class="label_50">
                    <!--PESQUISA AUTOMATICAMENTE NO BANCO O CPF DIGITADO AO MUDAR DE CAMPO DE FORMULARIO-->
                    <label class="label">
                        <span class="legend">CPF:</span>
                        <input type="text" style="font-size: 1.0em;" name="CPF" class="wc_cpf  j_consulta_cliente formCpf wc_value" callback="Clientes" callback_action="consulta" value="" placeholder="CPF:" />
                    </label>    
                    <!--PESQUISA AUTOMATICAMENTE NO BANCO O CNPJ DIGITADO AO MUDAR DE CAMPO DE FORMULARIO-->
                    <label class="label">
                        <span class="legend">CNPJ:</span>
                        <input type="text" style="font-size: 1.0em;" name="CNPJ" class="j_consulta_cliente wc_cnpj wc_value formCnpj" callback="Clientes" callback_action="consulta" value="" placeholder="Digite CNPJ"/>
                    </label>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="label_50">
                <label class="label">
                    <span class="legend">Nome:</span>
                    <input class="wc_nome wc_value" style="font-size: 1.0em;" type="text" name="NOME" placeholder="Nome Completo" required/>
                </label>
                <label class="label">
                    <span class="legend">Cliente:</span>
                    <?php $campos = getWctipoCliente()?>
                    <select name="TIPO" class="wc_tipo wc_value" style="font-size: 1.0em;" type="text" required>
                        <option selected disabled value="">Selecione o tipo de cliente:</option>
                        <?php
                        foreach ($campos as $key=>$value) {?>
                            <option value="<?php echo $key?>"><?php echo $value;?></option>
                        <?php } ?>
                    </select>
                </label>
                <div class="clear"></div>
            </div>       
            <div class="label_50">
                <label class="label">
                    <span class="legend">Telefone:</span>
                    <input class="formPhone wc_telefone wc_value" style="font-size: 1.0em;" type="tel" name="TELEFONE" placeholder="Telefone" required/>
                </label>
                <label class="label">
                    <span class="legend">E-mail:</span>
                    <input class="wc_email wc_value" style="font-size: 1.0em;" type="email" name="EMAIL" placeholder="E-mail" required/>
                </label>                    
            </div>
            <hr style="border-top: 2px solid #1a4a7b;">   <!-- SEPERAÇÃO DE LINHAS -->
            <br>
            <div class="label_50">
                <label class="label">
                    <span class="legend">CEP:</span>
                    <input class="wc_getCep wc_cep wc_value" style="font-size: 1.0em;" type="text" name="CEP" placeholder="Digite o CEP " required/>
                </label>
                <label class="label">
                    <span class="legend">Logradouro:</span>
                    <input class="wc_logradouro wc_value" style="font-size: 1.0em;" type="text" name="LOGRADOURO" placeholder="Logradouro" required/>
                </label>
                <div class="clear"></div>
            </div>
            <div class="label_50">    
                <label class="label">
                    <span class="legend">Número:</span>
                    <input class="wc_numero wc_value" style="font-size: 1.0em;" type="text" name="NUMERO" placeholder="Número" required/>
                </label>
                <label class="label">
                    <span class="legend">Complemento:</span>
                    <input class="wc_value" style="font-size: 1.0em;" type="text" name="COMPLEMENTO" placeholder="Complemento" required/>
                </label>
                <div class="clear"></div>
            </div>
            <div class="label_33"> 
                <label class="label">
                    <span class="legend">Bairro:</span>
                    <input class="wc_bairro wc_value" style="font-size: 1.0em;" type="text" name="BAIRRO" placeholder="Bairro" required/>
                </label>
                <label class="label">
                    <span class="legend">Cidade:</span>
                    <input class="wc_localidade wc_value" style="font-size: 1.0em;" type="text" name="CIDADE" placeholder="Cidade" required/>
                </label>
                <label class="label">
                    <span class="legend">UF:</span>
                    <input class="wc_uf wc_value" style="font-size: 1.0em;" type="text" name="UF" placeholder="UF" required/>
                </label>
                <div class="clear"></div>
            </div>
            <hr style="border-top: 2px solid #1a4a7b;">   <!-- SEPERAÇÃO DE LINHAS -->
            <br>
            <div class="label_100">
                <label class="label">
                    <span class="legend">Tipo:</span>
                    <!-- <input class="wc_value" style="font-size: 1.4em;" type="text" name="TIPO" placeholder="Tipo de Serviço" required/>-->
                    <?php $campos = getWctipoServico()?>
                    <select name="TIPOSERVICO" class="wc_value" style="font-size: 1.0em;" type="text" required>
                        <option selected disabled value="">Selecione o tipo de serviço:</option>
                        <?php
                        foreach ($campos as $key=>$value) {?>
                            <option value="<?php echo $key?>"><?php echo $value;?></option>
                        <?php } ?>
                    </select>
                </label>
                <div class="clear"></div>
            </div>
            <div class="label_100">
                <label class="label">
                    <span  class="legend">OBS:</span>
                    <textarea class="wc_value" style="font-size: 1.0em;" type="text" name="OBS" placeholder="Observações" required></textarea>
                </label>
                <div class="clear"></div>
            </div>
            <div class="label_100">
                <label class="label">
                    <img class="form_load none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                    <button name="public" value="1" class="btn btn_darkblue fl_left icon-share" style="margin-left: 5px;">Cadastrar</button>
                    <div class="clear"></div>
                </label>
            </div>
        </div>
    </article>

    <article class="box box30">
        <header>
          <h3 style="text-align: center;">Dados do Cliente</h3>
      </header> 
      <div class="box_content">
        <div class="j_dados_cliente"></div>        
        <table>
            <div class="j_endereco_cliente">  
            </div>
        </table>
           <!-- <div class="j_dados_cliente"></div>
            <div class="j_endereco_cliente"></div>-->
        </div>
    </article>
</div>
<div class="box box25"></div>
</form>
</div>
</article>
</div>