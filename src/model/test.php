<?php
session_start();
require_once __DIR__ . '/../service/RecipeService.php';


$userId = $_SESSION['user_id'];

$recipeService = new RecipeService();




