<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: #efefef;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container-custom {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }
        .panel {
            background: #ffffff;
            border-radius: 18px;
            padding: 32px 28px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .titulo {
            font-size: 2rem;
            font-weight: 700;
            color: #d71d1d;
            text-align: center;
            margin-bottom: 24px;
        }
        .input-style {
            width: 100%;
            border-radius: 999px;
            border: 3px solid #2e2e2e;
            background: #d9d9d9;
            padding: 14px 18px;
            margin-top: 8px;
            font-size: 1rem;
        }
        select.input-style { appearance: auto; }
        .btn-cadastrar {
            display: block;
            margin: 24px auto 0;
            background: #d76a66;
            color: white;
            border: none;
            border-radius: 18px;
            padding: 16px 28px;
            font-weight: 800;
            text-transform: uppercase;
            box-shadow: 0 6px 0 #b65d58;
        }
        .links {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 24px;
        }
        .links a { color: #b72d2d; font-weight: 700; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="panel">
            <div class="titulo">Cadastro de aluno</div>

            <div class="mb-3">
                <label for="nome">Nome</label>
                <input id="nome" type="text" class="input-style" placeholder="Digite o nome do aluno">
            </div>

            <div class="mb-3">
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

            <div class="mb-3">
                <label for="id_rfid">ID do cartão RFID</label>
                <input id="id_rfid" type="text" class="input-style" placeholder="Digite o ID do cartão">
            </div>

            <button id="cadastrar_aluno" class="btn-cadastrar">Cadastrar</button>
            <nav class="links" aria-label="Navegação">
                <a href="/">Início</a>
                <a href="/registrar_entrada">Registrar entrada</a>
            </nav>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#cadastrar_aluno').click(function () {
                $.ajax({
                    url: '/api/alunos',
                    method: 'POST',
                    data: {
                        nome: $('#nome').val(),
                        turma: $('#turma').val(),
                        id_rfid: $('#id_rfid').val()
                    },
                    success: function (response) {
                        if (response.erro === 'n') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: response.mensagem,
                                confirmButtonText: 'Continuar'
                            }).then(function () {
                                window.location.href = '/registrar_entrada';
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
                            text: xhr.responseJSON?.message || 'Não foi possível cadastrar o aluno.'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
