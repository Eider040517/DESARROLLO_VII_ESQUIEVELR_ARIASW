<?php require_once __DIR__ . '/../../src/controller/commentController.php'
?>
<link rel="stylesheet" href="/public/assets/css/comment.css">
<section class="area-comments">
  <h2>Comentarios</h2>
  <!-- Formulario para enviar comentarios -->
  <div class="content-comment">
    <div class="content-logo-user">
      <span> <?= htmlspecialchars(substr($_SESSION['username'], 0, 1)) ?></span>
    </div>
    <div class="comment-textarea">
      <form id="commentForm" method="POST" action="/src/controller/commentController.php">
        <input type="hidden" name="recipe_id" value="<?php echo htmlspecialchars($recipeInfo['recipe_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        <textarea name="comment" id="commentText" placeholder="Escribe un comentario..." required></textarea>
        <button type="submit" name="action" value="create"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="text-cookpad-24 mise-icon mise-icon-send">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7 12-4 8 18-8L3 4l4 8Zm0 0h5"></path>
          </svg></button>
      </form>
    </div>

  </div>


  <!-- Lista de comentarios -->
  <div id="commentsList">
    <?php
    $comments = getRecipeComments($recipeInfo['recipe_id']);
    foreach ($comments as $comment):
    ?>
      <li class="comment">
        <div class="content-logo-user">
          <span> <?= htmlspecialchars(substr($comment['username'], 0, 1)) ?></span>
        </div>
        <div class="comment-data">
          <strong><?= htmlspecialchars($comment['username']) ?></strong>
          <span><?= htmlspecialchars($comment['created_at']) ?></span>
          <p><?= htmlspecialchars($comment['comment']) ?></p>
        </div>

      </li>
    <?php endforeach; ?>
  </div>
</section>