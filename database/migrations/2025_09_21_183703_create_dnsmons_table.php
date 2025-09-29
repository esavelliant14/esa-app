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
        Schema::create('table_dns_mon', function (Blueprint $table) {
            $table->id();
            $table->string('id_domain',128)->nullable();
            $table->string('name_domain',150)->nullable();
            $table->string('vendor',128);
            $table->integer('id_group');
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_dns_mon');
    }
};
