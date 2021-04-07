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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('user_oid');
                $table->string('email', 64);
                $table->string('password', 64);
                $table->string('name', 64);
                $table->integer('role_oid');
                $table->tinyInteger('charge_type')->nullable();
                $table->decimal('charge_unit_price', 10, 6)->nullable();
                $table->string('created_by', 32);
                $table->string('updated_by', 32);
                $table->timestamps();
                $table->softDeletes();
                $table->unique('email');
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
        Schema::dropIfExists('users');
    }
}
