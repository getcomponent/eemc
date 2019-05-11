<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'last_passed')) {
                Schema::table('users', function (Blueprint $table) {

                    $table->dropColumn('last_passed');
                });
            }
            $table->bigInteger('last_passed')->unsigned()->nullable();
            $table->foreign('last_passed')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_last_passed_foreign');
            $table->dropColumn('last_passed');
        });
    }
}
