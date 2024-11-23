<?php
require __DIR__ . '/../../config.php';
require BASE_PATH . 'src/model/User.php';
require BASE_PATH . 'src/model/Password_Reset.php';

//Mejorar la seguridad para ingreso de datos
$action = isset($_POST['action']) ? $_POST['action'] : " ";
$username = isset($_POST['username']) ? $_POST['username'] : " ";
$email = isset($_POST['email']) ? $_POST['email'] : " ";
$password = isset($_POST['password']) ? $_POST['password'] : " ";
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : " ";
$token = isset($_POST['token']) ? $_POST['token'] : " ";

$user = new User();
$password_reset = new Password_Reset();

switch ($action) {
  case 'register':
    if ($user->isLoginUser($email)) {
      $message = '<p> EL USUARIO YA EXITE </p>';
      require BASE_PATH . 'view/login.php';
    } else {
      $password = password_hash($password, PASSWORD_BCRYPT);
      $user->CreateUserRegister($username, $email, $password);
      $message = '<p> SE REGISTRO CORRECTAMENTE </p>';
      require BASE_PATH . 'view/login.php';
    }
    break;
  case 'login':
    $resp = $user->login($email, $password);
    if ($resp) {
      session_start();
      $_SESSION['user_id'] = $resp['user_id'];
      $_SESSION['username'] = $resp['username'];
      $_SESSION['user_email'] = $resp['user_email'];
      header('Location:' . BASE_URL . '/../../view/home.php');
      exit;
    } else {
      //Revisar y mejorar los error de que se devuelven
      $message = '<p> NO SE PUDO REGISTRAR </p>';
      header('Location: /../../index.php'); // Redirigir al inicio
    }
    break;
  case 'logout':
    session_start();
    session_destroy();
    header('Location: /../../index.php'); // Redirigir al inicio
    break;
  case 'reset':
    if ($user->isLoginUser($email)) {
      $user_id = $user->isLoginUser($email);
      $token = bin2hex(random_bytes(50));
      $hashedToken = password_hash($token, PASSWORD_DEFAULT);

      $password_reset->DeleteToken($email);
      $password_reset->CreateToken($email, $hashedToken);

      $urlReset = 'http://' . $_SERVER['HTTP_HOST'] . '/view/login/resetPassword.php?user_id=' . urldecode($user_id) . '&email=' . urldecode($email) . '&token=' . urldecode($hashedToken);

      mail($email, "Password Reset", "Has click en el elance para cambiar contraseña: " . urldecode($urlReset));
      require BASE_PATH . 'view/login/emailConfirmation.php';
    }
    break;

  case 'update':

    $password = password_hash($password, PASSWORD_BCRYPT);
    $user->UpdatePassword($user_id, $password);
    $password_reset->DeleteToken($email);
    header('Location: /../../index.php'); // Redirigir al inicio
    break;

  default:

    header('Location: /../../index.php'); // Redirigir al inicio
    break;
}
