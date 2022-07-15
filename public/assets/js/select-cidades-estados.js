function preencheCidade(sigla, cidade) {
    $.ajax({
        url: '/cidades-estados',
        method: "GET",
        dataType: "HTML",
        data: {"estado": sigla, "cidade": cidade}
    }).done(function (data) {
        $("#cidade").html(data);
    });
}

function preencheEstado(sigla) {
    $.ajax({
        url: '/select-estados',
        method: "GET",
        dataType: "HTML",
        data: {"estado": sigla}
    }).done(function (estados) {
        $("#estado").html(estados);
    });
}

$(function () {
    $("#estado").change(function () {
        preencheCidade($(this).val());
    });
})
