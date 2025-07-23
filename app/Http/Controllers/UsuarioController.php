<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /* Mostrar listado ---------------------------------------------------- */
    public function index()
    {
        $usuarios = User::with('roles')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /* Formulario de creación --------------------------------------------- */
    public function create()
    {
        $roles = Role::pluck('name', 'id');   // para <select>
        return view('usuarios.create', compact('roles'));
    }

    /* Guardar usuario nuevo ---------------------------------------------- */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|min:6',
            'role_id'   => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole(Role::find($data['role_id'])->name);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    /* Formulario de edición ---------------------------------------------- */
    public function edit(User $usuario)
    {
        $roles = Role::pluck('name', 'id');
        return view('usuarios.edit', compact('usuario','roles'));
    }

    /* Actualizar usuario -------------------------------------------------- */
    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,'.$usuario->id,
            'password'  => 'nullable|confirmed|min:6',
            'role_id'   => 'required|exists:roles,id',
        ]);

        $usuario->update([
            'name'  => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
                          ? Hash::make($data['password'])
                          : $usuario->password,
        ]);

        // sincroniza rol
        $usuario->syncRoles([Role::find($data['role_id'])->name]);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario actualizado.');
    }

    /* Eliminar ------------------------------------------------------------ */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return back()->with('success','Usuario eliminado.');
    }
}
