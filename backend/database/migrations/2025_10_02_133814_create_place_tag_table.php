<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceTagTable extends Migration
{
    public function up()
    {
        Schema::create('place_tag', function (Blueprint $table) {
            $table->id(); // id univoco
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade'); // relazione con id Place
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade'); // relazione con id Tag
            $table->timestamps();
            $table->unique(['place_id','tag_id']); // evitare duplicati
        });
    }

    public function down()
    {
        Schema::dropIfExists('place_tag');
    }
}
