<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Notifications\SendTwoFactorCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
        if ($user->isAdmin()) {
            $code = rand(100000, 999999);
            $user->timestamps = false;
            $user->forceFill([
                'two_factor_code' => $code,
                'two_factor_expires_at' => now()->addMinutes(5),
            ])->save();

            // Generar la URL temporal firmada gigante que expira en 5 minutos
            $urlTemporal = URL::temporarySignedRoute(
                'admin.autenti',
                now()->addMinutes(5),
                ['token' => Str::random(64)]
            );

            try {
                $user->notifyNow(new SendTwoFactorCode($code));
            } catch (\Throwable $e) {
                Log::error('Error enviando código 2FA: ' . $e->getMessage());
                return redirect()->to($urlTemporal)->with('error', 'No se pudo enviar el correo: ' . $e->getMessage());
            }

            return redirect()->to($urlTemporal);
        }

        // 2. Si es Empleado, continúa su flujo normal a /categoria
        return redirect()->intended($this->redirectPath());
    }
}




