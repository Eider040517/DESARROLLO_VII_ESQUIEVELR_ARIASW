<?php
require_once __DIR__ . '/DataBase.php';

class Recipe
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }

  public function CreatRecipe($userId, $data)
  {
    $sql = " INSERT INTO recetas (user_id,nombre,descripcion,categoria,tiempo_preparacion) VALUES (:user_id,:nombre,:descripcion,:categoria,:tiempo_preparacion) ";
    try {

      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":user_id", $userId);
        $stm->bindParam(":nombre", $data['receta_nombre']);
        $stm->bindParam(":descripcion", $data['receta_descripcion']);
        $stm->bindParam(":categoria", $data['receta_categoria']);
        $stm->bindParam(":tiempo_preparacion", $data['receta_tiempo_preparacion']);
        $success = $stm->execute();
        if ($success) {
          $idReceta = $this->pdo->lastInsertId();
          return $idReceta;
        } else {
          echo "Receta no guardado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      // Captura y muestra el error de la base de datos
      echo "Error al guardar el receta: " . $e->getMessage();
    }
  }

  public function UpdateRecipe($data)
  {
    $sql = "UPDATE recetas SET 
            nombre = :nombre,
            descripcion = :descripcion,
            categoria = :categoria,
            tiempo_preparacion = :tiempo_preparacion 
        WHERE id = :id";

    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":nombre", $data['receta_nombre']);
        $stm->bindParam(":descripcion", $data['receta_descripcion']);
        $stm->bindParam(":categoria", $data['receta_categoria']);
        $stm->bindParam(":tiempo_preparacion", $data['receta_tiempo_preparacion']);
        $stm->bindParam(":id", $data['receta_id']);
        $success = $stm->execute();
        if ($success) {
          echo "Receta Modifica";
          return true;
        } else {
          echo "Receta no modificada";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al modificar el receta: " . $e->getMessage();
      return false;
    }
  }

  public function DeleteRecipe($id)
  {
    $sql = "DELETE FROM recetas WHERE id = :id";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id", $id);
        $success = $stm->execute();
        if ($success) {
          echo "Receta eliminado";
        } else {
          echo "Receta no eliminado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al receta el ingrediente: " . $e->getMessage();
      return false;
    }
  }

  public function ConsultRecipe($id)
  {
    $sql = "SELECT id AS receta_id,nombre AS receta_nombre,descripcion AS receta_descripcion,categoria AS receta_categoria,tiempo_preparacion AS receta_tiempo_preparacion,fecha_creacion AS receta_fecha_creacion FROM recetas WHERE id = :id;";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id", $id);
        $success = $stm->execute();
        $receta = $stm->fetch(PDO::FETCH_ASSOC);
        if ($success) {
          return $receta;
        } else {
          echo "Receta no ubicada";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al buscar el receta: " . $e->getMessage();
      return false;
    }
  }
  public function getRecipeByUser($user_id)
  {
    $sql = "SELECT id AS recipe_id, nombre AS recipe_name, descripcion AS recipe_descripcion, categoria AS recipe_category, tiempo_preparacion AS recipe_preparation_time, fecha_creacion AS recipe_creation_date
                    FROM recetas 
                WHERE user_id = :user_id;
        ";

    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":user_id", $user_id);
        $success = $stm->execute();
        $recetas = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($success) {
          return $recetas;
        } else {
          return "Usuario sin receta";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al buscar el recetas: " . $e->getMessage();
      return false;
    }
  }
}
