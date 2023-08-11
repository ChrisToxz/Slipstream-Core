<?php

use App\Enums\SlipStatus;
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
            // TODO: Make it not nullable, just for testing. Hmm it should be nullable because if first creates a token
            $table->nullableMorphs('mediable');
            $table->uuid('job_uuid')->nullable();

            $table->string('status')->default(SlipStatus::QUEUED);

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
