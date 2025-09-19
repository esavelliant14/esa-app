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
        Schema::create('table_bwm_bw', function (Blueprint $table) {
            $table->id();
            $table->string('hostname',128);
            $table->string('policer_name',64);
            $table->string('bandwidth',64);
            $table->string('burst_limit',64);
            $table->string('policer_status',64);
            $table->string('id_group',64);
            $table->string('id_user',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_bwm_bw');
    }
};
