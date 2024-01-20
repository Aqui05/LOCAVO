<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('marque');
            $table->string('model');
            $table->string('matriculation');
            $table->string('description');
            $table->double('prix',10,2)->nullable();
            $table->string('photo_path', 2048)->nullable();
            $table->string('category')->nullable();
            $table->decimal('rating', 3, 2)->nullable()->default(0);
            $table->timestamps();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
