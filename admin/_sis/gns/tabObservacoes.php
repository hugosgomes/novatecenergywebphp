<div id="observacoes"/>
    <h4 class="">Observações</h4>
    <label class="label box box100">
        <span><textarea name="Obs"></textarea></span>
    </label>
</div>
<div class="box box100 ">
    <label class="label">
    	<span class="legend termo-respon" style="display:none">Serviço de Origem:</span>
    	<select class="t_o_os" style="display:none">
    		<?php
                $Read->FullRead("SELECT [NomeOs] FROM [BDNVT].[dbo].[60_OS] WHERE {$IdOS} = [OT] AND [NomeOs] = 'Assistencia Tecnica' OR {$IdOS} = [OT] AND [NomeOs] = 'Assistencia domiciliar gas' OR {$IdOS} = [OT] AND [NomeOs] = 'Revisao preventiva anual' OR {$IdOS} = [OT] AND [NomeOs] = 'Visita de manutencao periodica' OR {$IdOS} = [OT] AND [NomeOs] = 'Visita tecnica' OR {$IdOS} = [OT] AND [NomeOs] = 'Visita de venda de equipamento'","");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $NomeOs):
                        echo "<option value='{$IdOS}' name='{$NomeOs['NomeOs']}'>{$NomeOs['NomeOs']}</option>";
                    endforeach;
                endif;
                ?>
    	</select>
    	<p class="decla" style="display:none">Declaro que os itens abaixo encontram-se adequados conforme aprovado no serviço acima realizado, e estou ciente de que os mesmos não devem ser alterados, e que a alteração deste coloca em risco a segurança na utilização do abastecimento a gás</p>
    	<div class="box box100">
    		<table class="t_responsabilidade" style="display:none">
    			<thead>
    				<td></td>
    				<th>Assinalar</th>
    				<th>Situação executada/existente</th>
    				<th colspan="6">Local</th>
    			</thead>
    			<tbody>
    				<tr>
    					<td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                        <td style="text-align: center;">4</td>
                        <td style="text-align: center;">5</td>
                        <td style="text-align: center;">6</td>
                    </tr>
    				<tr id="o_vp_superior1">
    					<td style="text-align: center;">1</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_vp_superior0" value="Ventilação permanente superior"></td>
    					<td>
    						<input class="o_tr_local o_tr_local1" type="checkbox" name="o_vp_superior1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local1" type="checkbox" name="o_vp_superior2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local1" type="checkbox" name="o_vp_superior3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local1" type="checkbox" name="o_vp_superior4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local1" type="checkbox" name="o_vp_superior5" value="área serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local1" type="checkbox" name="o_vp_superior6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_vp_inferior1">
    					<td style="text-align: center;">2</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_vp_inferior0" value="Ventilação permanente inferior"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_vp" type="checkbox" name="o_vp_inferior1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_vp" type="checkbox" name="o_vp_inferior2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_vp" type="checkbox" name="o_vp_inferior3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_vp" type="checkbox" name="o_vp_inferior4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_vp" type="checkbox" name="o_vp_inferior5" value="área serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_vp" type="checkbox" name="o_vp_inferior6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_ra_adequado1">
    					<td style="text-align: center;">3</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_ra_adequado0" value="Registro de aparelho adequado"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_ra" type="checkbox" name="o_ra_adequado1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_ra" type="checkbox" name="o_ra_adequado2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_ra" type="checkbox" name="o_ra_adequado3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_ra" type="checkbox" name="o_ra_adequado4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_ra" type="checkbox" name="o_ra_adequado5" value="área de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_ra" type="checkbox" name="o_ra_adequado6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_c_adequada1">
    					<td style="text-align: center;">4</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_c_adequada0" value="Chaminé adequada"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_c" type="checkbox" name="o_c_adequada1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_c" type="checkbox" name="o_c_adequada2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_c" type="checkbox" name="o_c_adequada3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_c" type="checkbox" name="o_c_adequada4" value="banheiro serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_c" type="checkbox" name="o_c_adequada5" value="área de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_c" type="checkbox" name="o_c_adequada6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_tf_adequada1">
    					<td style="text-align: center;">5</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_tf_adequada0" value="Tubo flexível adequado"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_tf" type="checkbox" name="o_tf_adequada1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_tf" type="checkbox" name="o_tf_adequada2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_tf" type="checkbox" name="o_tf_adequada3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_tf" type="checkbox" name="o_tf_adequada4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_tf" type="checkbox" name="o_tf_adequada5" value="área de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_tf" type="checkbox" name="o_tf_adequada6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_t_chamine1">
    					<td style="text-align: center;">6</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_t_chamine0" value="Terminal de chaminé"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_t" type="checkbox" name="o_t_chamine1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_t" type="checkbox" name="o_t_chamine2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_t" type="checkbox" name="o_t_chamine3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_t" type="checkbox" name="o_t_chamine4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_t" type="checkbox" name="o_t_chamine5" value="área de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_t" type="checkbox" name="o_t_chamine6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_a_aberta1">
    					<td style="text-align: center;">7</td>
    					<td><input class="o_tr_assinalar" type="checkbox" name=""></td>
    					<td><input class="situacao" type="text" name="o_a_aberta0" value="Área aberta"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_a" type="checkbox" name="o_a_aberta1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_a" type="checkbox" name="o_a_aberta2" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_a" type="checkbox" name="o_a_aberta3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_a" type="checkbox" name="o_a_aberta4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_a" type="checkbox" name="o_a_aberta5" value="área de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_a" type="checkbox" name="o_a_aberta6" value="outro">
    					</td>
    				</tr>
    				<tr id="o_outros1">
    					<td style="text-align: center;">8</td>
    					<td><input class="o_tr_assinalar" class="o_tr_local" type="checkbox" name=""></td>
    					<td><input class="situacao o" type="text" name="o_outros0" value="Outros"></td>
    					<td>
    						<input class="o_tr_local o_tr_local_outr" type="checkbox" name="o_outros1" value="cozinha">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_outr" type="checkbox" name="o_outros3" value="banheiro social">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_outr" type="checkbox" name="o_outros3" value="banheiro suíte">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_outr" type="checkbox" name="o_outros4" value="banheiro de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_outr" type="checkbox" name="o_outros5" value="área de serviço">
    					</td>
    					<td>
    						<input class="o_tr_local o_tr_local_outr" type="checkbox" name="o_outros6" value="outro">
    					</td>
    				</tr>
    			</tbody>
    		</table>
    		<ul id="legenda" style="display:none">
    			<li style="display:inline-block;margin-right: 5px"><strong>1</strong> cozinha</li>
    			<li style="display:inline-block;margin-right: 5px"><strong>2</strong> banheiro social</li>
    			<li style="display:inline-block;margin-right: 5px"><strong>3</strong> banheiro suíte</li>
    			<li style="display:inline-block;margin-right: 5px"><strong>4</strong> banheiro de serviço</li>
    			<li style="display:inline-block;margin-right: 5px"><strong>5</strong> área de serviço</li>
    			<li style="display:inline-block;margin-right: 5px"><strong>6</strong> outro</li>
    		</ul>
    </label>
</div>

<label class="label box box20 imagens-os" style="display:none" id="imagens-os-ass-c">
    <span class="legend"><b>Foto assinatura do cliente:</b></span>
    <input type="file" name="asscliente_fotos_arquivos[]" class="wc_loadimage" multiple/>
    <div class="dados_medidor">

    </div>
</label>
<label class="label box box20 imagens-os" style="display:none" id="imagens-os-ass-t">
    <span class="legend"><b>Foto assinatura do técnico:</b></span>
    <input type="file" name="asstecnico_fotos_arquivos[]" class="wc_loadimage" multiple/>
    <div class="dados_medidor">

    </div>
</label>
<label class="label box box20 imagens-os" style="display:none" id="imagens-os-local">
    <span class="legend"><b>Fotos do local:</b></span>
    <input type="file" name="local_fotos_arquivos[]" class="wc_loadimage" multiple/>
    <div class="dados_medidor">

    </div>
</label>
<div class="box box20 status-os">
    <label class="label">
      <span class="legend" >Status da OS:</span>
      <select id="" class="o_os_status" name="o_os_status" style="font-family: Arial;font-size: 11px;">
          <option disabled selected="selected" value="t">SELECIONAR O STATUS DA OS</option>
        <?php 
        foreach (getNovoStatusOs($Transaction = null) as $key => $value) {
          echo $key == 6 || $key == 5 || $key == 4 ? "" : "<option value='{$key}'>$value</option>";
        }
        ?>
      </select>
    </label>
</div>
<div class="box box10 status-os" style="padding-top:26px">
    <label class="label">
		<span id="j_btn_salvar" name="" class="btn btn_darkblue fl_left icon-share" style="height:35px">Finalizar</span>
	</label>
</div>