<?php
session_start();
$userId = $_SESSION['user_id'];

require_once __DIR__ .  '/../model/User.php';
require_once __DIR__ .  '/../model/Recipe.php';

$user = new User();
$recipe = new Recipe();

$userData = $user->getUserData($userId);
$recipeData = $recipe->getRecipeByUser($userId);

$userData = $userData[0];


