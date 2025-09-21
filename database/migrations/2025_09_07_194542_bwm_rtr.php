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
        Schema::create('table_bwm_rtr', function (Blueprint $table) {
            $table->id();
            $table->string('hostname',128);
            $table->string('ip_address',64);
            $table->string('interface',10);
            $table->string('brand',50);
            $table->string('logical_system',5);
            $table->string('regional',50);
            $table->string('id_group',10);
            $table->string('id_user',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_bwm_rtr');
    }
};
