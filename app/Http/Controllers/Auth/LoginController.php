<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller {
    
    public function login()
    {
        // Datos del formulario enviados por el usuario
        $input = Input::all();
        // Reglas de validacion
        $rules = array(
            'email'       => 'required|email',
            'password' => 'required'
        );
        // validamos los datos del formulario de login
        $validator = Validator::make($input, $rules);
        if ($validator->passes())
        {
            // Credenciales para el inicio de sesion del usuario
            $credentials = array('email' => $input['email'], 'password' => $input['password']);
            // Establece si tenemos acceso para acceder a nuestra cuenta de usuario
            $locked = true;
            // Comprobamos si el usuario es valido pero sin loguearlo
            if (Auth::validate($credentials))
            {
                // Obtenemos el identificador del usuario de Latch de nuestra base de datos (con sql)
                $user          = User::where('email', '=', $input['email'])->first();
                $accountId = $user->latch_account_id;
                // Comprueba si Latch nos da acceso
                if (Latch::unlocked($accountId))
                {
                    $locked = false;
                }
            }
            // Si la cuenta del usuario no esta bloqueada
            if ( ! $locked)
            {
                // Autentica al usuario
                if (Auth::attempt($credentials))
                {
                    //
                }
            }
        }
    }
}
