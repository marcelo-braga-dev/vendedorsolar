$(function () {
    $("#estado").change(function () {
        let sigla = $(this).val();

        preencheCidade(sigla);
    });
})

function preencheCidade(sigla, cidade) {
    $.ajax({
        url: urlBd,
        method: "GET",
        dataType: "HTML",
        data: {"estado": sigla, "cidade": cidade}
    }).done(function (data) {
        $("#cidade").html(data);
    });
}

