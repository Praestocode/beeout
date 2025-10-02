<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id(); // id autoincrementale
            $table->string('name'); // nome del locale
            $table->text('description')->nullable(); // descrizione del locale (facoltativa)
            $table->decimal('latitude', 10, 7); // latitudine
            $table->decimal('longitude', 10, 7); // longitudine
            $table->string('address'); // via + numero civico
            $table->string('city'); //città
            $table->string('region'); //regione
            $table->boolean('pending')->default(true); // in attesa di approvazione admin
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
?>