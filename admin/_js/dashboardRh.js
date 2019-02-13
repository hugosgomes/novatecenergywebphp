$(document).ready(function(){
	var callback = 'DashboardRh';
	var callback_action = 'selectfuncionarios';

	$.post('_ajax/' + callback + '.ajax.php', {callback, callback_action}, function (e) {

		if (e.nome){
			$(e.nome).appendTo("#painel1");
		}

		if (e.nome1) {
			$(e.nome1).appendTo("#painel2");
		}

		if (e.nome2) {
			$(e.nome2).appendTo("#painel3");
		}

		if (e.nomeLog) {
			$(e.nomeLog).appendTo("#painel_log");
		}


	},'json');

});


$('html').on('click', '#1', function(e){
	var callback = 'DashboardRh';
	var callback_action = 'clicarfuncionarios';

	$.post('_ajax/' + callback + '.ajax.php', {callback, callback_action}, function (e) {

		if (e.nomeF) {
			$('.documentos_vencidos option').remove();
			$(e.nomeF).appendTo(".documentos_vencidos");
		}

	},'json');


});

$('html').on('click', '#2', function(e){
	var callback = 'DashboardRh';
	var callback_action = 'clicarfuncionarios';

	$.post('_ajax/' + callback + '.ajax.php', {callback, callback_action}, function (e) {

		if (e.nomeF1) {
			$('.documentos_exp option').remove();
			$(e.nomeF1).appendTo(".documentos_exp");
		}

	},'json');


});	

$('html').on('click', '#3', function(e){
	var callback = 'DashboardRh';
	var callback_action = 'clicarfuncionarios';

	$.post('_ajax/' + callback + '.ajax.php', {callback, callback_action}, function (e) {

		if (e.nomeF2) {
			$('.documentos_pendentes option').remove();
			$(e.nomeF2).appendTo(".documentos_pendentes");
		}

	},'json');


});


$('html').on('click', '#4', function(e){
	var callback = 'DashboardRh';
	var callback_action = 'clicarfuncionarios';

	$.post('_ajax/' + callback + '.ajax.php', {callback, callback_action}, function (e) {

		if (e.nomeLog) {
			$('#j_table_DocumentosLog tr').remove();
			$(e.nomeLog).appendTo("#j_table_DocumentosLog");
		}

	},'json');

});

$(document).on('click', '.documentos_vencidos option', function (){
	
	var pegarvariavel = $(this).val();

	$(".pegarvalor").val(pegarvariavel);
	window.location = "dashboard.php?wc=rh/envioDocumentacao&ID="+pegarvariavel;
	$(".jogarvalor").trigger("click");

});
$(document).on('click', '.documentos_exp option', function (){
	
	var pegarvariavel = $(this).val();

	$(".pegarvalor").val(pegarvariavel);
	window.location = "dashboard.php?wc=rh/envioDocumentacao&ID="+pegarvariavel;
	$(".jogarvalor").trigger("click");

});
$(document).on('click', '.documentos_pendentes option', function (){
	
	var pegarvariavel = $(this).val();

	$(".pegarvalor").val(pegarvariavel);
	window.location = "dashboard.php?wc=rh/envioDocumentacao&ID="+pegarvariavel;
	$(".jogarvalor").trigger("click");

});