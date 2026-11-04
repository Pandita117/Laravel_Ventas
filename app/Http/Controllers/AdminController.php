<?php

namespace App\Http\Controllers;

use App\Notifications\SendTwoFactorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Muestra la vista de autenticación 2FA.
     * Solo es accesible si la URL firmada temporal es válida (5 min) y el usuario tiene un código 2FA activo.
     */
    public function vistaAutenticacion(Request $request)
    {
        // 1. Validar que la URL firmada temporal sea válida y no haya expirado (límite de 5 minutos)
        if (!$request->hasValidSignature()) {
            abort(403, 'Esta URL temporal de autenticación ha expirado (límite de 5 minutos) o no es válida.');
        }

        $user = auth()->user();

        // 2. Solo existe mientras el código 2FA esté presente y activo
        if (!$user || empty($user->two_factor_code) || now()->greaterThan($user->two_factor_expires_at)) {
            return redirect()->route('login')->withErrors([
                'email' => 'La sesión de autenticación temporal ha expirado o el código ya fue utilizado.'
            ]);
        }

        return view('admin.autenti');
    }

    /**
     * Procesa y valida el código escrito por el Admin
     */
    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'two_factor_code' => ['required', 'integer']
        ]);

        $user = auth()->user();

        if (!$user || empty($user->two_factor_code) || now()->greaterThan($user->two_factor_expires_at)) {
            return redirect()->route('login')->withErrors([
                'email' => 'El código ha expirado o ya fue utilizado. Por favor inicia sesión nuevamente.'
            ]);
        }

        if ($request->input('two_factor_code') == $user->two_factor_code) {
            $user->resetTwoFactorCode();

            return redirect()->route('getCategorias')->with('success', 'Verificación exitosa.');
        }

        return back()->withErrors(['two_factor_code' => 'El código ingresado es incorrecto.']);
    }

    /**
     * Reenvía un nuevo código 2FA al correo del administrador y renueva la URL temporal por 5 minutos
     */
    public function reenviarCodigo(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $code = rand(100000, 999999);
        $user->timestamps = false;
        $user->forceFill([
            'two_factor_code' => $code,
            'two_factor_expires_at' => now()->addMinutes(5),
        ])->save();

        // Generar una nueva URL temporal gigante de 5 minutos
        $nuevaUrl = URL::temporarySignedRoute(
            'admin.autenti',
            now()->addMinutes(5),
            ['token' => Str::random(64)]
        );

        try {
            $user->notifyNow(new SendTwoFactorCode($code));
            return redirect()->to($nuevaUrl)->with('status', 'Se ha enviado un nuevo código a tu correo y se ha renovado la URL temporal (5 min).');
        } catch (\Throwable $e) {
            Log::error('Error reenviando código 2FA: ' . $e->getMessage());
            return redirect()->to($nuevaUrl)->with('error', 'No se pudo enviar el correo: ' . $e->getMessage());
        }
    }
}

