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
        Schema::create('ad_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ad_account_number')->nullable();
            $table->string('ad_name')->nullable();
            $table->string('balance')->default(0);
            $table->string('daily_limit')->default(0);
            $table->string('payment_threshold')->default(0);
            $table->string('daily_spending_user')->default(0);
            $table->string('monthly_billing_date')->nullable();
            $table->string('card_4_digit')->nullable();
            $table->string('facebook_page_url_1')->nullable();
            $table->string('facebook_page_url_2')->nullable();
            $table->string('facebook_page_url_3')->nullable();
            $table->string('facebook_page_url_4')->nullable();
            $table->string('facebook_page_url_5')->nullable();
            $table->string('website_url')->nullable();
            $table->string('business_manager_id')->nullable();
            $table->string('confirmed_date')->nullable();
            $table->string('rejected_text')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('ad_accounts');
    }
};
