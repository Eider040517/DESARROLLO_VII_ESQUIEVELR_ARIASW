<?php
require_once __DIR__ . '/../service/RecipeService.php';

$recipeService = new RecipeService();
$action = isset($_POST['action']) ? $_POST['action'] : "";
$recipe_id = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : "";

switch ($action) {
  case 'update':

    $recipeInfo = $_POST['recipeInfo'];
    $ingredientInfo = $_POST['ingredientInfo'];
    $stepInfo = $_POST['stepInfo'];

    print_r($ingredientInfo);
    //$recipeService->UpdateRecipe($recipe_id,$recipeInfo, $ingredientInfo,$stepInfo);

    break;

  case 'edit':
    $recipeData =$recipeService->ConsultRecipe($recipe_id);

    $recipeInfo = $recipeData['info'];
    $ingredientInfo = $recipeData['ingredient'];
    $stepInfo = $recipeData['step'];

    require __DIR__ . "/../../view/recipe.php";
    break;

  case 'delete':
    echo "Para eliminar <br>";
    echo $action . " --- " . $recipe_id;
    break;

  default:
    # code...
    break;
}
