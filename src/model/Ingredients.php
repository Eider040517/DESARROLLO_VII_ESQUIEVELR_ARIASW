<?php
require_once __DIR__ . '/DataBase.php';

class Ingredients
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }

  public function CreateIngredients($idRecipe, $ingrediente)
  {
    $sql = " INSERT INTO ingredientes (id_receta,ingrediente) VALUES (:id_receta,:ingrediente)";
    try {

      // Preparar la consulta con ON DUPLICATE KEY UPDATE
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id_receta", $idRecipe);
        $stm->bindParam(":ingrediente", $ingrediente);
        $success = $stm->execute();
        if ($success) {
          echo "Ingrediente guardado";
        } else {
          echo "Ingrediente no guardado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      // Captura y muestra el error de la base de datos
      echo "Error al guardar el ingrediente: " . $e->getMessage();
      return false;
    }
  }

  public function UpdateIngredients($data)
  {

    $sql = "UPDATE ingredientes SET ingrediente = :ingrediente WHERE id = :id";

    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":ingrediente", $data['ingredient_name']);
        $stm->bindParam(":id", $data['ingredient_id']);
        $success = $stm->execute();
        if ($success) {
          echo "Ingrediente modificado";
        } else {
          echo "Ingrediente no modificado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al modificar el ingrediente: " . $e->getMessage();
      return false;
    }
  }

  public function DeleteIngredients($id)
  {
    $sql = "DELETE FROM ingredientes WHERE id = :id";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id", $id);
        $success = $stm->execute();
        if ($success) {
          echo "Ingrediente eliminado";
        } else {
          echo "Ingrediente no eliminado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al eliminar el ingrediente: " . $e->getMessage();
      return false;
    }
  }

  public function ConsultIngredients($idReceta)
  {
    $sql = "SELECT 
    id AS ingredient_id,
    ingrediente AS ingredient_name
    FROM 
      ingredientes
    WHERE 
      id_receta = :id_receta;
    ";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id_receta", $idReceta);
        $success = $stm->execute();
        $ingredientes = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($success) {
          return $ingredientes;
        } else {
          echo "Ingrediente no ubicada";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al buscar el ingrediente: " . $e->getMessage();
      return false;
    }
  }
}
