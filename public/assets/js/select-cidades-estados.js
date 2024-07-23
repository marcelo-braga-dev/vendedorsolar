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

function selecionaLocalidade(id) {
    $.get("/api/endereco/id", {
            'id': id
        }, function (result) {
            preencheEstado(result.sigla);
            preencheCidade(result.sigla, result.cidade);
        }
    );
}

$(function () {
    $("#estado").change(function () {
        preencheCidade($(this).val());
    });
});
