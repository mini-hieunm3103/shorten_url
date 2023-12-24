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
        Schema::create('url_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('url_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            // Thêm Khóa ngoại
            $table->foreign('url_id')->references('id')->on('urls')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_tag');
    }
};
