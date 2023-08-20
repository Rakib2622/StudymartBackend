<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addtimetopackagetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('time')->nullable();
            $table->string('covered1')->nullable();
            $table->string('covered2')->nullable();
            $table->string('covered3')->nullable();
            $table->string('covered4')->nullable();
            $table->string('covered5')->nullable();
            $table->string('covered6')->nullable();
            $table->string('covered7')->nullable();
            $table->string('covered8')->nullable();
            $table->string('covered9')->nullable();
            $table->string('covered10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}
