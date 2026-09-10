<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Início</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #efefef; font-family: Arial, Helvetica, sans-serif; }
        .inicio { width: min(980px, 92vw); background: #fff; border-radius: 22px; box-shadow: 0 14px 35px rgba(0, 0, 0, .12); padding: 28px 22px 34px; text-align: center; }
        .logo { width: 220px; max-width: 70%; display: block; margin: 0 auto 18px; }
        .titulo { color: #d71d1d; font-size: clamp(1.7rem, 2.4vw, 2.7rem); font-weight: 800; margin-bottom: 24px; }
        .menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; }
        .menu a { display: flex; align-items: center; justify-content: center; min-height: 92px; border-radius: 18px; background: linear-gradient(135deg, #d7514d, #b72d2d); box-shadow: 0 8px 20px rgba(188, 36, 36, .25); color: #fff; font-size: 1.15rem; font-weight: 700; text-decoration: none; }
        .status { display: inline-block; margin-top: 26px; padding: 12px 18px; border-radius: 999px; background: #e5f9ee; color: #186d43; font-weight: 700; }
    </style>
</head>
<body>
    <main class="inicio">
        <img src="{{ asset('images/sesi-logo.png') }}" alt="Logo SESI" class="logo">
        <div class="titulo">Sistema de controle escolar</div>
        <nav class="menu" aria-label="Menu principal">
            <a href="/cadastro_aluno">📝 Começar cadastro</a>
            <a href="/registrar_entrada">📋 Registrar entrada</a>
            <a href="/historico">📊 Histórico</a>
        </nav>
        <div class="status">Sistema funcionando corretamente</div>
    </main>
</body>
</html>
