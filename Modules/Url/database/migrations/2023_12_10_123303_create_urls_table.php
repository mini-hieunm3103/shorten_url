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
        Schema::create('urls', function (Blueprint $table) {
            $table->id(); //bigint
//            $table->string('title')->nullable();
            $table->string('long_url');
//            $table->integer('user_id')->nullable(); // người chưa đăng nhập vẫn có thể tạo shorten url
//            $table->text('description')->nullable();
            $table->integer('clicks')->default(0);
            $table->timestamps();
            $table->timestamp('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
