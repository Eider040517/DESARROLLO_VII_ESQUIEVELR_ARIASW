<?php ob_start(); ?>
<div class="content_modal">
  <div class="modal_form">
    <header>
      <h3>
        Recuperacion de cuente
      </h3>
    </header>
    <main>
      <p>Enviaremos un enlace de recuperación a</p>
      <p>Te hemos enviado un enlace de recuperación a</p>
      <h3><?= $email ?></h3>
      <p>Si no has recibido el correo electrónico, revisa tu carpeta de correo no deseado</p>
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