
<?php
include 'includes/navbar.php';
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
            <div class="card playlist-card">
                <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Playlist">
                <div class="card-body">
                    <h5 class="card-title">Rock Iniciante</h5>
                    <p class="card-text">Criado por: Admin</p>
                    <a href="#" class="btn btn-primary btn-playlist">Ver Playlist</a>
                </div>
            </div>
            <div class="card playlist-card">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Playlist">
                <div class="card-body">
                    <h5 class="card-title">Trap Vibes</h5>
                    <p class="card-text">Criado por: Admin</p>
                    <a href="#" class="btn btn-primary btn-playlist">Ver Playlist</a>
                </div>
            </div>
            <div class="card playlist-card">
                <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Playlist">
                <div class="card-body">
                    <h5 class="card-title">Hardcore Melódico</h5>
                    <p class="card-text">Criado por: Admin</p>
                    <a href="#" class="btn btn-primary btn-playlist">Ver Playlist</a>
                </div>
            </div>
            <!-- Adicione mais cards conforme necessário -->
        </div>
        <!-- Exemplo de músicas na playlist -->
        <div class="music-list">
            <h3 class="mb-3">Músicas da Playlist</h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Nome:</strong> Música 1<br>
                        <strong>Artista:</strong> Artista 1<br>
                        <strong>Álbum:</strong> Álbum 1<br>
                        <strong>Minutagem:</strong> 3:45
                    </div>
                    <button class="btn btn-success btn-play">Play</button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Nome:</strong> Música 2<br>
                        <strong>Artista:</strong> Artista 2<br>
                        <strong>Álbum:</strong> Álbum 2<br>
                        <strong>Minutagem:</strong> 4:12
                    </div>
                    <button class="btn btn-success btn-play">Play</button>
                </li>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
