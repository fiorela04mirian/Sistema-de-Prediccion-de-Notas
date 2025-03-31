<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));  // Enviar el usuario a la vista
    }

    // Actualizar el usuario con los datos enviados por el formulario
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required', // Se requiere la contraseña actual para hacer cambios
            'password' => 'nullable|confirmed|min:8',
        ], [
            'current_password.required' => 'Debes ingresar tu contraseña actual para actualizar los datos.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar nombre y correo
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Si el usuario desea cambiar la contraseña
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Guardar los cambios
        $user->save();

        return redirect()->route('users.edit')->with('success', 'Usuario actualizado con éxito.');
    }
}
