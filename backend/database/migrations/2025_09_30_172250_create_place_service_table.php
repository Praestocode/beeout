<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceServiceTable extends Migration
{
    public function up()
    {
        Schema::create('place_service', function (Blueprint $table) {
            $table->id(); // Id
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade'); // id Place related
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // id Service related
            $table->timestamps();
            $table->unique(['place_id','service_id']); // avoid duplicates
        });
    }

    public function down()
    {
        Schema::dropIfExists('place_service');
    }
}
?>