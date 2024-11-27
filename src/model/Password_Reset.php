<?php
require_once __DIR__ . '/DataBase.php';
class Password_Reset
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }

  public function CreateToken($email, $token)
  {
    $sql = "INSERT INTO password_reset (email, token) VALUES (:email, :token)";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":email", $email);
        $stm->bindParam(":token", $token);
        $stm->execute();
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al guardar Token " . $e->getMessage();
      return false;
    }
  }

  public function DeleteToken($email)
  {
    $sql = "DELETE FROM password_reset WHERE email = :email";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":email", $email);
        $stm->execute();
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al eliminar el ingrediente: " . $e->getMessage();
      return false;
    }
  }
}
