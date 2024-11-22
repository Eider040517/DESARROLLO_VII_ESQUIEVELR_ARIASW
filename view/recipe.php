
<link rel="stylesheet" href="/public/assets/css/recipe.css">
<form action="/src/controller/recipeController.php" method="POST">
    <!-- Campo oculto para el ID de la receta -->
    <input type="hidden" id="receta_id" name="recipeInfo[receta_id]" value="<?php echo htmlspecialchars($recipeInfo['receta_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="action" value="update">

    <!-- Datos de la receta -->
    <label for="nombre">Nombre de la receta:</label>
    <input type="text" id="nombre" name="recipeInfo[receta_nombre]"
        value="<?= htmlspecialchars($recipeInfo['receta_nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="recipeInfo[receta_descripcion]" required><?php echo htmlspecialchars($recipeInfo['receta_descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>

    <label for="categoria">Categoría:</label>
    <input type="text" id="categoria" name="recipeInfo[categoria]"
        value="<?php echo htmlspecialchars($recipeInfo['receta_categoria'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <label for="tiempo_preparacion">Tiempo de preparación (en minutos):</label>
    <input type="number" id="tiempo_preparacion" name="recipeInfo[receta_tiempo_preparacion]"
        value="<?php echo htmlspecialchars($recipeInfo['receta_tiempo_preparacion'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required><br><br>

    <!-- Ingredientes -->
    <h3>Ingredientes</h3>
    <div id="ingredientes">
        <?php if (!empty($ingredientInfo)): ?>
            <?php foreach ($ingredientInfo as $ingredient): ?>
                <div class="ingrediente">
                    <input type="hidden" name="ingredientInfo[][ingredient_id]" value="<?= $ingredient['ingredient_id'] ?>">

                    <input type="text" name="ingredientInfo[][ingredient_name]"
                        value="<?= htmlspecialchars($ingredient['ingredient_name'], ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Ingrediente <?php echo $index + 1; ?>" required><br><br>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="ingrediente">
                <input type="text" name="ingredientes[]" placeholder="Ingrediente 1" required><br><br>
            </div>
        <?php endif; ?>
    </div>
    <button type="button" id="agregarIngrediente">Agregar Ingrediente</button><br><br>

    <!-- Pasos -->
    <h3>Pasos</h3>
    <div id="pasos">
        <?php if (!empty($stepInfo)): ?>
            <?php foreach ($stepInfo as $step): ?>
                <div class="paso">
                    <input type="hidden" name="stepInfo[step_id]" value=" <?= htmlspecialchars($step['step_id']) ?> ">
                    <label ><?= htmlspecialchars($step['step_number']) ?></label>
                    <input type="text" name="stepInfo[paso_descripcion]"
                        value="<?= htmlspecialchars($step['step_descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Paso <?= $index + 1; ?>" required><br><br>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="paso">
                <input type="text" name="pasos[]" placeholder="Paso 1" required><br><br>
            </div>
        <?php endif; ?>
    </div>
    <button type="button" id="agregarPaso">Agregar Paso</button><br><br>

    <button type="submit">Guardar</button>
</form>

<script src="/public/assets/js/recipe.js"></script>