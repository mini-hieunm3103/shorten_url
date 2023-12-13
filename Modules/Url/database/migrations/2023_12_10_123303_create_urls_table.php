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
            $table->integer('user_id');
            $table->integer('clicks')->default(0);
            $table->timestamps();
            $table->timestamp('expired_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
