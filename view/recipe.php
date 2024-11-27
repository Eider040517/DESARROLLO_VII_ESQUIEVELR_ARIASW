<?php
session_start();
if (isset($_GET['action'])) {
    $action = 'create';
    unset($_SESSION['recipe_info']);
    unset($_SESSION['recipe_ingredient']);
    unset($_SESSION['recipe_setp']);
} else {
    $recipeInfo = $_SESSION['recipe_info'];
    $ingredientInfo = $_SESSION['recipe_ingredient'];
    $stepInfo =  $_SESSION['recipe_setp'];
    $action = 'update';
}
?>
<link rel="stylesheet" href="/public/assets/css/recipe.css">
<header>
    <div class="logo-header">
        <a href="/">
            <img src="/public/img/healthy_food.png" alt="logo">
        </a>
    </div>
    <nav>
        <div>
            <button type="button" id="userButton">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                    <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                </svg>
            </button>
            <!-- Modal abosolute -->
            <div id="userDropdown" class="dropdown-menu">
                <ul>
                    <li>
                        <a href="profile.php">Entrar a mi perfil</a>
                    <li>
                        <form id="logoutForm" action="/../src/controller/userController.php" method="post">
                            <input type="hidden" value="logout" name="action">
                        </form>

                        <a href="#" id="logoutLink">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>

        <?php if ($action === 'create') : ?>
            <button type="button" id="btnSave" class="btn-header btn-orange">Guardar</button>
        <?php elseif ($action === 'update'): ?>
            <button type="button" id="btnDelete" class="btn-header btn-red">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 20 20" class="mr-xs mise-icon mise-icon-bin">
                    <path fill="currentColor" fill-rule="evenodd" d="M8.1 3.15a.183.183 0 0 0-.173.125L7.569 4.35h4.862l-.358-1.075a.183.183 0 0 0-.174-.125H8.101Zm5.702 1.2-.495-1.486a1.483 1.483 0 0 0-1.408-1.014H8.101c-.639 0-1.206.409-1.408 1.014L6.198 4.35H2.5a.65.65 0 1 0 0 1.3h1.059l.585 8.782a3.983 3.983 0 0 0 3.975 3.718h3.763a3.983 3.983 0 0 0 3.974-3.718l.585-8.782H17.5a.65.65 0 1 0 0-1.3H13.802Zm1.337 1.3H4.86l.58 8.695A2.683 2.683 0 0 0 8.12 16.85h3.763a2.683 2.683 0 0 0 2.677-2.505l.58-8.695ZM8.333 7.684a.65.65 0 0 1 .65.65v5.833a.65.65 0 1 1-1.3 0V8.334a.65.65 0 0 1 .65-.65Zm3.984.65a.65.65 0 1 0-1.3 0v3.333a.65.65 0 1 0 1.3 0V8.334Z" clip-rule="evenodd"></path>
                </svg>
                <span>
                    Eliminar
                </span>
            </button>
            <button type="buton" id="btnUpdate" class="btn-header btn-orange">Guardar</button>
        <?php endif ?>

    </nav>
</header>

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
                        <input type="text" name="recipeInfo[recipe_name]" value="<?= htmlspecialchars($recipeInfo['recipe_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Título: Mi mejor sopa de guisantes" required>
                    </div>
                    <div class="recipe-description">
                        <textarea id="descripcion" name="recipeInfo[recipe_descripcion]" placeholder="Comparte un poco más sobre este plato. ¿Qué o quién te inspiró a cocinarlo? ¿Qué lo hace especial para ti? ¿Cuál es tu forma favorita de comerlo?" required><?php echo htmlspecialchars($recipeInfo['recipe_descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>
                    <div class="recipe-category">
                        <label for="categoria">Categoría</label>
                        <input type="text" id="categoria" name="recipeInfo[recipe_category]"
                            value="<?php echo htmlspecialchars($recipeInfo['recipe_category'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Postre" required>
                    </div>
                    <div class="recipe-time-preparation">
                        <label for="tiempo_preparacion">Tiempo de preparación</label>
                        <input type="number" id="tiempo_preparacion" name="recipeInfo[recipe_preparation_time]"
                            value="<?php echo htmlspecialchars($recipeInfo['recipe_preparation_time'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Minutos" required>
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
                                <?php if (!empty($ingredientInfo)): ?>
                                    <?php foreach ($ingredientInfo as $index => $ingredient): ?>
                                        <li class="ingrediente">
                                            <input type="hidden" name="ingredientInfo[<?= $index ?>][ingredient_id]" value="<?= htmlspecialchars($ingredient['ingredient_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <input type="text" name="ingredientInfo[<?= $index ?>][ingredient_name]"
                                                value="<?= htmlspecialchars($ingredient['ingredient_name'], ENT_QUOTES, 'UTF-8'); ?>"
                                                placeholder="Ingrediente <?= $index + 1; ?>" required>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="ingrediente">
                                        <input type="text" name="ingredientInfo[0][ingredient_name]" placeholder="Ingrediente 1" required><br><br>
                                    </div>
                                <?php endif; ?>
                            </ol>
                        </div>

                        <div class="recipe-data-btn">
                            <button type="button" id="agregarIngrediente">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12M6 12h12"></path>
                                </svg>
                                <span>Ingrediente</span>
                            </button>
                        </div>
                    </div>

                </section>
                <section class="recipe-step-content">
                    <div class="recipe-data-title">
                        <h2>Pasos</h2>
                    </div>

                    <div>
                        <div class="recipe-steps">
                            <ol id="pasos">
                                <?php if (!empty($stepInfo)): ?>
                                    <?php foreach ($stepInfo as $index => $step): ?>
                                        <li class="paso">
                                            <input type="hidden" name="stepInfo[<?= $index ?>][step_id]" value="<?= htmlspecialchars($step['step_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <input type="hidden" name="stepInfo[<?= $index ?>][step_number]" value="<?= htmlspecialchars($step['step_number'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <label form="stepInfo[<?= $index ?>][step_descripcion]"> <?= $index + 1; ?></label>
                                            <input type="text" name="stepInfo[<?= $index ?>][step_descripcion]"
                                                value="<?= htmlspecialchars($step['step_descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                                                placeholder="Paso <?= $index + 1; ?>" required>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="paso">
                                        <input type="hidden" name="stepInfo[0][step_number]" value="0">
                                        <input type="text" name="stepInfo[0][step_descripcion]" placeholder="Paso 1" required><br><br>
                                    </li>
                                <?php endif; ?>
                            </ol>
                        </div>

                        <div class="recipe-data-btn">
                            <button type="button" id="agregarPaso" ß>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12M6 12h12"></path>
                                </svg>
                                <span>Paso</span>
                            </button>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </form>
    <?php
    if ($action == 'update') {
        require __DIR__ . '/template/comments.php';
    }
    ?>
</div>
<script src="/public/assets/js/recipe.js"></script>