<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

Class LatchController extends BaseController {

    public function latch()
    {
        return view ('auth.latch');
    }
    
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
    
    public function unpair()
    {
        // Obtenemos el identificador del usuario de Latch de nuestra base de datos
        $accountId = Auth::user()->latch_account_id;
        // Despareamos al usuario de Latch
        if (Latch::unpair($accountId))
        {
            // Eliminamos el identificador del usuario de Latch de nuestra base de datos
        }
        // Si hay algun error, se lo mostramos al usuario
        else
        {
            echo Latch::error();
        }
    }
}

