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
            $table->string('domain',128);
            $table->datetime('created_date');
            $table->datetime('expired_date');
            $table->string('status',20);
            $table->string('suspended',10);
            $table->string('locked',15);
            $table->string('ns1',128)->nullable();
            $table->string('ns2',128)->nullable();
            $table->string('ns3',128)->nullable();
            $table->string('ns4',128)->nullable();
            $table->string('ns5',128)->nullable();
            $table->string('ns6',128)->nullable();
            $table->string('ns7',128)->nullable();
            $table->string('ns8',128)->nullable();
            $table->string('ns9',128)->nullable();
            $table->string('ns10',128)->nullable();
            $table->string('ns11',128)->nullable();
            $table->string('ns12',128)->nullable();
            $table->string('ns13',128)->nullable();
            $table->string('id_group','15');
            $table->string('id_user','15');
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
