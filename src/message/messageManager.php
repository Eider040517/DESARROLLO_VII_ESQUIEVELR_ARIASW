<?php

class MessageManager
{
  // Tipos de mensaje
  const TYPE_ERROR = 'error';
  const TYPE_SUCCESS = 'success';
  const TYPE_WARNING = 'warning';
  const TYPE_INFO = 'info';
  // Agregar error o mensaje de éxito
  public static function addMessage($type, $key, $message)
  {
    if (!isset($_SESSION['messages'])) {
      $_SESSION['messages'] = [];
    }
    if (!isset($_SESSION['messages'][$type])) {
      $_SESSION['messages'][$type] = [];
    }
    $_SESSION['messages'][$type][$key][] = $message;
  }

  // Obtener mensajes (errores o éxito) según el tipo
  public static function getMessages($type, $key)
  {
    if (isset($_SESSION['messages'][$type][$key])) {
      $messages = $_SESSION['messages'][$type][$key];
      unset($_SESSION['messages'][$type][$key]); // Elimina los mensajes una vez recuperados
      return $messages;
    }
    return [];
  }

  // Verificar si existen mensajes de un tipo específico
  public static function hasMessages($type, $key)
  {
    return isset($_SESSION['messages'][$type][$key]) && !empty($_SESSION['messages'][$type][$key]);
  }

  // Limpiar mensajes (de éxito o error)
  public static function clearMessages($type = null)
  {
    if ($type) {
      unset($_SESSION['messages'][$type]);
    } else {
      unset($_SESSION['messages']);
    }
  }
}
