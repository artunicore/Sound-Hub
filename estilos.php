<?php
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estilos Musicais - SoundHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Selecione seus estilos favoritos</h2>
        <form action="estilos.php" method="post">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="rock" id="rock">
                <label class="form-check-label" for="rock">Rock</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="metal melódico" id="metal">
                <label class="form-check-label" for="metal">Metal Melódico</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="funk submundo" id="funksub">
                <label class="form-check-label" for="funksub">Funk Submundo</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="funk proibidão" id="funkproib">
                <label class="form-check-label" for="funkproib">Funk Proibidão</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="trap" id="trap">
                <label class="form-check-label" for="trap">Trap</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="hardbass" id="hardbass">
                <label class="form-check-label" for="hardbass">Hardbass</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="estilos[]" value="hardcore melódico" id="hardcore">
                <label class="form-check-label" for="hardcore">Hardcore Melódico</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar estilos</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
