

<?php
session_start();
include 'includes/navbar.php';

// Exemplo de playlists por estilo
$playlists = [
    'rock' => [
        [
            'nome' => 'Rock Iniciante',
            'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=400&q=80',
            'criador' => 'Admin',
            'musicas' => [
                ['nome' => 'Música Rock 1', 'artista' => 'Artista Rock', 'album' => 'Álbum Rock', 'minutagem' => '3:45'],
                ['nome' => 'Música Rock 2', 'artista' => 'Artista Rock', 'album' => 'Álbum Rock', 'minutagem' => '4:12'],
            ]
        ]
    ],
    'trap' => [
        [
            'nome' => 'Trap Vibes',
            'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80',
            'criador' => 'Admin',
            'musicas' => [
                ['nome' => 'Trap Song 1', 'artista' => 'Trap Star', 'album' => 'Trap Album', 'minutagem' => '2:58'],
                ['nome' => 'Trap Song 2', 'artista' => 'Trap Star', 'album' => 'Trap Album', 'minutagem' => '3:21'],
            ]
        ]
    ],
    'hardcore melódico' => [
        [
            'nome' => 'Hardcore Melódico',
            'img' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80',
            'criador' => 'Admin',
            'musicas' => [
                ['nome' => 'Hardcore 1', 'artista' => 'Hardcore Band', 'album' => 'Hardcore Album', 'minutagem' => '3:10'],
                ['nome' => 'Hardcore 2', 'artista' => 'Hardcore Band', 'album' => 'Hardcore Album', 'minutagem' => '4:00'],
            ]
        ]
    ],
    // Adicione outros estilos e playlists conforme necessário
];

$estilos = [];
if (isset($_SESSION['estilos_favoritos']) && $_SESSION['estilos_favoritos']) {
    $estilos = explode(',', $_SESSION['estilos_favoritos']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoundHub - Aplicação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #23234a 0%, #1e1e2f 100%);
            color: #fff;
        }
        .main-section {
            background: rgba(35,35,74,0.95);
            border-radius: 2rem;
            margin-top: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 2rem;
        }
        .playlist-carousel {
            display: flex;
            overflow-x: auto;
            gap: 2rem;
            padding-bottom: 1rem;
        }
        .playlist-card {
            min-width: 270px;
            background: #29294d;
            border-radius: 1.5rem;
            box-shadow: 0 4px 16px 0 rgba(31, 38, 135, 0.25);
            color: #fff;
            border: none;
        }
        .playlist-card img {
            border-radius: 1.5rem 1.5rem 0 0;
            height: 180px;
            object-fit: cover;
        }
        .btn-playlist {
            border-radius: 2rem;
            font-size: 1.1rem;
            padding: 0.5rem 1.5rem;
        }
        .music-list {
            background: #23234a;
            border-radius: 1rem;
            margin-top: 2rem;
            padding: 1rem;
        }
        .music-list .list-group-item {
            background: transparent;
            color: #fff;
            border: none;
            border-bottom: 1px solid #444;
        }
        .btn-play {
            border-radius: 2rem;
            font-size: 1rem;
            padding: 0.4rem 1.2rem;
        }
        .alert-info {
            background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
            color: #fff;
            border-radius: 1rem;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container main-section">
        <div class="alert alert-info" role="alert">
            Ao fazer upload, você assina um termo de condição dizendo que está ciente que os dados de música estarão públicos no site.
        </div>
        <h2 class="mb-4 text-center">A escolha da casa / Primeiros Passos</h2>
        <!-- Carrossel de playlists -->
        <div class="playlist-carousel mb-5">
            <?php
            $mostrou = false;
            if ($estilos) {
                foreach ($estilos as $estilo) {
                    $estilo = trim(strtolower($estilo));
                    if (isset($playlists[$estilo])) {
                        foreach ($playlists[$estilo] as $playlist) {
                            $mostrou = true;
                            echo '<div class="card playlist-card">';
                            echo '<img src="' . $playlist['img'] . '" class="card-img-top" alt="Playlist">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($playlist['nome']) . '</h5>';
                            echo '<p class="card-text">Criado por: ' . htmlspecialchars($playlist['criador']) . '</p>';
                            echo '<a href="#" class="btn btn-primary btn-playlist">Ver Playlist</a>';
                            echo '</div></div>';
                        }
                    }
                }
            }
            if (!$mostrou) {
                // Se não tem estilos favoritos, mostra todos
                foreach ($playlists as $estilo => $pls) {
                    foreach ($pls as $playlist) {
                        echo '<div class="card playlist-card">';
                        echo '<img src="' . $playlist['img'] . '" class="card-img-top" alt="Playlist">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($playlist['nome']) . '</h5>';
                        echo '<p class="card-text">Criado por: ' . htmlspecialchars($playlist['criador']) . '</p>';
                        echo '<a href="#" class="btn btn-primary btn-playlist">Ver Playlist</a>';
                        echo '</div></div>';
                    }
                }
            }
            ?>
        </div>
        <!-- Exemplo de músicas na playlist -->
        <div class="music-list">
            <h3 class="mb-3">Músicas da Playlist</h3>
            <ul class="list-group">
                <?php
                // Mostra músicas da primeira playlist do primeiro estilo favorito
                $musicas = [];
                if ($estilos) {
                    foreach ($estilos as $estilo) {
                        $estilo = trim(strtolower($estilo));
                        if (isset($playlists[$estilo])) {
                            $musicas = $playlists[$estilo][0]['musicas'];
                            break;
                        }
                    }
                }
                if (!$musicas) {
                    // Se não tem estilos favoritos, mostra músicas da primeira playlist
                    $first = reset($playlists);
                    $musicas = $first[0]['musicas'];
                }
                foreach ($musicas as $musica) {
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    echo '<div>';
                    echo '<strong>Nome:</strong> ' . htmlspecialchars($musica['nome']) . '<br>';
                    echo '<strong>Artista:</strong> ' . htmlspecialchars($musica['artista']) . '<br>';
                    echo '<strong>Álbum:</strong> ' . htmlspecialchars($musica['album']) . '<br>';
                    echo '<strong>Minutagem:</strong> ' . htmlspecialchars($musica['minutagem']);
                    echo '</div>';
                    echo '<button class="btn btn-success btn-play">Play</button>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
