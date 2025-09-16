

<?php
include 'includes/navbar.php';
include 'db.php';

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $termo = isset($_POST['termo']) ? 1 : 0;

    if ($senha !== $senha2) {
        $msg = '<div class="alert alert-danger">As senhas não coincidem.</div>';
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'ouvinte';
        $sql = "INSERT INTO usuarios (usuario, email, senha, aceitou_termos, tipo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssis", $usuario, $email, $senha_hash, $termo, $tipo);
            if ($stmt->execute()) {
                $msg = '<div class="alert alert-success">Cadastro realizado com sucesso!</div>';
                // Login automático após o cadastro
                $last_id = $stmt->insert_id;
                $_SESSION['usuario_id'] = $last_id;
                $_SESSION['usuario_nome'] = $usuario;
                $_SESSION['estilos_favoritos'] = ''; // Novo usuário não tem favoritos ainda
                header('Location: estilos.php');
                exit;
            } else {
                $msg = '<div class="alert alert-danger">Erro ao cadastrar: ' . $stmt->error . '</div>';
            }
            $stmt->close();
        } else {
            $msg = '<div class="alert alert-danger">Erro na preparação da query.</div>';
        }
    }
}
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
        <?php echo $msg; ?>
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
            <div class="mb-3">
                <label class="form-label">Tipo de Cadastro</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo_ouvinte" value="ouvinte" checked>
                    <label class="form-check-label" for="tipo_ouvinte">Quero ouvir músicas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo_artista" value="artista">
                    <label class="form-check-label" for="tipo_artista">Sou artista e quero publicar músicas</label>
                </div>
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
