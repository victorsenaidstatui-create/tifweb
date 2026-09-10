<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #efefef; font-family: Arial, Helvetica, sans-serif; }
        .container-custom { max-width: 1200px; margin: 40px auto; padding: 20px; }
        .panel { background: #fff; border-radius: 18px; padding: 32px 28px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .titulo { font-size: 2rem; font-weight: 700; color: #d71d1d; text-align: center; margin-bottom: 24px; }
        table { width: 100%; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f3f3f3; }
        .filter-form { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 20px; }
        .input-style { border-radius: 999px; border: 2px solid #2e2e2e; background: #d9d9d9; padding: 10px 14px; }
        .btn-filter { background: #d76a66; border: none; color: white; border-radius: 12px; padding: 10px 18px; font-weight: 700; }
        .links { display: flex; gap: 18px; margin-top: 24px; }
        .links a { color: #b72d2d; font-weight: 700; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="panel">
            <div class="titulo">Histórico</div>

            <form method="GET" action="/historico" class="filter-form">
                <input type="text" name="nome" class="input-style" placeholder="Nome">
                <input type="text" name="turma" class="input-style" placeholder="Turma">
                <input type="date" name="data" class="input-style">
                <button type="submit" class="btn-filter">Filtrar</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Horário</th>
                        <th>Atividade</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registros as $registro)
                        <tr>
                            <td>{{ $registro->aluno->nome ?? 'N/A' }}</td>
                            <td>{{ $registro->aluno->turma ?? 'N/A' }}</td>
                            <td>{{ $registro->horario }}</td>
                            <td>{{ $registro->atividade }}</td>
                            <td>{{ \Carbon\Carbon::parse($registro->data)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum registro encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <nav class="links" aria-label="Navegação">
                <a href="/">Início</a>
                <a href="/cadastro_aluno">Novo cadastro</a>
                <a href="/registrar_entrada">Nova entrada</a>
            </nav>
        </div>
    </div>
</body>
</html>
