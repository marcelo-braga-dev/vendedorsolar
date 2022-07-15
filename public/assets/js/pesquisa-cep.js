$(function () {
    $('#cep').blur(function () {
        pesquisacep($(this).val());
    })
})

function limpa_formulario_cep() {
    $('#endereco').val('');
    $('#bairro').val('');
    preencheEstado('');
    preencheCidade('', '');
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        $('#endereco').val(conteudo.logradouro);
        $('#bairro').val(conteudo.bairro);
        preencheEstado(conteudo.uf);
        preencheCidade(conteudo.uf, conteudo.localidade);
    } else {
        limpa_formulario_cep();
    }
}

function pesquisacep(valor) {
    let cep = valor.replace(/\D/g, '');

    if (cep !== "") {
        const validacep = /^\d{8}$/;
        if (validacep.test(cep)) {
            document.getElementById('endereco').value = "...";
            document.getElementById('bairro').value = "...";

            const script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            document.body.appendChild(script);
        } else {
            limpa_formulario_cep();
        }
    } else {
        limpa_formulario_cep();
    }
}
