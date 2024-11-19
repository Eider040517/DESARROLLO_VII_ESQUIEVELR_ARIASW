<?php

require_once __DIR__ . '/DataBase.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }
    //Se crea el usuario por medio de registro
    public function CreateUserRegister($userInfo)
    {
        $sql = " INSERT INTO user (username,email,password) VALUES (:username,:email,:password) ";
        try {
            // Preparar la consulta con ON DUPLICATE KEY UPDATE
            if ($stm = $this->pdo->prepare($sql)) {
                $stm->bindParam(":username", $userInfo['username']);
                $stm->bindParam(":email", $userInfo['email']);
                $stm->bindParam(":password", $userInfo['password']);
                $success = $stm->execute();
                if ($success) {
                    echo "Usuario Guaradado";
                } else {
                    echo "Usuario no guardado";
                }
            }
            unset($stm);
        } catch (PDOException $e) {
            // Captura y muestra el error de la base de datos
            echo "Error al guardar el usuario: " . $e->getMessage();
            return false;
        }
    }

    public function isLoginUser($userInfo)
    {
        $sql = "SELECT password FROM user WHERE email = :email AND username = :username";
        try {
            if ($stm = $this->pdo->prepare($sql)) {
                $stm->bindParam(':email', $userInfo['email']);
                $stm->bindParam(':username', $userInfo['username']);
                $stm->execute();
                $resp = $stm->fetchColumn();
                if (password_verify($userInfo['password'],$resp)) {
                    return true;
                } else {
                    return $resp .'</br>';
                }
            }
        } catch (PDOException $e) {
            echo "Error al verificar usario: " . $e->getMessage();
        }
    }
}
