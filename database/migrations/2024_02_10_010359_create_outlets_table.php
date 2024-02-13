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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('merchant_id')->unsigned();
            $table->bigInteger('province_id')->length(11)->nullable();
            $table->bigInteger('city_id')->length(11)->nullable();
            $table->string('address')->nullable();
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
