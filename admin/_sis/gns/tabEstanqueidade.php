 
    <h4 class="icon-user-plus">Teste de Estanquidade</h4>
                    <div id="tipo-servico">
                            <input type="hidden" name="callback" value="Dadostabela"/>
                            <input type="hidden" name="callback_action" value="dados_formulario"/>
                     <div class="hiddens">

                     </div>
                        <label class="label box box100">
                            <span class="legend">Nº do Manometro:</span>
                            <select value="" type="text" name="t_num_manometro" >
                                <option selected disabled value="">Selecione o Nº do Manometro:</option>
                                <?php
                                $Read->FullRead("SELECT Id AS id, CODIGO AS codigo, PRODUTO AS manometro
                                 FROM [40_Produtos]
                                 WHERE (PRODUTO LIKE N'%MANÔMETRO%') AND CODIGO IS NOT NULL"," ");
                                if ($Read->getResult()):
                                    foreach ($Read->getResult() as $manometro):
                                        echo "<option value='{$manometro['id']}' name='{$manometro['codigo']}'>{$manometro['codigo']} - {$manometro['manometro']}</option>";
                                    endforeach;
                                endif;

                                ?>
                            </select>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Pressão Inicial:</span>
                            <input type="text" name="t_p_inicial" id="t_p_inicial" class="t_p_inicial" placeholder="Inicial:" />
                        </label>
                        <label class="label box box50">
                            <span class="legend">Pressão Final:</span>
                            <input type="text" name="t_p_Final" id="t_p_Final" class="t_p_Final" placeholder="Final:" />
                        </label>
                        <label class="label box box100">
                            <span class="legend">Tempo do teste:</span>
                            <input type="text" name="t_tempo_teste" id="t_tempo_teste" class="t_tempo_teste"  placeholder="Tempo:" />
                        </label>
                        <label class="label box box100">
                            <span class="legend">Status:</span>

                            <span><input id="ok" type="radio" name="t_1status" value="ok" style="width:5%" checked />Ok</span>
                            <span><input id="vazamento" type="radio" name="t_1status" value="vazamento" style="width:5%">Vazamento</span>
                            <br>
                            <br>
                            <span class="t_vazamento-L" style="display:none;"><input style="width:5%;" id="menor-5L" type="radio" name="t_2status" value="Menor 5L">Menor 5L</span>
                            <span class="t_vazamento-L" style="display:none;"><input style="width:5%;" id="maior-5L" type="radio" name="t_2status" value="Maior 5L">Maior 5L</span>
                        
                        </label>
                        <label id="status-ocorrencia" class="label box box100" style="display:none">
                            <span class="legend">Nº Ocorrência:</span>
                            <input type="text" name="t_num_ocorrencia" id="t_num_ocorrencia" class="t_num_ocorrencia"  placeholder="ocorrência:" />
                        </label>
                        <label class="label box box50">
                            <span class="legend">Dados do Medidor:</span>
                            <input type="file" name="t_foto_dados_medidor" id="t_foto_dados_medidor" class="t_foto_dados_medidor" class="wc_loadimage" multiple/>
                        </label>
                        <label class="label box box50">
                            <span class="legend">Foto Situação do Serviço:</span>
                            <input type="file" name="t_foto_servico" id="t_foto_servico" class="t_foto_servico" class="wc_loadimage" multiple/>
                        </label>

                        <label class="label box box100">
                            <span class="legend">Aparelhos no Local:</span>
                            <a class="btn btn_darkblue t_aparelho1" href="#aparelho-1" rel="modal:open"><i class="icon-plus"></i><span contador="0" id="t_aparelho1">Cozinha (0)</span></a>
                            <a class="btn btn_darkblue t_aparelho2" href="#aparelho-2" rel="modal:open"><i class="icon-plus"></i><span contador="0" id="t_aparelho2"> Banheiro Social (0)</span></a>
                            <a class="btn btn_darkblue t_aparelho3" href="#aparelho-3" rel="modal:open"><i class="icon-plus"></i><span contador="0" id="t_aparelho3"> Banheiro Suíte (0)</span></a>
                            <a class="btn btn_darkblue t_aparelho4" href="#aparelho-4" rel="modal:open"><i class="icon-plus"></i><span contador="0" id="t_aparelho4"> Banheiro Serviço (0)</span></a>
                            <a class="btn btn_darkblue t_aparelho5" href="#aparelho-5" rel="modal:open"><i class="icon-plus"></i><span contador="0" id="t_aparelho5"> Área Serviço (0)</span></a>
                            <a class="btn btn_darkblue t_aparelho6" href="#aparelho-6" rel="modal:open"><i class="icon-plus"></i><span contador="0" id="t_aparelho6"> Outros (0)</span></a>
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
                                        <input  type="text" name="t_cozinhaTipo" id="t_cozinhaTipo"  placeholder="Tipo:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Marca:</span>
                                        <input  type="text" name="t_cozinhaMarca" id="t_cozinhaMarca"  placeholder="Marca:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Modelo:</span>
                                        <input  type="text" name="t_cozinhaModelo" id="t_cozinhaModelo"  placeholder="Modelo:" required/>
                                    </label>
                                    <label class="label box box50">
                                        <span class="legend">Pot nominal:</span>
                                        <input  type="text" type="text" name="t_cozinhaPot" id="t_cozinhaPot" placeholder="Pot nominal:" required/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_cozinhaFuncionamento"  value="Bom" style="width:5%" checked />Bom
                                        <input type="radio" name="t_cozinhaFuncionamento"  value="Ruim" style="width:5%"/>Ruim
                                        <input type="radio" name="t_cozinhaFuncionamento"   value="Fora de uso" style="width:5%" />Fora de uso
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
                                        <input type="text" name="t_b_SocialPot" id="t_b_SocialPot" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="t_b_SocialTiragem" value="Natural" style="width:5%" checked />Natural
                                        <input type="radio" name="t_b_SocialTiragem" value="Forçada" style="width:5%">Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="t_b_SocialCombustao" value="Aberta" style="width:5%" checked />Aberta
                                        <input type="radio" name="t_b_SocialCombustao" value="Fechada" style="width:5%">Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_b_SocialFuncionamento" value="Bom" style="width:5%" checked />Bom
                                        <input type="radio" name="t_b_SocialFuncionamento" value="Ruim" style="width:5%"/>Ruim
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
                                        <input type="text" name="t_b_SuitePot" id="t_b_SuitePot" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="t_b_SuiteTiragem" value="Natural" style="width:5%" checked />Natural
                                        <input type="radio" name="t_b_SuiteTiragem" value="Forçada" style="width:5%" />Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="t_b_SuiteCombustao" value="Aberta" style="width:5%" checked />Aberta
                                        <input type="radio" name="t_b_SuiteCombustao" value="Fechada" style="width:5%" />Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_b_SuiteFuncionamento" value="Bom" style="width:5%" checked />Bom
                                        <input type="radio" name="t_b_SuiteFuncionamento" value="Ruim" style="width:5%"/>Ruim
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
                                        <input type="text" name="t_b_ServicoPot" id="t_b_ServicoPot" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="t_b_ServicoTiragem" value="Natural" style="width:5%" checked />Natural
                                        <input type="radio" name="t_b_ServicoTiragem" value="Forçada" style="width:5%"  />Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="t_b_ServicoCombustao" value="Aberta" style="width:5%" checked />Aberta
                                        <input type="radio" name="t_b_ServicoCombustao" value="Fechada" style="width:5%" />Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_b_ServicoFuncionamento" value="Bom" style="width:5%" checked />Bom
                                        <input type="radio" name="t_b_ServicoFuncionamento" value="Ruim" style="width:5%" />Ruim
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
                                        <input type="text" name="t_a_ServicoPot" id="t_a_ServicoPot" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="t_a_ServicoTiragem" value="Natural" style="width:5%" checked />Natural
                                        <input type="radio" name="t_a_ServicoTiragem" value="Forçada" style="width:5%"  />Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="t_a_ServicoCombustao" value="Aberta" style="width:5%" checked />Aberta
                                        <input type="radio" name="t_a_ServicoCombustao" value="Fechada" style="width:5%" />Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_a_ServicoFuncionamento" value="Bom" style="width:5%" checked />Bom
                                        <input type="radio" name="t_a_ServicoFuncionamento" value="Ruim" style="width:5%" />Ruim
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
                                        <input type="text" name="t_OutroPot" id="t_OutroPot" placeholder="Pot nominal:"/>
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Tiragem:</span>
                                        <input type="radio" name="t_OutroTiragem" value="Natural" style="width:5%" checked />Natural
                                        <input type="radio" name="t_OutroTiragem" value="Forçada" style="width:5%"  />Forçada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Combustão:</span>
                                        <input type="radio" name="t_OutroCombustao" value="Aberta" style="width:5%" checked />Aberta
                                        <input type="radio" name="t_OutroCombustao" value="Fechada" style="width:5%" />Fechada
                                    </label>
                                    <label class="label box box100">
                                        <span class="legend">Funcionamento:</span>
                                        <input type="radio" name="t_OutroFuncionamento" value="Bom" style="width:5%" checked />Bom
                                        <input type="radio" name="t_OutroFuncionamento" value="Ruim" style="width:5%" />Ruim
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
                               <center><span name="public" value="1" class="btn btn_darkblue  icon-plus t_salvar_outro" style="margin-left: 5px;" id="t_salvar_outro" >Adicionar</span>
                                <div class="clear"></div></center>
                            </div>
                        </article>
                        </div><!--- Fim modal aparelho-6 --->
            </div><!---- Final da div id="tipo-servico" ---->