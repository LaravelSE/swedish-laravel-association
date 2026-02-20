<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('datetime');
            $table->string('location');
            $table->text('description');
            $table->json('details')->nullable();
            $table->json('schedule')->nullable();
            $table->json('footer')->nullable();
            $table->json('organizers')->nullable();
            $table->text('closing')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
