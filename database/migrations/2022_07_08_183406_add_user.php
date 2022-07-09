<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studs', function (Blueprint $table) {
            $table->integer('age');
            $table->integer('gender')->comment("1-Male,2-Female");
            $table->integer('reporting_teacher');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studs', function (Blueprint $table) {
            //
        });
    }
}
