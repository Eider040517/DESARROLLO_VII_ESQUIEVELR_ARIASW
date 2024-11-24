<?php
session_start();
require_once __DIR__ . '/../model/Recipe.php';
require_once __DIR__ . '/..//model/Ingredients.php';
require_once __DIR__ . '/../model/Steps.php';
class RecipeService
{
  private $recipe;
  private $ingredient;
  private $step;

  public function __construct()
  {
    $this->recipe = new Recipe();
    $this->ingredient = new Ingredients();
    $this->step =  new Steps();
  }

  public function saveRecipe($userId, $recipeInfo, $ingredientinfo, $stepinfo, $fileName)
  {
    try {
      $idRecipe = $this->recipe->CreatRecipe($userId, $recipeInfo, $fileName);
      if ($idRecipe) {
        foreach ($ingredientinfo as $int) {
          $this->ingredient->CreateIngredients($idRecipe, $int['ingredient_name']);
        }

        foreach ($stepinfo as $value) {
          $this->step->CreateStep($idRecipe, $value);
        }

        // Mensaje de éxito al registrar la receta
        MessageManager::addMessage(MessageManager::TYPE_SUCCESS, 'recipe', 'Receta registrada exitosamente.');
      } else {
        // Mensaje de error si no se crea la receta
        MessageManager::addMessage(MessageManager::TYPE_ERROR, 'recipe', 'Error al crear la receta.');
      }
    } catch (Exception $e) {
      // Mensaje de error si ocurre una excepción
      MessageManager::addMessage(MessageManager::TYPE_ERROR, ' recipe', 'Error: ' . $e->getMessage());
    }
  }



  public function UpdateRecipe($recipeInfo, $ingredientInfo, $stepinfo, $filename)
  {
    try {
      if ($this->recipe->UpdateRecipe($recipeInfo, $filename)) {
        foreach ($ingredientInfo as $ingredientData) {
          if (!isset($ingredientData['ingredient_id'])) {
            $this->ingredient->CreateIngredients($recipeInfo['recipe_id'], $ingredientData['ingredient_name']);
          } else {
            $this->ingredient->UpdateIngredients($ingredientData);
          }
        }

        foreach ($stepinfo as $stepData) {
          if (!isset($stepData['step_id'])) {
            $this->step->CreateStep($recipeInfo['recipe_id'], $stepData);
          } else {
            $this->step->UpdateStep($stepData);
          }
        }
        // Mensaje de éxito al actualizar la receta
        MessageManager::addMessage(MessageManager::TYPE_SUCCESS, 'recipe', 'Receta actualizada exitosamente.');
      } else {
        // Mensaje de error si no se actualiza la receta
        MessageManager::addMessage(MessageManager::TYPE_ERROR, 'recipe', 'Error al actualizar la receta.');
      }
    } catch (Exception $e) {
      // Mensaje de error si ocurre una excepción
      MessageManager::addMessage(MessageManager::TYPE_ERROR, 'recipe', 'Error: ' . $e->getMessage());
    }
  }


  public function DeleteRecipe($idRecipe)
  {
    try {
      $this->recipe->DeleteRecipe($idRecipe);
      // Mensaje de éxito al eliminar la receta
      MessageManager::addMessage(MessageManager::TYPE_SUCCESS, 'create', 'Receta eliminada exitosamente.');
    } catch (Exception $e) {
      // Mensaje de error si ocurre una excepción
      MessageManager::addMessage(MessageManager::TYPE_ERROR, 'create', 'Error al eliminar la receta: ' . $e->getMessage());
    }
  }

  public function ConsultRecipe($idRecipe)
  {
    try {
      $recipeInfo = $this->recipe->ConsultRecipe($idRecipe);
      if ($recipeInfo) {
        $ingredientInfo = $this->ingredient->ConsultIngredients($idRecipe);
        $stepInfo = $this->step->Consultstep($idRecipe);
        return [
          'info' => $recipeInfo,
          'ingredient' => $ingredientInfo,
          'step' => $stepInfo
        ];
      } else {
        // Mensaje de error si no se encuentra la receta
        MessageManager::addMessage(MessageManager::TYPE_ERROR, 'recipe', 'Receta no encontrada.');
      }
    } catch (Exception $e) {
      // Mensaje de error si ocurre una excepción
      MessageManager::addMessage(MessageManager::TYPE_ERROR, 'recipe', 'Error al consultar receta: ' . $e->getMessage());
    }
  }
}
