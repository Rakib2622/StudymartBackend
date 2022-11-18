<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('role')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile_no')->unique();
            $table->integer('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('identity_no')->nullable();
            $table->string('institute')->nullable();
            $table->integer('passing_year')->nullable();
            $table->string('degree')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('clss_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role')
                    ->references('id')->on('roles')
                    ->onDelete('set null');
            $table->foreign('address_id')
                ->references('id')->on('addresses')
                ->onDelete('set null');
            $table->foreign('clss_id')
                ->references('id')->on('clsses')
                ->onDelete('set null');
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('set null');
            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
