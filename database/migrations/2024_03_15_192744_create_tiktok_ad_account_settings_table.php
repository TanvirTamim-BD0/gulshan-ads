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
        Schema::create('tiktok_ad_account_settings', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->string('account_name')->nullable();
            $table->string('current_balance')->nullable();
            $table->string('daily_limit')->nullable();
            $table->string('payment_threshold')->nullable();
            $table->string('daily_spending_user')->nullable();
            $table->string('monthly_billing_date')->nullable();
            $table->string('card_4_digit')->nullable();
            $table->string('business_manager_id')->nullable();
            $table->string('social')->nullable();
            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiktok_ad_account_settings');
    }
};
