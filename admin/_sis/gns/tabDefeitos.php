
<style type="text/css">
.invisivel{
    display:none;
}
</style>


<div class="d_hiddens">
</div>

<div id="servicos-defeitos"/>
<h4>Instalação com Defeito?</h4>
<label class="label box box100">
    <span><input id="instalacao-ok" type="radio" name="status" value="Sim" style="width:5%">Sim</span>
    <span><input id="instalacao-defeito" type="radio" name="status" value="Não" style="width:5%">Não</span>
    <div id="dados-do-def"  style="display:none">
        <label id="foto-defeito" class="label box box50" style="display:none">
            <span class="legend">Foto Defeitos:</span>
            <input type="file" name="defeitos_fotos_arquivos[]" class="wc_loadimage" multiple/>
        </label>
        <div class="defeitos_arquivos">

        </div>
        <label class="label box box100">
            <a class="btn btn_darkblue" href="#dist-interna" rel="modal:open"><i class="icon-share"></i>Distribuição interna</a>
            <a class="btn btn_darkblue" href="#Ap-gas" rel="modal:open"><i class="icon-share"></i>Aparelhos a Gás</a>
            <a class="btn btn_darkblue" href="#liga-ap" rel="modal:open"><i class="icon-share"></i>Ligações dos Aparelhos a Gás</a>
            <a class="btn btn_darkblue" href="#ind-exaust" rel="modal:open"><i class="icon-share"></i>Individual de Exautão Natural e Forçada</a>
            <a class="btn btn_darkblue" href="#cole-exaust" rel="modal:open"><i class="icon-share"></i>Coletivo de Exautão Natural e Forçada</a>
            <a class="btn btn_darkblue" href="#caract-h" rel="modal:open"><i class="icon-share"></i>Características Higiênicas da Combustão</a>
            <a class="btn btn_darkblue" href="#reco" rel="modal:open"><i class="icon-share"></i>Recomendações</a>
        </label>
    </div>
</label>

</div>

<div class="box50">
    <table id="d_DefeitosSalvos" style="display:none">
        <thead>
            <tr>
                <th colspan="2" style="text-align: center;">Formulários Salvos</th>
            </tr>
        </thead>
        <tbody id="lista-defeitos">

        </tbody>
    </table>
</div>


<!--INÍCIO DO MODAL DE DISTRIBUIÇÃO INTERNA-->
<div id="dist-interna" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Rede de distibuição Interna:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal" style="">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th>Instalação Interna</th>
                </tr>
                <tbody id="d-dist-interna-tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><span class="legend" id="d-dist-interna-1-item"><?php echo getItemInspecao(1); ?></span></td>
                        <td>
                            <select id="d-dist-interna-1">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                   </tr>
                   <tr>
                    <td>2</td>
                    <td><span class="legend" id="d-dist-interna-2-item"><?php echo getItemInspecao(2); ?></span></td>
                    <td>
                        <select id="d-dist-interna-2">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
               </tr>
               <tr>
                <td>3</td>
                <td><span class="legend" id="d-dist-interna-3-item">Afastamentos e a ocorrência de interferências com tubulações de água quente ou fria. Afastamentos quando em redes em paralelo maior ou igual a 30 mm e quando em cruzamentos maior ou igual a 10 mm</span></td>
                <td>
                    <select id="d-dist-interna-3">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
           </tr>
           <tr>
            <td>4</td>
            <td><span class="legend" id="d-dist-interna-4-item">Afastamentos e a ocorrência de interferências com tubulação de vapor. Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 10 mm.</span></td>
            <td>
                <select id="d-dist-interna-4">
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
       </tr>
       <tr>
        <td>5</td>
        <td><span class="legend" id="d-dist-interna-5-item">Afastamentos e a ocorrência de interferências com chaminés. Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 50 mm.</span></td>
        <td>
            <select id="d-dist-interna-5">
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
   </tr>
   <tr>
    <td>6</td>
    <td><span class="legend" id="d-dist-interna-6-item">Afastamentos e a ocorrência de interferências com tubulação de gás. Afastamentos quando em redes em paralelo maior ou igual a 10 mm e quando em cruzamentos maior ou igual a 10 mm.</span></td>
    <td>
        <select id="d-dist-interna-6">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>7</td>
    <td><span class="legend" id="d-dist-interna-7-item">Afastamentos e a ocorrência de interferências com as demais instalações (águas pluviais, esgoto). Afastamentos quando em redes em paralelo maior ou igual a 50 mm e quando em cruzamentos maior ou igual a 10 mm.</span></td>
    <td>
        <select id="d-dist-interna-7">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>8</td>
    <td><span class="legend" id="d-dist-interna-8-item">Encaminhamento da tubulação da rede. Rede não passando por vazios, caixas d'água, caixa de escada ou poços de elevadores.</span></td>
    <td>
        <select id="d-dist-interna-8">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>9</td>
    <td><span class="legend" id="d-dist-interna-9-item">Condições dos elementos de suportação. Suportes íntegros, com robustez compatível, adequadamente distanciados, bem fixados e protegidos contra corrosão.</span></td>
    <td>
        <select id="d-dist-interna-9">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>10</td>
    <td><span class="legend" id="d-dist-interna-10-item">Identificação da tubulação de gás. Pintura na cor padrão ou de etiqueta com a palavra gás.</span></td>
    <td>
        <select id="d-dist-interna-10">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>11</td>
    <td><span class="legend" id="d-dist-interna-11-item">Tipo de material utilizado na rede, inclusive tubos multicamada e PE x Aço. Utilização de materiais não contemplados na ABNT NBR 15526 e Nota Técnica da ABEGÁS.</span></td>
    <td>
        <select id="d-dist-interna-11">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>12</td>
    <td><span class="legend" id="d-dist-interna-12-item">Integridade do material utilizado na rede. Inexistência de amassamentos, corrosão ou fissuras.</span></td>
    <td>
        <select id="d-dist-interna-12">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>13</td>
    <td><span class="legend" id="d-dist-interna-13-item">Local de instalação dos materiais. Adequação dos materiais quanto a aspectos de proteção, conforme ABNT NBR 15526.</span></td>
    <td>
        <select id="d-dist-interna-13">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>14</td>
    <td><span class="legend" id="d-dist-interna-14-item">Estanqueidade para a rede de distibuição interna. Vazamento após realização de ensaio entre 1 l/h e 5 l/h.</span></td>
    <td>
        <select id="d-dist-interna-14">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>15</td>
    <td><span class="legend" id="d-dist-interna-15-item">Estanqueidade para a rede de distibuição interna. Vazamento após realização de ensaio maior que 5 l/h.</span></td>
    <td>
        <select id="d-dist-interna-15">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>16</td>
    <td><span class="legend" id="d-dist-interna-16-item">Estanqueidade das conexões de ligação dos medidores. Conexões estanques.</span></td>
    <td>
        <select id="d-dist-interna-16">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>17</td>
    <td><span class="legend" id="d-dist-interna-17-item">Condições de acesso ao abrigo. Desobstruído, permitindo a marcação, inspeção e manutenção dos medidores.</span></td>
    <td>
        <select id="d-dist-interna-17">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>18</td>
    <td><span class="legend" id="d-dist-interna-18-item">Abertura para ventilação permanente no abrigo de medidores. Existência de abertura para ventilação permanente superior ou inferior do abrigo, conforme gás combustível utilizado na instalação.</span></td>
    <td>
        <select id="d-dist-interna-18">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>19</td>
    <td><span class="legend" id="d-dist-interna-19-item">Abertura para ventilação permanente no abrigo de medidores. Área da ventilação permanente superior ou inferior equivalente a 1/10 da área da planta baixa.</span></td>
    <td>
        <select id="d-dist-interna-19">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>20</td>
    <td><span class="legend" id="d-dist-interna-20-item">Condição de instalação de medidores localizados nos andares. Existência de ventilação permanente, para o exterior.</span></td>
    <td>
        <select id="d-dist-interna-20">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>21</td>
    <td><span class="legend" id="d-dist-interna-21-item">Dispositivos no interior do abrigo. Ausência de dispositivos e/ou instalações elétricas no interior do abrigo, que possam produzir chama ou centelhamento.</span></td>
    <td>
        <select id="d-dist-interna-21">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>22</td>
    <td><span class="legend" id="d-dist-interna-22-item">Dispositivos no interior do abrigo. Ausência de entulhos, botijões de GLP ou outros materiais no interior do abrigo.</span></td>
    <td>
        <select id="d-dist-interna-22">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>23</td>
    <td><span class="legend" id="d-dist-interna-23-item">Dispositivos no interior do abrigo. Luminárias, interruptores, tomadas, e/ou outras instalações elétricas para uso da cabine com blindagem a prova de explosão.</span></td>
    <td>
        <select id="d-dist-interna-23">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
</tbody>
</table>
</div>
<!--FIM DO MODAL DE DISTRIBUIÇÃO INTERNA-->


<span id="btn_distribuicao_interna" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px; margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
</div><!--- Fim modal Rede de distibuição Interna --->

<div id="Ap-gas" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Aparelhos a Gás:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th colspan="3">Aparelhos</th>
                </tr>
                <tbody id="d_ap-gas-tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td><span class="legend" id="d_ap-gas_1-item">Local de instalação dos aparelhos a gás de circuito aberto. Não devem ser instalados em dormitório e banheiro.</span></td>
                        <td>
                            <select id="d_ap-gas_1-1" style="width: 65;">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                       <td>
                        <select id="d_ap-gas_1-2" style="width: 65;">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
                   <td>
                    <select id="d_ap-gas_1-3" style="width: 65;">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
           </tr>
           <tr>
            <td>25</td>
            <td><span class="legend" id="d_ap-gas_2-item">Volume do local de instalação de aparelho a gás de circuito aberto, com ou sem duto de exaustão natural. Volume mínimo do ambiente maior ou igual a 6 m³.</span></td>
            <td>
                <select id="d_ap-gas_2-1" >
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
           <td>
            <select id="d_ap-gas_2-2" >
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
       <td>
        <select id="d_ap-gas_2-3" >
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>26</td>
    <td><span class="legend" id="d_ap-gas_3-item">Cozinha apenas com fogão de até 216 kcal/min  e com volume maior ou igual que 6 m³. Ventilação com área total útil e permanente de no mínimo 800 cm². (Superior –600 cm² (para uma área externa) e inferior – 200 cm²). Ambientes com aparelhos de potência superior  216kcal/min, será necessário multiplicar a potência por 1,5. Caso dê <= 800 manter ventilação acima, caso seja > 800, 33% desse valor é igual a ventilação inferior e 67% desse valor é igual a ventilação superior.</span></td>
    <td>
        <select id="d_ap-gas_3-1" >
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_3-2" >
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_3-3" >
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>27</td>
    <td><span class="legend" id="d_ap-gas_4-item">Aquecedor de circuito aberto com potência de até 200 Kcal/min instalados em banheiro, condicionado à conformidade das demais adequações e a aplicação de ações mitigadoras. Volume do ambiente maior ou igual a 6m³.</span></td>
    <td>
        <select id="d_ap-gas_4-1" >
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_4-2" >
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_4-3" >
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>28</td>
    <td><span class="legend" id="d_ap-gas_5-item">Aquecedor de circuito aberto instalados em banheiro no interior de BOXE. Divisória acima de 1,80 m e vão da divisória ao teto menor que 0,40 m.</span></td>
    <td>
        <select id="d_ap-gas_5-1" >
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_5-2" >
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_5-3" >
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>29</td>
    <td><span class="legend" id="d_ap-gas_6-item">Aparelho a gás de circuito aberto com exaustão mecânica. Exaustão mecânica ligada (condicionado à conformidade das demais adequações e a aplicação de ações mitigadoras).</span></td>
    <td>
        <select id="d_ap-gas_6-1" >
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_6-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_6-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>30</td>
    <td><span class="legend" id="d_ap-gas_7-item">Aquecedor instalado no interior de banheiro com exaustão mecânica (RJ).</span></td>
    <td>
        <select id="d_ap-gas_7-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_7-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_7-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>31</td>
    <td><span class="legend" id="d_ap-gas_8-item">Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Abertura para ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência.</span></td>
    <td>
        <select id="d_ap-gas_8-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_8-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_8-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>32</td>
    <td><span class="legend" id="d_ap-gas_9-item">Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Abertura para ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Insuficiência.</span></td>
    <td>
        <select id="d_ap-gas_9-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_9-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_9-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>33</td>
    <td><span class="legend" id="d_ap-gas_10-item">Aquecedor de circuito aberto instalados em outros ambientes, exceto banheiro. Instalação de duto de exaustão e terminal, conforme ABNT NBR 13103.</span></td>
    <td>
        <select id="d_ap-gas_10-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_10-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_10-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>34</td>
    <td><span class="legend" id="d_ap-gas_11-item">Ventilação permanente, superior e/ou inferior, no local de instalação do aparelho a gás de circuito aberto, sem duto de exaustão ou duto de exaustão natural. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência</span></td>
    <td>
        <select id="d_ap-gas_11-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_11-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_11-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>35</td>
    <td><span class="legend" id="d_ap-gas_12-item">Ventilação permanente, superior e/ou inferior, no local de instalação do aparelho a gás de circuito aberto, sem duto de exaustão ou duto de exaustão natural. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ².Insuficiência</span></td>
    <td>
        <select id="d_ap-gas_12-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_12-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_12-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>36</td>
    <td><span class="legend" id="d_ap-gas_13-item">Abertura permanente do local de instalação de aparelho a gás de circuito aberto, com exaustão forçada. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Inexistência</span></td>
    <td>
        <select id="d_ap-gas_13-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_13-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_13-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>37</td>
    <td><span class="legend" id="d_ap-gas_14-item">Abertura permanente do local de instalação de aparelho a gás de circuito aberto, com exaustão forçada. Abertura de ventilação permanente superior de 600 cm² e inferior de 200 cm². Somando um total de no mínimo 800 cm ². Insuficiência</span></td>
    <td>
        <select id="d_ap-gas_14-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_14-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_14-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>38</td>
    <td><span class="legend" id="d_ap-gas_15-item">Aparelho de cocção único em cozinha. Existência de ventilação com área total útil e permanente de no mínimo 800 cm². (Superior – 600 cm² (para uma área externa) e inferior – 200 cm²)</span></td>
    <td>
        <select id="d_ap-gas_15-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_15-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_15-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>39</td>
    <td><span class="legend" id="d_ap-gas_16-item">Abertura de ventilação permanente indireta através de duto. Comprimento do duto até 3 metros, 1 vez a área mínima da abertura superior.</span></td>
    <td>
        <select id="d_ap-gas_16-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_16-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_16-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>40</td>
    <td><span class="legend" id="d_ap-gas_17-item">Abertura de ventilação permanente indireta através de duto.  Comprimento do duto de 3 até 10 metros, 1,5 vez a área mínima da abertura superior.</span></td>
    <td>
        <select id="d_ap-gas_17-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_17-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_17-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>41</td>
    <td><span class="legend" id="d_ap-gas_18-item">Abertura de ventilação permanente indireta através de duto. Comprimento do duto acima de 10 metros, 2 vezes a área mínima da abertura superior.</span></td>
    <td>
        <select id="d_ap-gas_18-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_18-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_18-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>42</td>
    <td><span class="legend" id="d_ap-gas_19-item">Aparelho permanente superior indireta em comunicação com o exterior. Seção livre mínima de 1600 cm²até o comprimento de 4 m.</span></td>
    <td>
        <select id="d_ap-gas_19-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_19-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_19-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>43</td>
    <td><span class="legend" id="d_ap-gas_20-item">Ventilação permanente superior e inferior de um ambiente contíguo com área livre, mínima, de 1,5 m², com somatório dos volumes igual ou maior que 6 m³. Existência de ventilação permanente superior e inferior conforme ABNT NBR 13103. Inexistência</span></td>
    <td>
        <select id="d_ap-gas_20-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_20-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_20-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>44</td>
    <td><span class="legend" id="d_ap-gas_21-item">Ventilação permanente superior e inferior de um ambiente contíguo com área livre, mínima, de 1,5 m², com somatório dos volumes igual ou maior que 6 m³. Existência de ventilação permanente superior e inferior conforme ABNT NBR 13103. Insuficiência</span></td>
    <td>
        <select id="d_ap-gas_21-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_21-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_21-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>45</td>
    <td><span class="legend" id="d_ap-gas_22-item">Ventilação permanente superior e inferior de um ambiente contíguo com área livre menor que 1,5 m², porém maior ou igual a 1,2 m² e potência total igual ou menor que 216 kcal/min. Ventilação com área total útil e permanente de no mínimo 600 cm² para uma área externa.</span></td>
    <td>
        <select id="d_ap-gas_22-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_22-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_22-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>46</td>
    <td><span class="legend" id="d_ap-gas_23-item">Condições físicas dos aparelhos a gás. Inexistência de peças e componentes soltos ou danificados.</span></td>
    <td>
        <select id="d_ap-gas_23-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_23-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_23-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>47</td>
    <td><span class="legend" id="d_ap-gas_24-item">Estanqueidade de gás nos aparelhos. Aparelhos a gás estanques, sem vazamento de gás.</span></td>
    <td>
        <select id="d_ap-gas_24-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_24-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_24-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>48</td>
    <td><span class="legend" id="d_ap-gas_25-item">Estanqueidade de água nos aparelhos. Aparelhos a gás estanques, sem vazamento de água.</span></td>
    <td>
        <select id="d_ap-gas_25-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_25-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_25-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>49</td>
    <td><span class="legend" id="d_ap-gas_26-item">Condições de chama do queimador do aparelho. Chama do aparelho estável, sem variação de cor azul (em potência máxima e mínima).</span></td>
    <td>
        <select id="d_ap-gas_26-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_26-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_26-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>50</td>
    <td><span class="legend" id="d_ap-gas_27-item">Sistema de acendimento automático do aparelho. Sistema automático funcionando conforme as orientações do fabricante.</span></td>
    <td>
        <select id="d_ap-gas_27-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_27-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_27-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>51</td>
    <td><span class="legend" id="d_ap-gas_28-item">Dispositivo de segurança do aparelho. Dispositivo de segurança funcionando conforme as orientações do fabricante.</span></td>
    <td>
        <select id="d_ap-gas_28-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_28-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_28-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>52</td>
    <td><span class="legend" id="d_ap-gas_29-item">Botões de regulagem e elementos de controle. Funcionamento conforme manual do fabricante.</span></td>
    <td>
        <select id="d_ap-gas_29-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ap-gas_29-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ap-gas_29-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
</tbody>
</table>
</div>


<span id="btn_aparelho_gas" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
</div><!--- Fim modal Aparelhos a Gás --->

<div id="liga-ap" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Ligações dos Aparelhos a Gás:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th colspan="3">Aparelhos</th>
                </tr>
                <tbody id="d_liga-ap-tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                    </tr>
                    <tr>
                        <td>53</td>
                        <td><span class="legend" id="d_liga-ap_1-item">Estanqueidade nas ligações da rede com o aparelho. Ligação do aparelho com a rede estanque.</span></td>
                        <td>
                            <select id="d_liga-ap_1_1" style="width: 65;">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                       <td>
                        <select id="d_liga-ap_1_2" style="width: 65;">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
                   <td>
                    <select id="d_liga-ap_1_3" style="width: 65;">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
           </tr>
           <tr>
            <td>54</td>
            <td><span class="legend" id="d_liga-ap_2-item">Material utilizado na ligação do aparelho. Tubos flexíveis conforme ABNT NBR 14177, ABNT NBR 113419, ABNT NBR 14745 ou ABNT NBR 14955.</span></td>
            <td>
                <select id="d_liga-ap_2_1">
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
           <td>
            <select id="d_liga-ap_2_2">
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
       <td>
        <select id="d_liga-ap_2_3">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>55</td>
    <td><span class="legend" id="d_liga-ap_3-item">Condições físicas do tubo flexível. Inexistência de danos físicos nos tubos flexíveis.</span></td>
    <td>
        <select id="d_liga-ap_3_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_3_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_3_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>56</td>
    <td><span class="legend" id="d_liga-ap_4-item">Estanqueidade na válvula de bloqueio do aparelho. Válvula de bloqueio estanque.</span></td>
    <td>
        <select id="d_liga-ap_4_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_4_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_4_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>57</td>
    <td><span class="legend" id="d_liga-ap_5-item">Identificação do ponto de gás do aquecedor. Identificado na cor amarela e na posição central.</span></td>
    <td>
        <select id="d_liga-ap_5_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_5_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_5_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>58</td>
    <td><span class="legend" id="d_liga-ap_6-item">Localização da válvula de bloqueio do aparelho. Válvula de bloqueio em local de fácil acesso, com ventilação adequada e protegidas, de forma a se evitar acionamento acidental.</span></td>
    <td>
        <select id="d_liga-ap_6_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_6_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_6_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>59</td>
    <td><span class="legend" id="d_liga-ap_7-item">Pontos de espera sem uso. Tamponamento adequado com bujão ou tampa rosqueada de metal e estanque dos pontos.</span></td>
    <td>
        <select id="d_liga-ap_7_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_7_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_7_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>60</td>
    <td><span class="legend" id="d_liga-ap_8-item">Condições dimensionais das chaminés. Diâmetro do duto igual ao diâmetro da saída da chaminé do aparelho a gás. ( Ou com adaptador conforme Abegas)</span></td>
    <td>
        <select id="d_liga-ap_8_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_8_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_8_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>61</td>
    <td><span class="legend" id="d_liga-ap_9-item">Instalação da chaminé individual. Chaminé com encaixes firmes nas conexões com os aparelhos a gás, conforme ABNT NBR 13103.</span></td>
    <td>
        <select id="d_liga-ap_9_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_liga-ap_9_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_liga-ap_9_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
</tbody>
</table>
</div>


<span id="btn_liga-ap" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
</div><!--- Fim modal Aparelhos a Gás --->

<div id="ind-exaust" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Individual de Exaustão Natural e Forçada:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th colspan="3">Aparelhos</th>
                </tr>
                <tbody id="d_ind-exaust_tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                    </tr>
                    <tr>
                        <td>62</td>
                        <td><span class="legend" id="d_ind-exaust_1-item">Condições do duto de exaustão em aquecedor de circuito aberto de exaustão natural ou forçada. Existência de dutos de exaustão, conforme ABNT NBR 13103.</span></td>
                        <td>
                            <select id="d_ind-exaust_1-1" style="width: 65;">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                       <td>
                        <select id="d_ind-exaust_1-2" style="width: 65;">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
                   <td>
                    <select id="d_ind-exaust_1-3" style="width: 65;">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
           </tr>
           <tr>
            <td>63</td>
            <td><span class="legend" id="d_ind-exaust_2-item">Compatibilidade da chaminé com o diâmetro da saída do defletor. Inexistência de estrangulamentos do duto em relação ao defletor do aparelho.</span></td>
            <td>
                <select id="d_ind-exaust_2-1">
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
           <td>
            <select id="d_ind-exaust_2-2">
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
       <td>
        <select id="d_ind-exaust_2-3">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>64</td>
    <td><span class="legend" id="d_ind-exaust_3-item">Altura vertical do duto do aquecedor de circuito aberto de exaustão natural. Altura inicial maior ou igual a 35 cm.</span></td>
    <td>
        <select id="d_ind-exaust_3-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_3-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_3-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>65</td>
    <td><span class="legend" id="d_ind-exaust_4-item">Declividade do sistema de exaustão. Duto do sistema de exaustão ascendente.</span></td>
    <td>
        <select id="d_ind-exaust_4-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_4-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_4-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>66</td>
    <td><span class="legend" id="d_ind-exaust_5-item">Conexão da chaminé com o duto de exaustão e o terminal em aquecedor de circuito aberto de exaustão natural ou forçada. Conexão firme do duto com o aparelho e o terminal.</span></td>
    <td>
        <select id="d_ind-exaust_5-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_5-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_5-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>67</td>
    <td><span class="legend" id="d_ind-exaust_6-item">Condições físicas dos dutos de exaustão. Inexistência de rachadura, rasgos ou emendas indevidas no duto de exaustão.</span></td>
    <td>
        <select id="d_ind-exaust_6-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_6-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_6-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>68</td>
    <td><span class="legend" id="d_ind-exaust_7-item">Terminal no exterior da edificação para aquecedor de circuito aberto de exaustão natural ou forçada. Existência do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.</span></td>
    <td>
        <select id="d_ind-exaust_7-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_7-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_7-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>69</td>
    <td><span class="legend" id="d_ind-exaust_8-item">Instalação do terminal de chaminé. Instalação levando em consideração limites de distância, conforme ABNT NBR 13103. (10 cm da face da edificação e 40 cm de raio)</span></td>
    <td>
        <select id="d_ind-exaust_8-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_8-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_8-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>70</td>
    <td><span class="legend" id="d_ind-exaust_9-item">Quantidade de curvas e desvios do duto de exaustão em aquecedor de circuito aberto de exaustão natural ou forçada. Inexistência de excessos de curvas e desvios no duto de exaustão, conforme ABNT NBR 13103, ou conforme manual do fabricante.</span></td>
    <td>
        <select id="d_ind-exaust_9-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_9-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_9-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>71</td>
    <td><span class="legend" id="d_ind-exaust_10-item">Situação do ambiente de percurso do sistema de exaustão. Ventilação superior e inferior de no mínimo 200 cm². (Ventilação da Chaminé passando por gesso ou a própria chaminé passando por mais de um cômodo).</span></td>
    <td>
        <select id="d_ind-exaust_10-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_10-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_10-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>72</td>
    <td><span class="legend" id="d_ind-exaust_11-item">Integridade do material do duto de exaustão. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.</span></td>
    <td>
        <select id="d_ind-exaust_11-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_11-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_11-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>73</td>
    <td><span class="legend" id="d_ind-exaust_12-item">Condições de adequação e robustez dos suportes do duto de exaustão. Suportes adequados ao material do duto de exaustão e bem posicionados.</span></td>
    <td>
        <select id="d_ind-exaust_12-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_12-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_12-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>74</td>
    <td><span class="legend" id="d_ind-exaust_13-item">Saída dos condutos de exaustão de produtos da combustão em locais não considerados áreas externas. Saídas de produtos da combustão para área externa ou locais considerados áreas externas.</span></td>
    <td>
        <select id="d_ind-exaust_13-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_13-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_13-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>75</td>
    <td><span class="legend" id="d_ind-exaust_14-item">Aparelho de cocção em cozinhas com potência nominal igual ou maior que 360kcal/min, sem coifa exaustora de forma a conduzir os produtos da combustão para fora do ambiente. Existência de coifa exaustora.</span></td>
    <td>
        <select id="d_ind-exaust_14-1" style="width: 65;">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_ind-exaust_14-2" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_ind-exaust_14-3" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
</tbody>
</table>
</div>
<span id="btn_ind-exaust" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
</div><!--- Fim modal Individual de Exaustão Natural e Forçada --->

<div id="cole-exaust" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Coletivo de Exaustão Natural e Forçada:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th colspan="3">Aparelhos</th>
                </tr>
                <tbody id="d_cole-exaust_tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                    </tr>
                    <tr>
                        <td>76</td>
                        <td><span class="legend" id="d_cole-exaust_1-item">Material das chaminés coletivas. Materiais incombustíveis, suportar temperatura superior a 200°C e ser resistente à corrosão.</span></td>
                        <td>
                            <select id="d_cole-exaust_1-1" style="width: 65;">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                       <td>
                        <select id="d_cole-exaust_1-2" style="width: 65;">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
                   <td>
                    <select id="d_cole-exaust_1-3" style="width: 65;">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
           </tr>
           <tr>
            <td>77</td>
            <td><span class="legend" id="d_cole-exaust_2-item">Condições dimensionais da chaminé coletiva. Área da chaminé coletiva maior ou igual à maior seção da chaminé individual conectada a ela, e altura mínima de 5m do defletor do último aquecedor até o terminal da chaminé.</span></td>
            <td>
                <select id="d_cole-exaust_2-1">
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
           <td>
            <select id="d_cole-exaust_2-2">
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
       <td>
        <select id="d_cole-exaust_2-3">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>78</td>
    <td><span class="legend" id="d_cole-exaust_3-item">Abertura inferior da chaminé coletiva. Abertura inferior na chaminé de, no mínimo, 100 cm² para limpeza, com possibilidade de acesso e de uma ligação para saída da água de condensação para o esgoto, feita através de tubo resistente à corrosão.</span></td>
    <td>
        <select id="d_cole-exaust_3-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_cole-exaust_3-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_cole-exaust_3-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>79</td>
    <td><span class="legend" id="d_cole-exaust_4-item">Interligação da chaminé individual com a chaminé coletiva. Existência de, no máximo, duas chaminés individuais por pavimento conectado à chaminé coletiva.</span></td>
    <td>
        <select id="d_cole-exaust_4-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_cole-exaust_4-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_cole-exaust_4-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>80</td>
    <td><span class="legend" id="d_cole-exaust_5-item">Interligação da chaminé individual com a chaminé coletiva. Ligação da chaminé individual na chaminé coletiva no sentido ascendente.</span></td>
    <td>
        <select id="d_cole-exaust_5-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_cole-exaust_5-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_cole-exaust_5-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>81</td>
    <td><span class="legend" id="d_cole-exaust_6-item">Terminal de chaminé. Existência e o correto posicionamento do terminal de chaminé no exterior da edificação, conforme ABNT NBR 13103.</span></td>
    <td>
        <select id="d_cole-exaust_6-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_cole-exaust_6-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_cole-exaust_6-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>82</td>
    <td><span class="legend" id="d_cole-exaust_7-item">Condições de obstrução do terminal para uso da chaminé coletiva. Chaminé desobstruída.</span></td>
    <td>
        <select id="d_cole-exaust_7-1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_cole-exaust_7-2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_cole-exaust_7-3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
</tbody>
</table>
</div>
<span id="btn_cole-exaust" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
</div><!--- Fim modal Coletivo de Exaustão Natural e Forçada --->

<div id="caract-h" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Características Higiênicas da Combustão:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th colspan="3">Aparelhos</th>
                </tr>
                <tbody id="d_caract-higi_tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                    </tr>
                    <tr>
                        <td>83</td>
                        <td><span class="legend" id="d_caract-higi_1-item">Medição de COn das combustões nos aquecedores de circuito aberto. Nota: nos casos de chaminés coletivas considerar o funcionamento simultâneo de pelo menos 60% dos aparelhos a ela conectados. Gases de 2ª família: COn de 500 &micro;mol/mol. Gases de 3ª família: COn menor que 1000 &micro;mol/mol.</span></td>
                        <td>
                            <select id="d_caract-higi_1-1" style="width: 65;">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                       <td>
                        <select id="d_caract-higi_1-2" style="width: 65;">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
                   <td>
                    <select id="d_caract-higi_1-3" style="width: 65;">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
           </tr>
           <tr>
            <td>84</td>
            <td><span class="legend" id="d_caract-higi_2-item">Medição de CO no ambiente com aquecedores de circuito aberto instalados. Nota: no caso de chaminés coletivas, considerar o funcionamento de pelo menos 60% dos aparelhos a ela conectados. CO menor que 15 &micro;mol/mol. CO maior que 15 &micro;mol/mol e menor que 50 &micro;mol/mol</span></td>
            <td>
                <select id="d_caract-higi_2-1">
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
           <td>
            <select id="d_caract-higi_2-2">
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
       <td>
        <select id="d_caract-higi_2-3">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
</tr>
<tr>
    <td>85</td>
    <td><span class="legend" id="d_caract-higi_3-item">Fogão e/ou outros aparelhos de cocção (capacidade acima de 360 kcal/min). CO menor que 15 &micro;mol/mol. CO maior que 15 &micro;mol/mol e menor que 50 &micro;mol/mol</span></td>
    <td>
        <select id="d_caract-higi_3-1" style="width: 65;">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td><select id="d_caract-higi_3-2" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select></td>
   <td><select id="d_caract-higi_3-3" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select></td>
</tr>
</tbody>
</table>
</div>
<span id="btn_caract-hig" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
</div><!--- Fim modal Características Higiênicas da Combustão --->

<div id="reco" class="modal" style="height: auto;">
   <article class="box box100">
    <header>
      <h3 style="text-align: center;">Recomendações:</h3>
  </header>
  <div class="box_content">
    <article class='box box100'>
        <div class="scroll-modal">
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Item de Inspeção</th>
                    <th>Instalação Interna</th>
                    <th colspan="3">Aparelhos</th>
                </tr>
                <tbody id="d_reco-tbody">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">2</td>
                        <td style="text-align: center;">3</td>
                    </tr>
                    <tr>
                        <td>86</td>
                        <td><span class="legend" id="d_reco-1-item">Medidas ao alto invertidas, ou seja, medida ao alto do cliente à esquerda do medidor.</span></td>
                        <td>
                            <select id="d_reco-1_1">
                               <option value="NULL"></option>
                               <option value="N/A">N/A</option>
                               <option value="C">C</option>
                               <option value="I">I</option>
                               <option value="RI">RI</option>
                           </select>
                       </td>
                       <td>
                        <select id="d_reco-1_2">
                           <option value="NULL"></option>
                           <option value="N/A">N/A</option>
                           <option value="C">C</option>
                           <option value="I">I</option>
                           <option value="RI">RI</option>
                       </select>
                   </td>
                   <td>
                    <select id="d_reco-1_3">
                       <option value="NULL"></option>
                       <option value="N/A">N/A</option>
                       <option value="C">C</option>
                       <option value="I">I</option>
                       <option value="RI">RI</option>
                   </select>
               </td>
               <td>
                <select id="d_reco-1_4">
                   <option value="NULL"></option>
                   <option value="N/A">N/A</option>
                   <option value="C">C</option>
                   <option value="I">I</option>
                   <option value="RI">RI</option>
               </select>
           </td>
       </tr>
       <tr>
        <td>87</td>
        <td><span class="legend" id="d_reco-2-item">Instalação energizada.</span></td>
        <td>
            <select id="d_reco-2_1">
               <option value="NULL"></option>
               <option value="N/A">N/A</option>
               <option value="C">C</option>
               <option value="I">I</option>
               <option value="RI">RI</option>
           </select>
       </td>
       <td>
        <select id="d_reco-2_2">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_reco-2_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-2_4">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>88</td>
    <td><span class="legend" id="d_reco-3-item">Rede de distibuição interna sem plaquetas de identificação e/ou inadequadas. As plaquetas de identificação da instalação devem estar localizadas a direita do medidor (na rede de distibuição interna), em local visível e ter marcação de forma indelével, informando a unidade a que pertence a instalação.</span></td>
    <td>
        <select id="d_reco-3_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_reco-3_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-3_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-3_4">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>89</td>
    <td><span class="legend" id="d_reco-4-item">Abrigo de medidores sem porta, sem visor, sem fechadura e/ou cadeado.</span></td>
    <td>
        <select id="d_reco-4_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_reco-4_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-4_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-4_4">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>90</td>
    <td><span class="legend" id="d_reco-5-item">Abrigo de medidor inacabados e/ou em mal estado de conservação.</span></td>
    <td>
        <select id="d_reco-5_1">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_reco-5_2">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-5_3">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-5_4">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
<tr>
    <td>91</td>
    <td><span class="legend" id="d_reco-6-item">Aquecedor instalado em área considerada externa sem chaminé para melhorar a eficiência da combustão.</span></td>
    <td>
        <select id="d_reco-6_1" style="width: 65;">
           <option value="NULL"></option>
           <option value="N/A">N/A</option>
           <option value="C">C</option>
           <option value="I">I</option>
           <option value="RI">RI</option>
       </select>
   </td>
   <td>
    <select id="d_reco-6_2" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-6_3" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
<td>
    <select id="d_reco-6_4" style="width: 65;">
       <option value="NULL"></option>
       <option value="N/A">N/A</option>
       <option value="C">C</option>
       <option value="I">I</option>
       <option value="RI">RI</option>
   </select>
</td>
</tr>
</table>
</div>
<span id="btn_reco" name="public" value="1" class="btn btn_darkblue fl_right icon-share" style="margin-left: 5px;margin-top: 20px;">Enviar</span>
<div class="clear"></div>

</article>
</div>
</article>
    </div><!--- Fim modal Recomendações --->