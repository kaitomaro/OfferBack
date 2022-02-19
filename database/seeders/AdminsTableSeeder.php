<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admins')->delete();

      DB::table('admins')->insert([
             [
                  'name'      => '管理者',
                  'email'     => 'info@eatap.co.jp',
                  'email_verified_at' => date('Y-m-d H:i:s'),
                  'password' => Hash::make('Pa1234ss123wor3411d'),
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s') 
               ]
          ]);
    }
}