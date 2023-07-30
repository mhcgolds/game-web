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
        Schema::create('game_stage_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_stage_id');
            $table->unsignedBigInteger('game_stage_target_id')->nullable();
            $table->string('description');
            $table->smallInteger('order');
            $table->timestamps();
            
            $table->foreign('game_stage_id')->references('id')->on('game_stages')->onDelete('cascade');
            $table->foreign('game_stage_target_id')->references('id')->on('game_stages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_stage_actions');
    }
};
