
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">SoundHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="app.php">Aplicação</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="upload.php">Upload</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['usuario_nome'])): ?>
          <li class="nav-item">
            <span class="navbar-text text-info fw-bold">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro.php">Registrar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
