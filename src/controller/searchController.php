<?php
session_start();
require_once __DIR__ . '/../model/Recipe.php';

$recipe = new Recipe();
unset($_SESSION['search_results']);
unset($_SESSION['search_term']);


$searchTerm = isset($_POST['searchTerm']) ? filter_input(INPUT_POST, 'searchTerm', FILTER_SANITIZE_STRING) : '';
if ($searchTerm) {
  $recipeAll = $recipe->searchRecipes($searchTerm);

  $_SESSION['search_results'] = $recipeAll;
  $_SESSION['search_term'] = $searchTerm;
} else {
  $_SESSION['search_results'] = [];
  $_SESSION['search_term'] = '';
}

print_r($recipeAll);

header('Location:' . '/view/home.php');
