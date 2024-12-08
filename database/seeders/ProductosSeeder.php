<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            ['id_producto' => 1, 'descripcion' => 'Camiseta de algodón (M)', 'precio_costo' => 5.00, 'precio_venta' => 12.00, 'stock' => 50],
            ['id_producto' => 3, 'descripcion' => 'Chaqueta de cuero (M)', 'precio_costo' => 40.00, 'precio_venta' => 75.00, 'stock' => 20],
            ['id_producto' => 4, 'descripcion' => 'Zapatillas deportivas Nike Air Max (42)', 'precio_costo' => 45.00, 'precio_venta' => 80.00, 'stock' => 15],
            ['id_producto' => 5, 'descripcion' => 'Sudadera con capucha Adidas (L)', 'precio_costo' => 30.00, 'precio_venta' => 55.00, 'stock' => 40],
            ['id_producto' => 6, 'descripcion' => 'Pantalón de vestir Dockers (34)', 'precio_costo' => 20.00, 'precio_venta' => 35.00, 'stock' => 25],
            ['id_producto' => 7, 'descripcion' => 'Camisa de manga larga Ralph Lauren (M)', 'precio_costo' => 25.00, 'precio_venta' => 50.00, 'stock' => 35],
            ['id_producto' => 8, 'descripcion' => 'Vestido de verano Zara (S)', 'precio_costo' => 15.00, 'precio_venta' => 30.00, 'stock' => 10],
            ['id_producto' => 9, 'descripcion' => 'Reloj Tommy Hilfiger', 'precio_costo' => 50.00, 'precio_venta' => 90.00, 'stock' => 12],
            ['id_producto' => 10, 'descripcion' => 'Sombrero de paja (Tamaño único)', 'precio_costo' => 10.00, 'precio_venta' => 25.00, 'stock' => 50],
        ]);
    }
}
