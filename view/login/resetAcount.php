<?php ob_start(); ?>

<div class="content_modal">
  <div class="modal_form">
    <header>
      <h2>
        ¿Olvidaste tu contraseña?
      </h2>
      <p>
        Revise su correo electrónico para completar el restablecimiento de su contraseña.
      </p>
    </header>
    <main>
      <!-- Formulario par inicio de sesion -->
      <form class="content_form" method="post" action="/src/controller/userController.php">
        <input type="email" id="email" name="email" placeholder="Correo electrónico" required>

        <button type="submit" name="action" value="reset">Enviar enlace de recuperacion</button>
      </form>
      <!-- Listado de tipos de inicio de session por medio de servicios -->

    </main>
    <footer>
      <a href="/">Volver a inicio de sesión</a>
    </footer>
  </div>
  <div class="bg_modal"></div>
</div>


<?php
$content = ob_get_clean();
require __DIR__ . '/../template/layout.php';
?>