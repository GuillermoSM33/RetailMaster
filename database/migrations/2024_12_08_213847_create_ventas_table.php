<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id_venta'); // Llave primaria
            $table->decimal('total', 12, 4);
            $table->decimal('monto_recibido', 12, 4);
            $table->decimal('cambio', 12, 4);
            $table->timestamp('fecha_venta')->useCurrent();
            $table->enum('metodo_pago', ['Efectivo', 'Tarjeta']);
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
