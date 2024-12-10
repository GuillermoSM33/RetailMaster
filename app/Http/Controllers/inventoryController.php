<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class inventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Retornar la vista con los productos
        return view('admin.inventory', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verificar los datos recibidos
        \Log::info($request->all());

         // Validar los datos del formulario
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'precio_costo' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        // Crear el nuevo producto
        Producto::create([
            'descripcion' => $validatedData['descripcion'],
            'precio_costo' => $validatedData['precio_costo'],
            'precio_venta' => $validatedData['precio_venta'],
            'stock' => $validatedData['stock'],
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_producto)
    {
        // Encontrar el producto por id
        $producto = Producto::findOrFail($id_producto);

        // Eliminar el producto
        $producto->delete();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
