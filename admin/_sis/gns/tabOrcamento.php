     <div id="orcamento"/>
        <h4 class="icon-user-plus">Orçamento</h4>
        <label class="label box box100">
             <div class="box box100">
                 <div class="box box33">
                     <label class="label">
                        <span class="legend">Pesquisar Peças</span>
                         <select rel="0" id="o_peca" name="o_peca">
                                    
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Peca] AS peca, [ValorFinal] AS valor FROM [60_Pecas]", " ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $PECAS):
                            echo "<option  id='{$PECAS['valor']}'' value='{$PECAS['id']}'>{$PECAS['peca']}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div> 
                 <div class="box box14">
                     <label class="label">
                        <span class="legend">Qtd.</span>
                        <input id="o_qtd-pecas" type="number" style="font-size: 1.0em;"  class="j_qtd_pecas" min="1" value="1"  />
                    </label>    
                 </div>
                 <div class="box box14">
                     <span class="legend"></span>
                     <label>
                        <span class="j_add_pecas icon-plus btn btn_darkblue" style="height: 35px;margin-top: 14px; callback="Dadostabela" callback_action="consulta">Add Peças</span>
                     </label>
                 </div>    
                 </div>

                <div class="box box100">
                <div class="">
                    <span class="legend">Cliente tem plano ?</span>
                    <span><input class="o_tipoCliente" id="orc-aprovado" type="radio" name="status" value="o_tipoClienteCp" style="width:5%" checked>Sim</span>
                    <span><input class="o_tipoCliente" id="orc-reprovado" type="radio" name="status" value="o_tipoClienteSp" style="width:5%">Não</span>
                </div>
                <div class="box box33" id="o_cliente_sem_plano" style="display:none">
                     <label class="label">
                        <span class="legend">Pesquisar Serviços / sem plano</span>
                         <select id="o_servicos_s_com_p" rel="0" class="j_consulta" callback="Dadostabela" callback_action="consulta" >   
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos]"," ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $SERVICOS):
                            echo "<option id='{$SERVICOS['valorcliente']}' value='{$SERVICOS['id']}'>{$SERVICOS['descricao']}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div>
                 <div class="box box33" id="o_cliente_com_plano">
                     <label class="label">
                        <span class="legend">Pesquisar Serviços / com plano</span>
                         <select id="o_servicos_c_com_p" rel="0" class="j_consulta" callback="Dadostabela" callback_action="consulta" >   
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos]"," ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $SERVICOS):
                            echo "<option id='{$SERVICOS['valorclientepag']}' value='{$SERVICOS['id']}'>{$SERVICOS['descricao']}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div> 
                 <div class="box box14">
                     <label class="label">
                        <span class="legend">Qtd.</span>
                        <input min="1" id="o_qtd_servicos" type="number" style="font-size: 1.0em;" class="j_consulta" callback="Dadostabela" callback_action="consulta" value="1"  />
                    </label>    
                 </div> 
                 <div class="box box14">

                     <span class="legend"></span>
                    <button class="j_add_servicos btn btn_darkblue" style="height: 35px;margin-top: 14px;"><span class="icon-plus"></span>Add Serviços</button>
                 </div>    
                 </div>
                 <table id="o_tabela-pecasEservicos">
                    <thead>
                        <tr>
                            <th colspan="5" style="text-align: center">Tabela Orçamento</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Descrição</th>
                            <th style="text-align: center;">Qtd</th>
                            <th style="text-align: center;">R$ unit</th>
                            <th style="text-align: center;">R$ total</th>
                            <th style="text-align: center;">Remover</th>
                        </tr>
                    </thead>
                        <!--- linhas adicionadas via Jquery --->
                    <tbody>
                    </tbody>
                </table>
                <p style="font-size:20px;padding-top: 10px;">valor total: R$ <span class="valor-total"><!-- valor total table --></span></p>

            <br/>

            <div class="">
                <span class="legend">Orçamento Aprovado ?:</span>
                <span><input id="o_aprovado" class="o_aprovado_reprovado" type="radio" name="status" value="o_aprovado" style="width:5%">Sim</span>
                <span><input id="o_reprovado" class="o_aprovado_reprovado" type="radio" name="status" value="o_reprovado" style="width:5%">Não</span>
            </div>

            <div id="o_forma-pgt" style="display:none">
                <span class="legend">Forma de Pagamento:</span>
                <span><input id="o_parcelas-1" type="radio" name="o_parcelas" value="o_parcelas-1" style="width:5%" checked>á vista</span>
                <span><input id="o_parcelas-3" type="radio" name="o_parcelas" value="o_parcelas-3" style="width:5%">3 parcelas</span>
                <span><input id="o_parcelas-6" type="radio" name="o_parcelas" value="o_parcelas-6" style="width:5%">6 parcelas</span>
                <span><input id="o_parcelas-12" type="radio" name="o_parcelas" value="o_parcelas-12" style="width:5%">12 parcelas</span>
                <label>
                    <span><input id="o_parcelas_maior_12" type="radio" name="o_parcelas" value="o_parcelas_maior_12" style="width:5%">Mais parcelas (autorização do supervisor)</span>
                    <input id="o_parcelas-seleciona" type="number" name="status" value="" min="13"  style="width:5%;height:20px">
                </label>
            </div><br/>

            <div class="box box33" id="o_cliente_com_plano" style="">
               <label class="label">
                <span class="legend">Tipo de Contato</span>
                <select id="o_contato" rel="0" class="">   
                    <option id="" value="">contato1</option>
                    <option id="" value="">contato2</option>
                    <option id="" value="">contato3</option>
                </select><br><br>
                <textarea class="" id="" placeholder="Observações"></textarea>
                <br><br>
                <span id="" name="" class="btn btn_darkblue fl_left icon-share" style="height:35px">Finalizar</span>
        </label>    
    </div> 
    
           </div>