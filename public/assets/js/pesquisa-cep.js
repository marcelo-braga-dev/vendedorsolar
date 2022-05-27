function limpa_formulario_cep() {
    $('#endereco').val('');
    $('#bairro').val('');
    $('#estado').val('conteudo.uf').select2();
    $('#cidade').val('conteudo.uf').select2();
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        $('#endereco').val(conteudo.logradouro);
        $('#bairro').val(conteudo.bairro);
        $('#estado').val(conteudo.uf).select2();

        preencheCidade(conteudo.uf, conteudo.localidade);
    } else {
        limpa_formulario_cep();
        // alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {
    let cep = valor.replace(/\D/g, '');

    if (cep !== "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            document.getElementById('endereco').value = "...";
            document.getElementById('bairro').value = "...";

            var script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            document.body.appendChild(script);
        } else {
            limpa_formulario_cep();
            // alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulario_cep();
    }
}
