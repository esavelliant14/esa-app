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
        Schema::create('radacct', function (Blueprint $table) {
            $table->id('radacctid',21);
            $table->string('acctsessionid', 64)->index();
            $table->string('acctuniqueid', 32)->index();
            $table->string('username', 64)->index();
            $table->string('realm',64)->nullable();
            $table->string('nasipaddress', 15)->index();
            $table->string('nasportid',64)->nullable();
            $table->string('nasporttype',32)->nullable();
            $table->datetime('acctstarttime')->index()->nullable();
            $table->datetime('acctupdatetime')->nullable();
            $table->datetime('acctstoptime')->index()->nullable();
            $table->integer('acctinterval')->index()->nullable();
            $table->integer('acctsessiontime')->index()->nullable();
            $table->string('acctauthentic',32)->nullable();
            $table->string('connectinfo_start',128)->nullable();
            $table->string('connectinfo_stop',128)->nullable();
            $table->bigInteger('acctinputoctets')->nullable();
            $table->bigInteger('acctoutputoctets')->nullable();
            $table->string('calledstationid',50);
            $table->string('callingstationid',50);
            $table->string('acctterminatecause',32);
            $table->string('servicetype',32)->nullable();
            $table->string('framedprotocol',32)->nullable();
            $table->string('framedipaddress',15)->index();
            $table->string('framedipv6address',45)->index();
            $table->string('framedipv6prefix',45)->index();
            $table->string('framedinterfaceid',44)->index();
            $table->string('delegatedipv6prefix',45)->index();
            $table->string('class',64)->index()->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radacct');
    }
};
