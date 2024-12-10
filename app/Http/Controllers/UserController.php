<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver')->only('index');
        $this->middleware('permission:crear')->only(['create', 'store']);
        $this->middleware('permission:editar')->only(['edit', 'update']);
        $this->middleware('permission:eliminar')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();

        return view('admin.users', compact('users', 'roles'));
    }

    /**
     * Return user data as JSON.
     */
    public function getUser(User $user)
    {
        return response()->json([
            'user' => $user,
            'roles' => $user->roles->pluck('name'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateUser($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.modals.editUser', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = $this->validateUser($request, $user->id);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->syncRoles([]); // Eliminar roles antes de borrar
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }

    /**
     * Validate user input.
     */
    private function validateUser(Request $request, $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'roles' => 'required|array|exists:roles,name',
        ];

        if ($request->isMethod('post')) { // Validación adicional para creación
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return Validator::make($request->all(), $rules);
    }

    public function generatePDF()
    {
        // Obtén todos los usuarios
        $users = User::all();

        // Genera el contenido HTML del PDF
        $html = view('users.report', compact('users'))->render();

        // Configura DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Define el tamaño y la orientación del papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza el PDF
        $dompdf->render();

        // Envía el PDF al navegador para descarga
        return $dompdf->stream('usuarios.pdf', ['Attachment' => false]);
    }
}
