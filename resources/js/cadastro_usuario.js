$(document).ready(function () {
    $("#cadastro_usuario").click(function () {
        $.ajax({
            url: "/api/cadastro_usuario",
            method: "POST",
            data: {
                nome: $("#nome").val(),
                turma: $("#turma").val(),
                horario: $("#horario").val(),
                atividade: $("#atividade").val(),
                observacao: $("#observacao").val(),
            },
            success: function (response) {
                if (response['erro'] == 'n') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: response['mensagem']
                    });
                    $("#nome, #turma, #horario, #atividade, #observacao").val('');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: response['mensagem']
                    });
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: xhr.responseJSON?.message || 'Não foi possível completar o cadastro.'
                });
            }
        });
    });
});