<?php
session_start();
require_once __DIR__ . '/../model/Recipe.php';

$recipe =  new Recipe();
unset($_SESSION['recipe_all']);

$recipeAll = $recipe->getAllRecipe();
if ($recipeAll) {
  $_SESSION['recipe_all'] = $recipeAll;
} else {
  $_SESSION['recipe_all'] = [];
}

print_r($_SESSION['recipe_all']);

header('Location:' . '/view/home.php');
