        <h4 class="icon-user-plus">Teste de Estanquidade</h4>
                    <div id="tipo-servico">            
                     <div class="t_hiddens">
                     </div>
                        <label class="label box box100">
                            <span class="legend"><b>Nº do Manometro:</b></span>
                            <select value="" type="text" name="t_num_manometro">
                               <!-- <option selected disabled value="">Selecione o Nº do Manometro:</option>-->
                                <?php
                                $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME, SUB.PRODUTO,
                                   [00_NivelAcesso].ID AS IDFUNC, SUB.IDPROD,
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
                                   WHERE [40_Interna_ID].TIPO_MOVIMENTO = 244 AND MOBILE_GNS = 1 AND [00_NivelAcesso].ID = {$IdTecnico}","");
                                if ($Read->getResult()):
                                    foreach ($Read->getResult() as $manometro):
                                        echo "<option value='{$manometro['IDPROD']}' name='{$manometro['IDFUNC']}'>{$manometro['PRODUTO']}</option>";
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </label>
                        <label class="label box box50">
                            <span class="legend"><b>Pressão Inicial:</b></span>
                            <input type="text" name="t_p_inicial" id="t_p_inicial" class="t_p_inicial" placeholder="Inicial:" onkeypress='return SomenteNumero(event)'/>
                        </label>
                        <label class="label box box50">
                            <span class="legend"><b>Pressão Final:</b></span>
                            <input type="text" name="t_p_Final" id="t_p_Final" class="t_p_Final" placeholder="Final:" onkeypress='return SomenteNumero(event)'/>
                        </label>
                        <label class="label box box100">
                            <span class="legend"><b>Tempo do teste:</b></span>
                            <input type="text" name="t_tempo_teste" id="t_tempo_teste" class="t_tempo_teste"  placeholder="Tempo:"  onkeypress='return SomenteNumero(event)'/>
                        </label>
                        <label class="label box box100">
                            <span class="legend"><b>Status:</b></span>

                            <span><input id="ok" type="radio" name="t_1status" value="ok" style="width:5%"  />Ok</span>
                            <span><input id="vazamento" type="radio" name="t_1status" value="vazamento" style="width:5%">Vazamento</span>
                            <br>
                            <br>
                            <span class="t_vazamento-L" style="display:none;"><input style="width:5%;" id="menor-5L" type="radio" name="t_2status" value="Menor 5L">Menor 5L</span>
                            <span class="t_vazamento-L" style="display:none;"><input style="width:5%;" id="maior-5L" type="radio" name="t_2status" value="Maior 5L">Maior 5L</span>
                        
                        </label>
                        <label id="status-ocorrencia" class="label box box100" style="display:none">
                            <span class="legend"><b>Nº Ocorrência:</b></span>
                            <input type="text" name="t_num_ocorrencia" id="t_num_ocorrencia" class="t_num_ocorrencia"  placeholder="ocorrência:" onkeypress='return SomenteNumero(event)' />
                        </label>
                        <label class="label box box50">
                            <span class="legend"><b>Dados do Medidor:</b></span>
                            <input type="file" name="medidor_fotos_arquivos[]" class="wc_loadimage" multiple/>
                            <div class="dados_medidor">

                            </div>
                        </label>
                        <label class="label box box50">
                            <span class="legend"><b>Foto Situação do Serviço:</b></span>
                            <input type="file" name="servico_fotos_arquivos[]" class="wc_loadimage" multiple/>
                            <div class="dados_servico">

                            </div>
                        </label>

                        <center><label class="label box box100">
                            <span class="legend" style="font-size: 15px;"><b>Aparelhos no Local:</b></span>
                            <br>
                            <a class="btn btn_green t_aparelho1" href="#aparelho-1" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho1">Cozinha</span></a>
                            <a class="btn btn_green t_aparelho2" href="#aparelho-2" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho2"> Banheiro Social</span></a>
                            <a class="btn btn_green t_aparelho3" href="#aparelho-3" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho3"> Banheiro Suíte</span></a>
                            <a class="btn btn_green t_aparelho4" href="#aparelho-4" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho4"> Banheiro Serviço</span></a>
                            <a class="btn btn_green t_aparelho5" href="#aparelho-5" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho5"> Área Serviço </span></a>
                            <a class="btn btn_green t_aparelho6" href="#aparelho-6" rel="modal:open"><i class="icon-plus"></i><span contador="0" quantidade="0" id="t_aparelho6"> Outros </span></a>
                        </label></center>
                        <div id="aparelho-1" class="modal" style="height: auto;">
                             <article class="box box100">
                                <header>
                                  <h3 style="text-align: center;">Cozinha</h3>
                                </header>
                              <div class="box_content">
                                <article class='box box100'>
                                    <label class="label box box50">
                                        <span class="legend">Tipo:</span>
                                        <!--<input  type="text" id="t_cozinhaTipo"  placeholder="Tipo:" required/>-->
                                        <select id="t_cozinhaTipo">
                                            <option id="t_cozinhaTipo_Selecione">Selecione um tipo</option>
                                            <option value="Fogão">Fogão</option>
                                            <option value="Churrasqueira">Churrasqueira</option>
                                            <option value="Aquecedor">Aquecedor</option>
                                        </select>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input  type="text" id="t_CozinhaMarca"  placeholder="Marca:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input  type="text" id="t_CozinhaModelo"  placeholder="Modelo:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input  type="text" type="text" id="t_CozinhaPot" placeholder="Pot nominal:" required onkeypress='return SomenteNumero(event)'/>
                                    </label>
                                    <label class="label box box33">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_CozinhaFuncionamento" value="Bom" style="width:5%"  />Bom
                                        &ensp;
                                        <input type="radio" name="t_CozinhaFuncionamento" value="Ruim" style="width:5%"/>Ruim
                                        &ensp;
                                        <input type="radio" name="t_CozinhaFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
                                    </label>
                                    <label class="label box box33">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="t_CozinhaTiragem" value="Natural" style="width:5%"  />Natural
                                        &ensp;
                                        <input type="radio" name="t_CozinhaTiragem" value="Forçada" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box33">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="t_CozinhaCombustao" value="Aberta" style="width:5%"  />Aberta
                                        &ensp;
                                        <input type="radio" name="t_CozinhaCombustao" value="Fechada" style="width:5%">Fechada
                                    </label>
                                    <header>
                                     <h3 style="text-align: center;">Higiene da Combustão:</h3>
                                  </header>
                                      <br>
                                        <label class="label box box33">
                                            <span class="legend">Tiragem:</span>
                                            <input type="text" name="t_Cozinha_h_Tiragem" id="t_Cozinha_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
                                        </label>
                                        <label class="label box box33">
                                            <span class="legend">COn:</span>
                                            <input type="text" name="t_Cozinha_h_Con" id="t_Cozinha_h_Con" placeholder="COn:"/>
                                        </label>
                                        <label class="label box box33">
                                            <span class="legend">CO amb:</span>
                                            <input type="text" name="t_Cozinha_h_CoAmb" id="t_Cozinha_h_CoAmb"  placeholder="CO amb:"/>
                                        </label>
                                        <label class="label box box33">
                                            <span class="legend">Tempo (min):</span>
                                            <input type="text" name="t_Cozinha_h_Tempo" id="t_Cozinha_h_Tempo"  placeholder="COn:"/>
                                        </label>
                                        <label class="label box box33">
                                            <span class="legend">Analisador:</span>
                                            <input type="text" name="t_Cozinha_h_Analisador" id="t_Cozinha_h_Analisador"  placeholder="Analisador:"/>
                                        </label>
                                        <label class="label box box33">
                                            <span class="legend">Número de série:</span>
                                            <input type="text" name="t_Cozinha_h_NumSerie" id="t_Cozinha_h_NumSerie"  placeholder="número de série:"/>
                                        </label>
                                    </article>
                               <center><span id="t_salvar_cozinha" name="public" value="1" class="t_salvar_cozinha btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
                                <div class="clear"></div>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-1 --->
                        <div id="aparelho-2" class="modal" style="height: auto;">
                           <article class="box box100">
                            <header>
                              <h3 style="text-align: center;">Banheiro Social</h3>
                          </header>
                          <div class="box_content">
                            <article class='box box100'>
                                <label class="label box box50">
                                    <span class="legend">Tipo:</span>
                                    <!--<input  type="text" id="t_b_SocialTipo"  placeholder="Tipo:" required/>-->
                                    <select id="t_b_SocialTipo">
                                        <option id="t_b_SocialTipo_Selecione">Selecione um tipo</option>
                                        <option value="Fogão">Fogão</option>
                                        <option value="Churrasqueira">Churrasqueira</option>
                                        <option value="Aquecedor">Aquecedor</option>
                                    </select>
                                </label>
                                <label class="label box box50">
                                    <span class="legend">Marca:</span>
                                    <input  type="text" id="t_b_SocialMarca"  placeholder="Marca:" required/>
                                </label>
                                <label class="label box box50">
                                    <span class="legend">Modelo:</span>
                                    <input  type="text" id="t_b_SocialModelo"  placeholder="Modelo:" required/>
                                </label>
                                <label class="label box box50">
                                    <span class="legend">Pot nominal:</span>
                                    <input  type="text" type="text" id="t_b_SocialPot" placeholder="Pot nominal:" required onkeypress='return SomenteNumero(event)'/>
                                </label>
                                <label class="label box box33">
                                    <span class="legend">Funcionamento:</span>
                                    <input type="radio" name="t_b_SocialFuncionamento" value="Bom" style="width:5%"  />Bom
                                    &ensp;
                                    <input type="radio" name="t_b_SocialFuncionamento" value="Ruim" style="width:5%"/>Ruim
                                    &ensp;
                                    <input type="radio" name="t_b_SocialFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
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
                                <header>
                                 <h3 style="text-align: center;">Higiene da Combustão:</h3>
                             </header>
                             <br>
                             <label class="label box box33">
                                <span class="legend">Tiragem:</span>
                                <input type="text" name="t_b_Social_h_Tiragem" id="t_b_Social_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
                            </label>
                            <label class="label box box33">
                                <span class="legend">COn:</span>
                                <input type="text" name="t_b_Social_h_Con" id="t_b_Social_h_Con" placeholder="COn:"/>
                            </label>
                            <label class="label box box33">
                                <span class="legend">CO amb:</span>
                                <input type="text" name="t_b_Social_h_CoAmb" id="t_b_Social_h_CoAmb"  placeholder="CO amb:"/>
                            </label>
                            <label class="label box box33">
                                <span class="legend">Tempo (min):</span>
                                <input type="text" name="t_b_Social_h_Tempo" id="t_b_Social_h_Tempo"  placeholder="COn:"/>
                            </label>
                            <label class="label box box33">
                                <span class="legend">Analisador:</span>
                                <input type="text" name="t_b_Social_h_Analisador" id="t_b_Social_h_Analisador"  placeholder="Analisador:"/>
                            </label>
                            <label class="label box box33">
                                <span class="legend">Número de série:</span>
                                <input type="text" name="t_b_Social_h_NumSerie" id="t_b_Social_h_NumSerie"  placeholder="número de série:"/>
                            </label>
                        </article>
                        <center><span id="t_salvar_banheiro_social" name="public" value="1" class="t_salvar_banheiro_social btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
                        <div class="clear"></div>
                    </div>
                </article>
            </div><!--- Fim modal aparelho-2 --->
            <div id="aparelho-3" class="modal" style="height: auto;">
               <article class="box box100">
                <header>
                    <h3 style="text-align: center;">Banheiro Suite</h3>
                </header>
                <div class="box_content">
                    <article class='box box100'>
                        <label class="label box box50">
                            <span class="legend">Tipo:</span>
                            <!--<input  type="text" id="t_b_SuiteTipo"  placeholder="Tipo:" required/>-->
                            <select id="t_b_SuiteTipo">
                                <option id="t_b_SuiteTipo_Selecione">Selecione um tipo</option>
                                <option value="Fogão">Fogão</option>
                                <option value="Churrasqueira">Churrasqueira</option>
                                <option value="Aquecedor">Aquecedor</option>
                            </select>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Marca:</span>
                            <input  type="text" id="t_b_SuiteMarca"  placeholder="Marca:" required/>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Modelo:</span>
                            <input  type="text" id="t_b_SuiteModelo"  placeholder="Modelo:" required/>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Pot nominal:</span>
                            <input  type="text" type="text" id="t_b_SuitePot" placeholder="Pot nominal:" required onkeypress='return SomenteNumero(event)'/>
                        </label>
                        <label class="label box box33">
                            <span class="legend">Funcionamento:</span>
                            <input type="radio" name="t_b_SuiteFuncionamento" value="Bom" style="width:5%"  />Bom
                            &ensp;
                            <input type="radio" name="t_b_SuiteFuncionamento" value="Ruim" style="width:5%"/>Ruim
                            &ensp;
                            <input type="radio" name="t_b_SuiteFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
                        </label>
                        <label class="label box box33">
                            <span class="legend">Tiragem:</span>
                            <input type="radio" name="t_b_SuiteTiragem" value="Natural" style="width:5%"  />Natural
                            &ensp;
                            <input type="radio" name="t_b_SuiteTiragem" value="Forçada" style="width:5%">Forçada
                        </label>
                        <label class="label box box33">
                            <span class="legend">Combustão:</span>
                            <input type="radio" name="t_b_SuiteCombustao" value="Aberta" style="width:5%"  />Aberta
                            &ensp;
                            <input type="radio" name="t_b_SuiteCombustao" value="Fechada" style="width:5%">Fechada
                        </label>
                        <header>
                         <h3 style="text-align: center;">Higiene da Combustão:</h3>
                     </header>
                     <br>
                     <label class="label box box33">
                        <span class="legend">Tiragem:</span>
                        <input type="text" name="t_b_Suite_h_Tiragem" id="t_b_Suite_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">COn:</span>
                        <input type="text" name="t_b_Suite_h_Con" id="t_b_Suite_h_Con" placeholder="COn:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">CO amb:</span>
                        <input type="text" name="t_b_Suite_h_CoAmb" id="t_b_Suite_h_CoAmb"  placeholder="CO amb:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">Tempo (min):</span>
                        <input type="text" name="t_b_Suite_h_Tempo" id="t_b_Suite_h_Tempo"  placeholder="COn:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">Analisador:</span>
                        <input type="text" name="t_b_Suite_h_Analisador" id="t_b_Suite_h_Analisador"  placeholder="Analisador:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">Número de série:</span>
                        <input type="text" name="t_b_Suite_h_NumSerie" id="t_b_Suite_h_NumSerie"  placeholder="número de série:"/>
                    </label>
                </article>
                        <center><span id="t_salvar_banheiro_suite" name="public" value="1" class="t_salvar_banheiro_suite btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
                        <div class="clear"></div>
                    </div>
                </article>
            </div><!--- Fim modal aparelho-3 --->
            <div id="aparelho-4" class="modal" style="height: auto;">
               <article class="box box100">
                <header>
                    <h3 style="text-align: center;">Banheiro Serviço</h3>
                </header>
                <div class="box_content">
                    <article class='box box100'>
                        <label class="label box box50">
                            <span class="legend">Tipo:</span>
                            <!--<input  type="text" id="t_b_ServicoTipo"  placeholder="Tipo:" required/>-->
                            <select id="t_b_ServicoTipo">
                                <option id="t_b_ServicoTipo_Selecione">Selecione um tipo</option>
                                <option value="Fogão">Fogão</option>
                                <option value="Churrasqueira">Churrasqueira</option>
                                <option value="Aquecedor">Aquecedor</option>
                            </select>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Marca:</span>
                            <input  type="text" id="t_b_ServicoMarca"  placeholder="Marca:" required/>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Modelo:</span>
                            <input  type="text" id="t_b_ServicoModelo"  placeholder="Modelo:" required/>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Pot nominal:</span>
                            <input  type="text" type="text" id="t_b_ServicoPot" placeholder="Pot nominal:" required onkeypress='return SomenteNumero(event)'/>
                        </label>
                        <label class="label box box33">
                            <span class="legend">Funcionamento:</span>
                            <input type="radio" name="t_b_ServicoFuncionamento" value="Bom" style="width:5%"  />Bom
                            &ensp;
                            <input type="radio" name="t_b_ServicoFuncionamento" value="Ruim" style="width:5%"/>Ruim
                            &ensp;
                            <input type="radio" name="t_b_ServicoFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
                        </label>
                        <label class="label box box33">
                            <span class="legend">Tiragem:</span>
                            <input type="radio" name="t_b_ServicoTiragem" value="Natural" style="width:5%"  />Natural
                            &ensp;
                            <input type="radio" name="t_b_ServicoTiragem" value="Forçada" style="width:5%">Forçada
                        </label>
                        <label class="label box box33">
                            <span class="legend">Combustão:</span>
                            <input type="radio" name="t_b_ServicoCombustao" value="Aberta" style="width:5%"  />Aberta
                            &ensp;
                            <input type="radio" name="t_b_ServicoCombustao" value="Fechada" style="width:5%">Fechada
                        </label>
                        <header>
                         <h3 style="text-align: center;">Higiene da Combustão:</h3>
                     </header>
                     <br>
                     <label class="label box box33">
                        <span class="legend">Tiragem:</span>
                        <input type="text" name="t_b_Servico_h_Tiragem" id="t_b_Servico_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">COn:</span>
                        <input type="text" name="t_b_Servico_h_Con" id="t_b_Servico_h_Con" placeholder="COn:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">CO amb:</span>
                        <input type="text" name="t_b_Servico_h_CoAmb" id="t_b_Servico_h_CoAmb"  placeholder="CO amb:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">Tempo (min):</span>
                        <input type="text" name="t_b_Servico_h_Tempo" id="t_b_Servico_h_Tempo"  placeholder="COn:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">Analisador:</span>
                        <input type="text" name="t_b_Servico_h_Analisador" id="t_b_Servico_h_Analisador"  placeholder="Analisador:"/>
                    </label>
                    <label class="label box box33">
                        <span class="legend">Número de série:</span>
                        <input type="text" name="t_b_Servico_h_NumSerie" id="t_b_Servico_h_NumSerie"  placeholder="número de série:"/>
                    </label>
                </article>
            <center><span id="t_salvar_banheiro_servico" name="public" value="1" class="t_salvar_banheiro_servico btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
            <div class="clear"></div>
        </div>
    </article>
</div><!--- Fim modal aparelho-4 --->
<div id="aparelho-5" class="modal" style="height: auto;">
    <article class="box box100">
        <header>
            <h3 style="text-align: center;">Área Serviço</h3>
        </header>
        <div class="box_content">
            <article class='box box100'>
                <label class="label box box50">
                    <span class="legend">Tipo:</span>
                    <!--<input  type="text" id="t_a_ServicoTipo"  placeholder="Tipo:" required/>-->
                    <select id="t_a_ServicoTipo">
                        <option id="t_a_ServicoTipo_Selecione">Selecione um tipo</option>
                        <option value="Fogão">Fogão</option>
                        <option value="Churrasqueira">Churrasqueira</option>
                        <option value="Aquecedor">Aquecedor</option>
                    </select>
                </label>
                <label class="label box box50">
                    <span class="legend">Marca:</span>
                    <input  type="text" id="t_a_ServicoMarca"  placeholder="Marca:" required/>
                </label>
                <label class="label box box50">
                    <span class="legend">Modelo:</span>
                    <input  type="text" id="t_a_ServicoModelo"  placeholder="Modelo:" required/>
                </label>
                <label class="label box box50">
                    <span class="legend">Pot nominal:</span>
                    <input  type="text" type="text" id="t_a_ServicoPot" placeholder="Pot nominal:" required onkeypress='return SomenteNumero(event)'/>
                </label>
                <label class="label box box33">
                    <span class="legend">Funcionamento:</span>
                    <input type="radio" name="t_a_ServicoFuncionamento" value="Bom" style="width:5%"  />Bom
                    &ensp;
                    <input type="radio" name="t_a_ServicoFuncionamento" value="Ruim" style="width:5%"/>Ruim
                    &ensp;
                    <input type="radio" name="t_a_ServicoFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
                </label>
                <label class="label box box33">
                    <span class="legend">Tiragem:</span>
                    <input type="radio" name="t_a_ServicoTiragem" value="Natural" style="width:5%"  />Natural
                    &ensp;
                    <input type="radio" name="t_a_ServicoTiragem" value="Forçada" style="width:5%">Forçada
                </label>
                <label class="label box box33">
                    <span class="legend">Combustão:</span>
                    <input type="radio" name="t_a_ServicoCombustao" value="Aberta" style="width:5%"  />Aberta
                    &ensp;
                    <input type="radio" name="t_a_ServicoCombustao" value="Fechada" style="width:5%">Fechada
                </label>
                <header>
                 <h3 style="text-align: center;">Higiene da Combustão:</h3>
             </header>
             <br>
             <label class="label box box33">
                <span class="legend">Tiragem:</span>
                <input type="text" name="t_a_Servico_h_Tiragem" id="t_a_Servico_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
            </label>
            <label class="label box box33">
                <span class="legend">COn:</span>
                <input type="text" name="t_a_Servico_h_Con" id="t_a_Servico_h_Con" placeholder="COn:"/>
            </label>
            <label class="label box box33">
                <span class="legend">CO amb:</span>
                <input type="text" name="t_a_Servico_h_CoAmb" id="t_a_Servico_h_CoAmb"  placeholder="CO amb:"/>
            </label>
            <label class="label box box33">
                <span class="legend">Tempo (min):</span>
                <input type="text" name="t_a_Servico_h_Tempo" id="t_a_Servico_h_Tempo"  placeholder="COn:"/>
            </label>
            <label class="label box box33">
                <span class="legend">Analisador:</span>
                <input type="text" name="t_a_Servico_h_Analisador" id="t_a_Servico_h_Analisador"  placeholder="Analisador:"/>
            </label>
            <label class="label box box33">
                <span class="legend">Número de série:</span>
                <input type="text" name="t_a_Servico_h_NumSerie" id="t_a_Servico_h_NumSerie"  placeholder="número de série:"/>
            </label>
        </article>
    <center><span id="t_salvar_area_servico" name="public" value="1" class="t_salvar_area_servico btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
    <div class="clear"></div>
</div>
</article>
</div><!--- Fim modal aparelho-5 --->
<div id="aparelho-6" class="modal" style="height: auto;">
  <article class="box box100">
    <header>
        <h3 style="text-align: center;">Outros Locais</h3>
    </header>
    <div class="box_content">
        <article class='box box100'>
            <label class="label box box50">
                <span class="legend">Tipo:</span>
                <!--<input  type="text" id="t_OutroTipo"  placeholder="Tipo:" required/>-->
                <select id="t_OutroTipo">
                    <option id="t_OutroTipo_Selecione">Selecione um tipo</option>
                    <option value="Fogão">Fogão</option>
                    <option value="Churrasqueira">Churrasqueira</option>
                    <option value="Aquecedor">Aquecedor</option>
                </select>
            </label>
            <label class="label box box50">
                <span class="legend">Marca:</span>
                <input  type="text" id="t_OutroMarca"  placeholder="Marca:" required/>
            </label>
            <label class="label box box50">
                <span class="legend">Modelo:</span>
                <input  type="text" id="t_OutroModelo"  placeholder="Modelo:" required/>
            </label>
            <label class="label box box50">
                <span class="legend">Pot nominal:</span>
                <input  type="text" type="text" id="t_OutroPot" placeholder="Pot nominal:" required onkeypress='return SomenteNumero(event)'/>
            </label>
            <label class="label box box33">
                <span class="legend">Funcionamento:</span>
                <input type="radio" name="t_OutroFuncionamento" value="Bom" style="width:5%"  />Bom
                &ensp;
                <input type="radio" name="t_OutroFuncionamento" value="Ruim" style="width:5%"/>Ruim
                &ensp;
                <input type="radio" name="t_OutroFuncionamento" value="Fora de uso" style="width:5%">Fora de uso
            </label>
            <label class="label box box33">
                <span class="legend">Tiragem:</span>
                <input type="radio" name="t_OutroTiragem" value="Natural" style="width:5%"  />Natural
                &ensp;
                <input type="radio" name="t_OutroTiragem" value="Forçada" style="width:5%">Forçada
            </label>
            <label class="label box box33">
                <span class="legend">Combustão:</span>
                <input type="radio" name="t_OutroCombustao" value="Aberta" style="width:5%"  />Aberta
                &ensp;
                <input type="radio" name="t_OutroCombustao" value="Fechada" style="width:5%">Fechada
            </label>
            <header>
             <h3 style="text-align: center;">Higiene da Combustão:</h3>
         </header>
         <br>
         <label class="label box box33">
            <span class="legend">Tiragem:</span>
            <input type="text" name="t_Outro_h_Tiragem" id="t_Outro_h_Tiragem" class="tiragem" placeholder="Tiragem:"/>
        </label>
        <label class="label box box33">
            <span class="legend">COn:</span>
            <input type="text" name="t_Outro_h_Con" id="t_Outro_h_Con" placeholder="COn:"/>
        </label>
        <label class="label box box33">
            <span class="legend">CO amb:</span>
            <input type="text" name="t_Outro_h_CoAmb" id="t_Outro_h_CoAmb"  placeholder="CO amb:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Tempo (min):</span>
            <input type="text" name="t_Outro_h_Tempo" id="t_Outro_h_Tempo"  placeholder="COn:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Analisador:</span>
            <input type="text" name="t_Outro_h_Analisador" id="t_Outro_h_Analisador"  placeholder="Analisador:"/>
        </label>
        <label class="label box box33">
            <span class="legend">Número de série:</span>
            <input type="text" name="t_Outro_h_NumSerie" id="t_Outro_h_NumSerie"  placeholder="número de série:"/>
        </label>
    </article>
<center><span id="t_salvar_outro" name="public" value="1" class="t_salvar_outro btn btn_darkblue icon-plus" style="margin-left: 5px;">Adicionar</span></center>
<div class="clear"></div>
</div>
</article>
</div><!--- Fim modal aparelho-6 --->
<div class="box box100">
       <div class="t_table_aparelhos" id="t_table_aparelhos" style="display: none;">
          <div class="tabela-responsivel" style="height: auto;">
           <table style="font-size: 90%;">
            <thead>
                <tr>
                   <th style="text-align: center;">Aparelho</th>
                   <th style="text-align: center;">Local</th>
                    <th style="text-align: center;">Tipo</th>
                    <th style="text-align: center;">Marca</th>
                    <th style="text-align: center;">Modelo</th>
                    <th style="text-align: center;">POT Nominal</th>
                    <th style="text-align: center;">Funcionamento</th>
                    <th style="text-align: center;">Tiragem</th>
                    <th style="text-align: center;">Combustão</th>
                    <th style="text-align: center;">H. Tiragem</th>
                    <th style="text-align: center;">H. CON</th>
                    <th style="text-align: center;">H. CO AMB</th>
                    <th style="text-align: center;">Tempo</th>
                    <th style="text-align: center;">Analisador</th>
                    <th style="text-align: center;">Núm. Série</th>
                    <th style="text-align: center;">Ação</th>
                </tr>
            </thead>
            <tbody id="t_tabela_aparelhos" >  

            </tbody>
        </table>
    </div>
    <br>
</div>


</div>
     </div><!---- Final da div id="tipo-servico" ---->
