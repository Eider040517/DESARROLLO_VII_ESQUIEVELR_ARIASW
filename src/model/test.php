<?php
require_once __DIR__ . '/Recipe.php';

$recipe = new Recipe();


$recetas = $recipe->searchRecipes('sopa');

print_r($recetas);
