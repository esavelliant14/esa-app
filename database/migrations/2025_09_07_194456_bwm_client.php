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
        Schema::create('table_bwm_client', function (Blueprint $table) {
            $table->id();
            $table->string('hostname',128);
            $table->string('interface',15);
            $table->integer('unit_interface');
            $table->string('status_unit',10);
            $table->string('description',128);
            $table->string('ip_address',50);
            $table->integer('vlan_id');
            $table->string('policer_status',50);
            $table->string('input_policer',10);
            $table->string('input_policer_status',50);
            $table->string('output_policer',50);
            $table->string('output_policer_status',10);
            $table->string('id_group',5);
            $table->string('id_user',5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_bwm_client');
    }
};
