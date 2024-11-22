<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();



// Include the configuration file
require_once __DIR__ . '/config.php';

// Include necessary files
require_once BASE_PATH . 'src/model/DataBase.php';

if (isset($_SESSION['user_id'])) {

  header('Location: view/home.php');
} else {
  header('Location: view/login.php');
}
