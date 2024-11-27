<?php
// Iniciamos el buffer de salida
ob_start();

?>
<div class="content_modal">
  <div class="modal_form">
    <header>
      <h2>
        Login
      </h2>
      <p>
        ¡Haz que cocinar todos los días sea divertido!
      </p>
    </header>
    <main>
      <!-- Formulario par inicio de sesion -->
      <form class="content_form" method="post" action="/src/controller/userController.php">

        <input type="email" id="email" name="email" placeholder="Correo Electonico" required>

        <input type="password" id="password" name="password" placeholder="Contraseña" required>


        <button type="submit" name="action" value="login">Iniciar Sesión</button>
      </form>

      <a href="/view/login/resetAcount.php">Recupera tu contraseña</a>
      <div class="content-span">
        <span class="border-span"></span>
        <span class="px-sm">or</span>
        <span class="border-span"></span>
      </div>
      <!-- Listado de tipos de inicio de session por medio de servicios -->
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
      <span> ¿Aún no tienes cuenta?</span>
      <a href="/view/login/register.php">Crear Cuenta</a>
    </footer>
  </div>
</div>
<?php
// Guardamos el contenido del buffer en la variable $content
$content = ob_get_clean();
// Incluimos el layout
require __DIR__ . '/template/layout.php';
?>