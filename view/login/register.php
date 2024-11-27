<?php
// Iniciamos el buffer de salida

ob_start();
?>
<div class="content_modal">
  <div class="modal_form">
    <header>
      <h2>
        Unirse a Cookpad
      </h2>
      <p>
        Mantén todas tus recetas favoritas en un solo lugar.
      </p>
    </header>
    <main>
      <form class="content_form" id="content_form" method="post" action="/src/controller/userController.php">
        <input type="hidden" name="action" value="register">

        <input type="text" id="username" name="username" placeholder="Nombre" required>

        <input type="email" id="email" name="email" placeholder="Correo Eletrocio" required>

        <input type="password" id="password" name="password" placeholder="Contraseña" required>

        <input type="password" id="password_repeat" name="password_repeat" placeholder="Repite Contraseña" required>

        <div id="passwordError" style="color: red; display: none;">Las contraseñas no coinciden.</div>

        <button type="submit">Registrar</button>
      </form>
      <div class="content-span">
        <span class="border-span"></span>
        <span class="px-sm">or</span>
        <span class="border-span"></span>
      </div>
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
      <span>¿Ya tienes una cuenta? </span>
      <a href="/view/login.php">Inicia Session</a>
    </footer>
  </div>
  <div class="bg_modal"></div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require __DIR__ . '/../template/layout.php';
?>