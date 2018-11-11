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
    // create table if not exists user (userid text primary key not null, password text not null, email text, markdown blob, gtoken blob, create_dt text not null, update_dt text not null);
    // https://readouble.com/laravel/5.5/ja/migrations.html#creating-columns
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->binary('markdown')->nullable();
      $table->binary('gtoken')->nullable();
      $table->rememberToken();
      $table->timestamps(); // created_at, updated_at 作成
      //$table->primary(['userid', 'parent_id']);
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
