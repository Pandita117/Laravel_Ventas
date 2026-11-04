<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    $request->validare([
        'two_factor_code' => ['requiered', 'integer']
    ]);

    $user = auth() -> user();

    if ($request->input('two_factor_code') == $user->two_factor_code) {
        
        if (now()->lessThanOrEqualTo($user->two_factor_expires_at)) {
                $user->resetTwoFactorCode();

                return redirect()->route('admin.autenti')->with('success', 'Verificación exitosa.');
            }

            return back()->withErrors(['two_factor_code' => 'El código ha expirado. Por favor inicia sesión nuevamente.']);
        }
        return back()->withErrors(['two_factor_code' => 'El código ingresado es incorrecto.']);

    }

    }

