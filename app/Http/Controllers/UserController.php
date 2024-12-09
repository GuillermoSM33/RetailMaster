<?php

namespace App\Http\Controllers;

use App\Models\User; // Importar el modelo User
use Illuminate\Http\Request;
use App\Models\Role; // Importar el modelo Role

class UserController extends Controller
{
    public function __construct()
    {
        // Definir los permisos necesarios para cada acción
        $this->middleware('permission:ver usuarios')->only('index');
        $this->middleware('permission:crear usuarios')->only(['create', 'store']);
        $this->middleware('permission:editar usuarios')->only(['edit', 'update']);
        $this->middleware('permission:eliminar usuarios')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los usuarios con sus roles, paginados
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener roles disponibles
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array|exists:roles,name'
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Asignar roles al usuario
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Obtener todos los roles disponibles
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array|exists:roles,name',
        ]);

        // Actualizar los datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Actualizar los roles del usuario
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Eliminar el usuario
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito');
    }
}
