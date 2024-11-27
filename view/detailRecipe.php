<?php

session_start();
if (!isset($_SESSION['recipe_info'])) {
  echo 'hola';
  header('Location: /view/home.php');
}
$recipeInfo = $_SESSION['recipe_info'];
$ingredientInfo = $_SESSION['recipe_ingredient'];
$stepInfo = $_SESSION['recipe_setp'];
$action = 'update';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>title</title>
  <link rel="stylesheet" href="/public/assets/css/detailRecipe.css">
</head>



<body>


  <?php require __DIR__ . '/template/header.php'; ?>
  <div class="content-main">

    <form action="/src/controller/recipeController.php" method="POST" enctype="multipart/form-data" id="recipeForm">
      <input type="hidden" id="actionInput" name="action" value="">
      <input type="hidden" id="receta_id" name="recipeInfo[recipe_id]" value="<?php echo htmlspecialchars($recipeInfo['recipe_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
      <input type="hidden" id="receta_id" name="recipeInfo[recipe_imagen]" value="<?php echo htmlspecialchars($recipeInfo['recipe_imagen'] ?? null, ENT_QUOTES, 'UTF-8'); ?>">
      <div class="recipe_main">
        <section class="recipe_about">

          <div class="upload-img">
            <?php if ($action === 'update'): ?>
              <div class="recipe-img">
                <img src="/uploads/<?= isset($recipeInfo['recipe_imagen']) ? urldecode($recipeInfo['recipe_imagen']) : "" ?> " alt="Imagen">
              </div>
            <?php else: ?>
              <div class="recipe-img_text">
                <img src="//global-web-assets.cpcdn.com/assets/camera-f90eec676af2f051ccca0255d3874273a419172412e3a6d2884f963f6ec5a2c3.png">
                <p class="recipe-img_title">Upload recipe photo</p>
                <p>Show others your finished dish</p>
              </div>
            <?php endif ?>
            <input id="recipe_img" name="recipe_img" type="file">
          </div>

          <div class="recipe-info">
            <div class="recipe-title">
              <p class="p-data">
                <?= htmlspecialchars($recipeInfo['recipe_name'], ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </div>
            <div class="recipe-description">
              <p class="p-data">
                <?php echo htmlspecialchars($recipeInfo['recipe_descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </div>
            <div class="recipe-category">
              <label for="categoria">Categoría</label>
              <p class="p-data">
                <?php echo htmlspecialchars($recipeInfo['recipe_category'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </div>
            <div class="recipe-time-preparation">
              <label for="tiempo_preparacion">Tiempo de preparación</label>
              <p class="p-data">
                <?php echo htmlspecialchars($recipeInfo['recipe_preparation_time'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </div>

          </div>

        </section>

        <div class="recipe-data">
          <section class="recipe-ingredient-content">
            <div class="recipe-data-title">
              <h2>Ingredientes</h2>
            </div>
            <div>
              <div class="recipe-ingrediente">
                <ol id="ingredientes">
                  <?php foreach ($ingredientInfo as $index => $ingredient): ?>
                    <li class="ingrediente">
                      <p>
                        <?= htmlspecialchars($ingredient['ingredient_name'], ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </li>
                  <?php endforeach; ?>
                </ol>
              </div>
          </section>
          <section class="recipe-step-content">
            <div class="recipe-data-title">
              <h2>Pasos</h2>
            </div>

            <div>
              <div class="recipe-steps">
                <ol id="pasos">
                  <?php foreach ($stepInfo as $index => $step): ?>
                    <li class="paso">
                      <label form="stepInfo[<?= $index ?>][step_descripcion]"> <?= $index + 1; ?></label>
                      <p>
                        <?= htmlspecialchars($step['step_descripcion'], ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </li>
                  <?php endforeach; ?>
                </ol>
              </div>
            </div>
          </section>
        </div>

      </div>
    </form>


    <?php require __DIR__ . '/template/comments.php'; ?>
  </div>
</body>