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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();


            $table->text('full_name')->nullable();
            $table->text('position')->nullable();
            $table->text('home_club')->nullable();
            $table->text('public_email')->nullable();
            $table->text('public_phone')->nullable();

            $table->string('nationality')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->text('about')->nullable();
            $table->text('photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
