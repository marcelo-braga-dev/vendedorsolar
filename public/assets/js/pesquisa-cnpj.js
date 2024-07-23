$(function () {
    $('#cnpj').blur(function (e) {
        let cnpj = $('#cnpj').val().replace(/[^0-9]/g, '');

        if (cnpj.length === 14) {
            $.ajax({
                url: 'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
                method: 'GET',
                dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
                complete: function (xhr) {
                    let response = xhr.responseJSON;

                    if (response.status === 'OK') {
                        $('#razao_social').val(response.nome);
                        $('#nome_fantasia').val(response.fantasia);
                    } else {
                        $('#razao_social').val('');
                        $('#nome_fantasia').val('');
                    }
                }
            });
        }
    });
});
