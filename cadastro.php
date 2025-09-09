
<?php
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - SoundHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #23234a 0%, #1e1e2f 100%);
            color: #fff;
        }
        .card-cadastro {
            background: rgba(35,35,74,0.97);
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            margin-top: 3rem;
            padding: 2.5rem 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .form-label {
            color: #b3b3ff;
        }
        .btn-cadastro {
            font-size: 1.1rem;
            padding: 0.6rem 2rem;
            border-radius: 2rem;
        }
        .btn-link {
            color: #8f94fb;
        }
    </style>
</head>
<body>
    <div class="card-cadastro">
        <h2 class="text-center mb-4">Cadastro</h2>
        <form action="cadastro.php" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="senha2" class="form-label">Reescrever Senha</label>
                <input type="password" class="form-control" id="senha2" name="senha2" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="termo" name="termo" required>
                <label class="form-check-label" for="termo">
                    Concordo com o uso dos meus dados conforme os termos do site.
                </label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-cadastro">Registrar</button>
                <a href="login.php" class="btn btn-link">Já tenho cadastro</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
