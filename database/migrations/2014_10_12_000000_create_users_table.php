<?php

use App\Engine\DbFields\Fields;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->autoIncrement()->primary();
            $table->integer('userType');
            $table->string('userName')->unique();
            $table->string('fullName');
            $table->string('gender', 10);
            $table->string('email');
            $table->string('mobileNumber');
            $table->string('password');
            $table->boolean('passwordUpdated')->default(false);
            $table->rememberToken();
            Fields::AddCommonField($table);
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
};
