<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeginKeyFromPostToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
         //   $table->bigInteger('user_id')->after('id')->nullable()->default(null);
         //   $table->bigInteger('user_id')->nullable()->default(null);
            $table->foreignId('user_id')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
        //    $table->dropForeign('user_id');
            $table->dropColumn('user_id');
        });
    }
}
