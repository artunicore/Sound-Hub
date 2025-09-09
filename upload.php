
<?php
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload de Música - SoundHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #23234a 0%, #1e1e2f 100%);
            color: #fff;
        }
        .card-upload {
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
        .btn-upload {
            font-size: 1.1rem;
            padding: 0.6rem 2rem;
            border-radius: 2rem;
        }
    </style>
</head>
<body>
    <div class="card-upload">
        <h2 class="text-center mb-4">Upload de Música</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Música</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="artista" class="form-label">Artista</label>
                <input type="text" class="form-control" id="artista" name="artista" required>
            </div>
            <div class="mb-3">
                <label for="album" class="form-label">Álbum</label>
                <input type="text" class="form-control" id="album" name="album">
            </div>
            <div class="mb-3">
                <label for="minutagem" class="form-label">Minutagem</label>
                <input type="text" class="form-control" id="minutagem" name="minutagem">
            </div>
            <div class="mb-3">
                <label for="arquivo" class="form-label">Arquivo de Música</label>
                <input type="file" class="form-control" id="arquivo" name="arquivo" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-upload">Fazer Upload</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
