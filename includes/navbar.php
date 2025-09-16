
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo isset($_SESSION['usuario_id']) ? 'app.php' : 'index.php'; ?>">SoundHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <?php if (isset($_SESSION['usuario_id'])): ?>

          <li class="nav-item orange-500">
            <a class="nav-link " href="upload.php">para artistas</a>
          </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['usuario_id'])): ?>
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
