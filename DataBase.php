<?php
/* Clase que envuelve una instancia de la clase PDO
  para el manejo de la base de datos*/

define("HOSTNAME", "localhost");// Nombre del host
define("DATABASE", "databasetest104"); // Nombre de la base de datos
define("PORT", "80"); // Numero del puerto
define("USERNAME", "root"); // Nombre del usuario
define("PASSWORD", ""); //constraseña


class DataBase
{
// Única instancia de la clase
     
    private static $db = null;
    
// Instancia de PDO
   
    private static $pdo;

    final private function __construct()
    {
        try {
            // Crear nueva conexión PDO
            self::getDb();
        } catch (PDOException $e) {
            // Manejo de excepciones
        }
    }
    
     // Retorna en la única instancia de la clase 
    public static function getInstance()
    {
        if (self::$db === null) {
            self::$db = new self();
        }
        return self::$db;
    }
     /* Crear una nueva conexión basada en PDO, en este punto
        se pasan los datos para realizar la conexión*/
    public function getDb()
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO(
                'mysql:dbname=' . DATABASE .
                ';host=' . HOSTNAME .
                ';port:'. PORT .';',
                USERNAME,
                PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            // Habilitar excepciones
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
     // Evita la clonación del objeto 
    final protected function __clone(){}
    
    function _destructor(){
        self::$pdo = null;}
}
