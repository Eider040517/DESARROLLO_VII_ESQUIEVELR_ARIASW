<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<link rel="stylesheet" href="/../public/assets/css/header.css">

<header>
  <div class="content_title">
    <h2>RECIPE</h2>
  </div>
  <div class="content_nav">
    <?php if (isset($_SESSION['user_id'])): ?>
      <form action="recipe.php" method="get">
        <button type="submit" name="action" value="create"> Crear</button>
      </form>

      <button id="userButton">
        <?= htmlentities($_SESSION['username']) ?>
      </button>
      <!-- Modal estilo dropdown -->
      <div id="userDropdown" class="dropdown-menu">
        <ul>
          <li>
            <a href="profile.php">Entrar a mi perfil</a>
          <li>
            <form id="logoutForm" action="/../src/controller/userController.php" method="post">
              <input type="hidden" value="logout" name="action">
            </form>
            <a href="#" id="logoutLink">Cerrar sesión</a>
          </li>
        </ul>
      </div>
    <?php endif ?>
  </div>
</header>
<script src="/../public/assets/js/header.js"></script>