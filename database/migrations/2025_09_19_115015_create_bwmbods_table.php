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
        Schema::create('table_bwm_bod', function (Blueprint $table) {
            $table->id();
            $table->string('hostname',128);
            $table->string('description',128);
            $table->string('interface','10');
            $table->integer('unit_interface');
            $table->string('old_input_policer','15');
            $table->string('old_output_policer','15');
            $table->string('bod_input_policer','15');
            $table->string('bod_output_policer','15');
            $table->datetime('bod_until');
            $table->string('status');
            $table->string('id_group','5');
            $table->string('id_user','5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_bwm_bod');
    }
};
