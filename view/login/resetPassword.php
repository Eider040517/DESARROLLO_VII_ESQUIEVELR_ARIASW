<?php
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $token = $_GET['token'];
  $email = $_GET['email'];
}

ob_start(); ?>
<div class="content_modal">
  <div class="modal_form">
    <header>
      <h3>
        Cambio de contraseña
      </h3>
    </header>
    <main>
      <form class="content_form" id="content_form" method="post" action="/src/controller/userController.php">
        <input type="hidden" name="user_id" value=" <?= $user_id ?> ">
        <input type="hidden" name="token" value=" <?= $token ?> ">
        <input type="hidden" name="email" value="<?= $email ?>">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="password">Repita la contraseña:</label>
        <input type="password" id="password_repeat" name="password_repeat" required>

        <div id="passwordError" style="color: red; display: none;">Las contraseñas no coinciden.</div>

        <button type="submit" name="action" value="update">Guardar</button>
      </form>

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