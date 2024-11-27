<?php
require_once __DIR__ . '/../model/Comments.php';
$commentModel = new Comments();
if (isset($_POST['recipe_id'])) {
  session_start();
  $action = filter_var($_POST['action'], FILTER_SANITIZE_SPECIAL_CHARS);
  $recipe_id = filter_var($_POST['recipe_id'], FILTER_SANITIZE_NUMBER_INT);
  $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
  $comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);

  switch ($action) {
    case 'create':
      $commentModel->CreateComment($recipe_id, $user_id, $comment);
      header('Location: /view/detailRecipe.php');
      break;

    default:
      # code...
      break;
  }
}

function getRecipeComments($recipe_id)
{
  global $commentModel;
  $comments = $commentModel->ConsultComments($recipe_id);
  return $comments;
}
