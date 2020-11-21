<?php
require '../Usuario.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $retorno = Usuario::remenPass(
        $body['correo']);
    
    if ($retorno) {
        // Código de éxito
        $usuario["estado"] = "1";
        $usuario["usuario"] = $retorno;
        
        $to = $body['correo'];
        $subject = "AGROTIC, Recuerda tu Password";             
        $message = "La Recuperacion del password se realizo satisfactoriamente \n\n".
                    json_encode($retorno). 
                    "\n\nIMPORTANTE: Le recordamos que con este Password ya puedas ingresar a la App AGROTIC.\n\n".
                    "Para mayor informacion puedes comunicarte al correo : cjose07@misena.edu.co"; 
 
        mail($to, $subject, $message);
   
        print json_encode(array($usuario));
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'EL correo ingresado no se encuentra registrado')
    );}}


