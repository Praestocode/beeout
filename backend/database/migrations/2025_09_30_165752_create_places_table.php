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
            $table->id(); // id
            $table->string('name'); // Name
            $table->text('description')->nullable(); // Description (optional)
            $table->decimal('latitude', 10, 7); // Latitude
            $table->decimal('longitude', 10, 7); // Longitude
            $table->string('address'); // Address
            $table->string('city'); // City
            $table->string('region'); // Region
            $table->boolean('pending')->default(true); // Pending admin approval
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