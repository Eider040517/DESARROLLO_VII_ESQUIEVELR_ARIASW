<?php
require __DIR__ . '/../../config.php';
require BASE_PATH . 'src/model/User.php';

$action = isset($_POST['action']) ? $_POST['action'] : " ";
$username = isset($_POST['username']) ? $_POST['username'] : " ";
$email = isset($_POST['email']) ? $_POST['email'] : " ";
$password = isset($_POST['password']) ? $_POST['password'] : " ";

$user = new User();

switch ($action) {
  case 'register':
    if ($user->isLoginUser($username, $email)) {
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
      $_SESSION['user_email'] =$resp['user_email'];
      header('Location:' . BASE_URL . 'view/home.php');
      exit;
    } else {
      $message = '<p> NO SE PUDO REGISTRAR </p>';
      require BASE_PATH . 'view/login.php';
    }
    break;
  case 'logout':
    session_start();
    session_destroy();
    header('Location: /../../index.php'); // Redirigir al inicio
    break;

  default:
    echo $action . ' - accion presionado <br>';
    echo "Error no encontrado";
    # code...
    break;
}
