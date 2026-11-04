<?php

namespace App\Http\Controllers;

use App\Notifications\SendTwoFactorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function vistaAutenticacion()
    {
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

        if ($request->input('two_factor_code') == $user->two_factor_code) {
            if (now()->lessThanOrEqualTo($user->two_factor_expires_at)) {
                $user->resetTwoFactorCode();

                return redirect()->route('getCategorias')->with('success', 'Verificación exitosa.');
            }

            return back()->withErrors(['two_factor_code' => 'El código ha expirado. Por favor solicita uno nuevo.']);
        }

        return back()->withErrors(['two_factor_code' => 'El código ingresado es incorrecto.']);
    }

    /**
     * Reenvía un nuevo código 2FA al correo del administrador
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
            'two_factor_expires_at' => now()->addMinutes(10),
        ])->save();

        try {
            $user->notifyNow(new SendTwoFactorCode($code));
            return back()->with('status', 'Se ha enviado un nuevo código de verificación a tu correo.');
        } catch (\Throwable $e) {
            Log::error('Error reenviando código 2FA: ' . $e->getMessage());
            return back()->with('error', 'No se pudo enviar el correo: ' . $e->getMessage());
        }
    }
}

