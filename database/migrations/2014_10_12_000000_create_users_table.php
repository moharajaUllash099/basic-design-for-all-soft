<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->collation('utf16_general_ci');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('branch')->comment('0 = principal branch');;
            $table->string('activation_code')->nullable();
            $table->boolean('status')->default(1)->comment('0 = active, 1 = not active');
            $table->string('block')->default('0')->comment('0 = active, 1 = not active');
            $table->string('role')->references('id')->on('role');
            $table->string('img')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
