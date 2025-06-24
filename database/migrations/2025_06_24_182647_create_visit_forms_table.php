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
        Schema::create('visit_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('destination_id');
            $table->date('visit_date');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->enum('visit_type', ['sendirian', 'rombongan']);
            $table->integer('group_size')->nullable(); // Only filled when visit_type is 'rombongan'
            $table->text('suggestions')->nullable();
            $table->text('review')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');

            // One user can only have one form per destination
            $table->unique(['user_id', 'destination_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_forms');
    }
};
