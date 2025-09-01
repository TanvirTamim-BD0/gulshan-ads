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
        Schema::create('google_ad_account_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('ad_account_id')->nullable();
            $table->string('transfer_or_share')->nullable();
            $table->string('business_manager_id')->nullable();
            $table->string('confirmed_date')->nullable();
            $table->string('rejected_text')->nullable();
            $table->string('status')->default('Pending');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_ad_account_transfers');
    }
};
