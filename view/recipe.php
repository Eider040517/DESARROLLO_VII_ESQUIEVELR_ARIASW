<?php
require __DIR__ . '/template/header.php';

if (isset($_GET['action'])) {
    $action = 'create';
} else {
    $action = 'update';
}
?>
<link rel="stylesheet" href="/public/assets/css/recipe.css">
<?php if ($action === 'update'): ?>
    <div class="content_img">
        <img src="/uploads/<?= isset($recipeInfo['recipe_imagen']) ? urldecode($recipeInfo['recipe_imagen']) : "" ?> " alt="Imagen">
    </div> # code...

<?php endif ?>


<form class="recipe_form" action="/src/controller/recipeController.php" method="POST" enctype="multipart/form-data">

    <!-- Campo oculto para el ID de la receta -->
    <input type="hidden" id="receta_id" name="recipeInfo[recipe_id]" value="<?php echo htmlspecialchars($recipeInfo['recipe_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" id="receta_id" name="recipeInfo[recipe_imagen]" value="<?php echo htmlspecialchars($recipeInfo['recipe_imagen'] ?? null, ENT_QUOTES, 'UTF-8'); ?>">
    <!-- Campo para ingresar la imagen de la receta -->
    <label for="recipe_img">Selecciona una imagen/archivo:</label>
    <input id="recipe_img" name="recipe_img" type="file">

    <!-- Datos de la receta -->
    <label for="nombre">Nombre de la receta:</label>
    <input type="text" id="nombre" name="recipeInfo[recipe_name]"
        value="<?= htmlspecialchars($recipeInfo['recipe_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="recipeInfo[recipe_descripcion]" required><?php echo htmlspecialchars($recipeInfo['recipe_descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>

    <label for="categoria">Categoría:</label>
    <input type="text" id="categoria" name="recipeInfo[recipe_category]"
        value="<?php echo htmlspecialchars($recipeInfo['recipe_category'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <label for="tiempo_preparacion">Tiempo de preparación (en minutos):</label>
    <input type="number" id="tiempo_preparacion" name="recipeInfo[recipe_preparation_time]"
        value="<?php echo htmlspecialchars($recipeInfo['recipe_preparation_time'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <!-- Ingredientes -->
    <h3>Ingredientes</h3>
    <div id="ingredientes">
        <?php if (!empty($ingredientInfo)): ?>
            <?php foreach ($ingredientInfo as $index => $ingredient): ?>
                <div class="ingrediente">
                    <input type="hidden" name="ingredientInfo[<?= $index ?>][ingredient_id]" value="<?= htmlspecialchars($ingredient['ingredient_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="text" name="ingredientInfo[<?= $index ?>][ingredient_name]"
                        value="<?= htmlspecialchars($ingredient['ingredient_name'], ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Ingrediente <?= $index + 1; ?>" required>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="ingrediente">
                <input type="text" name="ingredientInfo[0][ingredient_name]" placeholder="Ingrediente 1" required><br><br>
            </div>
        <?php endif; ?>
    </div>
    <button type="button" id="agregarIngrediente">Agregar Ingrediente</button><br><br>

    <!-- Pasos -->
    <h3>Pasos</h3>
    <div id="pasos">
        <?php if (!empty($stepInfo)): ?>
            <?php foreach ($stepInfo as $index => $step): ?>
                <div class="paso">
                    <input type="hidden" name="stepInfo[<?= $index ?>][step_id]" value="<?= htmlspecialchars($step['step_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="stepInfo[<?= $index ?>][step_number]" value="<?= htmlspecialchars($step['step_number'], ENT_QUOTES, 'UTF-8'); ?>">
                    <label>Paso <?= $index + 1; ?>:</label>
                    <input type="text" name="stepInfo[<?= $index ?>][step_descripcion]"
                        value="<?= htmlspecialchars($step['step_descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Paso <?= $index + 1; ?>" required>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="paso">
                <input type="hidden" name="stepInfo[0][step_number]" value="0">
                <input type="text" name="stepInfo[0][step_descripcion]" placeholder="Paso 1" required><br><br>
            </div>
        <?php endif; ?>
    </div>
    <button type="button" id="agregarPaso">Agregar Paso</button><br><br>
    <?php if ($action === 'create') : ?>
        <button type="submit" name="action" value="create">Guardar</button>
    <?php elseif ($action === 'update'): ?>
        <button type="submit" name="action" value="delete">Eliminar</button>
        <button type="submit" name="action" value="update">Guardar</button>
    <?php endif ?>
</form>

<script src="/public/assets/js/recipe.js"></script>