<?php
 /* Actualiza una meta especificada por su identificador*/
require '../Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Actualizar usuario
    $retorno = Usuario::update(
        $body['idUser'],
        $body['nombre'],
        $body['apellidos'],
        $body['numDocumento'],
        $body['correo'],
        $body['password']);
    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Actualización exitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Actualización fallida')
        );
    }
}

