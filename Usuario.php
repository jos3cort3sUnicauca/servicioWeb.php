
<?php
require 'DataBase.php';

class Usuario{
    function __construct()
    {
    }
    
   
    /*------------------------------ CREATE ------------------------------------
     * Realizamos la insercionde un nuevo registro 
     * en la tabla Usuario
     *
     */
    public static function insert( 
            $nombre, 
            $apellidos, 
            $numDocumento,
            $correo, 
            $password){
        
        
        // Sentencia INSERT
        $comando = "INSERT INTO usuario( " .
            " nombre," .
            " apellidos," .
            " numDocumento" .
            " correo," .
            " password)".    
            " VALUES(?,?,?,?)";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $nombre,
                $apellido,
                $correo, 
                $password));
    }

    
   
    
    /* ---------------------------- READ ALL -------------------------------------
     * Retorna todos los registros de la tabla 'Usuario'
     * @param $idUsuario Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM usuario";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
  
    
    
     /* ------------------------- READ FOR ID ----------------------------------
      * Obtiene los campos de un usuario en particular identificado
     * con el numero ID.
     * @param $idUsuario Identificador de para realizar la consulta en la
     * tabla 'Usuario'
     */
    
    public static function getById($idUsuario){
        // Consulta en la tabla Usuario
        $consulta = "SELECT nombre,
                            apellidos,
                            numDocumento,
                            correo,                           
                            FROM usuario
                            WHERE idUsuario = ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idUsuario));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return false;
        }
    }
    
    
     /*----------------------------- UPDATE ------------------------------------
     * Actualiza los registros de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     */
    public static function update(
        $nombre,
        $apellidos,
        $numDocumento,    
        $correo,
        $password    
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usuario" .
                    " SET nombre=?, apellidos=?, "
                    . "numDocumento=?, correo=?, "
                    . "password=?"
                    . " WHERE idUsuario=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($idUsuario, $nombre, $apellidos, 
                        $numDocumento, $correo, $password
                ));
        
        return $cmd;
    }
    
    
    
    //------------------------------USUARIO YA EXISTE --------------------------
    
    public static function existeUser($correo)
    {
        $consulta = "SELECT * FROM usuario WHERE correo= ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($correo));
            $comando->fetch(PDO::FETCH_ASSOC);
            if ($comando->rowCount()>=1){
                
                return true;} 
            else{
                
                return false;}
           

        } catch (PDOException $e) {
            return false;
        }
    }
    
       
    //--------------------------------LOGIN --------------------------------------
    
    
    public static function logIn($correo ,$password)
    {
        $consulta = "SELECT * FROM usuario WHERE correo= ? AND password = ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($correo, $password));
            $comando->fetch(PDO::FETCH_ASSOC);
            if ($comando->rowCount()==1){
            
            return true;} 
            else     
                {return false;}
           

        } catch (PDOException $e) {
            return false;
        }
    }
    
    //-----------------------------------Remember User -------------------------
    
    public static function remenPass($correo)
    {
        $consulta = "SELECT password FROM usuario WHERE correo = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($correo));
            $row=$comando->fetch(PDO::FETCH_ASSOC);
            
            if ($comando->rowCount()==1){
            
            return $row; }
            
            else {
                
            return  false ;   
            }

        } catch (PDOException $e) {
            return false;
        }
    }  
}

