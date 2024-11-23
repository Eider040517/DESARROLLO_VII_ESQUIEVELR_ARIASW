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
    public function CreateUserRegister($username, $email, $password)
    {
        $sql = " INSERT INTO user (username,email,password) VALUES (:username,:email,:password) ";
        try {

            // Preparar la consulta con ON DUPLICATE KEY UPDATE
            if ($stm = $this->pdo->prepare($sql)) {
                $stm->bindParam(":username", $username);
                $stm->bindParam(":email", $email);
                $stm->bindParam(":password", $password);
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

    public function isLoginUser($email)
    {
        $sql = "SELECT id FROM user WHERE email = :email ";
        try {
            if ($stm = $this->pdo->prepare($sql)) {
                $stm->bindParam(':email', $email);
                $stm->execute();
                $user = $stm->fetch();
                if ($user) {
                    return $user['id'];
                } else {
                    return null;
                }
            }
        } catch (PDOException $e) {
            echo "Error al verificar usario: " . $e->getMessage();
        }
    }

    public function UpdatePassword($user_id, $password)
    {
        $sql = "UPDATE user SET 
            password = :password 
        WHERE id = :id";
        try {
            if ($stm = $this->pdo->prepare($sql)) {
                $stm->bindParam(":id", $user_id);
                $stm->bindParam(":password", $password);
                $success = $stm->execute();
                if ($success) {
                    echo "Password Actualizado";
                    return true;
                } else {
                    echo "Password No Actualizado";
                }
            }
            unset($stm);
        } catch (Exception $e) {
            echo "Error al modificar el password: " . $e->getMessage();
            return false;
        }
    }

    public function login($email, $password)
    {
        $sql = "SELECT id AS user_id ,username,email AS user_email,password FROM user WHERE email = :email ";
        try {
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':email', $email);
            $stm->execute();

            $user = $stm->fetch(PDO::FETCH_ASSOC); // Obtener un array asociativo con id y password

            if ($user) {
                // Validar la contraseña
                if (password_verify($password, $user['password'])) {
                    return $user; // Retorna el usuario si el login es exitoso
                } else {
                    return false; // Contraseña incorrecta
                }
            } else {
                return false; // Usuario no encontrado
            }
        } catch (PDOException $e) {
            echo "Error al logiar usario: " . $e->getMessage();
        }
    }

    public function getUserData($user_id)
    {
        $sql = "SELECT username , email AS user_email , create_time AS user_create_time 
                    FROM user
                WHERE id = :id;
        ";

        try {
            if ($stm = $this->pdo->prepare($sql)) {
                $stm->bindParam(":id", $user_id);
                $success = $stm->execute();
                $usuario = $stm->fetchAll(PDO::FETCH_ASSOC);
                if ($success) {
                    return $usuario;
                } else {
                    return "Datos del usuario";
                }
            }
            unset($stm);
        } catch (Exception $e) {
            echo "Error al buscar el usuario: " . $e->getMessage();
            return false;
        }
    }
}
