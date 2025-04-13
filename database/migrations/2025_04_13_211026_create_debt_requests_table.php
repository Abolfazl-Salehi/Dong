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
        Schema::create('debt_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id'); 
            $table->unsignedBigInteger('to_user_id');   
            $table->decimal('amount', 12);
            $table->string('description')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('from_user_id')->references('user_1')->on('friends');
            $table->foreign('to_user_id')->references('user_2')->on('friends');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debt_requests');
    }
};
