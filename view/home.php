<?php
session_start();
// Procesar resultados pasados desde el searchController
$recipeAll = $_SESSION['search_results'] ?? []; // Recupera resultados o vacío si no hay
$searchTerm = $_SESSION['search_term'] ?? ''; // Recupera el término de búsqueda o vacío si no hay

if (!isset($_SESSION['user_id']) && $_SESSION['user_id']) {
  require __DIR__ .  '/login.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../public/assets/css/home.css">
  <title>Recipe</title>
</head>

<body>
  <?php require __DIR__ . '/../view/template/header.php' ?>
  <div class="container">
    <h1>Bienvenido a Recetas</h1>
    <form action="/src/controller/searchController.php" method="POST">
      <input type="text" name="searchTerm" placeholder="Buscar recetas..." value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button type="submit">Buscar</button>
    </form>
    <div class="search-result-content">
      <?php if ($recipeAll): ?>
        <div class="card-container">
          <?php foreach ($recipeAll as $receta): ?>
            <div class="card">
              <img src="images/<?php echo htmlspecialchars($receta['imagen']); ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>" class="card-image">
              <div class="card-content">
                <h3 class="card-title"><?php echo htmlspecialchars($receta['nombre']); ?></h3>
                <p class="card-description"><?php echo htmlspecialchars($receta['descripcion']); ?></p>
                <p class="card-category">Categoría: <?php echo htmlspecialchars($receta['categoria']); ?></p>
                <p class="card-time">Tiempo: <?php echo htmlspecialchars($receta['tiempo_preparacion']); ?> minutos</p>
                <form action="/src/controller/recipeController.php" method="post">
                  <input type="hidden" name="recipe_id" value="<?php echo htmlspecialchars($receta['id']); ?>">
                  <button type="submit" class="card-button" name="action" value="detail">Ver detalles</button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <?php if ($searchTerm): ?>
          <p>No se encontraron recetas para "<strong><?php echo htmlspecialchars($searchTerm); ?></strong>".</p>
        <?php else: ?>
          <p>Introduce un término para buscar recetas.</p>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

</body>

</html>