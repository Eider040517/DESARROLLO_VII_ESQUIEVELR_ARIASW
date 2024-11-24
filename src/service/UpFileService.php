<?php
require_once __DIR__ . '/../message/messageManager.php';
class UpFileService
{
  public function __construct() {}

  public function addFile($file)
  {
    // Validar errores de subida
    if ($file['error'] !== UPLOAD_ERR_OK) {
      MessageManager::addMessage('error', 'create', "Error al subir la imagen: " . $file['error']);
      return false;
    }

    // Validar el tipo de archivo (solo imágenes)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
      MessageManager::addMessage('error', 'create', "El formato del archivo no es válido. Solo se permiten JPEG, PNG y GIF.");
      return false;
    }

    // Limitar el tamaño del archivo (ejemplo: 5 MB)
    $maxSize = 5 * 1024 * 1024; // 5 MB
    if ($file['size'] > $maxSize) {
      MessageManager::addMessage('error', 'create', "El archivo es demasiado grande. Máximo 5 MB.");
      return false;
    }

    // Crear un nombre único para evitar conflictos
    $uploadDir = dirname(__DIR__, 2) . '/uploads/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true); // Crear el directorio si no existe
    }

    // Generar un nombre único para el archivo
    $fileName = uniqid('img_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    $destination = $uploadDir . $fileName;

    // Intentar mover el archivo al directorio de subida
    if (move_uploaded_file($file['tmp_name'], $destination)) {
      // Si el archivo se sube correctamente, agregar mensaje de éxito
      MessageManager::addMessage('success', 'create', "La imagen se subió correctamente.");
      return $fileName;
    } else {
      MessageManager::addMessage('error', 'create', "Error al mover la imagen al servidor.");
      return null;
    }
  }
}
