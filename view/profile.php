<?php
require_once __DIR__ . '/../src/controller/userDataController.php';
require_once __DIR__ . '/../src/message/messageManager.php';

// Mostrar mensajes (tanto de error como de éxito) si existen
$errorMessages =  MessageManager::getMessages('error', 'recipe');
$successMessages = MessageManager::getMessages('success', 'recipe');
$allMessages = [];

if ($errorMessages) {
  $messageType = 'alert-error';
  $allMessages = $errorMessages;
} elseif ($successMessages) {
  $messageType = 'alert-success';
  $allMessages = $successMessages;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de Usuario</title>
  <link rel="stylesheet" href="/public/assets/css/profile.css">
</head>

<body>

  <?php require __DIR__ . '/template/header.php' ?>

  <main>
    <!-- Datos del perfil -->
    <section class="profile-info">
      <h2>Información del Perfil</h2>
      <p><strong>Nombre:</strong> <span id="profile-name"><?= htmlspecialchars($userData['username']) ?></span></p>
      <p><strong>Email:</strong> <span id="profile-email"><?= htmlspecialchars($userData['user_email']) ?></span></p>
      <p><strong>Fecha de Registro:</strong> <span id="profile-date"><?= $userData['user_create_time'] ?></span></p>
    </section>

    <?php
    if ($allMessages) :
      foreach ($allMessages as $message) :
    ?>
        <div class="alert <?php echo $messageType; ?>">
          <?php echo htmlspecialchars($message); ?>
        </div>
    <?php
      endforeach;
    endif;

    ?>




    <!-- Listado de recetas -->
    <section class="recipe-list">
      <h2>Mis Recetas</h2>
      <ul id="recipes">

        <?php foreach ($recipeData as $data): ?>
          <li class="recipe-item">
            <div class="recipe-img">
              <img src="/uploads/<?= isset($data['recipe_imagen']) ? urldecode($data['recipe_imagen']) : "" ?> " alt="Imagen">
            </div>
            <div class="recipe-info">
              <div class="recipe-info_data">
                <h3><?= htmlspecialchars($data['recipe_name']) ?></h3>
                <p> Categoria : <?= htmlspecialchars($data['recipe_category']) ?></p>
                <p>Tiempo de preparación: <?= htmlspecialchars($data['recipe_preparation_time']) ?> minutos</p>
              </div>

              <div class="recipe-action">
                <form action="/src/controller/recipeController.php" method="post">
                  <input type="hidden" name="recipe_id" value="<?= $data['recipe_id'] ?>">
                  <button class="recipe-btn btn-red" type="submit" name=" action" value="delete"> Eliminar</button>
                </form>
                <form action="/src/controller/recipeController.php" method="post">
                  <input type="hidden" name="recipe_id" value="<?= $data['recipe_id'] ?>">
                  <button class="recipe-btn btn-orange" type="submit" name="action" value="modified"> Modificar</button>
                </form>
              </div>

            </div>

          </li>

        <?php endforeach ?>
      </ul>
    </section>
  </main>
  <?php require __DIR__ . '/template/footer.php' ?>
</body>

</html>