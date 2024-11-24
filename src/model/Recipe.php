<?php
require_once __DIR__ . '/DataBase.php';

class Recipe
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }

  public function CreatRecipe($userId, $data, $fileName)
  {
    $sql = " INSERT INTO recetas (user_id,nombre,descripcion,categoria,tiempo_preparacion,imagen) VALUES (:user_id,:nombre,:descripcion,:categoria,:tiempo_preparacion , :imagen) ";
    try {

      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":user_id", $userId);
        $stm->bindParam(":nombre", $data['recipe_name']);
        $stm->bindParam(":descripcion", $data['recipe_descripcion']);
        $stm->bindParam(":categoria", $data['recipe_category']);
        $stm->bindParam(":tiempo_preparacion", $data['recipe_preparation_time']);
        $stm->bindParam(":imagen", $fileName);
        $success = $stm->execute();
        if ($success) {
          $idReceta = $this->pdo->lastInsertId();
          return $idReceta;
        } else {
          return false;
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      // Captura y muestra el error de la base de datos
      echo "Error al guardar el receta: " . $e->getMessage();
    }
  }

  public function UpdateRecipe($data, $fileName)
  {
    $sql = "UPDATE recetas SET 
            nombre = :nombre,
            descripcion = :descripcion,
            categoria = :categoria,
            tiempo_preparacion = :tiempo_preparacion,
            imagen = :imagen
        WHERE id = :id";

    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":nombre", $data['recipe_name']);
        $stm->bindParam(":descripcion", $data['recipe_descripcion']);
        $stm->bindParam(":categoria", $data['recipe_category']);
        $stm->bindParam(":tiempo_preparacion", $data['recipe_preparation_time']);
        $stm->bindParam(":imagen", $fileName);
        $stm->bindParam(":id", $data['recipe_id']);
        $success = $stm->execute();
        if ($success) {
          return true;
        } else {
          return false;
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
          return true;
        } else {
          return false;
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
    $sql = "SELECT id AS recipe_id,
                  nombre AS recipe_name,
                  descripcion AS recipe_descripcion,
                  categoria AS recipe_category,
                  tiempo_preparacion AS recipe_preparation_time,
                  imagen AS recipe_imagen,
                  fecha_creacion AS recipe_creation_date
            FROM recetas 
            WHERE id = :id;";
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
    $sql = "SELECT id AS recipe_id, nombre AS recipe_name, descripcion AS recipe_descripcion, categoria AS recipe_category, tiempo_preparacion AS recipe_preparation_time,imagen AS recipe_imagen, fecha_creacion AS recipe_creation_date
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
  public function searchRecipes($searchTerm)
  {
    $sql = "SELECT DISTINCT r.id, r.nombre, r.descripcion, r.categoria, r.tiempo_preparacion, r.imagen,r.fecha_creacion
    FROM recetas r
    LEFT JOIN ingredientes i ON r.id = i.id_receta
    LEFT JOIN pasos p ON r.id = p.id_receta
    WHERE r.nombre LIKE :searchTerm
       OR r.categoria LIKE :searchTerm
       OR i.ingrediente LIKE :searchTerm
       OR p.descripcion LIKE :searchTerm
    ORDER BY r.fecha_creacion DESC";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $success = $stm->execute([':searchTerm' => "%$searchTerm%"]);
        $recetas = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($success) {
          return $recetas;
        } else {
          return "No se encontro receseta";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al buscar el recetas: " . $e->getMessage();
      return false;
    }
  }
}
