<?php
/*Insertar una nueva meta en la base de datos*/
require '../Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    
    $retornoUno = Usuario::existeUser($body['correo']);
   
   if ($retornoUno){
       
       print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Usuario ya existe'));
       
       } else {
           
           $retornoDos = Usuario::insert(
                $body['nombre'],
                $body['apellidos'],
                $body['numDocumento'],
                $body['correo'],
                $body['password']);
       
     if ($retornoDos) {
        // Código de éxito
        
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación exitosa'));
      } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida'));
       } }         
}

