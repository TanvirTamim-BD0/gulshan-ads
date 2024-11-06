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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('post_link')->nullable();
            $table->string('post_image')->nullable();
            $table->string('campaign_type')->nullable();
            $table->json('location_id')->nullable();
            $table->string('detailed_targeting_type')->nullable();
            $table->string('detailed_targeting_name')->nullable();
            $table->json('detailed_targeting_chiled')->nullable();
            $table->string('age_start')->nullable();
            $table->string('age_end')->nullable();
            $table->string('gender')->nullable();
            $table->string('budget')->nullable();
            $table->string('days')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('messenger')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('editor_access')->nullable();
            $table->string('confirmed_date')->nullable();
            $table->string('confirmed_text')->nullable();
            $table->string('rejected_text')->nullable();
            $table->string('running_status')->default('Resume');
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
        Schema::dropIfExists('campaigns');
    }
};
