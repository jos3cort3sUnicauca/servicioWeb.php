<?php

require '../Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $retorno = Usuario::logIn(
            $body['correo'],
            $body['contra']);
  
    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => $retorno,
                'mensaje' => 'Login Exitoso')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => $retorno,
                'mensaje' => 'Cantrasena o Usuario invalido ')
        );
    }
}

