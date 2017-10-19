<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
=======
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Latch;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    
    // Create a new controller instance.
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
<<<<<<< HEAD
=======

/*class LoginController extends BaseController {

    use AuthenticatesUsers;
    
    public function login()
    {
        // Datos del formulario enviados por el usuario
        //$input = Input::all();
        if(isset($_POST['username']) &&  
             isset($_POST['password']) &&  
             isset($_POST['otc'])) {

             $username = $_POST['username'];
             $password=  $_POST['password'];
             $otc = $_POST['otc'];

             $input = array($username, $password, $otc);
             //dd($input);
         }

        // Reglas de validacion
        //$rules = array(
        //    'username'       => 'required|username',
        //    'password' => 'required'
        //);
        // validamos los datos del formulario de login
        //$validator = Validator::make($input, $rules);
        //dd($validator);
        //if ($validator->passes())
        if ($input)
        {
            //dd($validator->passes());
            // Credenciales para el inicio de sesion del usuario
            $credentials = array('username' => $input[0], 'password' => $input[1]);
            //dd($credentials);

            // Establece si tenemos acceso para acceder a nuestra cuenta de usuario
            $locked = true;

            // Comprobamos si el usuario es valido pero sin loguearlo
            if (\Auth::validate($credentials))
            {
                // Obtenemos el identificador del usuario de Latch de nuestra base de datos (con sql)
                $user = User::where('username', '=', $input[0])->first();
                //dd($user);
                $accountId = $user->latch_account_id;

                // Comprueba si Latch nos da acceso
                if (\Latch::unlocked($accountId))
                {
                    $locked = false;
                }
            }
            // Si la cuenta del usuario no esta bloqueada
            if ( ! $locked)
            {
                // Autentica al usuario
                if (\Auth::attempt($credentials))
                {
                    //
                }
            }
        }
    }
}
*/
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
