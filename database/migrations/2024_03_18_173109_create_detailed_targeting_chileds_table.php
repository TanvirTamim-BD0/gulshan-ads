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
        Schema::create('detailed_targeting_chileds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detailed_targeting_id')->nullable();
            $table->string('name')->nullable();
            $table->foreign('detailed_targeting_id')->references('id')->on('detailed_targetings')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailed_targeting_chileds');
    }
};
