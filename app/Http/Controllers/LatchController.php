<?php


Class LatchController extends BaseController {
    
    public function pair()
    {
        // Comprobamos que venga el token desde el formulario
        if (Input::has('token'))
        {
            // Obtenemos el código de pareado del usuario
            $token = Input::token('token');
            // Intenta parear Latch con el código (token)
            if ($accountId = Latch::pair($token))
            {
                // Si consigue parear guardamos el identificador del usuario (cifrado) de Latch en nuestra base de datos
            }
            // Si ocurre algún error, mostramos al usuario un mensaje de error de una forma amigable
            else
            {
                echo Latch::error();
            }
        }
    }
}
