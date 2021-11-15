<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha', $precision = 0);
            $table->float('subtotal', 8, 2);
            $table->float('total', 8, 2);
            $table->integer('id_mesa');
            $table->string('codigo');
            $table->integer('id_usuario');
            $table->char('tipodeorden', 1);
            $table->boolean('pagado');
            $table->float('propina', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
