function iniciaPagina(idAno,idMes){
    var dataAtual = new Date();
    $(idAno).append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
    $(idAno).append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
    $(idAno).append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');

    document.getElementById(idMes).selectedIndex = dataAtual.getMonth()+1;

    //carregaPagina();
}