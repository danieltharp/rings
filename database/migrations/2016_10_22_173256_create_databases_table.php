<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rings')->create('databases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('realmid');
            $table->ipAddress('address');
            $table->unsignedSmallInteger('port');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('databases');
    }
}
