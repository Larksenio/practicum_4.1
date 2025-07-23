<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /**  GET /register  */
    public function create()
    {
        // Devuelve resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**  POST /register  */
    public function store(Request $request)
    {
        /* 1. Validación  */
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        /* 2. Alta del usuario  */
        /** @var \App\Models\User $user */
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        /* 3. Rol por defecto (“user”)  */
        // Se asegura de que exista el rol
        $role = Role::firstOrCreate(['name' => 'user']);
        $user->assignRole($role);

        /* 4. Dispara evento de registro (opcional: email-verify) */
        event(new Registered($user));

        /* 5. Login y redirección según rol */
        Auth::login($user);

        return $user->hasRole('admin')
            ? redirect()->intended('/admin')
            : redirect()->intended('/');
    }
}