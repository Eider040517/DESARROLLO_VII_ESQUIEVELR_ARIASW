<?php
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

  public function saveRecipe($userId, $data)
  {
    $recipeinfo = $data['info'];
    $ingredientinfo = $data['ingredient'];
    $stepinfo = $data['step'];
    try {
      $idRecipe = $this->recipe->CreatRecipe($userId, $recipeinfo);
      if ($idRecipe) {
        foreach ($ingredientinfo as $int) {
          $this->ingredient->CreateIngredients($idRecipe, $int['ingrediente_nombre']);
        }

        foreach ($stepinfo as $value) {
          $this->step->CreateStep($idRecipe, $value);
        }
      }
    } catch (Exception $e) {
      return "Error: Error al registrar receta. " . $e->getMessage();
    }
  }

  public function UpdateRecipe($recipe_id,$recipeInfo,$ingredientInfo,$stepinfo)
  {
    try {
      if ($this->recipe->UpdateRecipe($recipeInfo)) {
        foreach ($ingredientInfo as $ingredientData) {
          if ($ingredientData['ingrediente_id'] === null) {
            $this->ingredient->CreateIngredients($recipe_id, $ingredientData['ingrediente_nombre']);
          } else {
            $this->ingredient->UpdateIngredients($ingredientData);
          }
        }

        foreach ($stepinfo as $stepData) {
          if ($stepData['paso_id'] === null) {
            $this->step->CreateStep($recipe_id, $stepData);
          } else {
            $this->step->UpdateStep($stepData);
          }
        }
      }
    } catch (Exception $e) {
      return "Error: Error al registrar receta. " . $e->getMessage();
    }
  }

  public function DelectRecipe($idRecipe)
  {
    try {
      $this->recipe->DeleteRecipe($idRecipe);
    } catch (Exception $e) {
      echo "ERROR: En la eliminacion de la receta" . $e->getMessage();
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
      }
    } catch (Exception $e) {
      echo "Error al conultar Receta" . $e->getMessage();
    }
  }
}
