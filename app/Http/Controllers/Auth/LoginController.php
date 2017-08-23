<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/*class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    
    // Create a new controller instance.
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}*/

class LoginController extends BaseController {
    
    public function login()
    {
        // Datos del formulario enviados por el usuario
        $input = Input::all();
        // Reglas de validacion
        $rules = array(
            'username'       => 'required|username',
            'password' => 'required'
        );
        // validamos los datos del formulario de login
        $validator = Validator::make($input, $rules);
        if ($validator->passes())
        {
            // Credenciales para el inicio de sesion del usuario
            $credentials = array('username' => $input['username'], 'password' => $input['password']);
            // Establece si tenemos acceso para acceder a nuestra cuenta de usuario
            $locked = true;
            // Comprobamos si el usuario es valido pero sin loguearlo
            if (Auth::validate($credentials))
            {
                // Obtenemos el identificador del usuario de Latch de nuestra base de datos (con sql)
                $user          = User::where('username', '=', $input['username'])->first();
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
