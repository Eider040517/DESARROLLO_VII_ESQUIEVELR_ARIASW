<?php
// Iniciamos el buffer de salida

ob_start();
?>
<div class="content_modal">
  <div class="modal_form">
    <header>
      <h2>
        Register
      </h2>
    </header>
    <main>
      <form class="content_form" id="content_form" method="post" action="/src/controller/userController.php">
        <input type="hidden" name="action" value="register">
        <label for="username">Nombre de usario:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="password">Repita la contraseña:</label>
        <input type="password" id="password_repeat" name="password_repeat" required>

        <div id="passwordError" style="color: red; display: none;">Las contraseñas no coinciden.</div>

        <button type="submit">Registrar</button>
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
    <footer></footer>
  </div>
  <div class="bg_modal"></div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require __DIR__ . '/../template/layout.php';
?>