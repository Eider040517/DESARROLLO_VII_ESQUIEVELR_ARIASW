<?php
// Iniciamos el buffer de salida
ob_start();
$message = '';
?>
<div class="content_modal">
  <div class="modal_form">
    <header>
      <h2>
        Login
      </h2>
    </header>
    <main>
      <form class="content_form" method="post" action="/src/controller/userController.php">
        <input type="hidden" value="login" name="action">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Iniciar Sesión</button>
      </form>
      <ul>
        <li>
          <form action="" method="get">
            <input type="hidden" name="action" value="google_login">
            <button class="google-btn">Iniciar Sesión con Google</button>
          </form>
        </li>
      </ul>
    </main>
    <footer>
      <a href="/view/register.php">Crear Cuenta</a>
    </footer>
  </div>
  <div class="bg_modal"></div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require __DIR__ . '/template/layout.php';
?>