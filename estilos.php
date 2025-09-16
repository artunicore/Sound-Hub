
<?php
session_start();
include 'includes/navbar.php';
include 'db.php';
$msg = "";
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estilos'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $estilos_selecionados = $_POST['estilos'];
    $estilos_string = implode(',', $estilos_selecionados);

    $sql = "UPDATE usuarios SET estilos_favoritos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $estilos_string, $usuario_id);
        if ($stmt->execute()) {
            $_SESSION['estilos_favoritos'] = $estilos_string;
            header('Location: app.php');
            exit;
        } else {
            $msg = '<div class="alert alert-danger">Erro ao salvar os estilos: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    } else {
        $msg = '<div class="alert alert-danger">Erro na preparação da query.</div>';
    }
}

// Estilos disponíveis
$estilos_lista = [
    'rock' => 'Rock',
    'metal melódico' => 'Metal Melódico',
    'funk submundo' => 'Funk Submundo',
    'funk proibidão' => 'Funk Proibidão',
    'trap' => 'Trap',
    'hardbass' => 'Hardbass',
    'hardcore melódico' => 'Hardcore Melódico'
];

// Buscar gostos já salvos
$gostos_salvos = [];
if (isset($_SESSION['estilos_favoritos']) && !empty($_SESSION['estilos_favoritos'])) {
    $gostos_salvos = explode(',', $_SESSION['estilos_favoritos']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estilos Musicais - SoundHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #23234a 0%, #1e1e2f 100%);
            color: #fff;
        }
        .card-estilos {
            background: rgba(35,35,74,0.97);
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            margin-top: 3rem;
            padding: 2.5rem 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .form-check-label {
            color: #b3b3ff;
        }
        .btn-estilos {
            font-size: 1.1rem;
            padding: 0.6rem 2rem;
            border-radius: 2rem;
        }
    </style>
</head>
<body>
    <div class="card-estilos">
        <h2 class="text-center mb-4">Selecione seus estilos favoritos</h2>
        <?php echo $msg; ?>
        <form action="estilos.php" method="post">
            <?php foreach ($estilos_lista as $key => $label): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="estilos[]" value="<?php echo $key; ?>" id="<?php echo $key; ?>"
                        <?php if (in_array($key, $gostos_salvos)) echo 'checked'; ?>>
                    <label class="form-check-label" for="<?php echo $key; ?>"><?php echo $label; ?></label>
                </div>
            <?php endforeach; ?>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-estilos">Salvar estilos</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
