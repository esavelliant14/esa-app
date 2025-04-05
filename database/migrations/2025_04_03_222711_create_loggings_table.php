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
        Schema::create('table_loggings', function (Blueprint $table) {
            $table->id();
            $table->string('action_by');
            $table->string('category_action');
            $table->string('status');
            $table->text('ip_address');
            $table->text('agent');
            $table->text('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_loggings');
    }
};
