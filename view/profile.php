<?php
require_once __DIR__ . '/../src/controller/userDataController.php';
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
  <header class="header">
    <h1>Bienvenido, <span id="user-name">Nombre del Usuario</span></h1>
  </header>

  <main class="profile">
    <!-- Datos del perfil -->
    <section class="profile-info">
      <h2>Información del Perfil</h2>
      <p><strong>Nombre:</strong> <span id="profile-name"><?= htmlspecialchars($userData['username']) ?></span></p>
      <p><strong>Email:</strong> <span id="profile-email"><?= htmlspecialchars($userData['user_email']) ?></span></p>
      <p><strong>Fecha de Registro:</strong> <span id="profile-date"><?= $userData['user_create_time'] ?></span></p>
    </section>

    <!-- Listado de recetas -->
    <section class="recipe-list">
      <h2>Recetas Creadas</h2>
      <ul id="recipes">

        <?php foreach ($recipeData as $data): ?>
          <li class="recipe-item">

            <h3><?= htmlspecialchars($data['recipe_name']) ?></h3>
            <p> Categoria : <?= htmlspecialchars($data['recipe_category']) ?></p>
            <p>Tiempo de preparación: <?= htmlspecialchars($data['recipe_preparation_time']) ?> minutos</p>
            <form action="/src/controller/recipeController.php" method="post">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="recipe_id" value="<?= $data['recipe_id'] ?>">
              <button type="submit"> Eliminar</button>
            </form>
            <form action="/src/controller/recipeController.php" method="post">
              <input type="hidden" name="action" value="edit">
              <input type="hidden" name="recipe_id" value="<?= $data['recipe_id'] ?>">
              <button type="submit"> Modificar</button>
            </form>
          </li>

        <?php endforeach ?>
      </ul>
    </section>
  </main>
</body>

</html>