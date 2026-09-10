<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Entrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background: #efefef; font-family: Arial, Helvetica, sans-serif; }
        .container-custom { max-width: 1000px; margin: 40px auto; padding: 20px; }
        .panel { background: #fff; border-radius: 18px; padding: 32px 28px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .titulo { font-size: 2rem; font-weight: 700; color: #d71d1d; text-align: center; margin-bottom: 24px; }
        .input-style, .textarea-style { width: 100%; border-radius: 999px; border: 3px solid #2e2e2e; background: #d9d9d9; padding: 14px 18px; margin-top: 8px; font-size: 1rem; }
        select.input-style { appearance: auto; }
        .textarea-style { border-radius: 24px; resize: none; min-height: 120px; }
        .btn-registrar { display: block; margin: 24px auto 0; background: #d76a66; color: white; border: none; border-radius: 18px; padding: 16px 28px; font-weight: 800; text-transform: uppercase; box-shadow: 0 6px 0 #b65d58; }
        .links { display: flex; justify-content: center; gap: 18px; margin-top: 24px; }
        .links a { color: #b72d2d; font-weight: 700; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="panel">
            <div class="titulo">Registrar entrada</div>

            <div class="mb-3">
                <label for="nome">Nome</label>
                <input id="nome" type="text" class="input-style" placeholder="Digite o nome do aluno">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="turma">Turma</label>
                    <select id="turma" class="input-style">
                        <option value="">Selecione a turma</option>
                        <option value="9º ano A">9º ano A</option>
                        <option value="9º ano B">9º ano B</option>
                        <option value="1º ano A">1º ano A</option>
                        <option value="1º ano B">1º ano B</option>
                        <option value="2º ano A">2º ano A</option>
                        <option value="2º ano B">2º ano B</option>
                        <option value="3º ano A">3º ano A</option>
                        <option value="3º ano B">3º ano B</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="horario">Horário</label>
                    <select id="horario" class="input-style">
                        <option value="">Selecione o horário</option>
                        <option value="12:00">12:00</option>
                        <option value="12:10">12:10</option>
                        <option value="12:20">12:20</option>
                        <option value="12:30">12:30</option>
                        <option value="12:40">12:40</option>
                        <option value="12:50">12:50</option>
                        <option value="13:00">13:00</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="atividade">Motivo</label>
                <select id="atividade" class="input-style">
                    <option value="">Selecione o motivo</option>
                    <option value="Personaliza">Personaliza</option>
                    <option value="Academia">Academia</option>
                    <option value="Prepara ENEM">Prepara ENEM</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="observacao">Observação <span id="observacao_obrigatoria" hidden>(justificativa obrigatória para Outros)</span></label>
                <textarea id="observacao" class="textarea-style" placeholder="Descreva a justificativa quando escolher Outros"></textarea>
            </div>

            <button id="registrar_entrada" class="btn-registrar">Registrar</button>
            <nav class="links" aria-label="Navegação">
                <a href="/">Início</a>
                <a href="/cadastro_aluno">Cadastro</a>
                <a href="/historico">Histórico</a>
            </nav>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#atividade').change(function () {
                const outros = $(this).val() === 'Outros';
                $('#observacao_obrigatoria').prop('hidden', !outros);
                $('#observacao').prop('required', outros);
            });

            $('#registrar_entrada').click(function () {
                if ($('#atividade').val() === 'Outros' && !$('#observacao').val().trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Justificativa obrigatória',
                        text: 'Explique a escolha de Outros na observação.'
                    });
                    return;
                }

                $.ajax({
                    url: '/api/registros',
                    method: 'POST',
                    data: {
                        nome: $('#nome').val(),
                        turma: $('#turma').val(),
                        horario: $('#horario').val(),
                        atividade: $('#atividade').val(),
                        observacao: $('#observacao').val()
                    },
                    success: function (response) {
                        if (response.erro === 'n') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: response.mensagem,
                                confirmButtonText: 'Ver histórico'
                            }).then(function () {
                                window.location.href = '/historico';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: response.mensagem
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: xhr.responseJSON?.message || 'Não foi possível registrar a entrada.'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
