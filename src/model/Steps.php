<?php
require_once __DIR__ . '/DataBase.php';

class Steps
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }

  public function CreateStep($idRecipe, $data)
  {
    $sql = " INSERT INTO pasos (id_receta,numero_paso,descripcion) VALUES (:id_receta,:numero_paso,:descripcion)";
    try {

      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id_receta", $idRecipe);
        $stm->bindParam(":numero_paso", $data['step_number']);
        $stm->bindParam(":descripcion", $data['step_description']);
        $success = $stm->execute();
        if ($success) {
          echo "Paso guardado";
        } else {
          echo "Paso no guardado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al guardar el Paso: " . $e->getMessage();
      return false;
    }
  }

  public function UpdateStep($data)
  {
    $sql = "UPDATE pasos SET numero_paso = :numero_paso , descripcion = :descripcion  WHERE id = :id";
    try {

      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":numero_paso", $data['step_number']);
        $stm->bindParam(":descripcion", $data['step_descripcion']);
        $stm->bindParam(":id", $data['paso_id']);
        $success = $stm->execute();
        if ($success) {
          echo "Paso Modificado";
        } else {
          echo "Paso no modificado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al modificar el Paso: " . $e->getMessage();
      return false;
    }
  }
  public function Delectstep($id)
  {
    $sql = "DELETE FROM pasos WHERE id = :id";

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
      echo "Error al eliminar el Paso: " . $e->getMessage();
      return false;
    }
  }

  public function Consultstep($idReceta)
  {
    $sql = "SELECT 
    id AS step_id,
    numero_paso AS step_number,
    descripcion AS step_descripcion
    FROM 
      pasos
    WHERE 
      id_receta = :id_receta
    ORDER BY 
      numero_paso ASC;
    ";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id_receta", $idReceta);
        $success = $stm->execute();
        $pasos = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($success) {
          return $pasos;
        } else {
          echo "Pasos no ubicado";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al buscar el Pasos: " . $e->getMessage();
      return false;
    }
  }
}
