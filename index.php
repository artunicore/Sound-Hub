
<?php
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoundHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e1e2f 0%, #23234a 100%);
            color: #fff;
        }
        .hero-section {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgba(30,30,47,0.8);
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            margin-top: 2rem;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
        .carousel-img {
            height: 350px;
            object-fit: cover;
            border-radius: 1rem;
        }
        .artist-section {
            background: rgba(35,35,74,0.9);
            border-radius: 2rem;
            margin-top: 3rem;
            padding: 2rem 0;
            box-shadow: 0 4px 16px 0 rgba(31, 38, 135, 0.25);
        }
        .artist-img {
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .btn-explore {
            font-size: 1.2rem;
            padding: 0.75rem 2rem;
            border-radius: 2rem;
        }
        .btn-upload {
            font-size: 1.1rem;
            padding: 0.6rem 1.5rem;
            border-radius: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Section -->
        <section class="hero-section text-center">
            <div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80" class="d-block w-100 carousel-img" alt="Música 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=800&q=80" class="d-block w-100 carousel-img" alt="Música 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" class="d-block w-100 carousel-img" alt="Música 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <h1>Explore o Universo SoundHub</h1>
            <p>Descubra o mundo das músicas independentes com estilo e atitude!</p>
            <a href="cadastro.php" class="btn btn-primary btn-explore shadow">Explore o Universo SoundHub</a>
        </section>

        <!-- Seção Artistas -->
        <section class="artist-section text-center mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80" class="img-fluid artist-img" alt="Anime radical 1">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=400&q=80" class="img-fluid artist-img" alt="Anime radical 2">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="https://images.unsplash.com/photo-1465101178521-c1a9136a3c8b?auto=format&fit=crop&w=400&q=80" class="img-fluid artist-img" alt="Anime radical 3">
                </div>
            </div>
            <h2 class="mt-4">Seja um artista independente!</h2>
            <p>Mostre seu talento para o mundo. Faça upload das suas músicas e conquiste seu espaço!</p>
            <a href="cadastro.php" class="btn btn-success btn-upload shadow">Quero ser artista!</a>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
