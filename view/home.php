<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_id']) {
  require __DIR__ .  '/login.php';
}
echo dirname(__DIR__);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../public/assets/css/home.css">
  <title>Recipe</title>
</head>

<body>
  <?php require __DIR__ . '/../view/template/header.php' ?>
</body>

</html>