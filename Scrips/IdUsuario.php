<?php
/* Obtiene el detalle de un usuario especificado por
 * su identificador "idUsuario"*/
require '../Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['idUsuario'])) {
        // Obtener parámetro idMeta
        $parametro = $_GET['idUsuario'];
        // Tratar retorno
        $retorno = Usuario::getById($parametro);
        if ($retorno) {
            $usuario["estado"] = "1";
            $usuario["usuario"] = $retorno;
            // Enviar objeto json de la meta
            print json_encode($usuario);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                ));
        }
    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            ));
   }}
