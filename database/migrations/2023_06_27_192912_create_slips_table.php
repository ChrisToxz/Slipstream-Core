<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slips', function (Blueprint $table) {
            $table->id();
            $table->string('token');

            $table->string('title');
            $table->string('description')->nullable();
            $table->string('thumb')->nullable(); // TODO: Nasty trick to get the thumb by a custom cast in frontend.
            // TODO: Make it not nullable, just for testing
            $table->nullableMorphs('mediable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slips');
    }
};
