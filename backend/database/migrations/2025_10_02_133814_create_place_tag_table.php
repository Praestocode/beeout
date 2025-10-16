<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceTagTable extends Migration
{
    public function up()
    {
        Schema::create('place_tag', function (Blueprint $table) {
            $table->id(); // id
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade'); // id Place related
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade'); // id Tag related
            $table->timestamps();
            $table->unique(['place_id','tag_id']); // avoid duplicates
        });
    }

    public function down()
    {
        Schema::dropIfExists('place_tag');
    }
}
