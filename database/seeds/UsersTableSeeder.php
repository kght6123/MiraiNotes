<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = new User;
    $user->name     = 'kght6123';
    $user->email    = 'admin@kght6123.work';
    $user->password = password_hash('kght6123', PASSWORD_DEFAULT);
    $user->save();
  }
}
