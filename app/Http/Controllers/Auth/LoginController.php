<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Donde redirigir a los usuarios después de iniciar sesión.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Obtener las credenciales para autenticar al usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // Aquí usamos 'name' en lugar de 'email'
        return [
            'name' => $request->name,
            'password' => $request->password,
        ];
    }

    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string', // Valida que el nombre esté presente
            'password' => 'required|string', // Valida que la contraseña esté presente
        ]);

        // Intentar autenticar al usuario
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            // Si la autenticación es exitosa, redirigir a la página de destino
            return redirect()->intended($this->redirectTo);
        }

        // Si las credenciales son incorrectas, volver a mostrar el formulario con un error
        return back()->withErrors([
            'name' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }
}
