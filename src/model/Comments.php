<?php
require_once __DIR__ . '/DataBase.php';

class Comments
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }

  public function CreateComment($idRecipe, $user_id, $comment)
  {
    $sql = " INSERT INTO recipe_comments (id_receta,user_id,comment) VALUES (:id_receta,:user_id,:comment)";
    try {

      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id_receta", $idRecipe);
        $stm->bindParam(":user_id", $user_id);
        $stm->bindParam(":comment", $comment);
        $success = $stm->execute();
        if ($success) {
          echo "Comentario guardado";
        } else {
          echo "Comentario no guardado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al guardar el comentario: " . $e->getMessage();
      return false;
    }
  }



  public function DeleteComment($comment_id)
  {
    $sql = "DELETE FROM recipe_comments WHERE id = :comment_id";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id", $comment_id);
        $success = $stm->execute();
        if ($success) {
          echo "Comentario eliminado";
        } else {
          echo "Comentario no eliminado";
        }
      }
      unset($stm);
    } catch (PDOException $e) {
      echo "Error al eliminar el comentario: " . $e->getMessage();
      return false;
    }
  }

  public function ConsultComments($recipe_id)
  {
    $sql = "SELECT 
    u.username AS username ,
    c.comment AS comment,
    c.created_at
    FROM 
      recipe_comments c
    JOIN user u ON c.user_id = u.id
    WHERE 
      id_receta = :id_receta;
    ORDER BY c.created_at DESC
    ";
    try {
      if ($stm = $this->pdo->prepare($sql)) {
        $stm->bindParam(":id_receta", $recipe_id);
        $success = $stm->execute();
        $comments = $stm->fetchAll(PDO::FETCH_ASSOC);
        if ($success) {
          return $comments;
        } else {
          echo "Usuario si comentarios";
        }
      }
      unset($stm);
    } catch (Exception $e) {
      echo "Error al buscar el Comentario: " . $e->getMessage();
      return false;
    }
  }
}
