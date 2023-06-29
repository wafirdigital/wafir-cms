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
        Schema::create('post_topic', function (Blueprint $table) {
            $table->integer('post_id')->foreign('post_id')->references('id')->on('posts')->nullable();
            $table->integer('topic_id')->foreign('topic_id')->references('id')->on('topics')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_topic');
    }
};
