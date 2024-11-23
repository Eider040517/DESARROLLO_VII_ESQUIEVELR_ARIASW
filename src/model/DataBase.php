<?php
require_once __DIR__ . '/../../config.php';
class Database

{
  // Instancia única de la clase (patrón Singleton)
  private static $instance = null;
  // Conexión PDO
  private $conn;

  // Constructor privado para prevenir la creación directa de objetos
  public function __construct()
  {
    try {
      // Creamos la conexión PDO
      $this->conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME ,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );
    } catch (PDOException $e) {
      die("Error: No se pudo conectar. " . $e->getMessage());
    }
  }

  // Método para obtener la instancia única de la clase
  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  // Método para obtener la conexión PDO
  public function getConnection()
  {
    return $this->conn;
  }
  public function unstepDO(){
    unset($this->conn);
  }
}