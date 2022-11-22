<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('users')){
            Schema::table('users', function (Blueprint $table) {
                $table->string('mobile',11)->nullable(true)->default('');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('users','mobile')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('mobile');
            });
        }
    }
}
