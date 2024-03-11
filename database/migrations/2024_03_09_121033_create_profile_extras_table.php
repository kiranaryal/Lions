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
        Schema::create('profile_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->index();
            $table->text('category')->nullable();
            $table->text('org_name')->nullable();
            $table->text('position')->nullable();
            $table->text('date')->nullable();
            $table->text('photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_extras');
    }
};
