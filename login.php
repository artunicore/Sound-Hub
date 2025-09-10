
<?php
session_start();
include 'includes/navbar.php';
include 'db.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $sql = "SELECT id, usuario, senha, estilos_favoritos FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha'])) {
                $_SESSION['usuario_id'] = $row['id'];
                $_SESSION['usuario_nome'] = $row['usuario'];
                $_SESSION['estilos_favoritos'] = $row['estilos_favoritos'];
                header('Location: app.php');
                exit;
            } else {
                $msg = '<div class="alert alert-danger">Senha incorreta.</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger">Usuário não encontrado.</div>';
        }
        $stmt->close();
    } else {
        $msg = '<div class="alert alert-danger">Erro na preparação da query.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SoundHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #23234a 0%, #1e1e2f 100%);
            color: #fff;
        }
        .card-login {
            background: rgba(35,35,74,0.97);
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            margin-top: 3rem;
            padding: 2.5rem 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .form-label {
            color: #b3b3ff;
        }
        .btn-login {
            font-size: 1.1rem;
            padding: 0.6rem 2rem;
            border-radius: 2rem;
        }
    </style>
</head>
<body>
    <div class="card-login">
        <h2 class="text-center mb-4">Login</h2>
        <?php echo $msg; ?>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-login">Entrar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
