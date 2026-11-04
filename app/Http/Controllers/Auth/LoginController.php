<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Notifications\SendTwoFactorCode;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Dónde redirigir a los empleados (usuarios normales) tras loguearse.
     *
     * @var string
     */
    protected $redirectTo = '/categoria';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Se ejecuta inmediatamente después de que el usuario ingresa sus credenciales correctamente.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            $code = rand(100000, 999999);
            $user->forceFill([
                'two_factor_code' => $code,
                'two_factor_expires_at' => now()->addMinutes(10),
            ])->save();

            $user->notifyNow(new SendTwoFactorCode($code));
            return redirect()->route('admin.autenti');
        }

        // 2. Si es Empleado, continúa su flujo normal a /categoria
        return redirect()->intended($this->redirectPath());
    }
}