<?php

header('Content-Type: text/html; charset=utf-8');
echo "<body style='font-family: sans-serif; background-color: #f4f4f9; padding: 2rem;'>";
echo "<h1>SoundHub Installation Script</h1>";

// --- Configuração do Banco de Dados ---
// Altere se suas credenciais forem diferentes
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "soundhub";

// --- Funções Auxiliares ---
function message($text, $type = 'info') {
    $color = '#17a2b8'; // Azul para info
    if ($type === 'success') {
        $color = '#28a745'; // Verde para sucesso
    } elseif ($type === 'error') {
        $color = '#dc3545'; // Vermelho para erro
    }
    echo "<p style='color: $color; margin: 0.5rem 0;'>$text</p>";
}

try {
    // 1. Conectar ao servidor MySQL
    $conn = new mysqli($db_server, $db_user, $db_pass);
    if ($conn->connect_error) {
        throw new Exception("Falha na conexão com o MySQL: " . $conn->connect_error);
    }
    message("Conexão com o MySQL bem-sucedida.", 'success');

    // 2. Criar o banco de dados se ele não existir
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if ($conn->query($sql_create_db) === TRUE) {
        message("Banco de dados '{$db_name}' criado ou já existente.", 'success');
    } else {
        throw new Exception("Erro ao criar o banco de dados: " . $conn->error);
    }

    // 3. Selecionar o banco de dados
    $conn->select_db($db_name);
    message("Banco de dados '{$db_name}' selecionado.");

    // 4. SQL para criar a tabela 'usuarios'
    $sql_usuarios = "
    CREATE TABLE IF NOT EXISTS `usuarios` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `usuario` varchar(50) NOT NULL,
      `email` varchar(100) NOT NULL,
      `senha` varchar(255) NOT NULL,
      `aceitou_termos` tinyint(1) NOT NULL DEFAULT 0,
      `tipo` varchar(20) NOT NULL DEFAULT 'ouvinte',
      `estilos_favoritos` text DEFAULT NULL,
      `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    if ($conn->query($sql_usuarios) === TRUE) {
        message("Tabela 'usuarios' criada ou já existente.", 'success');
    } else {
        throw new Exception("Erro ao criar a tabela 'usuarios': " . $conn->error);
    }

    // 5. SQL para criar a tabela 'musicas'
    $sql_musicas = "
    CREATE TABLE IF NOT EXISTS `musicas` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `usuario_id` int(11) NOT NULL,
      `nome` varchar(255) NOT NULL,
      `artista` varchar(255) NOT NULL,
      `album` varchar(255) DEFAULT NULL,
      `minutagem` varchar(10) DEFAULT NULL,
      `caminho_arquivo` varchar(255) NOT NULL,
      `caminho_capa` varchar(255) DEFAULT NULL,
      `genero` varchar(50) DEFAULT NULL,
      `data_upload` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `usuario_id` (`usuario_id`),
      CONSTRAINT `musicas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    if ($conn->query($sql_musicas) === TRUE) {
        message("Tabela 'musicas' criada ou já existente.", 'success');
    } else {
        throw new Exception("Erro ao criar a tabela 'musicas': " . $conn->error);
    }

    // 6. Semear o banco de dados (Seeding)
    message("<hr style='border-top: 1px solid #ccc;'><h4>Semeando o banco de dados com dados de exemplo...</h4>");

    // Verificar se o usuário de exemplo já existe para evitar duplicatas
    $check_user_sql = "SELECT id FROM usuarios WHERE email = 'ouvinte@soundhub.com'";
    $result = $conn->query($check_user_sql);

    if ($result->num_rows == 0) {
        // --- Inserir usuário 'ouvinte' ---
        $stmt_user = $conn->prepare("INSERT INTO usuarios (usuario, email, senha, aceitou_termos, tipo, estilos_favoritos) VALUES (?, ?, ?, 1, ?, ?)");
        $ouvinte_user = 'ouvinte_demo';
        $ouvinte_email = 'ouvinte@soundhub.com';
        $ouvinte_pass = password_hash('senha123', PASSWORD_DEFAULT);
        $ouvinte_tipo = 'ouvinte';
        $ouvinte_estilos = 'rock,trap,hardcore melódico';
        $stmt_user->bind_param("sssss", $ouvinte_user, $ouvinte_email, $ouvinte_pass, $ouvinte_tipo, $ouvinte_estilos);
        if ($stmt_user->execute()) {
            message("Usuário 'ouvinte_demo' (senha: senha123) criado com sucesso.", 'success');
        } else {
            message("Erro ao criar usuário 'ouvinte_demo': " . $stmt_user->error, 'error');
        }

        // --- Inserir usuário 'artista' ---
        $artista_user = 'artista_demo';
        $artista_email = 'artista@soundhub.com';
        $artista_pass = password_hash('senha123', PASSWORD_DEFAULT);
        $artista_tipo = 'artista';
        $artista_estilos = ''; // Artista não precisa de estilos favoritos inicialmente
        $stmt_user->bind_param("sssss", $artista_user, $artista_email, $artista_pass, $artista_tipo, $artista_estilos);
        if ($stmt_user->execute()) {
            $artista_id = $stmt_user->insert_id;
            message("Usuário 'artista_demo' (senha: senha123) criado com sucesso.", 'success');

            // --- Inserir música de exemplo para o artista ---
            $stmt_music = $conn->prepare("INSERT INTO musicas (usuario_id, nome, artista, album, minutagem, caminho_arquivo, caminho_capa, genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $music_nome = 'Sample Song';
            $music_artista = 'artista_demo';
            $music_album = 'Demo Album';
            $music_min = '3:30';
            $music_path = 'uploads/musicas/sample.mp3'; // Caminho de exemplo
            $cover_path = 'uploads/capas/sample.jpg'; // Caminho de exemplo
            $music_genero = 'rock';
            $stmt_music->bind_param("isssssss", $artista_id, $music_nome, $music_artista, $music_album, $music_min, $music_path, $cover_path, $music_genero);
            if ($stmt_music->execute()) {
                message("Música de exemplo 'Sample Song' adicionada.", 'success');
            } else {
                message("Erro ao adicionar música de exemplo: " . $stmt_music->error, 'error');
            }
            $stmt_music->close();
        } else {
            message("Erro ao criar usuário 'artista_demo': " . $stmt_user->error, 'error');
        }
        $stmt_user->close();
    } else {
        message("Dados de exemplo já existem no banco de dados. Pulo da semeadura.", 'info');
    }

    $conn->close();

    echo "<hr style='border-top: 1px solid #ccc;'>";
    message("<h2>Instalação Concluída!</h2>", 'success');
    message("O banco de dados e as tabelas foram configurados com sucesso.", 'success');
    echo "<p style='font-weight: bold; color: #dc3545;'>Por segurança, por favor, delete este arquivo (install.php) agora.</p>";

} catch (Exception $e) {
    message("Ocorreu um erro: " . $e->getMessage(), 'error');
    echo "<p>Por favor, verifique suas credenciais de banco de dados (usuário: '{$db_user}') e permissões, depois tente novamente.</p>";
}

echo "</body>";
?>