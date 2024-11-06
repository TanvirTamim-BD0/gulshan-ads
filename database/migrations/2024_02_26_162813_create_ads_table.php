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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('site_logo')->nullable();
            $table->string('site_name')->nullable();
            $table->text('headline_text')->nullable();
            $table->string('ads_1')->nullable();
            $table->string('ads_2')->nullable();
            $table->string('ads_3')->nullable();
            $table->string('ads_4')->nullable();
            $table->string('ads_5')->nullable();
            $table->string('ads_6')->nullable();
            $table->string('ads_text_1')->nullable();
            $table->string('ads_text_2')->nullable();
            $table->string('ads_text_3')->nullable();
            $table->string('ads_text_4')->nullable();
            $table->string('ads_text_5')->nullable();
            $table->string('ads_text_6')->nullable();
            $table->string('ads_link_1')->nullable();
            $table->string('ads_link_2')->nullable();
            $table->string('ads_link_3')->nullable();
            $table->string('ads_link_4')->nullable();
            $table->string('ads_link_5')->nullable();
            $table->string('ads_link_6')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
