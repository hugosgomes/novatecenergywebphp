<?php
if (empty($DashboardLogin)):
die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

//AUTO DELETE POST TRASH
if (DB_AUTO_TRASH):
    $Delete = new Delete;
    $Delete->ExeDelete(DB_CATEGORIES, "WHERE category_title IS NULL AND category_content IS NULL AND category_id >= :st", "st=1");
endif;
?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-embed2">Work Control® Samples</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php">Dashboard</a>
            <span class="crumb">/</span>
            Exemplos de Código do Painel
        </p>
    </div>
</header>

<div class="dashboard_content">
    <div class="box box100">
        <div class="sample_tab_nav">
            <a class='conf_menu wc_tab wc_active' href='#panels'><span class="icon-stack">Painéis</span></a>
            <a class='conf_menu wc_tab' href='#boxes'><span class="icon-codepen">Caixas</span></a>
            <a class='conf_menu wc_tab' href='#forms'><span class="icon-keyboard">Formulários</span></a>
            <a class='conf_menu wc_tab' href='#buttons'><span class="icon-plus">Botões</span></a>
            <a class='conf_menu wc_tab' href='#icons'><span class="icon-IcoMoon">Ícones</span></a>
        </div>
        <div class="tab_contents">
            <div class="wc_tab_target wc_active" id="panels">
                <div class="box box50">
                    <div class="panel_header">
                        <span>
                            <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_icon_action_subtitle"></a>
                        </span>
                        <h2><span class="icon-command">Título do Painel</span></h2>
                        <p class="subtitle">Subtítulo do Painel</p>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                </div>

                <div class="box box50">    
                    <div class="panel_header">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_icon_subtitle"></a>
                        </span>
                        <h2 class="icon-command">Título do Painel</h2>
                        <p class="subtitle">Subtítulo do Painel</p>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                </div>

                <div class="box box50">
                    <div class="panel_header">
                        <span>
                            <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_action_subtitle"></a>
                        </span>
                        <h2>Título do Painel</h2>
                        <p>Subtítulo do Painel</p>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                </div>

                <div class="box box50">    
                    <div class="panel_header">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_subtitle"></a>
                        </span>
                        <h2>Título do Painel</h2>
                        <p>Subtítulo do Painel</p>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                </div>

                <div class="box box50">
                    <div class="panel_header">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_icon"></a>
                        </span>
                        <h2><span class="icon-command">Título do Painel</span></h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                </div>

                <div class="box box50">    
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_default"></a>
                        </span>
                        <h2 class="icon-command">Título do Painel</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header success">
                        <span>
                            <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_success"></a>
                        </span>
                        <h2 class="icon-arrow-up">Sucesso</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor.</p>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header alert">
                        <span>
                            <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_alert"></a>
                        </span>
                        <h2 class="icon-arrow-up">Alerta</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor.</p>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header info">
                        <span>
                            <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_info"></a>
                        </span>
                        <h2 class="icon-arrow-up">Informação</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor.</p>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header warning">
                        <span>
                            <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_header_warning"></a>
                        </span>
                        <h2 class="icon-arrow-up">Cuidado</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor.</p>
                    </div>
                </div>

                <div class="box box100">
                    <div class="panel_header">
                        <h2 class="icon-command">Título do Painel</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                    <div class="panel_footer">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_footer"></a>
                        </span>
                        <p>&reg; Conteúdo do rodapé interno</p>
                    </div>
                </div>

                <div class="box box100">
                    <div class="panel_header">
                        <h2 class="icon-command">Título do Painel</h2>
                    </div>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar. Vestibulum metus lacus, porta non orci in, euismod semper quam. 
                            Quisque tincidunt tortor non nibh sagittis porttitor. Ut justo lacus, mattis ut fringilla ac, lacinia vel diam.</p>
                    </div>
                    <div class="panel_footer_external">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="panel_footer_external"></a>
                        </span>
                        <p>&reg; Conteúdo do rodapé externo</p>
                    </div>
                </div>

                <div class="box box100">
                    <div class="panel_header">
                        <h2>Título de Cabeçalho em h2</h2>
                        <h3>Título de Cabeçalho em h3</h3>
                        <h4>Título de Cabeçalho em h4</h4>
                        <h5>Título de Cabeçalho em h5</h5>
                        <h6>Título de Cabeçalho em h6</h6>

                        <br>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Esse <i>parágrafo</i> possui um <u>elemento</u> <mark>mark</mark> com formatação padrão do CSS para <b>destaque!</b></p>

                        <ul>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                        </ul>

                        <ol>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                        </ol>
                    </div>

                    <div class="panel">
                        <h2>Título do Painel em h2</h2>
                        <h3>Título do Painel em h3</h3>
                        <h4>Título do Painel em h4</h4>
                        <h5>Título do Painel em h5</h5>
                        <h6>Título do Painel em h6</h6>

                        <br>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Esse <i>parágrafo</i> possui um <u>elemento</u> <mark>mark</mark> com formatação padrão do CSS para <b>destaque!</b></p>

                        <ul>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                            <li>Item de lista não ordenada</li>
                        </ul>

                        <ol>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                            <li>Item de lista ordenada</li>
                        </ol>

                    </div>

                    <div class="panel_footer">
                        <h2>Título do Rodapé em h2</h2>
                        <h3>Título do Rodapé em h3</h3>
                        <h4>Título do Rodapé em h4</h4>
                        <h5>Título do Rodapé em h5</h5>
                        <h6>Título do Rodapé em h6</h6>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Esse <i>parágrafo</i> possui um <u>elemento</u> <mark>mark</mark> com formatação padrão do CSS para <b>destaque!</b></p>
                    </div>

                    <div class="panel_footer_external">
                        <h2>Título do Rodapé em h2</h2>
                        <h3>Título do Rodapé em h3</h3>
                        <h4>Título do Rodapé em h4</h4>
                        <h5>Título do Rodapé em h5</h5>
                        <h6>Título do Rodapé em h6</h6>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque at enim at volutpat. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc maximus magna et venenatis pellentesque. 
                            Maecenas sollicitudin sit amet ligula et pulvinar.</p>
                        <p>Esse <i>parágrafo</i> possui um <u>elemento</u> <mark>mark</mark> com formatação padrão do CSS para <b>destaque!</b></p>
                    </div>
                </div>
            </div>
            <!--CLOSE PANELS-->

            <div class="wc_tab_target ds_none" id="boxes">

                <div class="box box100">
                    <div class="panel_header">
                        <h2 class="icon-display">CONJUNTOS DE BOX</h2>
                        <p class="subtitle">Para trabalhar com o sistema de box é bem simples! Basta que você crie uma div e insira a class box + o tamanho da box que você deseja! Lembre-se que a soma do tamanho das box's deve ser igual a 100! Logo se quiser um painel com 100% de largura crie uma div com as classes box box100, ou se desejar ter dois painéis com 50% de largura cada um, crie duas divs, cada uma delas com as classes box box50 respectivamente.</p>
                        <p class="subtitle"><strong>* Atenção:</strong> Somente a box33 a soma não é igual a 100, pois 3 box de 33,33% de largura é igual a 99,99% e esse 1% é descontado na margem.</p>
                    </div>
                </div>

                <!-- PRIMEIRA LINHA COMPLETA -->
                <div class="box box100">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box100"></a>
                        </span>
                        <h2>BOX 100</h2>
                    </div>
                </div>
                <!-- PRIMEIRA LINHA COMPLETA -->

                <!-- SEGUNDA LINHA COMPLETA-->
                <div class="box box50">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box50"></a>
                        </span>
                        <h2>BOX 50</h2>
                    </div>
                </div>

                <div class="box box50">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box50"></a>
                        </span>
                        <h2>BOX 50</h2>
                    </div>
                </div>
                <!-- SEGUNDA LINHA COMPLETA-->

                <!-- TERCEIRA LINHA COMPLETA-->
                <div class="box box33">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box33"></a>
                        </span>
                        <h2>BOX 33</h2>
                    </div>
                </div>

                <div class="box box33">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box33"></a>
                        </span>
                        <h2>BOX 33</h2>
                    </div>
                </div>

                <div class="box box33">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box33"></a>
                        </span>
                        <h2>BOX 33</h2>
                    </div>
                </div>
                <!-- TERCEIRA LINHA COMPLETA-->

                <!-- QUARTA LINHA COMPLETA -->
                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>
                <!-- QUARTA LINHA COMPLETA -->

                <div class="box box100">
                    <div class="panel_footer_external">
                        <p>Box's uniformemente distribuídos</p>
                    </div>
                </div>

                <!-- 
                    MESCLANDO BOXS
                    A SOMA DE TODAS AS BOX DEVE SER IGUAL A 100 
                -->

                <div class="box box100">
                    <div class="panel_header">
                        <h2 class="icon-display">MESCLANDO CONJUNTOS DE BOX</h2>
                        <p class="subtitle">O conceito da soma deve ser 100 assim como nas box uniformes, mas você tem a possibilidade de mesclar diversos tamanhos de painéis para distribuir melhor o seu conteúdo na tela do usuário. Veja os exemplos abaixo!</p>
                    </div>
                </div>

                <!-- PRIMEIRA LINHA COMPLETA -->
                <div class="box box30">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box30"></a>
                        </span>
                        <h2>BOX 30</h2>
                    </div>
                </div>

                <div class="box box70">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box70"></a>
                        </span>
                        <h2>BOX 70</h2>
                    </div>
                </div>
                <!-- PRIMEIRA LINHA COMPLETA -->

                <!-- SEGUNDA LINHA COMPLETA -->
                <div class="box box70">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box70"></a>
                        </span>
                        <h2>BOX 70</h2>
                    </div>
                </div>

                <div class="box box30">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box30"></a>
                        </span>
                        <h2>BOX 30</h2>
                    </div>
                </div>
                <!-- SEGUNDA LINHA COMPLETA -->

                <!-- TERCEIRA LINHA COMPLETA -->
                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>

                <div class="box box50">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box50"></a>
                        </span>
                        <h2>BOX 50</h2>
                    </div>
                </div>
                <!-- TERCEIRA LINHA COMPLETA -->

                <!-- QUARTA LINHA COMPLETA -->
                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>

                <div class="box box50">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box50"></a>
                        </span>
                        <h2>BOX 50</h2>
                    </div>
                </div>

                <div class="box box25">
                    <div class="panel_header default">
                        <span>
                            <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-embed2 wc_clip" rel="box25"></a>
                        </span>
                        <h2>BOX 25</h2>
                    </div>
                </div>
                <!-- QUARTA LINHA COMPLETA -->

                <div class="box box100">
                    <div class="panel_footer_external">
                        <p>Box's distribuídos de forma irregular</p>
                    </div>
                </div>
            </div>
            <!--CLOSE BOXES-->

            <div class="wc_tab_target ds_none" id="forms">
                <div class="box box100">

                    <div class="panel_header default">
                        <span>
                            <a href="javacript:void(0)" class="btn btn_blue icon-embed2 icon-notext wc_clip" rel="form"></a>
                        </span>
                        <h2 class="icon-embed2">Exemplo de Formulário</h2>
                    </div>

                    <div class="panel">
                        <form>
                            <label class="label">
                                <span class="legend">Campo 100%:</span>
                                <input style="font-size: 1.4em;" type="text" name="titulo" placeholder="Digite um título" required/>
                            </label>

                            <div class="label_50">
                                <label class="label">
                                    <span class="legend">Campo 1 50%:</span>
                                    <input style="font-size: 1.4em;" type="text" name="campo1" placeholder="Digite um título" required/>
                                </label>
                                <label class="label">
                                    <span class="legend">Campo 2 50%:</span>
                                    <input style="font-size: 1.4em;" type="text" name="campo2" placeholder="Digite um título" required/>
                                </label>
                                <div class="clear"></div>
                            </div>

                            <div class="label_33">
                                <label class="label">
                                    <span class="legend">Campo 1 30%:</span>
                                    <input style="font-size: 1.4em;" type="text" name="campo1" placeholder="Digite um título" required/>
                                </label>
                                <label class="label">
                                    <span class="legend">Campo 2 30%:</span>
                                    <input style="font-size: 1.4em;" type="text" name="campo2" placeholder="Digite um título" required/>
                                </label>

                                <label class="label">
                                    <span class="legend">Campo 3 30%:</span>
                                    <input style="font-size: 1.4em;" type="text" name="campo3" placeholder="Digite um título" required/>
                                </label>
                            </div>

                            <label class="label">
                                <input type="submit" name="titulo" value="Enviar" class="btn btn_green fl_right"/>
                            </label>
                        </form>
                        <div class="clear"></div>
                    </div>
                </div> 
            </div>
            <!--CLOSE FORMS-->

            <div class="wc_tab_target ds_none" id="buttons">
                <div class="box_content">
                    <p>Todas as variações abaixo podem ser aplicadas a elementos do tipo <b>&LT;a></b> ou <b>&LT;button></b> adicionando obrigatoriamente a classe <b>.btn</b> e depois a variação.</p>
                    <p>Cores:</p>
                    <a href="javascript:void(0)" class="btn">Botão Cor Padrão</a>
                    <a href="javascript:void(0)" class="btn btn_green">Botão .btn_green</a>
                    <a href="javascript:void(0)" class="btn btn_yellow">Botão .btn_yellow</a>
                    <a href="javascript:void(0)" class="btn btn_blue">Botão .btn_blue</a>
                    <a href="javascript:void(0)" class="btn btn_red">Botão .btn_red</a>

                    <p>Tamanho:</p>
                    <a href="javascript:void(0)" class="btn btn_green">Botão Tamanho Padrão</a>
                    <a href="javascript:void(0)" class="btn btn_green btn_small">Botão .btn_small</a>
                    <a href="javascript:void(0)" class="btn btn_green btn_medium">Botão .btn_medium</a>
                    <a href="javascript:void(0)" class="btn btn_green btn_large">Botão .btn_large</a>
                    <a href="javascript:void(0)" class="btn btn_green btn_xlarge">Botão .btn_xlarge</a>
                    <a href="javascript:void(0)" class="btn btn_green btn_xxlarge">Botão .btn_xxlarge</a>

                    <p>Ícone:</p>
                    <a href="javascript:void(0)" class="btn btn_yellow icon-IcoMoon">Botão com Ícone .icon-IcoMoon</a>
                    <a href="javascript:void(0)" class="btn btn_yellow icon-IcoMoon icon-notext"></a> - icon-notext

                    <p>Borda:</p>
                    <a href="javascript:void(0)" class="btn btn_blue">Botão Borda Padrão</a>
                    <a href="javascript:void(0)" class="btn btn_blue rounded">Botão .rounded</a>
                    <a href="javascript:void(0)" class="btn btn_blue icon-calendar icon-notext rounded"></a> - icon-calendar icon-notext rounded
                </div>
            </div>
            <!--CLOSE BUTTONS-->

            <div class="wc_tab_target ds_none" id="icons">
                <link rel="stylesheet" href="<?= BASE; ?>/_cdn/bootcss/icomoon/demo-files/demo.css"/>
                <div class="box box100">
                    <div class="panel_header default">
                        <h2 class="mhmm mvm"><span class="fgc1">Font Name:</span> icomoon <small class="fgc1">(Glyphs:&nbsp;491)</small></h2>
                    </div>
                    <div class="panel">
                        <div class="clearfix mhl ptl">
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-home">

                                    </span>
                                    <span class="mls"> icon-home</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e900" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe900;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="home, house" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-home2">

                                    </span>
                                    <span class="mls"> icon-home2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e901" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe901;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="home2, house2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-home3">

                                    </span>
                                    <span class="mls"> icon-home3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e902" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe902;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="home3, house3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-office">

                                    </span>
                                    <span class="mls"> icon-office</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e903" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe903;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="office, buildings" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-newspaper">

                                    </span>
                                    <span class="mls"> icon-newspaper</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e904" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe904;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="newspaper, news" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pencil">

                                    </span>
                                    <span class="mls"> icon-pencil</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e905" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe905;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pencil, write" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pencil2">

                                    </span>
                                    <span class="mls"> icon-pencil2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e906" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe906;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pencil2, write2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-quill">

                                    </span>
                                    <span class="mls"> icon-quill</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e907" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe907;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="quill, feather" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pen">

                                    </span>
                                    <span class="mls"> icon-pen</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e908" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe908;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pen, write3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-blog">

                                    </span>
                                    <span class="mls"> icon-blog</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e909" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe909;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="blog, pen2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-eyedropper">

                                    </span>
                                    <span class="mls"> icon-eyedropper</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e90a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe90a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="eyedropper, color" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-droplet">

                                    </span>
                                    <span class="mls"> icon-droplet</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e90b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe90b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="droplet, color2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paint-format">

                                    </span>
                                    <span class="mls"> icon-paint-format</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e90c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe90c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paint-format, format" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-image">

                                    </span>
                                    <span class="mls"> icon-image</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e90d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe90d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="image, picture" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-images">

                                    </span>
                                    <span class="mls"> icon-images</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e90e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe90e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="images, pictures" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-camera">

                                    </span>
                                    <span class="mls"> icon-camera</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e90f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe90f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="camera, photo" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-headphones">

                                    </span>
                                    <span class="mls"> icon-headphones</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e910" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe910;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="headphones, headset" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-music">

                                    </span>
                                    <span class="mls"> icon-music</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e911" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe911;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="music, song" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-play">

                                    </span>
                                    <span class="mls"> icon-play</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e912" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe912;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="play, video" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-film">

                                    </span>
                                    <span class="mls"> icon-film</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e913" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe913;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="film, video2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-video-camera">

                                    </span>
                                    <span class="mls"> icon-video-camera</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e914" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe914;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="video-camera, video3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-dice">

                                    </span>
                                    <span class="mls"> icon-dice</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e915" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe915;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="dice, game" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pacman">

                                    </span>
                                    <span class="mls"> icon-pacman</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e916" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe916;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pacman, game2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spades">

                                    </span>
                                    <span class="mls"> icon-spades</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e917" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe917;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spades, cards" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-clubs">

                                    </span>
                                    <span class="mls"> icon-clubs</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e918" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe918;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="clubs, cards2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-diamonds">

                                    </span>
                                    <span class="mls"> icon-diamonds</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e919" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe919;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="diamonds, cards3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bullhorn">

                                    </span>
                                    <span class="mls"> icon-bullhorn</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e91a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe91a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bullhorn, megaphone" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-connection">

                                    </span>
                                    <span class="mls"> icon-connection</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e91b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe91b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="connection, wifi" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-podcast">

                                    </span>
                                    <span class="mls"> icon-podcast</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e91c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe91c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="podcast, broadcast" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-feed">

                                    </span>
                                    <span class="mls"> icon-feed</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e91d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe91d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="feed, wave" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mic">

                                    </span>
                                    <span class="mls"> icon-mic</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e91e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe91e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mic, microphone" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-book">

                                    </span>
                                    <span class="mls"> icon-book</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e91f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe91f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="book, read" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-books">

                                    </span>
                                    <span class="mls"> icon-books</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e920" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe920;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="books, library" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-library">

                                    </span>
                                    <span class="mls"> icon-library</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e921" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe921;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="library2, bank" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-text">

                                    </span>
                                    <span class="mls"> icon-file-text</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e922" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe922;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-text, file" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-profile">

                                    </span>
                                    <span class="mls"> icon-profile</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e923" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe923;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="profile, file2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-empty">

                                    </span>
                                    <span class="mls"> icon-file-empty</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e924" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe924;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-empty, file3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-files-empty">

                                    </span>
                                    <span class="mls"> icon-files-empty</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e925" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe925;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="files-empty, files" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-text2">

                                    </span>
                                    <span class="mls"> icon-file-text2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e926" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe926;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-text2, file4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-picture">

                                    </span>
                                    <span class="mls"> icon-file-picture</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e927" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe927;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-picture, file5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-music">

                                    </span>
                                    <span class="mls"> icon-file-music</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e928" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe928;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-music, file6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-play">

                                    </span>
                                    <span class="mls"> icon-file-play</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e929" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe929;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-play, file7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-video">

                                    </span>
                                    <span class="mls"> icon-file-video</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e92a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe92a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-video, file8" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-zip">

                                    </span>
                                    <span class="mls"> icon-file-zip</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e92b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe92b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-zip, file9" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-copy">

                                    </span>
                                    <span class="mls"> icon-copy</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e92c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe92c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="copy, duplicate" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paste">

                                    </span>
                                    <span class="mls"> icon-paste</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e92d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe92d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paste, clipboard-file" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stack">

                                    </span>
                                    <span class="mls"> icon-stack</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e92e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe92e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stack, layers" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-folder">

                                    </span>
                                    <span class="mls"> icon-folder</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e92f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe92f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="folder, directory" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-folder-open">

                                    </span>
                                    <span class="mls"> icon-folder-open</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e930" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe930;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="folder-open, directory2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-folder-plus">

                                    </span>
                                    <span class="mls"> icon-folder-plus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e931" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe931;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="folder-plus, directory3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-folder-minus">

                                    </span>
                                    <span class="mls"> icon-folder-minus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e932" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe932;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="folder-minus, directory4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-folder-download">

                                    </span>
                                    <span class="mls"> icon-folder-download</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e933" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe933;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="folder-download, directory5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-folder-upload">

                                    </span>
                                    <span class="mls"> icon-folder-upload</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e934" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe934;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="folder-upload, directory6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-price-tag">

                                    </span>
                                    <span class="mls"> icon-price-tag</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e935" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe935;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="price-tag" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-price-tags">

                                    </span>
                                    <span class="mls"> icon-price-tags</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e936" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe936;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="price-tags" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-barcode">

                                    </span>
                                    <span class="mls"> icon-barcode</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e937" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe937;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="barcode" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-qrcode">

                                    </span>
                                    <span class="mls"> icon-qrcode</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e938" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe938;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="qrcode" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ticket">

                                    </span>
                                    <span class="mls"> icon-ticket</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e939" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe939;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ticket, theater" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cart">

                                    </span>
                                    <span class="mls"> icon-cart</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e93a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe93a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cart, purchase" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-coin-dollar">

                                    </span>
                                    <span class="mls"> icon-coin-dollar</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e93b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe93b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="coin-dollar, money" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-coin-euro">

                                    </span>
                                    <span class="mls"> icon-coin-euro</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e93c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe93c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="coin-euro, money2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-coin-pound">

                                    </span>
                                    <span class="mls"> icon-coin-pound</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e93d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe93d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="coin-pound, money3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-coin-yen">

                                    </span>
                                    <span class="mls"> icon-coin-yen</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e93e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe93e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="coin-yen, money4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-credit-card">

                                    </span>
                                    <span class="mls"> icon-credit-card</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e93f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe93f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="credit-card, money5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-calculator">

                                    </span>
                                    <span class="mls"> icon-calculator</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e940" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe940;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="calculator, compute" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-lifebuoy">

                                    </span>
                                    <span class="mls"> icon-lifebuoy</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e941" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe941;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="lifebuoy, support" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-phone">

                                    </span>
                                    <span class="mls"> icon-phone</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e942" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe942;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="phone, telephone" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-phone-hang-up">

                                    </span>
                                    <span class="mls"> icon-phone-hang-up</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e943" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe943;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="phone-hang-up, telephone2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-address-book">

                                    </span>
                                    <span class="mls"> icon-address-book</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e944" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe944;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="address-book, contact" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-envelop">

                                    </span>
                                    <span class="mls"> icon-envelop</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e945" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe945;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="envelop, mail" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pushpin">

                                    </span>
                                    <span class="mls"> icon-pushpin</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e946" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe946;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pushpin, pin" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-location">

                                    </span>
                                    <span class="mls"> icon-location</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e947" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe947;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="location, map-marker" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-location2">

                                    </span>
                                    <span class="mls"> icon-location2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e948" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe948;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="location2, map-marker2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-compass">

                                    </span>
                                    <span class="mls"> icon-compass</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e949" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe949;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="compass, direction" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-compass2">

                                    </span>
                                    <span class="mls"> icon-compass2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e94a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe94a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="compass2, direction2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-map">

                                    </span>
                                    <span class="mls"> icon-map</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e94b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe94b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="map, guide" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-map2">

                                    </span>
                                    <span class="mls"> icon-map2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e94c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe94c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="map2, guide2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-history">

                                    </span>
                                    <span class="mls"> icon-history</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e94d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe94d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="history, time" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-clock">

                                    </span>
                                    <span class="mls"> icon-clock</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e94e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe94e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="clock, time2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-clock2">

                                    </span>
                                    <span class="mls"> icon-clock2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e94f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe94f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="clock2, time3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-alarm">

                                    </span>
                                    <span class="mls"> icon-alarm</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e950" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe950;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="alarm, time4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bell">

                                    </span>
                                    <span class="mls"> icon-bell</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e951" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe951;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bell, alarm2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stopwatch">

                                    </span>
                                    <span class="mls"> icon-stopwatch</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e952" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe952;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stopwatch, time5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-calendar">

                                    </span>
                                    <span class="mls"> icon-calendar</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e953" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe953;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="calendar, date" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-printer">

                                    </span>
                                    <span class="mls"> icon-printer</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e954" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe954;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="printer, print" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-keyboard">

                                    </span>
                                    <span class="mls"> icon-keyboard</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e955" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe955;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="keyboard, typing" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-display">

                                    </span>
                                    <span class="mls"> icon-display</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e956" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe956;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="display, screen" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-laptop">

                                    </span>
                                    <span class="mls"> icon-laptop</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e957" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe957;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="laptop, computer" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mobile">

                                    </span>
                                    <span class="mls"> icon-mobile</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e958" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe958;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mobile, cell-phone" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mobile2">

                                    </span>
                                    <span class="mls"> icon-mobile2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e959" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe959;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mobile2, cell-phone2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tablet">

                                    </span>
                                    <span class="mls"> icon-tablet</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e95a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe95a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tablet, mobile3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tv">

                                    </span>
                                    <span class="mls"> icon-tv</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e95b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe95b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tv, television" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-drawer">

                                    </span>
                                    <span class="mls"> icon-drawer</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e95c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe95c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="drawer, box" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-drawer2">

                                    </span>
                                    <span class="mls"> icon-drawer2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e95d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe95d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="drawer2, box2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-box-add">

                                    </span>
                                    <span class="mls"> icon-box-add</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e95e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe95e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="box-add, box3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-box-remove">

                                    </span>
                                    <span class="mls"> icon-box-remove</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e95f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe95f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="box-remove, box4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-download">

                                    </span>
                                    <span class="mls"> icon-download</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e960" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe960;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="download, save" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-upload">

                                    </span>
                                    <span class="mls"> icon-upload</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e961" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe961;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="upload, load" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-floppy-disk">

                                    </span>
                                    <span class="mls"> icon-floppy-disk</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e962" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe962;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="floppy-disk, save2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-drive">

                                    </span>
                                    <span class="mls"> icon-drive</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e963" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe963;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="drive, save3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-database">

                                    </span>
                                    <span class="mls"> icon-database</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e964" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe964;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="database, db" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-undo">

                                    </span>
                                    <span class="mls"> icon-undo</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e965" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe965;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="undo, ccw" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-redo">

                                    </span>
                                    <span class="mls"> icon-redo</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e966" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe966;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="redo, cw" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-undo2">

                                    </span>
                                    <span class="mls"> icon-undo2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e967" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe967;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="undo2, left" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-redo2">

                                    </span>
                                    <span class="mls"> icon-redo2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e968" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe968;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="redo2, right" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-forward">

                                    </span>
                                    <span class="mls"> icon-forward</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e969" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe969;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="forward, right2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-reply">

                                    </span>
                                    <span class="mls"> icon-reply</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e96a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe96a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="reply, left2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bubble">

                                    </span>
                                    <span class="mls"> icon-bubble</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e96b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe96b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bubble, comment" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bubbles">

                                    </span>
                                    <span class="mls"> icon-bubbles</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e96c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe96c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bubbles, comments" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bubbles2">

                                    </span>
                                    <span class="mls"> icon-bubbles2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e96d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe96d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bubbles2, comments2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bubble2">

                                    </span>
                                    <span class="mls"> icon-bubble2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e96e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe96e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bubble2, comment2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bubbles3">

                                    </span>
                                    <span class="mls"> icon-bubbles3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e96f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe96f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bubbles3, comments3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bubbles4">

                                    </span>
                                    <span class="mls"> icon-bubbles4</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e970" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe970;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bubbles4, comments4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-user">

                                    </span>
                                    <span class="mls"> icon-user</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e971" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe971;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="user, profile2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-users">

                                    </span>
                                    <span class="mls"> icon-users</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e972" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe972;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="users, group" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-user-plus">

                                    </span>
                                    <span class="mls"> icon-user-plus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e973" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe973;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="user-plus, user2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-user-minus">

                                    </span>
                                    <span class="mls"> icon-user-minus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e974" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe974;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="user-minus, user3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-user-check">

                                    </span>
                                    <span class="mls"> icon-user-check</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e975" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe975;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="user-check, user4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-user-tie">

                                    </span>
                                    <span class="mls"> icon-user-tie</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e976" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe976;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="user-tie, user5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-quotes-left">

                                    </span>
                                    <span class="mls"> icon-quotes-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e977" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe977;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="quotes-left, ldquo" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-quotes-right">

                                    </span>
                                    <span class="mls"> icon-quotes-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e978" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe978;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="quotes-right, rdquo" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hour-glass">

                                    </span>
                                    <span class="mls"> icon-hour-glass</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e979" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe979;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hour-glass, loading" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner">

                                    </span>
                                    <span class="mls"> icon-spinner</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e97a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe97a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner, loading2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner2">

                                    </span>
                                    <span class="mls"> icon-spinner2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e97b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe97b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner2, loading3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner3">

                                    </span>
                                    <span class="mls"> icon-spinner3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e97c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe97c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner3, loading4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner4">

                                    </span>
                                    <span class="mls"> icon-spinner4</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e97d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe97d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner4, loading5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner5">

                                    </span>
                                    <span class="mls"> icon-spinner5</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e97e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe97e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner5, loading6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner6">

                                    </span>
                                    <span class="mls"> icon-spinner6</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e97f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe97f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner6, loading7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner7">

                                    </span>
                                    <span class="mls"> icon-spinner7</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e980" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe980;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner7, loading8" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner8">

                                    </span>
                                    <span class="mls"> icon-spinner8</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e981" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe981;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner8, loading9" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner9">

                                    </span>
                                    <span class="mls"> icon-spinner9</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e982" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe982;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner9, loading10" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner10">

                                    </span>
                                    <span class="mls"> icon-spinner10</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e983" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe983;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner10, loading11" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spinner11">

                                    </span>
                                    <span class="mls"> icon-spinner11</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e984" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe984;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spinner11, loading12" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-binoculars">

                                    </span>
                                    <span class="mls"> icon-binoculars</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e985" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe985;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="binoculars, lookup" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-search">

                                    </span>
                                    <span class="mls"> icon-search</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e986" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe986;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="search, magnifier" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-zoom-in">

                                    </span>
                                    <span class="mls"> icon-zoom-in</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e987" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe987;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="zoom-in, magnifier2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-zoom-out">

                                    </span>
                                    <span class="mls"> icon-zoom-out</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e988" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe988;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="zoom-out, magnifier3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-enlarge">

                                    </span>
                                    <span class="mls"> icon-enlarge</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e989" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe989;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="enlarge, expand" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shrink">

                                    </span>
                                    <span class="mls"> icon-shrink</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e98a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe98a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shrink, collapse" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-enlarge2">

                                    </span>
                                    <span class="mls"> icon-enlarge2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e98b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe98b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="enlarge2, expand2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shrink2">

                                    </span>
                                    <span class="mls"> icon-shrink2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e98c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe98c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shrink2, collapse2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-key">

                                    </span>
                                    <span class="mls"> icon-key</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e98d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe98d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="key, password" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-key2">

                                    </span>
                                    <span class="mls"> icon-key2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e98e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe98e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="key2, password2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-lock">

                                    </span>
                                    <span class="mls"> icon-lock</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e98f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe98f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="lock, secure" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-unlocked">

                                    </span>
                                    <span class="mls"> icon-unlocked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e990" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe990;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="unlocked, lock-open" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wrench">

                                    </span>
                                    <span class="mls"> icon-wrench</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e991" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe991;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wrench, tool" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-equalizer">

                                    </span>
                                    <span class="mls"> icon-equalizer</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e992" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe992;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="equalizer, sliders" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-equalizer2">

                                    </span>
                                    <span class="mls"> icon-equalizer2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e993" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe993;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="equalizer2, sliders2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cog">

                                    </span>
                                    <span class="mls"> icon-cog</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e994" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe994;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cog, gear" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cogs">

                                    </span>
                                    <span class="mls"> icon-cogs</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e995" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe995;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cogs, gears" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hammer">

                                    </span>
                                    <span class="mls"> icon-hammer</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e996" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe996;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hammer, tool2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-magic-wand">

                                    </span>
                                    <span class="mls"> icon-magic-wand</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e997" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe997;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="magic-wand, wizard" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-aid-kit">

                                    </span>
                                    <span class="mls"> icon-aid-kit</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e998" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe998;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="aid-kit, health" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bug">

                                    </span>
                                    <span class="mls"> icon-bug</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e999" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe999;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bug, virus" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pie-chart">

                                    </span>
                                    <span class="mls"> icon-pie-chart</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e99a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe99a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pie-chart, stats" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stats-dots">

                                    </span>
                                    <span class="mls"> icon-stats-dots</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e99b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe99b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stats-dots, stats2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stats-bars">

                                    </span>
                                    <span class="mls"> icon-stats-bars</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e99c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe99c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stats-bars, stats3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stats-bars2">

                                    </span>
                                    <span class="mls"> icon-stats-bars2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e99d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe99d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stats-bars2, stats4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-trophy">

                                    </span>
                                    <span class="mls"> icon-trophy</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e99e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe99e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="trophy, cup" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-gift">

                                    </span>
                                    <span class="mls"> icon-gift</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e99f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe99f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="gift, present" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-glass">

                                    </span>
                                    <span class="mls"> icon-glass</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="glass, drink" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-glass2">

                                    </span>
                                    <span class="mls"> icon-glass2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="glass2, drink2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mug">

                                    </span>
                                    <span class="mls"> icon-mug</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mug, drink3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spoon-knife">

                                    </span>
                                    <span class="mls"> icon-spoon-knife</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spoon-knife, food" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-leaf">

                                    </span>
                                    <span class="mls"> icon-leaf</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="leaf, nature" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-rocket">

                                    </span>
                                    <span class="mls"> icon-rocket</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="rocket, jet" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-meter">

                                    </span>
                                    <span class="mls"> icon-meter</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="meter, gauge" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-meter2">

                                    </span>
                                    <span class="mls"> icon-meter2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="meter2, gauge2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hammer2">

                                    </span>
                                    <span class="mls"> icon-hammer2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hammer2, gavel" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-fire">

                                    </span>
                                    <span class="mls"> icon-fire</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9a9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9a9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="fire, flame" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-lab">

                                    </span>
                                    <span class="mls"> icon-lab</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9aa" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9aa;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="lab, beta" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-magnet">

                                    </span>
                                    <span class="mls"> icon-magnet</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ab" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ab;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="magnet, attract" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bin">

                                    </span>
                                    <span class="mls"> icon-bin</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ac" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ac;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bin, trashcan" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bin2">

                                    </span>
                                    <span class="mls"> icon-bin2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ad" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ad;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bin2, trashcan2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-briefcase">

                                    </span>
                                    <span class="mls"> icon-briefcase</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ae" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ae;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="briefcase, portfolio" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-airplane">

                                    </span>
                                    <span class="mls"> icon-airplane</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9af" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9af;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="airplane, travel" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-truck">

                                    </span>
                                    <span class="mls"> icon-truck</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="truck, transit" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-road">

                                    </span>
                                    <span class="mls"> icon-road</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="road, asphalt" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-accessibility">

                                    </span>
                                    <span class="mls"> icon-accessibility</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="accessibility" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-target">

                                    </span>
                                    <span class="mls"> icon-target</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="target, goal" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shield">

                                    </span>
                                    <span class="mls"> icon-shield</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shield, security" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-power">

                                    </span>
                                    <span class="mls"> icon-power</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="power, lightning" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-switch">

                                    </span>
                                    <span class="mls"> icon-switch</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="switch" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-power-cord">

                                    </span>
                                    <span class="mls"> icon-power-cord</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="power-cord, plugin" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-clipboard">

                                    </span>
                                    <span class="mls"> icon-clipboard</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="clipboard, board" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-list-numbered">

                                    </span>
                                    <span class="mls"> icon-list-numbered</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9b9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9b9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="list-numbered, options" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-list">

                                    </span>
                                    <span class="mls"> icon-list</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ba" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ba;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="list, todo" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-list2">

                                    </span>
                                    <span class="mls"> icon-list2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9bb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9bb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="list2, todo2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tree">

                                    </span>
                                    <span class="mls"> icon-tree</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9bc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9bc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tree, branches" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-menu">

                                    </span>
                                    <span class="mls"> icon-menu</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9bd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9bd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="menu, list3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-menu2">

                                    </span>
                                    <span class="mls"> icon-menu2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9be" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9be;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="menu2, options2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-menu3">

                                    </span>
                                    <span class="mls"> icon-menu3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9bf" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9bf;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="menu3, options3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-menu4">

                                    </span>
                                    <span class="mls"> icon-menu4</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="menu4, options4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cloud">

                                    </span>
                                    <span class="mls"> icon-cloud</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cloud, weather" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cloud-download">

                                    </span>
                                    <span class="mls"> icon-cloud-download</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cloud-download, cloud2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cloud-upload">

                                    </span>
                                    <span class="mls"> icon-cloud-upload</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cloud-upload, cloud3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cloud-check">

                                    </span>
                                    <span class="mls"> icon-cloud-check</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cloud-check, cloud4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-download2">

                                    </span>
                                    <span class="mls"> icon-download2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="download2, save4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-upload2">

                                    </span>
                                    <span class="mls"> icon-upload2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="upload2, load2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-download3">

                                    </span>
                                    <span class="mls"> icon-download3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="download3, save5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-upload3">

                                    </span>
                                    <span class="mls"> icon-upload3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="upload3, load3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sphere">

                                    </span>
                                    <span class="mls"> icon-sphere</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9c9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9c9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sphere, globe" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-earth">

                                    </span>
                                    <span class="mls"> icon-earth</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ca" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ca;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="earth, globe2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-link">

                                    </span>
                                    <span class="mls"> icon-link</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9cb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9cb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="link, chain" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-flag">

                                    </span>
                                    <span class="mls"> icon-flag</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9cc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9cc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="flag, report" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-attachment">

                                    </span>
                                    <span class="mls"> icon-attachment</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9cd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9cd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="attachment, paperclip" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-eye">

                                    </span>
                                    <span class="mls"> icon-eye</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ce" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ce;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="eye, views" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-eye-plus">

                                    </span>
                                    <span class="mls"> icon-eye-plus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9cf" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9cf;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="eye-plus, views2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-eye-minus">

                                    </span>
                                    <span class="mls"> icon-eye-minus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="eye-minus, views3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-eye-blocked">

                                    </span>
                                    <span class="mls"> icon-eye-blocked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="eye-blocked, views4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bookmark">

                                    </span>
                                    <span class="mls"> icon-bookmark</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bookmark, ribbon" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bookmarks">

                                    </span>
                                    <span class="mls"> icon-bookmarks</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bookmarks, ribbons" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sun">

                                    </span>
                                    <span class="mls"> icon-sun</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sun, weather2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-contrast">

                                    </span>
                                    <span class="mls"> icon-contrast</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="contrast" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-brightness-contrast">

                                    </span>
                                    <span class="mls"> icon-brightness-contrast</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="brightness-contrast" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-star-empty">

                                    </span>
                                    <span class="mls"> icon-star-empty</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="star-empty, rate" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-star-half">

                                    </span>
                                    <span class="mls"> icon-star-half</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="star-half, rate2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-star-full">

                                    </span>
                                    <span class="mls"> icon-star-full</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9d9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9d9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="star-full, rate3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-heart">

                                    </span>
                                    <span class="mls"> icon-heart</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9da" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9da;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="heart, like" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-heart-broken">

                                    </span>
                                    <span class="mls"> icon-heart-broken</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9db" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9db;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="heart-broken, heart2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-man">

                                    </span>
                                    <span class="mls"> icon-man</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9dc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9dc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="man, male" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-woman">

                                    </span>
                                    <span class="mls"> icon-woman</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9dd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9dd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="woman, female" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-man-woman">

                                    </span>
                                    <span class="mls"> icon-man-woman</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9de" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9de;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="man-woman, toilet" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-happy">

                                    </span>
                                    <span class="mls"> icon-happy</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9df" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9df;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="happy, emoticon" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-happy2">

                                    </span>
                                    <span class="mls"> icon-happy2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="happy2, emoticon2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-smile">

                                    </span>
                                    <span class="mls"> icon-smile</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="smile, emoticon3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-smile2">

                                    </span>
                                    <span class="mls"> icon-smile2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="smile2, emoticon4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tongue">

                                    </span>
                                    <span class="mls"> icon-tongue</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tongue, emoticon5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tongue2">

                                    </span>
                                    <span class="mls"> icon-tongue2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tongue2, emoticon6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sad">

                                    </span>
                                    <span class="mls"> icon-sad</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sad, emoticon7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sad2">

                                    </span>
                                    <span class="mls"> icon-sad2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sad2, emoticon8" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wink">

                                    </span>
                                    <span class="mls"> icon-wink</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wink, emoticon9" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wink2">

                                    </span>
                                    <span class="mls"> icon-wink2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wink2, emoticon10" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-grin">

                                    </span>
                                    <span class="mls"> icon-grin</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9e9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9e9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="grin, emoticon11" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-grin2">

                                    </span>
                                    <span class="mls"> icon-grin2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ea" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ea;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="grin2, emoticon12" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cool">

                                    </span>
                                    <span class="mls"> icon-cool</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9eb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9eb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cool, emoticon13" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cool2">

                                    </span>
                                    <span class="mls"> icon-cool2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ec" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ec;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cool2, emoticon14" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-angry">

                                    </span>
                                    <span class="mls"> icon-angry</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ed" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ed;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="angry, emoticon15" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-angry2">

                                    </span>
                                    <span class="mls"> icon-angry2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ee" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ee;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="angry2, emoticon16" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-evil">

                                    </span>
                                    <span class="mls"> icon-evil</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ef" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ef;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="evil, emoticon17" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-evil2">

                                    </span>
                                    <span class="mls"> icon-evil2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="evil2, emoticon18" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shocked">

                                    </span>
                                    <span class="mls"> icon-shocked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shocked, emoticon19" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shocked2">

                                    </span>
                                    <span class="mls"> icon-shocked2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shocked2, emoticon20" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-baffled">

                                    </span>
                                    <span class="mls"> icon-baffled</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="baffled, emoticon21" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-baffled2">

                                    </span>
                                    <span class="mls"> icon-baffled2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="baffled2, emoticon22" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-confused">

                                    </span>
                                    <span class="mls"> icon-confused</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="confused, emoticon23" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-confused2">

                                    </span>
                                    <span class="mls"> icon-confused2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="confused2, emoticon24" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-neutral">

                                    </span>
                                    <span class="mls"> icon-neutral</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="neutral, emoticon25" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-neutral2">

                                    </span>
                                    <span class="mls"> icon-neutral2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="neutral2, emoticon26" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hipster">

                                    </span>
                                    <span class="mls"> icon-hipster</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9f9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9f9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hipster, emoticon27" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hipster2">

                                    </span>
                                    <span class="mls"> icon-hipster2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9fa" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9fa;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hipster2, emoticon28" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wondering">

                                    </span>
                                    <span class="mls"> icon-wondering</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9fb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9fb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wondering, emoticon29" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wondering2">

                                    </span>
                                    <span class="mls"> icon-wondering2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9fc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9fc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wondering2, emoticon30" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sleepy">

                                    </span>
                                    <span class="mls"> icon-sleepy</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9fd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9fd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sleepy, emoticon31" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sleepy2">

                                    </span>
                                    <span class="mls"> icon-sleepy2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9fe" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9fe;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sleepy2, emoticon32" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-frustrated">

                                    </span>
                                    <span class="mls"> icon-frustrated</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="e9ff" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xe9ff;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="frustrated, emoticon33" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-frustrated2">

                                    </span>
                                    <span class="mls"> icon-frustrated2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea00" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea00;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="frustrated2, emoticon34" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-crying">

                                    </span>
                                    <span class="mls"> icon-crying</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea01" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea01;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="crying, emoticon35" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-crying2">

                                    </span>
                                    <span class="mls"> icon-crying2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea02" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea02;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="crying2, emoticon36" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-point-up">

                                    </span>
                                    <span class="mls"> icon-point-up</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea03" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea03;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="point-up, finger" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-point-right">

                                    </span>
                                    <span class="mls"> icon-point-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea04" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea04;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="point-right, finger2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-point-down">

                                    </span>
                                    <span class="mls"> icon-point-down</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea05" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea05;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="point-down, finger3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-point-left">

                                    </span>
                                    <span class="mls"> icon-point-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea06" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea06;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="point-left, finger4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-warning">

                                    </span>
                                    <span class="mls"> icon-warning</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea07" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea07;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="warning, sign" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-notification">

                                    </span>
                                    <span class="mls"> icon-notification</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea08" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea08;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="notification, warning2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-question">

                                    </span>
                                    <span class="mls"> icon-question</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea09" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea09;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="question, help" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-plus">

                                    </span>
                                    <span class="mls"> icon-plus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea0a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea0a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="plus, add" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-minus">

                                    </span>
                                    <span class="mls"> icon-minus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea0b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea0b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="minus, subtract" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-info">

                                    </span>
                                    <span class="mls"> icon-info</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea0c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea0c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="info, information" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cancel-circle">

                                    </span>
                                    <span class="mls"> icon-cancel-circle</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea0d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea0d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cancel-circle, close" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-blocked">

                                    </span>
                                    <span class="mls"> icon-blocked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea0e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea0e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="blocked, forbidden" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-cross">

                                    </span>
                                    <span class="mls"> icon-cross</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea0f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea0f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="cross, cancel" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-checkmark">

                                    </span>
                                    <span class="mls"> icon-checkmark</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea10" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea10;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="checkmark, tick" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-checkmark2">

                                    </span>
                                    <span class="mls"> icon-checkmark2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea11" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea11;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="checkmark2, tick2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spell-check">

                                    </span>
                                    <span class="mls"> icon-spell-check</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea12" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea12;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spell-check, spelling" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-enter">

                                    </span>
                                    <span class="mls"> icon-enter</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea13" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea13;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="enter, signin" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-exit">

                                    </span>
                                    <span class="mls"> icon-exit</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea14" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea14;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="exit, signout" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-play2">

                                    </span>
                                    <span class="mls"> icon-play2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea15" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea15;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="play2, player" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pause">

                                    </span>
                                    <span class="mls"> icon-pause</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea16" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea16;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pause, player2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stop">

                                    </span>
                                    <span class="mls"> icon-stop</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea17" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea17;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stop, player3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-previous">

                                    </span>
                                    <span class="mls"> icon-previous</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea18" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea18;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="previous, player4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-next">

                                    </span>
                                    <span class="mls"> icon-next</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea19" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea19;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="next, player5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-backward">

                                    </span>
                                    <span class="mls"> icon-backward</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea1a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea1a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="backward, player6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-forward2">

                                    </span>
                                    <span class="mls"> icon-forward2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea1b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea1b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="forward2, player7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-play3">

                                    </span>
                                    <span class="mls"> icon-play3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea1c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea1c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="play3, player8" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pause2">

                                    </span>
                                    <span class="mls"> icon-pause2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea1d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea1d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pause2, player9" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stop2">

                                    </span>
                                    <span class="mls"> icon-stop2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea1e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea1e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stop2, player10" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-backward2">

                                    </span>
                                    <span class="mls"> icon-backward2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea1f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea1f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="backward2, player11" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-forward3">

                                    </span>
                                    <span class="mls"> icon-forward3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea20" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea20;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="forward3, player12" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-first">

                                    </span>
                                    <span class="mls"> icon-first</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea21" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea21;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="first, player13" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-last">

                                    </span>
                                    <span class="mls"> icon-last</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea22" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea22;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="last, player14" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-previous2">

                                    </span>
                                    <span class="mls"> icon-previous2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea23" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea23;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="previous2, player15" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-next2">

                                    </span>
                                    <span class="mls"> icon-next2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea24" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea24;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="next2, player16" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-eject">

                                    </span>
                                    <span class="mls"> icon-eject</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea25" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea25;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="eject, player17" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-high">

                                    </span>
                                    <span class="mls"> icon-volume-high</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea26" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea26;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-high, volume" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-medium">

                                    </span>
                                    <span class="mls"> icon-volume-medium</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea27" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea27;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-medium, volume2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-low">

                                    </span>
                                    <span class="mls"> icon-volume-low</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea28" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea28;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-low, volume3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-mute">

                                    </span>
                                    <span class="mls"> icon-volume-mute</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea29" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea29;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-mute, volume4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-mute2">

                                    </span>
                                    <span class="mls"> icon-volume-mute2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea2a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea2a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-mute2, volume5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-increase">

                                    </span>
                                    <span class="mls"> icon-volume-increase</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea2b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea2b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-increase, volume6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-volume-decrease">

                                    </span>
                                    <span class="mls"> icon-volume-decrease</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea2c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea2c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="volume-decrease, volume7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-loop">

                                    </span>
                                    <span class="mls"> icon-loop</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea2d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea2d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="loop, repeat" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-loop2">

                                    </span>
                                    <span class="mls"> icon-loop2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea2e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea2e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="loop2, repeat2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-infinite">

                                    </span>
                                    <span class="mls"> icon-infinite</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea2f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea2f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="infinite" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shuffle">

                                    </span>
                                    <span class="mls"> icon-shuffle</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea30" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea30;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shuffle, random" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-up-left">

                                    </span>
                                    <span class="mls"> icon-arrow-up-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea31" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea31;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-up-left, up-left" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-up">

                                    </span>
                                    <span class="mls"> icon-arrow-up</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea32" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea32;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-up, up" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-up-right">

                                    </span>
                                    <span class="mls"> icon-arrow-up-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea33" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea33;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-up-right, up-right" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-right">

                                    </span>
                                    <span class="mls"> icon-arrow-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea34" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea34;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-right, right3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-down-right">

                                    </span>
                                    <span class="mls"> icon-arrow-down-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea35" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea35;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-down-right, down-right" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-down">

                                    </span>
                                    <span class="mls"> icon-arrow-down</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea36" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea36;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-down, down" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-down-left">

                                    </span>
                                    <span class="mls"> icon-arrow-down-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea37" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea37;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-down-left, down-left" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-left">

                                    </span>
                                    <span class="mls"> icon-arrow-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea38" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea38;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-left, left3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-up-left2">

                                    </span>
                                    <span class="mls"> icon-arrow-up-left2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea39" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea39;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-up-left2, up-left2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-up2">

                                    </span>
                                    <span class="mls"> icon-arrow-up2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea3a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea3a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-up2, up2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-up-right2">

                                    </span>
                                    <span class="mls"> icon-arrow-up-right2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea3b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea3b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-up-right2, up-right2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-right2">

                                    </span>
                                    <span class="mls"> icon-arrow-right2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea3c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea3c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-right2, right4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-down-right2">

                                    </span>
                                    <span class="mls"> icon-arrow-down-right2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea3d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea3d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-down-right2, down-right2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-down2">

                                    </span>
                                    <span class="mls"> icon-arrow-down2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea3e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea3e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-down2, down2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-down-left2">

                                    </span>
                                    <span class="mls"> icon-arrow-down-left2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea3f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea3f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-down-left2, down-left2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-arrow-left2">

                                    </span>
                                    <span class="mls"> icon-arrow-left2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea40" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea40;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="arrow-left2, left4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-circle-up">

                                    </span>
                                    <span class="mls"> icon-circle-up</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea41" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea41;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="circle-up, up3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-circle-right">

                                    </span>
                                    <span class="mls"> icon-circle-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea42" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea42;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="circle-right, right5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-circle-down">

                                    </span>
                                    <span class="mls"> icon-circle-down</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea43" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea43;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="circle-down, down3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-circle-left">

                                    </span>
                                    <span class="mls"> icon-circle-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea44" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea44;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="circle-left, left5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tab">

                                    </span>
                                    <span class="mls"> icon-tab</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea45" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea45;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tab, arrows" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-move-up">

                                    </span>
                                    <span class="mls"> icon-move-up</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea46" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea46;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="move-up, sort" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-move-down">

                                    </span>
                                    <span class="mls"> icon-move-down</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea47" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea47;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="move-down, sort2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sort-alpha-asc">

                                    </span>
                                    <span class="mls"> icon-sort-alpha-asc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea48" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea48;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sort-alpha-asc, arrange" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sort-alpha-desc">

                                    </span>
                                    <span class="mls"> icon-sort-alpha-desc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea49" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea49;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sort-alpha-desc, arrange2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sort-numeric-asc">

                                    </span>
                                    <span class="mls"> icon-sort-numeric-asc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea4a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea4a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sort-numeric-asc, arrange3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sort-numberic-desc">

                                    </span>
                                    <span class="mls"> icon-sort-numberic-desc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea4b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea4b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sort-numberic-desc, arrange4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sort-amount-asc">

                                    </span>
                                    <span class="mls"> icon-sort-amount-asc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea4c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea4c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sort-amount-asc, arrange5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sort-amount-desc">

                                    </span>
                                    <span class="mls"> icon-sort-amount-desc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea4d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea4d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sort-amount-desc, arrange6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-command">

                                    </span>
                                    <span class="mls"> icon-command</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea4e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea4e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="command, cmd" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-shift">

                                    </span>
                                    <span class="mls"> icon-shift</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea4f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea4f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="shift" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ctrl">

                                    </span>
                                    <span class="mls"> icon-ctrl</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea50" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea50;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ctrl, control" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-opt">

                                    </span>
                                    <span class="mls"> icon-opt</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea51" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea51;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="opt, option" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-checkbox-checked">

                                    </span>
                                    <span class="mls"> icon-checkbox-checked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea52" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea52;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="checkbox-checked, checkbox" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-checkbox-unchecked">

                                    </span>
                                    <span class="mls"> icon-checkbox-unchecked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea53" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea53;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="checkbox-unchecked, checkbox2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-radio-checked">

                                    </span>
                                    <span class="mls"> icon-radio-checked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea54" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea54;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="radio-checked, radio-button" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-radio-checked2">

                                    </span>
                                    <span class="mls"> icon-radio-checked2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea55" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea55;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="radio-checked2, radio-button2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-radio-unchecked">

                                    </span>
                                    <span class="mls"> icon-radio-unchecked</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea56" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea56;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="radio-unchecked, radio-button3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-crop">

                                    </span>
                                    <span class="mls"> icon-crop</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea57" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea57;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="crop, resize" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-make-group">

                                    </span>
                                    <span class="mls"> icon-make-group</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea58" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea58;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="make-group" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ungroup">

                                    </span>
                                    <span class="mls"> icon-ungroup</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea59" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea59;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ungroup" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-scissors">

                                    </span>
                                    <span class="mls"> icon-scissors</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea5a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea5a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="scissors, cut" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-filter">

                                    </span>
                                    <span class="mls"> icon-filter</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea5b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea5b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="filter, funnel" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-font">

                                    </span>
                                    <span class="mls"> icon-font</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea5c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea5c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="font, typeface" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ligature">

                                    </span>
                                    <span class="mls"> icon-ligature</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea5d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea5d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ligature, typography" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ligature2">

                                    </span>
                                    <span class="mls"> icon-ligature2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea5e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea5e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ligature2, typography2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-text-height">

                                    </span>
                                    <span class="mls"> icon-text-height</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea5f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea5f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="text-height, wysiwyg" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-text-width">

                                    </span>
                                    <span class="mls"> icon-text-width</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea60" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea60;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="text-width, wysiwyg2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-font-size">

                                    </span>
                                    <span class="mls"> icon-font-size</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea61" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea61;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="font-size, wysiwyg3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-bold">

                                    </span>
                                    <span class="mls"> icon-bold</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea62" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea62;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="bold, wysiwyg4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-underline">

                                    </span>
                                    <span class="mls"> icon-underline</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea63" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea63;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="underline, wysiwyg5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-italic">

                                    </span>
                                    <span class="mls"> icon-italic</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea64" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea64;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="italic, wysiwyg6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-strikethrough">

                                    </span>
                                    <span class="mls"> icon-strikethrough</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea65" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea65;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="strikethrough, wysiwyg7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-omega">

                                    </span>
                                    <span class="mls"> icon-omega</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea66" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea66;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="omega, wysiwyg8" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sigma">

                                    </span>
                                    <span class="mls"> icon-sigma</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea67" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea67;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sigma, wysiwyg9" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-page-break">

                                    </span>
                                    <span class="mls"> icon-page-break</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea68" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea68;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="page-break, wysiwyg10" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-superscript">

                                    </span>
                                    <span class="mls"> icon-superscript</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea69" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea69;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="superscript, wysiwyg11" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-subscript">

                                    </span>
                                    <span class="mls"> icon-subscript</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea6a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea6a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="subscript, wysiwyg12" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-superscript2">

                                    </span>
                                    <span class="mls"> icon-superscript2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea6b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea6b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="superscript2, wysiwyg13" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-subscript2">

                                    </span>
                                    <span class="mls"> icon-subscript2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea6c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea6c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="subscript2, wysiwyg14" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-text-color">

                                    </span>
                                    <span class="mls"> icon-text-color</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea6d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea6d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="text-color, wysiwyg15" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pagebreak">

                                    </span>
                                    <span class="mls"> icon-pagebreak</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea6e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea6e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pagebreak, wysiwyg16" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-clear-formatting">

                                    </span>
                                    <span class="mls"> icon-clear-formatting</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea6f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea6f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="clear-formatting, wysiwyg17" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-table">

                                    </span>
                                    <span class="mls"> icon-table</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea70" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea70;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="table, wysiwyg18" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-table2">

                                    </span>
                                    <span class="mls"> icon-table2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea71" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea71;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="table2, wysiwyg19" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-insert-template">

                                    </span>
                                    <span class="mls"> icon-insert-template</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea72" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea72;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="insert-template, wysiwyg20" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pilcrow">

                                    </span>
                                    <span class="mls"> icon-pilcrow</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea73" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea73;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pilcrow, wysiwyg21" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ltr">

                                    </span>
                                    <span class="mls"> icon-ltr</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea74" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea74;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ltr, wysiwyg22" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-rtl">

                                    </span>
                                    <span class="mls"> icon-rtl</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea75" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea75;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="rtl, wysiwyg23" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-section">

                                    </span>
                                    <span class="mls"> icon-section</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea76" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea76;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="section, wysiwyg24" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paragraph-left">

                                    </span>
                                    <span class="mls"> icon-paragraph-left</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea77" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea77;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paragraph-left, wysiwyg25" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paragraph-center">

                                    </span>
                                    <span class="mls"> icon-paragraph-center</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea78" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea78;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paragraph-center, wysiwyg26" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paragraph-right">

                                    </span>
                                    <span class="mls"> icon-paragraph-right</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea79" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea79;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paragraph-right, wysiwyg27" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paragraph-justify">

                                    </span>
                                    <span class="mls"> icon-paragraph-justify</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea7a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea7a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paragraph-justify, wysiwyg28" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-indent-increase">

                                    </span>
                                    <span class="mls"> icon-indent-increase</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea7b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea7b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="indent-increase, wysiwyg29" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-indent-decrease">

                                    </span>
                                    <span class="mls"> icon-indent-decrease</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea7c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea7c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="indent-decrease, wysiwyg30" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-share">

                                    </span>
                                    <span class="mls"> icon-share</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea7d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea7d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="share, out" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-new-tab">

                                    </span>
                                    <span class="mls"> icon-new-tab</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea7e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea7e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="new-tab, out2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-embed">

                                    </span>
                                    <span class="mls"> icon-embed</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea7f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea7f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="embed, code" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-embed2">

                                    </span>
                                    <span class="mls"> icon-embed2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea80" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea80;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="embed2, code2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-terminal">

                                    </span>
                                    <span class="mls"> icon-terminal</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea81" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea81;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="terminal, console" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-share2">

                                    </span>
                                    <span class="mls"> icon-share2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea82" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea82;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="share2, social" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mail">

                                    </span>
                                    <span class="mls"> icon-mail</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea83" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea83;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mail2, contact2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mail2">

                                    </span>
                                    <span class="mls"> icon-mail2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea84" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea84;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mail3, contact3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mail3">

                                    </span>
                                    <span class="mls"> icon-mail3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea85" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea85;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mail4, contact4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-mail4">

                                    </span>
                                    <span class="mls"> icon-mail4</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea86" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea86;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="mail5, contact5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-amazon">

                                    </span>
                                    <span class="mls"> icon-amazon</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea87" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea87;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="amazon, brand" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google">

                                    </span>
                                    <span class="mls"> icon-google</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea88" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea88;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google, brand2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google2">

                                    </span>
                                    <span class="mls"> icon-google2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea89" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea89;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google2, brand3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google3">

                                    </span>
                                    <span class="mls"> icon-google3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea8a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea8a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google3, brand4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google-plus">

                                    </span>
                                    <span class="mls"> icon-google-plus</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea8b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea8b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google-plus, brand5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google-plus2">

                                    </span>
                                    <span class="mls"> icon-google-plus2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea8c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea8c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google-plus2, brand6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google-plus3">

                                    </span>
                                    <span class="mls"> icon-google-plus3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea8d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea8d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google-plus3, brand7" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hangouts">

                                    </span>
                                    <span class="mls"> icon-hangouts</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea8e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea8e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hangouts, brand8" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-google-drive">

                                    </span>
                                    <span class="mls"> icon-google-drive</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea8f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea8f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="google-drive, brand9" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-facebook">

                                    </span>
                                    <span class="mls"> icon-facebook</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea90" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea90;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="facebook, brand10" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-facebook2">

                                    </span>
                                    <span class="mls"> icon-facebook2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea91" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea91;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="facebook2, brand11" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-instagram">

                                    </span>
                                    <span class="mls"> icon-instagram</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea92" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea92;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="instagram, brand12" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-whatsapp">

                                    </span>
                                    <span class="mls"> icon-whatsapp</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea93" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea93;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="whatsapp, brand13" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-spotify">

                                    </span>
                                    <span class="mls"> icon-spotify</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea94" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea94;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="spotify, brand14" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-telegram">

                                    </span>
                                    <span class="mls"> icon-telegram</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea95" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea95;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="telegram, brand15" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-twitter">

                                    </span>
                                    <span class="mls"> icon-twitter</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea96" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea96;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="twitter, brand16" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-vine">

                                    </span>
                                    <span class="mls"> icon-vine</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea97" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea97;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="vine, brand17" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-vk">

                                    </span>
                                    <span class="mls"> icon-vk</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea98" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea98;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="vk, brand18" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-renren">

                                    </span>
                                    <span class="mls"> icon-renren</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea99" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea99;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="renren, brand19" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-sina-weibo">

                                    </span>
                                    <span class="mls"> icon-sina-weibo</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea9a" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea9a;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="sina-weibo, brand20" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-rss">

                                    </span>
                                    <span class="mls"> icon-rss</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea9b" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea9b;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="feed2, rss" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-rss2">

                                    </span>
                                    <span class="mls"> icon-rss2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea9c" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea9c;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="feed3, rss2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-youtube">

                                    </span>
                                    <span class="mls"> icon-youtube</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea9d" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea9d;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="youtube, brand21" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-youtube2">

                                    </span>
                                    <span class="mls"> icon-youtube2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea9e" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea9e;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="youtube2, brand22" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-twitch">

                                    </span>
                                    <span class="mls"> icon-twitch</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ea9f" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xea9f;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="twitch, brand23" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-vimeo">

                                    </span>
                                    <span class="mls"> icon-vimeo</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="vimeo, brand24" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-vimeo2">

                                    </span>
                                    <span class="mls"> icon-vimeo2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="vimeo2, brand25" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-lanyrd">

                                    </span>
                                    <span class="mls"> icon-lanyrd</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="lanyrd, brand26" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-flickr">

                                    </span>
                                    <span class="mls"> icon-flickr</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="flickr, brand27" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-flickr2">

                                    </span>
                                    <span class="mls"> icon-flickr2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="flickr2, brand28" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-flickr3">

                                    </span>
                                    <span class="mls"> icon-flickr3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="flickr3, brand29" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-flickr4">

                                    </span>
                                    <span class="mls"> icon-flickr4</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="flickr4, brand30" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-dribbble">

                                    </span>
                                    <span class="mls"> icon-dribbble</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="dribbble, brand31" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-behance">

                                    </span>
                                    <span class="mls"> icon-behance</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="behance, brand32" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-behance2">

                                    </span>
                                    <span class="mls"> icon-behance2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaa9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaa9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="behance2, brand33" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-deviantart">

                                    </span>
                                    <span class="mls"> icon-deviantart</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaaa" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaaa;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="deviantart, brand34" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-500px">

                                    </span>
                                    <span class="mls"> icon-500px</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaab" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaab;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="500px, brand35" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-steam">

                                    </span>
                                    <span class="mls"> icon-steam</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaac" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaac;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="steam, brand36" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-steam2">

                                    </span>
                                    <span class="mls"> icon-steam2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaad" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaad;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="steam2, brand37" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-dropbox">

                                    </span>
                                    <span class="mls"> icon-dropbox</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaae" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaae;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="dropbox, brand38" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-onedrive">

                                    </span>
                                    <span class="mls"> icon-onedrive</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaaf" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaaf;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="onedrive, brand39" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-github">

                                    </span>
                                    <span class="mls"> icon-github</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="github, brand40" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-npm">

                                    </span>
                                    <span class="mls"> icon-npm</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="npm, brand41" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-basecamp">

                                    </span>
                                    <span class="mls"> icon-basecamp</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="basecamp, brand42" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-trello">

                                    </span>
                                    <span class="mls"> icon-trello</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="trello, brand43" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wordpress">

                                    </span>
                                    <span class="mls"> icon-wordpress</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wordpress, brand44" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-joomla">

                                    </span>
                                    <span class="mls"> icon-joomla</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="joomla, brand45" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-ello">

                                    </span>
                                    <span class="mls"> icon-ello</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="ello, brand46" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-blogger">

                                    </span>
                                    <span class="mls"> icon-blogger</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="blogger, brand47" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-blogger2">

                                    </span>
                                    <span class="mls"> icon-blogger2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="blogger2, brand48" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tumblr">

                                    </span>
                                    <span class="mls"> icon-tumblr</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eab9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeab9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tumblr, brand49" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tumblr2">

                                    </span>
                                    <span class="mls"> icon-tumblr2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaba" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaba;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tumblr2, brand50" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-yahoo">

                                    </span>
                                    <span class="mls"> icon-yahoo</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eabb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeabb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="yahoo, brand51" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-yahoo2">

                                    </span>
                                    <span class="mls"> icon-yahoo2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eabc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeabc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="yahoo2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-tux">

                                    </span>
                                    <span class="mls"> icon-tux</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eabd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeabd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="tux, brand52" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-appleinc">

                                    </span>
                                    <span class="mls"> icon-appleinc</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eabe" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeabe;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="apple, brand53" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-finder">

                                    </span>
                                    <span class="mls"> icon-finder</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eabf" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeabf;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="finder, brand54" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-android">

                                    </span>
                                    <span class="mls"> icon-android</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="android, brand55" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-windows">

                                    </span>
                                    <span class="mls"> icon-windows</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="windows, brand56" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-windows8">

                                    </span>
                                    <span class="mls"> icon-windows8</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="windows8, brand57" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-soundcloud">

                                    </span>
                                    <span class="mls"> icon-soundcloud</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="soundcloud, brand58" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-soundcloud2">

                                    </span>
                                    <span class="mls"> icon-soundcloud2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="soundcloud2, brand59" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-skype">

                                    </span>
                                    <span class="mls"> icon-skype</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="skype, brand60" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-reddit">

                                    </span>
                                    <span class="mls"> icon-reddit</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="reddit, brand61" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-hackernews">

                                    </span>
                                    <span class="mls"> icon-hackernews</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="hackernews, brand62" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-wikipedia">

                                    </span>
                                    <span class="mls"> icon-wikipedia</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="wikipedia, brand63" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-linkedin">

                                    </span>
                                    <span class="mls"> icon-linkedin</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eac9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeac9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="linkedin, brand64" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-linkedin2">

                                    </span>
                                    <span class="mls"> icon-linkedin2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaca" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaca;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="linkedin2, brand65" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-lastfm">

                                    </span>
                                    <span class="mls"> icon-lastfm</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eacb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeacb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="lastfm, brand66" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-lastfm2">

                                    </span>
                                    <span class="mls"> icon-lastfm2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eacc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeacc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="lastfm2, brand67" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-delicious">

                                    </span>
                                    <span class="mls"> icon-delicious</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eacd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeacd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="delicious, brand68" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stumbleupon">

                                    </span>
                                    <span class="mls"> icon-stumbleupon</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eace" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeace;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stumbleupon, brand69" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stumbleupon2">

                                    </span>
                                    <span class="mls"> icon-stumbleupon2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eacf" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeacf;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stumbleupon2, brand70" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-stackoverflow">

                                    </span>
                                    <span class="mls"> icon-stackoverflow</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="stackoverflow, brand71" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pinterest">

                                    </span>
                                    <span class="mls"> icon-pinterest</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pinterest, brand72" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-pinterest2">

                                    </span>
                                    <span class="mls"> icon-pinterest2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="pinterest2, brand73" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-xing">

                                    </span>
                                    <span class="mls"> icon-xing</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="xing, brand74" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-xing2">

                                    </span>
                                    <span class="mls"> icon-xing2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="xing2, brand75" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-flattr">

                                    </span>
                                    <span class="mls"> icon-flattr</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="flattr, brand76" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-foursquare">

                                    </span>
                                    <span class="mls"> icon-foursquare</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="foursquare, brand77" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-yelp">

                                    </span>
                                    <span class="mls"> icon-yelp</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="yelp, brand78" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-paypal">

                                    </span>
                                    <span class="mls"> icon-paypal</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="paypal, brand79" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-chrome">

                                    </span>
                                    <span class="mls"> icon-chrome</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="ead9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xead9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="chrome, browser" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-firefox">

                                    </span>
                                    <span class="mls"> icon-firefox</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eada" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeada;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="firefox, browser2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-IE">

                                    </span>
                                    <span class="mls"> icon-IE</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eadb" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeadb;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="IE, browser3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-edge">

                                    </span>
                                    <span class="mls"> icon-edge</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eadc" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeadc;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="edge, browser4" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-safari">

                                    </span>
                                    <span class="mls"> icon-safari</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eadd" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeadd;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="safari, browser5" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-opera">

                                    </span>
                                    <span class="mls"> icon-opera</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eade" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeade;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="opera, browser6" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-pdf">

                                    </span>
                                    <span class="mls"> icon-file-pdf</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eadf" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeadf;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-pdf, file10" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-openoffice">

                                    </span>
                                    <span class="mls"> icon-file-openoffice</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae0" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae0;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-openoffice, file11" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-word">

                                    </span>
                                    <span class="mls"> icon-file-word</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae1" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae1;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-word, file12" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-file-excel">

                                    </span>
                                    <span class="mls"> icon-file-excel</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae2" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae2;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="file-excel, file13" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-libreoffice">

                                    </span>
                                    <span class="mls"> icon-libreoffice</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae3" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae3;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="libreoffice, file14" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-html-five">

                                    </span>
                                    <span class="mls"> icon-html-five</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae4" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae4;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="html-five, w3c" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-html-five2">

                                    </span>
                                    <span class="mls"> icon-html-five2</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae5" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae5;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="html-five2, w3c2" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-css3">

                                    </span>
                                    <span class="mls"> icon-css3</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae6" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae6;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="css3, w3c3" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-git">

                                    </span>
                                    <span class="mls"> icon-git</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae7" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae7;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="git, brand80" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-codepen">

                                    </span>
                                    <span class="mls"> icon-codepen</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae8" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae8;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="codepen, brand81" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-svg">

                                    </span>
                                    <span class="mls"> icon-svg</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eae9" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeae9;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="svg" class="liga unitRight" />
                                </div>
                            </div>
                            <div class="glyph fs1">
                                <div class="clearfix bshadow0 pbs">
                                    <span class="icon-IcoMoon">

                                    </span>
                                    <span class="mls"> icon-IcoMoon</span>
                                </div>
                                <fieldset class="fs0 size1of1 clearfix hidden-false">
                                    <input type="text" readonly value="eaea" class="unit size1of2" />
                                    <input type="text" maxlength="1" readonly value="&#xeaea;" class="unitRight size1of2 talign-right" />
                                </fieldset>
                                <div class="fs0 bshadow0 clearfix hidden-false">
                                    <span class="unit pvs fgc1">liga: </span>
                                    <input type="text" readonly value="IcoMoon, icomoon" class="liga unitRight" />
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <!--CLOSE ICONS-->

        </div>
    </div>
</div>



<!--PANELS CLIPBOARD-->
<textarea id="panel_header_icon_action_subtitle" style="position: absolute; left: -10000px;">
<div class="panel_header">
    <span>
        <a href="javascript:void(0)" class="btn btn_blue icon-notext icon-link"></a>
    </span>
    <h2><span class="icon-command">Título do Painel</span></h2>
    <p class="subtitle">Subtítulo do Painel</p>
</div>
</textarea>

<textarea id="panel_header_action_subtitle" style="position: absolute; left: -10000px;">
<div class="panel_header">
    <span>
        <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
    </span>
    <h2>Título do Painel</h2>
    <p>Subtítulo do Painel</p>
</div>
</textarea>

<textarea id="panel_header_subtitle" style="position: absolute; left: -10000px;">
<div class="panel_header">
    <h2 class="no_border">Título do Painel</h2>
    <p>Subtítulo do Painel</p>
</div>
</textarea>

<textarea id="panel_header_icon_subtitle" style="position: absolute; left: -10000px;">
<div class="panel_header">
    <h2 class="icon-command">Título do Painel</h2>
    <p class="subtitle">Subtítulo do Painel</p>
</div>
</textarea>

<textarea id="panel_header_icon" style="position: absolute; left: -10000px;">
<div class="panel_header">
    <h2 class="icon-command">Título do Painel</h2>
</div>
</textarea>

<textarea id="panel_header_success" style="position: absolute; left: -10000px;">
<div class="panel_header success">
    <span>
        <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
    </span>
    <h2 class="icon-arrow-up">Sucesso</h2>
</div>
</textarea>

<textarea id="panel_header_alert" style="position: absolute; left: -10000px;">
<div class="panel_header alert">
    <span>
        <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
    </span>
    <h2 class="icon-arrow-up">Alerta</h2>
</div>
</textarea>

<textarea id="panel_header_info" style="position: absolute; left: -10000px;">
<div class="panel_header info">
    <span>
        <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
    </span>
    <h2 class="icon-arrow-up">Informação</h2>
</div>
</textarea>

<textarea id="panel_header_warning" style="position: absolute; left: -10000px;">
<div class="panel_header warning">
    <span>
        <a href="javascript:void(0)" class="btn icon-notext icon-link"></a>
    </span>
    <h2 class="icon-arrow-up">Cuidado</h2>
</div>
</textarea>

<textarea id="panel_footer" style="position: absolute; left: -10000px;">
<div class="panel_footer">
    <p>&reg; Conteúdo do rodapé interno</p>
</div>
</textarea>

<textarea id="panel_footer_external" style="position: absolute; left: -10000px;">
<div class="panel_footer_external">
    <p>&reg; Conteúdo do rodapé externo</p>
</div>
</textarea>

<!--BOXES CLIP BOARD-->
<textarea id="box100" style="position: absolute; left: -10000px;">
<div class="box box100">
    <!-- INSIRA AQUI O SEU panel_header -->
    <div class="panel">
        <p>Insira seu texto...</p>
    </div>
    <!-- INSIRA AQUI O SEU panel_footer -->
</div>
</textarea>

<textarea id="box70" style="position: absolute; left: -10000px;">
<div class="box box70">
    <!-- INSIRA AQUI O SEU panel_header -->
    <div class="panel">
        <p>Insira seu texto...</p>
    </div>
    <!-- INSIRA AQUI O SEU panel_footer -->
</div>
</textarea>

<textarea id="box50" style="position: absolute; left: -10000px;">
<div class="box box50">
    <!-- INSIRA AQUI O SEU panel_header -->
    <div class="panel">
        <p>Insira seu texto...</p>
    </div>
    <!-- INSIRA AQUI O SEU panel_footer -->
</div>
</textarea>

<textarea id="box33" style="position: absolute; left: -10000px;">
<div class="box box33">
    <!-- INSIRA AQUI O SEU panel_header -->
    <div class="panel">
        <p>Insira seu texto...</p>
    </div>
    <!-- INSIRA AQUI O SEU panel_footer -->
</div>
</textarea>

<textarea id="box30" style="position: absolute; left: -10000px;">
<div class="box box30">
    <!-- INSIRA AQUI O SEU panel_header -->
    <div class="panel">
        <p>Insira seu texto...</p>
    </div>
    <!-- INSIRA AQUI O SEU panel_footer -->
</div>
</textarea>

<textarea id="box25" style="position: absolute; left: -10000px;">
<div class="box box25">
    <!-- INSIRA AQUI O SEU panel_header -->
    <div class="panel">
        <p>Insira seu texto...</p>
    </div>
    <!-- INSIRA AQUI O SEU panel_footer -->
</div>
</textarea>

<!--FORMS-->
<textarea id="form" style="position: absolute; left: -10000px;">
    <form>
        <label class="label">
            <span class="legend">Campo 100%:</span>
            <input style="font-size: 1.4em;" type="text" name="titulo" placeholder="Digite um título" required/>
        </label>

        <div class="label_50">
            <label class="label">
                <span class="legend">Campo 1 50%:</span>
                <input style="font-size: 1.4em;" type="text" name="campo1" placeholder="Digite um título" required/>
            </label>
            <label class="label">
                <span class="legend">Campo 2 50%:</span>
                <input style="font-size: 1.4em;" type="text" name="campo2" placeholder="Digite um título" required/>
            </label>
            <div class="clear"></div>
        </div>

        <div class="label_33">
            <label class="label">
                <span class="legend">Campo 1 30%:</span>
                <input style="font-size: 1.4em;" type="text" name="campo1" placeholder="Digite um título" required/>
            </label>
            <label class="label">
                <span class="legend">Campo 2 30%:</span>
                <input style="font-size: 1.4em;" type="text" name="campo2" placeholder="Digite um título" required/>
            </label>

            <label class="label">
                <span class="legend">Campo 3 30%:</span>
                <input style="font-size: 1.4em;" type="text" name="campo3" placeholder="Digite um título" required/>
            </label>
        </div>

        <label class="label">
            <input type="submit" name="titulo" value="Enviar" class="btn btn_green fl_right"/>
        </label>
    </form>
</textarea>