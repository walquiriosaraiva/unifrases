function dataFormatada() { 
    setTimeout(dataFormatada,1000);
    var data = new Date();
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    hora = data.getHours(),
    minutos = data.getMinutes(),
    segundos = data.getSeconds();

    hora = ("0" + hora).slice(-2);
    minutos = ("0" + minutos).slice(-2);
    segundos = ("0" + segundos).slice(-2);

    $('#dataHoraServidor').html([dia, mes, ano].join('/') + ' às ' + [hora, minutos, segundos].join(':'));
        
    return true;
}

$(document).ready(function () {
    setTimeout(dataFormatada,1000);
});