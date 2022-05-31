<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('unique_id')->after('id'); // TwitterのプロフィールのURLで利用されている値
            $table->string('avatar')->after('password');
            $table->text('bio')->after('avatar');
            $table->string('twitter_oauth_token')->after('bio');
            $table->string('twitter_oauth_token_secret')->after('twitter_oauth_token');
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
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
            $table->string('password')->change();
            $table->string('email')->change();
            $table->dropColumn('bio');
            $table->dropColumn('avatar');
            $table->dropColumn('unique_id');
        });
    }
}
