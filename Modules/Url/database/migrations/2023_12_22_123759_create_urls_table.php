<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id(); //bigint
            $table->string('title')->nullable();
            $table->string('long_url');
            $table->string('back_half')->nullable(); //cái đằng sau domain
            $table->integer('user_id')->unsigned();
            $table->integer('clicks')->default(0);
            $table->boolean('archived')->default(1); // 1: active ; 0: hidden => khi gửi bên client thì sẽ hiện là active: on (1) và off (0)
            $table->timestamps();
            $table->timestamp('expired_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
