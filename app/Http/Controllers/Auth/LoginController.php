<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller as BaseController;
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

    use AuthenticatesUsers;
    
    public function login()
    {
        // Datos del formulario enviados por el usuario
        //$input = Input::all();
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        $input = $_POST['username'];
=======
        $input = $_POST['username'] && $_POST['password'] && $_POST['otc'] ;
>>>>>>> 2b5f9f78af4654cdfc4480e474e6aa991d1f8935
=======
        $input = $_POST['username'] && $_POST['password'] && $_POST['otc'];
>>>>>>> 10bf344b1480961b06ec017ddc95d095a8cf0b39
=======
        if(isset($_POST['username']) &&  
             isset($_POST['password']) &&  
             isset($_POST['otc'])

             $input = $_POST['cn'] + $_POST['password'] + $_POST['otc'];

>>>>>>> 3f9682e32fd31d43001ba0c2882f4e333e4d8cfa
        dd($input);

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
