<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceServiceTable extends Migration
{
    public function up()
    {
        Schema::create('place_service', function (Blueprint $table) {
            $table->id(); // Id univoco
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade'); // Relazione con id place
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Relazione con id servizio
            $table->timestamps();
            $table->unique(['place_id','service_id']); // evitare duplicati
        });
    }

    public function down()
    {
        Schema::dropIfExists('place_service');
    }
}
?>