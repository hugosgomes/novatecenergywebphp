 
    <h4>Teste de Estanquidade</h4>
                    <div id="tipo-servico">            
                     <div class="t_hiddens">
                     </div>
                        <label class="label box box100">
                            <span class="legend"><b>Nº do Manometro:</b></span>
                            <select value="" type="text" name="t_num_manometro">
                               <option value="t">ESCOLHA UM MANÔMETRO</option>
        <?php
        $query = "SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME, SUB.PRODUTO,
        CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.ID ELSE TERC.ID END AS IDFUNC, SUB.IDPROD,
        CASE WHEN FUNC.ID IS NOT NULL THEN 'FUNCIONÁRIO' ELSE 'TERCEIRIZADO' END AS TIPOFUNC FROM [40_Interna_ID]
        LEFT JOIN Funcionários FUNC ON [40_Interna_ID].USUARIO_PORTADOR = FUNC.ID
        LEFT JOIN FuncionariosTerceirizados TERC ON [40_Interna_ID].USUARIO_PORTADOR_TERCEIRIZADO = TERC.ID
        INNER JOIN [00_NivelAcesso] ON FUNC.ID = [00_NivelAcesso].IDFUNCIONARIO OR TERC.ID = [00_NivelAcesso].IDTERCEIRIZADO
        INNER JOIN(
        SELECT max([40_Interna].INTERNA) ULTMOV, [40_Produtos].PRODUTO, [40_Produtos].Id IDPROD FROM [40_Produtos]
        INNER JOIN [40_Interna] ON [40_Produtos].Id = [40_Interna].PRODUTO
        WHERE [40_Produtos].PRODUTO LIKE 'MANÔMETRO%'
        GROUP BY [40_Produtos].PRODUTO, [40_Produtos].Id) SUB
        ON [40_Interna_ID].ID = SUB.ULTMOV
        WHERE [40_Interna_ID].TIPO_MOVIMENTO = 244 AND MOBILE_GNS = 1 AND CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.ID ELSE TERC.ID END = {$IdTecnico}
        ORDER BY NOME";
        $Read->FullRead($query," ");
        if ($Read->getResult()):
            foreach ($Read->getResult() as $manometro):
                echo "<option value='{$manometro['IDPROD']}'>{$manometro['PRODUTO']}</option>";
            endforeach;
        endif;
        ?>
                            </select>
                        </label>
                        <label class="label box box33">
                            <span class="legend"><b>Pressão Inicial:</b></span>
                            <input type="text" name="t_p_inicial" id="t_p_inicial" class="t_p_inicial" placeholder="Inicial:" />
                        </label>
                        <label class="label box box33">
                            <span class="legend"><b>Pressão Final:</b></span>
                            <input type="text" name="t_p_Final" id="t_p_Final" class="t_p_Final" placeholder="Final:" />
                        </label>
                        <label class="label box box33">
                            <span class="legend"><b>Tempo do teste:</b></span>
                            <input type="text" name="t_tempo_teste" id="t_tempo_teste" class="t_tempo_teste"  placeholder="Tempo:" />
                        </label>
                        <label class="label box box50">
                            <span class="legend"><b>Dados do Medidor:</b></span>
                            <input type="file" name="medidor_fotos_arquivos[]" class="wc_loadimage" multiple/>
                            <div class="dados_medidor">


</label>
<label id="status-ocorrencia" class="label box box100" style="display:none">
    <span class="legend"><b>Nº Ocorrência:</b></span>
    <input type="text" name="t_num_ocorrencia" id="t_num_ocorrencia" class="t_num_ocorrencia"  placeholder="ocorrência:" />
</label>
<label class="label box box50">
    <span class="legend"><b>Dados do Medidor:</b></span>
    <input type="file" name="medidor_fotos_arquivos[]" class="wc_loadimage" multiple/>
    <div class="dados_medidor">

                            </div>
                        </label>
                        <label class="label box box100">
                            <span class="legend"><b>Status:</b></span>
                            <span><input id="ok" type="radio" name="t_1status" value="ok" style="width:5%"  />Ok</span>
                            <span><input id="vazamento" type="radio" name="t_1status" value="vazamento" style="width:5%">Vazamento</span>
                            <span class="t_vazamento-L" style="display:none;"><input style="width:5%;" id="menor-5L" type="radio" name="t_2status" value="Menor 5L">Menor 5L</span>
                            <span class="t_vazamento-L" style="display:none;"><input style="width:5%;" id="maior-5L" type="radio" name="t_2status" value="Maior 5L">Maior 5L</span>
                        
                        </label>
                        <label id="status-ocorrencia" class="label box box100" style="display:none">
                            <span class="legend"><b>Nº Ocorrência:</b></span>
                            <input type="text" name="t_num_ocorrencia" id="t_num_ocorrencia" class="t_num_ocorrencia"  placeholder="ocorrência:" />
                        </label>

    </div>
</label>

<label class="label box box100">
    <span class="legend"><b>Aparelhos no Local:</b></span>
    <a class="btn btn_darkblue t_aparelho1" href="#aparelho-1" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho1">Cozinha (0)</span></a>
    <a class="btn btn_darkblue t_aparelho2" href="#aparelho-2" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho2"> Banheiro Social (0)</span></a>
    <a class="btn btn_darkblue t_aparelho3" href="#aparelho-3" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho3"> Banheiro Suíte (0)</span></a>
    <a class="btn btn_darkblue t_aparelho4" href="#aparelho-4" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho4"> Banheiro Serviço (0)</span></a>
    <a class="btn btn_darkblue t_aparelho5" href="#aparelho-5" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho5"> Área Serviço (0)</span></a>
    <a class="btn btn_darkblue t_aparelho6" href="#aparelho-6" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho6"> Outros (0)</span></a>
</label>

<div id="aparelho-1" class="modal" style="height: auto;">
 <article class="box box100">
    <header>
      <h3 style="text-align: center;">Aparelho 1 Local:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <label class="label box box50">
            <span class="legend">Tipo:</span>
            <input  type="text" id="t_cozinhaTipo"  placeholder="Tipo:" required/>
        </label>
        <label class="label box box50">
            <span class="legend">Marca:</span>
            <input  type="text" id="t_cozinhaMarca"  placeholder="Marca:" required/>
        </label>
        <label class="label box box50">
            <span class="legend">Modelo:</span>
            <input  type="text" id="t_cozinhaModelo"  placeholder="Modelo:" required/>
        </label>
        <label class="label box box50">
            <span class="legend">Pot nominal:</span>
            <input  type="text" type="text" id="t_cozinhaPot" onkeypress='return SomenteNumero(this,event)' placeholder="Pot nominal:" required/>
        </label>
        <label class="label box box100">
            <span class="legend">Funcionamento:</span>
            <input type="radio" name="t_cozinhaFuncionamento"  value="Bom" style="width:5%"  />Bom
            <input type="radio" name="t_cozinhaFuncionamento"  value="Ruim" style="width:5%"/>Ruim
            <input type="radio" name="t_cozinhaFuncionamento"   value="Fora de uso" style="width:5%" />Fora de uso
        </label>
    </article>
    <div class="t_table_aparelho1">
       <table style="font-size: 90%;">
        <thead>
            <tr>
                <th style="text-align: center;">Tipo:</th>
                <th style="text-align: center;">Marca:</th>
                <th style="text-align: center;">Modelo:</th>
                <th style="text-align: center;">POT Nominal:</th>
                <th style="text-align: center;">Funcionamento:</th>
                <th style="text-align: center;">Excluir:</th>
            </tr>
        </thead>
        <tbody id="t_aparelho_1" >  

        </tbody>
    </table>
    <br>
</div>
<center><span id="t_salvar_cozinha" name="public" value="1" class="t_salvar_cozinha btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
<div class="clear"></div>
</div>
</article>
</div><!--- Fim modal aparelho-1 --->

<div id="aparelho-2" class="modal" style="height: auto;">
 <article class="box box100">
    <header>
      <h3 style="text-align: center;">Aparelho 2 Local:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <label class="label box box50">
            <span class="legend">Tipo:</span>
            <input type="text" name="t_b_SocialTipo" id="t_b_SocialTipo"  placeholder="Tipo:" />
        </label>
        <label class="label box box50">
            <span class="legend">Marca:</span>
            <input type="text" name="t_b_SocialMarca" id="t_b_SocialMarca" placeholder="Marca:" />
        </label>
        <label class="label box box50">
            <span class="legend">Modelo:</span>
            <input  type="text" name="t_b_SocialModelo" id="t_b_SocialModelo" placeholder="Modelo:"/>
        </label>
        <label class="label box box50">
            <span class="legend">Pot nominal:</span>
            <input type="text" name="t_b_SocialPot" id="t_b_SocialPot" onkeypress='return SomenteNumero(this,event)' placeholder="Pot nominal:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Tiragem:</span>
            <input type="radio" name="t_b_SocialTiragem" value="Natural" style="width:5%"  />Natural
            &ensp;
            <input type="radio" name="t_b_SocialTiragem" value="Forçada" style="width:5%">Forçada
        </label>
        <label class="label box box33">
            <span class="legend">Combustão:</span>
            <input type="radio" name="t_b_SocialCombustao" value="Aberta" style="width:5%"  />Aberta
            &ensp;
            <input type="radio" name="t_b_SocialCombustao" value="Fechada" style="width:5%">Fechada
        </label>
        <label class="label box box33">
            <span class="legend">Funcionamento:</span>
            <input type="radio" name="t_b_SocialFuncionamento" value="Bom" style="width:5%"  />Bom
            &ensp;
            <input type="radio" name="t_b_SocialFuncionamento" value="Ruim" style="width:5%"/>Ruim
            &ensp;
            <input type="radio" name="t_b_SocialFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
        </label>
        <header>
          <h3 style="text-align: center;">Higiene da Combustão:</h3>
      </header>
      <div class="scroll-modal" style="height:300px;">

        <label class="label box box100">
            <span class="legend">Tiragem:</span>
            <input type="text" name="t_b_Social_h_Tiragem" id="t_b_Social_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
        </label>
        <label class="label box box100">
            <span class="legend">COn:</span>
            <input type="text" name="t_b_Social_h_Con" id="t_b_Social_h_Con" placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">CO amb:</span>
            <input type="text" name="t_b_Social_h_CoAmb" id="t_b_Social_h_CoAmb"  placeholder="CO amb:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Tempo (min):</span>
            <input type="text" name="t_b_Social_h_Tempo" id="t_b_Social_h_Tempo"  placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Analisador:</span>
            <input type="text" name="t_b_Social_h_Analisador" id="t_b_Social_h_Analisador"  placeholder="Analisador:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Número de série:</span>
            <input type="text" name="t_b_Social_h_NumSerie" id="t_b_Social_h_NumSerie"  placeholder="número de série:"/>
        </label>
    </div>
</article>
<div class="t_table_aparelho2">
    <br>
    <div class="tabela-responsivel" style="height: auto;">
       <table style="font-size: 90%;">
        <thead>
            <tr>
                <th style="text-align: center;">Tipo:</th>
                <th style="text-align: center;">Marca:</th>
                <th style="text-align: center;">Modelo:</th>
                <th style="text-align: center;">POT Nominal:</th>
                <th style="text-align: center;">Tiragem:</th>
                <th style="text-align: center;">Combustão:</th>
                <th style="text-align: center;">Funcionamento:</th>

                <th style="text-align: center;">H. Tiragem:</th>
                <th style="text-align: center;">H. CON:</th>
                <th style="text-align: center;">H. CO AMB:</th>
                <th style="text-align: center;">Tempo:</th>
                <th style="text-align: center;">Analisador:</th>
                <th style="text-align: center;">Núm. Série:</th>
                <th style="text-align: center;">Excluir:</th>
            </tr>
        </thead>
        <tbody id="t_aparelho_2" >  

        </tbody>
    </table>
</div>
<br>
</div>
<center> <span name="public" value="1" class=" btn btn_darkblue  icon-plus t_salvar_banheiro_social" style="margin-left: 5px;" id="t_salvar_banheiro_social" callback="ClientesOT" callback_action="addCliente">Adicionar</span></center>
<div class="clear"></div>
</div>
</article>
</div><!--- Fim modal aparelho-2 --->

<div id="aparelho-3" class="modal" style="height: auto;">
 <article class="box box100">
    <header>
      <h3 style="text-align: center;">Aparelho 3 Local:</h3>
  </header>
  <div class="box_content">
      <article class='box box100'>
        <label class="label box box50">
            <span class="legend">Tipo:</span>
            <input type="text" name="t_b_SuiteTipo" id="t_b_SuiteTipo"  placeholder="Tipo:" />
        </label>
        <label class="label box box50">
            <span class="legend">Marca:</span>
            <input type="text" name="t_b_SuiteMarca" id="t_b_SuiteMarca" placeholder="Marca:" />
        </label>
        <label class="label box box50">
            <span class="legend">Modelo:</span>
            <input  type="text" name="t_b_SuiteModelo" id="t_b_SuiteModelo" placeholder="Modelo:"/>
        </label>
        <label class="label box box50">
            <span class="legend">Pot nominal:</span>
            <input type="text" name="t_b_SuitePot" id="t_b_SuitePot" onkeypress='return SomenteNumero(this,event)' placeholder="Pot nominal:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Tiragem:</span>
            <input type="radio" name="t_b_SuiteTiragem" value="Natural" style="width:5%"  />Natural
            &ensp;
            <input type="radio" name="t_b_SuiteTiragem" value="Forçada" style="width:5%" />Forçada
        </label>
        <label class="label box box33">
            <span class="legend">Combustão:</span>
            <input type="radio" name="t_b_SuiteCombustao" value="Aberta" style="width:5%"  />Aberta
            &ensp;
            <input type="radio" name="t_b_SuiteCombustao" value="Fechada" style="width:5%" />Fechada
        </label>
        <label class="label box box33">
            <span class="legend">Funcionamento:</span>
            <input type="radio" name="t_b_SuiteFuncionamento" value="Bom" style="width:5%"  />Bom
            &ensp;
            <input type="radio" name="t_b_SuiteFuncionamento" value="Ruim" style="width:5%"/>Ruim
            &ensp;
            <input type="radio" name="t_b_SuiteFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
        </label>
        <header>
          <h3 style="text-align: center;">Higiene da Combustão:</h3>
      </header>
      <div class="scroll-modal" style="height:300px;">

        <label class="label box box100">
            <span class="legend">Tiragem:</span>
            <input type="text" name="t_b_Suite_h_Tiragem" id="t_b_Suite_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
        </label>
        <label class="label box box100">
            <span class="legend">COn:</span>
            <input type="text" name="t_b_Suite_h_Con" id="t_b_Suite_h_Con" placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">CO amb:</span>
            <input type="text" name="t_b_Suite_h_CoAmb" id="t_b_Suite_h_CoAmb"  placeholder="CO amb:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Tempo (min):</span>
            <input type="text" name="t_b_Suite_h_Tempo" id="t_b_Suite_h_Tempo"  placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Analisador:</span>
            <input type="text" name="t_b_Suite_h_Analisador" id="t_b_Suite_h_Analisador"  placeholder="Analisador:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Número de série:</span>
            <input type="text" name="t_b_Suite_h_NumSerie" id="t_b_Suite_h_NumSerie"  placeholder="número de série:"/>
        </label>
    </div>
</article>
<div class="t_table_aparelho3">
    <br>
    <div class="tabela-responsivel" style="height: auto;">
     <table style="font-size: 90%;">
        <thead>
            <tr>
                <th style="text-align: center;">Tipo:</th>
                <th style="text-align: center;">Marca:</th>
                <th style="text-align: center;">Modelo:</th>
                <th style="text-align: center;">POT Nominal:</th>
                <th style="text-align: center;">Tiragem:</th>
                <th style="text-align: center;">Combustão:</th>
                <th style="text-align: center;">Funcionamento:</th>

                <th style="text-align: center;">H. Tiragem:</th>
                <th style="text-align: center;">H. CON:</th>
                <th style="text-align: center;">H. CO AMB:</th>
                <th style="text-align: center;">Tempo:</th>
                <th style="text-align: center;">Analisador:</th>
                <th style="text-align: center;">Núm. Série:</th>
                <th style="text-align: center;">Excluir:</th>
            </tr>
        </thead>
        <tbody id="t_aparelho_3" >  

        </tbody>
    </table>
</div>
<br>
</div>
<center><span name="public" value="1" class="btn btn_darkblue  icon-plus t_salvar_banheiro_suite" style="margin-left: 5px;" id="t_salvar_banheiro_suite" callback="ClientesOT" callback_action="addCliente">Adicionar</span>
    <div class="clear"></div></center>
</div>
</article>
</div><!--- Fim modal aparelho-3 --->

<div id="aparelho-4" class="modal" style="height: auto;">
 <article class="box box100">
    <header>
      <h3 style="text-align: center;">Aparelho 4 Local:</h3>
  </header>
  <div class="box_content">
      <article class='box box100'>
        <label class="label box box50">
            <span class="legend">Tipo:</span>
            <input type="text" name="t_b_ServicoTipo" id="t_b_ServicoTipo"  placeholder="Tipo:" />
        </label>
        <label class="label box box50">
            <span class="legend">Marca:</span>
            <input type="text" name="t_b_ServicoMarca" id="t_b_ServicoMarca" placeholder="Marca:" />
        </label>
        <label class="label box box50">
            <span class="legend">Modelo:</span>
            <input  type="text" name="t_b_ServicoModelo" id="t_b_ServicoModelo" placeholder="Modelo:"/>
        </label>
        <label class="label box box50">
            <span class="legend">Pot nominal:</span>
            <input type="text" name="t_b_ServicoPot" id="t_b_ServicoPot" onkeypress='return SomenteNumero(this,event)' placeholder="Pot nominal:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Tiragem:</span>
            <input type="radio" name="t_b_ServicoTiragem" value="Natural" style="width:5%"  />Natural
            &ensp;
            <input type="radio" name="t_b_ServicoTiragem" value="Forçada" style="width:5%"  />Forçada
        </label>
        <label class="label box box33">
            <span class="legend">Combustão:</span>
            <input type="radio" name="t_b_ServicoCombustao" value="Aberta" style="width:5%"  />Aberta
            &ensp;
            <input type="radio" name="t_b_ServicoCombustao" value="Fechada" style="width:5%" />Fechada
        </label>
        <label class="label box box33">
            <span class="legend">Funcionamento:</span>
            <input type="radio" name="t_b_ServicoFuncionamento" value="Bom" style="width:5%"  />Bom
            &ensp;
            <input type="radio" name="t_b_ServicoFuncionamento" value="Ruim" style="width:5%" />Ruim
            &ensp;
            <input type="radio" name="t_b_ServicoFuncionamento" value="Fora de uso" style="width:5%" />Fora de uso
        </label>
        <header>
          <h3 style="text-align: center;">Higiene da Combustão:</h3>
      </header>
      <div class="scroll-modal" style="height:300px;">

        <label class="label box box100">
            <span class="legend">Tiragem:</span>
            <input type="text" name="t_b_Servico_h_Tiragem" id="t_b_Servico_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
        </label>
        <label class="label box box100">
            <span class="legend">COn:</span>
            <input type="text" name="t_b_Servico_h_Con" id="t_b_Servico_h_Con" placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">CO amb:</span>
            <input type="text" name="t_b_Servico_h_CoAmb" id="t_b_Servico_h_CoAmb"  placeholder="CO amb:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Tempo (min):</span>
            <input type="text" name="t_b_Servico_h_Tempo" id="t_b_Servico_h_Tempo"  placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Analisador:</span>
            <input type="text" name="t_b_Servico_h_Analisador" id="t_b_Servico_h_Analisador"  placeholder="Analisador:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Número de série:</span>
            <input type="text" name="t_b_Servico_h_NumSerie" id="t_b_Servico_h_NumSerie"  placeholder="número de série:"/>
        </label>
    </div>
</article>
<div class="t_table_aparelho4">
    <br>
    <div class="tabela-responsivel" style="height: auto;">
     <table style="font-size: 90%;">
        <thead>
            <tr>
                <th style="text-align: center;">Tipo:</th>
                <th style="text-align: center;">Marca:</th>
                <th style="text-align: center;">Modelo:</th>
                <th style="text-align: center;">POT Nominal:</th>
                <th style="text-align: center;">Tiragem:</th>
                <th style="text-align: center;">Combustão:</th>
                <th style="text-align: center;">Funcionamento:</th>

                <th style="text-align: center;">H. Tiragem:</th>
                <th style="text-align: center;">H. CON:</th>
                <th style="text-align: center;">H. CO AMB:</th>
                <th style="text-align: center;">Tempo:</th>
                <th style="text-align: center;">Analisador:</th>
                <th style="text-align: center;">Núm. Série:</th>
                <th style="text-align: center;">Excluir:</th>
            </tr>
        </thead>
        <tbody id="t_aparelho_4" >  

        </tbody>
    </table>
</div>
<br>
</div>
<center><span name="public" value="1" class="btn btn_darkblue  icon-plus t_salvar_banheiro_servico" style="margin-left: 5px;" id="t_salvar_banheiro_servico" callback="ClientesOT" callback_action="addCliente">Adicionar</span>
    <div class="clear"></div></center>
</div>
</article>
</div><!--- Fim modal aparelho-4 --->

<div id="aparelho-5" class="modal" style="height: auto;">
 <article class="box box100">
    <header>
      <h3 style="text-align: center;">Aparelho 5 Local:</h3>
  </header>
  <div class="box_content">
      <article class='box box100'>
        <label class="label box box50">
            <span class="legend">Tipo:</span>
            <input type="text" name="t_a_ServicoTipo" id="t_a_ServicoTipo"  placeholder="Tipo:" />
        </label>
        <label class="label box box50">
            <span class="legend">Marca:</span>
            <input type="text" name="t_a_ServicoMarca" id="t_a_ServicoMarca" placeholder="Marca:" />
        </label>
        <label class="label box box50">
            <span class="legend">Modelo:</span>
            <input  type="text" name="t_a_ServicoModelo" id="t_a_ServicoModelo" placeholder="Modelo:"/>
        </label>
        <label class="label box box50">
            <span class="legend">Pot nominal:</span>
            <input type="text" name="t_a_ServicoPot" id="t_a_ServicoPot" onkeypress='return SomenteNumero(this,event)' placeholder="Pot nominal:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Tiragem:</span>
            <input type="radio" name="t_a_ServicoTiragem" value="Natural" style="width:5%"  />Natural
            &ensp;
            <input type="radio" name="t_a_ServicoTiragem" value="Forçada" style="width:5%"  />Forçada
        </label>
        <label class="label box box33">
            <span class="legend">Combustão:</span>
            <input type="radio" name="t_a_ServicoCombustao" value="Aberta" style="width:5%"  />Aberta
            &ensp;
            <input type="radio" name="t_a_ServicoCombustao" value="Fechada" style="width:5%" />Fechada
        </label>
        <label class="label box box33">
            <span class="legend">Funcionamento:</span>
            <input type="radio" name="t_a_ServicoFuncionamento" value="Bom" style="width:5%"  />Bom
            &ensp;
            <input type="radio" name="t_a_ServicoFuncionamento" value="Ruim" style="width:5%" />Ruim
            &ensp;
            <input type="radio" name="t_a_ServicoFuncionamento" value="Fora de uso" style="width:5%" />Fora de uso
        </label>
        <header>
          <h3 style="text-align: center;">Higiene da Combustão:</h3>
      </header>
      <div class="scroll-modal" style="height:300px;">

        <label class="label box box100">
            <span class="legend">Tiragem:</span>
            <input type="text" name="t_a_Servico_h_Tiragem" id="t_a_Servico_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
        </label>
        <label class="label box box100">
            <span class="legend">COn:</span>
            <input type="text" name="t_a_Servico_h_Con" id="t_a_Servico_h_Con" placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">CO amb:</span>
            <input type="text" name="t_a_Servico_h_CoAmb" id="t_a_Servico_h_CoAmb"  placeholder="CO amb:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Tempo (min):</span>
            <input type="text" name="t_a_Servico_h_Tempo" id="t_a_Servico_h_Tempo"  placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Analisador:</span>
            <input type="text" name="t_a_Servico_h_Analisador" id="t_a_Servico_h_Analisador"  placeholder="Analisador:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Número de série:</span>
            <input type="text" name="t_a_Servico_h_NumSerie" id="t_a_Servico_h_NumSerie"  placeholder="número de série:"/>
        </label>
    </div> 
</article>
<div class="t_table_aparelho5">
    <br>
    <div class="tabela-responsivel" style="height: auto;">
     <table style="font-size: 90%;">
        <thead>
            <tr>
                <th style="text-align: center;">Tipo:</th>
                <th style="text-align: center;">Marca:</th>
                <th style="text-align: center;">Modelo:</th>
                <th style="text-align: center;">POT Nominal:</th>
                <th style="text-align: center;">Tiragem:</th>
                <th style="text-align: center;">Combustão:</th>
                <th style="text-align: center;">Funcionamento:</th>

                <th style="text-align: center;">H. Tiragem:</th>
                <th style="text-align: center;">H. CON:</th>
                <th style="text-align: center;">H. CO AMB:</th>
                <th style="text-align: center;">Tempo:</th>
                <th style="text-align: center;">Analisador:</th>
                <th style="text-align: center;">Núm. Série:</th>
                <th style="text-align: center;">Excluir:</th>
            </tr>
        </thead>
        <tbody id="t_aparelho_5" >  

        </tbody>
    </table>
</div>
<br>
</div>
<center><span name="public" value="1" class="btn btn_darkblue  icon-plus t_salvar_area_servico" style="margin-left: 5px;" id="t_salvar_area_servico" callback="ClientesOT" callback_action="addCliente">Adicionar</span>
    <div class="clear"></div></center>
</div>
</article>
</div><!--- Fim modal aparelho-5 --->
<div id="aparelho-6" class="modal" style="height: auto;">
 <article class="box box100">
    <header>
      <h3 style="text-align: center;">Outros:</h3>
  </header>
  <div class="box_content">
      <article class='box box100'>
        <label class="label box box50">
            <span class="legend">Tipo:</span>
            <input type="text" name="t_OutroTipo" id="t_OutroTipo"  placeholder="Tipo:" />
        </label>
        <label class="label box box50">
            <span class="legend">Marca:</span>
            <input type="text" name="t_OutroMarca" id="t_OutroMarca" placeholder="Marca:" />
        </label>
        <label class="label box box50">
            <span class="legend">Modelo:</span>
            <input  type="text" name="t_OutroModelo" id="t_OutroModelo" placeholder="Modelo:"/>
        </label>
        <label class="label box box50">
            <span class="legend">Pot nominal:</span>
            <input type="text" name="t_OutroPot" id="t_OutroPot" onkeypress='return SomenteNumero(this,event)' placeholder="Pot nominal:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Tiragem:</span>
            <input type="radio" name="t_OutroTiragem" value="Natural" style="width:5%"  />Natural
            &ensp;
            <input type="radio" name="t_OutroTiragem" value="Forçada" style="width:5%"  />Forçada
        </label>
        <label class="label box box33">
            <span class="legend">Combustão:</span>
            <input type="radio" name="t_OutroCombustao" value="Aberta" style="width:5%"  />Aberta
            &ensp;
            <input type="radio" name="t_OutroCombustao" value="Fechada" style="width:5%" />Fechada
        </label>
        <label class="label box box33">
            <span class="legend">Funcionamento:</span>
            <input type="radio" name="t_OutroFuncionamento" value="Bom" style="width:5%"  />Bom
            &ensp;
            <input type="radio" name="t_OutroFuncionamento" value="Ruim" style="width:5%" />Ruim
            &ensp;
            <input type="radio" name="t_OutroFuncionamento" value="Fora de uso" style="width:5%" />Fora de uso
        </label>
        <header>
          <h3 style="text-align: center;">Higiene da Combustão:</h3>
      </header>
      <div class="scroll-modal" style="height:300px;">

        <label class="label box box100">
            <span class="legend">Tiragem:</span>
            <input type="text" name="t_Outro_h_Tiragem" id="t_Outro_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
        </label>
        <label class="label box box100">
            <span class="legend">COn:</span>
            <input type="text" name="t_Outro_h_Con" id="t_Outro_h_Con" placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">CO amb:</span>
            <input type="text" name="t_Outro_h_CoAmb" id="t_Outro_h_CoAmb"  placeholder="CO amb:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Tempo (min):</span>
            <input type="text" name="t_Outro_h_Tempo" id="t_Outro_h_Tempo"  placeholder="COn:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Analisador:</span>
            <input type="text" name="t_Outro_h_Analisador" id="t_Outro_h_Analisador"  placeholder="Analisador:"/>
        </label>
        <label class="label box box100">
            <span class="legend">Número de série:</span>
            <input type="text" name="t_Outro_h_NumSerie" id="t_Outro_h_NumSerie"  placeholder="número de série:"/>
        </label>
    </div>   
</article>
<div class="t_table_aparelho6">
    <br>
    <div class="tabela-responsivel" style="height: auto;">
     <table style="font-size: 90%;">
        <thead>
            <tr>
                <th style="text-align: center;">Tipo:</th>
                <th style="text-align: center;">Marca:</th>
                <th style="text-align: center;">Modelo:</th>
                <th style="text-align: center;">POT Nominal:</th>
                <th style="text-align: center;">Tiragem:</th>
                <th style="text-align: center;">Combustão:</th>
                <th style="text-align: center;">Funcionamento:</th>

                <th style="text-align: center;">H. Tiragem:</th>
                <th style="text-align: center;">H. CON:</th>
                <th style="text-align: center;">H. CO AMB:</th>
                <th style="text-align: center;">Tempo:</th>
                <th style="text-align: center;">Analisador:</th>
                <th style="text-align: center;">Núm. Série:</th>
                <th style="text-align: center;">Excluir:</th>
            </tr>
        </thead>
        <tbody id="t_aparelho_6" >  

        </tbody>
    </table>
</div>
<br>
</div>
<center><span name="public" value="1" class="btn btn_darkblue  icon-plus t_salvar_outro" style="margin-left: 5px;" id="t_salvar_outro" >Adicionar</span>
    <div class="clear"></div></center>
</div>
</article>
</div><!--- Fim modal aparelho-6 --->
            </div><!---- Final da div id="tipo-servico" ---->