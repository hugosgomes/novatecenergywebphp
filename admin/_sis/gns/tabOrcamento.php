    
<?php
  $Read->FullRead("SELECT [ID],[EMPRESA],[DATA DE ADMISSÃO] FROM [Funcionários] WHERE [ID] = :id", "id={$_SESSION['userLogin']['ID']}");
  $NOME = $Read->getResult()[0];
?>
    <input type="hidden" name="USUARIOSISTEMA" value="<?php echo $NOME['ID'] ?>">
    <input type="hidden" name="EMPRESA" value="<?php echo $NOME['EMPRESA'] ?>">
    <div id="orcamento"/>
        <label class="label box box100">
             <div class="box box50">
                 <div class="box box50" style="">
                     <label class="label">
                        <span class="legend">Pesquisar Peças</span>
                         <select rel="0" id="o_peca" name="">
                                <option disabled="disabled" selected value="t">SELECIONAR PEÇA</option>         
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Peca] AS peca, [ValorFinal] AS valor FROM [60_Pecas]", " ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $PECAS):
                            echo "<option  id='{$PECAS['id']}'' value='{$PECAS['valor']}'>{$PECAS['peca']}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div> 
                 <div class="box box14">
                     <label class="label">
                        <span class="legend">Qtd.</span>
                        <input id="o_qtd-pecas" name="" type="number" style="font-size: 1.0em;"  class="j_qtd_pecas" min="1" value="1"  />
                    </label>    
                 </div>
                 <div class="box box15">
                     <span class="legend"></span>
                     <label>
                        <span class="j_add_pecas icon-plus btn btn_green" style="height: 35px;margin-top: 14px; callback="Dadostabela" callback_action="consulta">Add Peças</span>
                     </label>
                 </div>    
                 </div>
                <div class="box box50" style="padding-top: 12px;">
                <div class="box box50" id="o_cliente_sem_plano" style="display:none">
                     <label class="label">
                        <span class="legend">Pesquisar Serviços </span>
                         <select id="o_servicos_s_com_p" rel="0" class="j_consulta" callback="Dadostabela" callback_action="consulta" >   <option disabled="disabled" selected value="t">SELECIONAR SERVIÇO</option>
                        <?php
                        $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos]"," ");
                        if ($Read->getResult()):
                          foreach ($Read->getResult() as $SERVICOS):
                            if($SERVICOS['valorcliente'] > 0):
                              echo "<option id='{$SERVICOS['id']}' value='{$SERVICOS['valorcliente']}'>{$SERVICOS['descricao']}</option>";
                            endif;
                        endforeach;
                    endif;
                    ?>
                </select>
                    </label>    
                 </div>
                 <div class="box box50" id="o_cliente_com_plano">
                   <label class="label">
                    <span class="legend">Pesquisar Serviços</span>
                    <select id="o_servicos_c_com_p" name="" rel="0" class="j_consulta" callback="Dadostabela" callback_action="consulta" > 
                      <option disabled="disabled" selected value="t">SELECIONAR SERVIÇO</option>  
                      <?php
                      $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos]"," ");
                      if ($Read->getResult()):
                        foreach ($Read->getResult() as $SERVICOS):
                          if($SERVICOS['valorcliente'] > 0):
                            echo "<option id='{$SERVICOS['id']}' value='{$SERVICOS['valorclientepag']}'>{$SERVICOS['descricao']}</option>";
                          endif;
                        endforeach;
                      endif;
                      ?>
                    </select>
                  </label>    
                </div> 
                 <div class="box box14">
                     <label class="label">
                        <span class="legend">Qtd.</span>
                        <input min="1" id="o_qtd_servicos" name="" type="number" style="font-size: 1.0em;" class="j_consulta" callback="Dadostabela" callback_action="consulta" value="1" />
                    </label>    
                 </div> 
                 <div class="box box15">
                    <span class="legend"></span>
                    <button class="j_add_servicos btn btn_green" style="height: 35px;margin-top: 14px;"><span class="icon-plus"></span>Add Serviços</button>
                 </div>    
                 </div>
                 <table id="o_tabela-pecasEservicos" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th colspan="6" style="text-align: center">Tabela Orçamento</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Descrição</th>
                            <th style="text-align: center;">Qtd</th>
                            <th style="text-align: center;">R$ unit</th>
                            <th style="text-align: center;">R$ total</th>
                            <th style="text-align: center;">Aprovado</th>
                            <th style="text-align: center;">Remover</th>
                        </tr>
                    </thead>
                        <!--- linhas adicionadas via Jquery --->
                    <tbody>
                    </tbody>
                </table>
                  <div class="box box33">
                    <center><label class="label">
                      <p style="font-size:20px;padding-top: 10px;font-weight: bold;font-style: italic">Total Aprovado: R$ <span class="valor-total"><!-- valor total table --></span></p>
                    </label></center>
                  </div>
                  <div class="box box33">
                    <center><label class="label">
                      <p id="valor-parcelas" style="font-size:20px;padding-top: 10px;font-weight: bold;font-style: italic;display:none">Valor Parcelas: R$ <span class="valor-parcelas">0</span></p>
                    </label></center>
                  </div>
                  <div class="box box33">
                    <center><label class="label">
                      <p style="font-size:20px;padding-top: 10px;font-weight: bold;font-style: italic;color: red;">Total Reprovado: R$ <span class="valor-total-r"><!-- valor total table --></span></p>
                    </label></center>
                  </div>
                <input id="valor-total" type="hidden" name="o_valor_total_orcamento" value="0"/>
                <input id="valor-total-reprovado" type="hidden" name="o_valor_total_orcamento_r" value="0"/>

                <span class="o_p_hidden" value="0"><!--valor total peças--></span>
                <span class="o_s_hidden" value="0"><!--valor total serviços--></span><br>
                <span class="o_p_total_linhas"><!--total de linhas p--><input type="hidden" value="0" name="o_p_total_linhas"></span>
                <span class="o_s_total_linhas"><!--total de linhas s--><input type="hidden" value="0" name="o_s_total_linhas"></span>


            <br/>
              <div class="box box100">
                  <div class="box box50 forma-pagamento" id="o_forma_de_pagamento" style="display:none">
                      <label class="label">
                        <span class="legend" >Forma de Pagamento</span>
                        <select id="o_forma_de_pagamento_select" name="o_forma_de_pagamento" class="o_forma_de_pagamento_select"  style="font-family: Arial;font-size: 11px;">
                          <option disabled selected="selected" value="t">SELECIONAR FORMA DE PAGAMENTO</option>
                          <option value="0">À VISTA</option>
                          <option value="1">PARCELADO</option>
                        </select>
                      </label>
                  </div>
                  <div id="o_quant_parcelas" class="box box50" style="display:none">
                  <span class="legend">Número de Parcelas</span>
                  <span><input class="o_parcelas" id="o_parcelas-3" type="radio" name="O_quant_parcelas" value="3" style="width:5%">3 parcelas</span>
                  <span><input class="o_parcelas" id="o_parcelas-6" type="radio" name="O_quant_parcelas" value="6" style="width:5%">6 parcelas</span>
                  <span><input class="o_parcelas" id="o_parcelas-12" type="radio" name="O_quant_parcelas" value="12" style="width:5%">12 parcelas</span>
                  <label>
                      <span><input class="o_parcelas" id="o_parcelas_maior_12" type="radio" name="O_quant_parcelas" value="13" style="width:5%">Mais parcelas (autorização do supervisor)</span>

                      <input id="o_parcelas-seleciona" type="number" name=""  min="13"  style="display:none;width:12%;height:20px">
                  </label>
              </div>
            </div>
                <div class="box box50 status-orcamento">
                    <label class="label">
                      <span class="legend" >Status do Orçamento:</span>
                      <select id="" class="o_aprovado_reprovado" name="o_orcamento_status" style="font-family: Arial;font-size: 11px;">
                         <option  selected="selected" value="t">SELECIONAR O STATUS DO ORÇAMENTO</option>
                        <?php 
                        foreach (getStatusOrcamentoGNS($Transaction = null) as $key => $value) {
                          echo $key == 4 ? " " : "<option value='{$key}'>$value</option>";
                        }
                        ?>
                      </select>
                    </label>
                </div>
                <div class="box box15 data-agendamento" style="display:none">
                    <label class="label">
                      <span class="legend">Data do Agendamento:</span>
                      <input type="text" name="o_data_agendamento" class="jwc_datepicker o_data" placeholder="Data do agendamento"/>
                    </label>
                </div>

            <br/>

            <div class="box box100" id="o_cliente_com_plano" style="">
                <label class="label">
                    <div class="box box33">
                      <span class="legend">Nome do Contato</span>
                      <input type="text" name="NomeContato" placeholder="Nome do contato">
                    </div>
                    <div class="box box33">
                      <span class="legend">Telefone do Contato</span>
                      <input class="formPhone" type="text" name="TelContato" placeholder="Telefone">
                    </div>
                    <div class="box box33">
                      <span class="legend">CPF do cotnato</span>
                      <input class="formCpf" type="text" name="CPFContato" placeholder="Nº CPF">
                    </div>
                  <br><br>
                </label>    
            </div> 
    
           </div>