<?php
session_start();
// Procesar resultados pasados desde el searchController
$recipeAll = $_SESSION['search_results'] ?? []; // Recupera resultados o vacío si no hay
$searchTerm = $_SESSION['search_term'] ?? ''; // Recupera el término de búsqueda o vacío si no hay

unset($_SESSION['search_results']);
unset($_SESSION['search_term']);

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

    <div class="search-content">
      <a title="Cookpad" href="/">
        <img alt="Cookpad" class="logo_img" loading="lazy" src="/public/img/healthy_food.png">
      </a>
      <form autocomplete="off" action="/src/controller/searchController.php" method="post">
        <div class="search_form">
          <div class="search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="mise-icon mise-icon-search-unselected">
              <path stroke="currentColor" stroke-width="1.5" d="M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"></path>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m15 15 5 5"></path>
            </svg>
            <input type="text" name="searchTerm" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Buscar por receta, ingredientes o paso">
          </div>

          <button type="submit"> Buscar</button>
        </div>
      </form>
    </div>

    <div class="search-result-content">
      <?php if ($recipeAll): ?>
        <div class="card-container">
          <?php foreach ($recipeAll as $receta): ?>
            <div class="card">
              <div class="content-img">
                <img src="/uploads/<?php echo htmlspecialchars($receta['imagen']); ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>" class="card-image">
              </div>
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

          <div class="error-content">
            <p>No se encontraron recetas para "<strong><?php echo htmlspecialchars($searchTerm); ?></strong>".</p>
            <div class="error-wrap">

              <img src="//global-web-assets.cpcdn.com/assets/empty_states/no_results-8613ba06d717993e5429d9907d209dc959106472a8a4089424f1b0ccbbcd5fa9.svg">

              <div class="error-t">
                ¿No encuentras una receta?
              </div>

              <div class="error-p">
                <p>Sé el primero y comparte el tuyo. ¡Únete a la diversión y ayuda a tus compañeros cocineros!</p>
              </div>

              <div class="btn-error-form">
                <form action="recipe.php" method="get">
                  <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="mise-icon mise-icon-add-recipe">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 3H9.4c-2.24 0-3.36 0-4.216.436a4 4 0 0 0-1.748 1.748C3 6.04 3 7.16 3 9.4v5.2c0 2.24 0 3.36.436 4.216a4 4 0 0 0 1.748 1.748C6.04 21 7.16 21 9.4 21h5.2c2.24 0 3.36 0 4.216-.436a4 4 0 0 0 1.748-1.748C21 17.96 21 16.84 21 14.6V11M2 16h2M2 12h2M2 8h2"></path>
                      <path fill="currentColor" d="M14.364 13.725 16 8v7h-.674a1 1 0 0 1-.962-1.275Z"></path>
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 20v-5m0 0V8l-1.636 5.725A1 1 0 0 0 15.326 15H16Z"></path>
                      <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M8 8v2a2 2 0 0 0 2 2v0a2 2 0 0 0 2-2V8m-2 0v12"></path>
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 2v6M17 5h6"></path>
                    </svg>
                    <span>Agregar receta</span>
                  </button>
                  <input type="hidden" name="action" value="create">
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <?php require __DIR__ . '/template/footer.php' ?>

</body>

</html>