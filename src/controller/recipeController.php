<?php
require_once __DIR__ . '/../service/RecipeService.php';
require_once __DIR__ . '/../service/UpFileService.php';

$recipeService = new RecipeService();
$upFileService = new UpFileService();

$user_id = $_SESSION['user_id'];
$action = isset($_POST['action']) ? $_POST['action'] : "";
$recipe_id = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : $_POST['recipeInfo']['recipe_id'];

$recipeInfo = isset($_POST['recipeInfo']) ? $_POST['recipeInfo'] : "";
$ingredientInfo = isset($_POST['ingredientInfo']) ? $_POST['ingredientInfo'] : "";
$stepInfo = isset($_POST['stepInfo']) ? $_POST['stepInfo'] : "";

switch ($action) {
  case 'create':
    $file = $_FILES['recipe_img'];
    $fileName = $upFileService->addFile($file);
    $recipeService->saveRecipe($user_id, $recipeInfo, $ingredientInfo, $stepInfo, $fileName);
    header('Location: /view/profile.php');
    break;
  case 'modified':
    $data = $recipeService->ConsultRecipe($recipe_id);
    $recipeInfo = $data['info'];
    $ingredientInfo = $data['ingredient'];
    $stepInfo = $data['step'];
    require __DIR__ . '/../../view/recipe.php';
    break;
  case 'update':
    $file = $_FILES['recipe_img'];
    if (isset($file) && $file['error'] !== UPLOAD_ERR_NO_FILE) {
      $fileName = $upFileService->addFile($file);
    } else {
      $fileName = $recipeInfo['recipe_imagen'];
    }

    $recipeService->UpdateRecipe($recipeInfo, $ingredientInfo, $stepInfo, $fileName);
    header('Location: /view/profile.php');
    break;
  case 'detail':
    header('Location: /view/detailRecipe.php');
    break;
  case 'delete':
    $recipeService->DeleteRecipe($recipe_id);
    header('Location: /view/profile.php');
    break;
  default:


    break;
}
