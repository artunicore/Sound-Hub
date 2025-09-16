
<?php
session_start();
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
    'hardcore melódico' => 'Hardcore Melódico',
    'abertura de Anime' => 'Abertura de Anime',
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
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .estilos-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }
        .btn-estilo {
            background-color: #29294d;
            color: #b3b3ff;
            border: 2px solid #444;
            border-radius: 2rem;
            padding: 0.5rem 1.2rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            opacity: 0.7;
        }
        .btn-estilo:hover {
            transform: scale(1.05);
            opacity: 1;
        }
        .btn-estilo.selected {
            background-color: #4e54c8;
            border-color: #8f94fb;
            color: #fff;
            opacity: 1;
            box-shadow: 0 0 10px rgba(143, 148, 251, 0.5);
        }
        .btn-salvar {
            font-size: 1.1rem;
            padding: 0.6rem 2rem;
            border-radius: 2rem;
        }
    </style>
</head>
<body>
    <div class="card-estilos">
        <h1 class="text-center mb-4 text-warning">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h1>
        <h2 class="text-center mb-4">Selecione seus estilos favoritos</h2>
        <?php echo $msg; ?>
        <form action="estilos.php" method="post" id="estilosForm">
            <div class="estilos-container mb-4">
                <?php foreach ($estilos_lista as $key => $label): 
                    $isSelected = in_array($key, $gostos_salvos);
                ?>
                    <button type="button" class="btn-estilo <?php if ($isSelected) echo 'selected'; ?>" data-value="<?php echo htmlspecialchars($key); ?>">
                        <?php echo htmlspecialchars($label); ?>
                    </button>
                    <input type="checkbox" name="estilos[]" value="<?php echo htmlspecialchars($key); ?>" <?php if ($isSelected) echo 'checked'; ?> style="display: none;">
                <?php endforeach; ?>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-salvar">Salvar estilos</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-estilo');
            
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Alterna o estado visual do botão
                    this.classList.toggle('selected');
                    
                    // Encontra e alterna o checkbox oculto correspondente
                    const value = this.getAttribute('data-value');
                    const checkbox = document.querySelector(`input[type="checkbox"][value="${value}"]`);
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked;
                    }
                });
            });
        });
    </script>
</body>
</html>
