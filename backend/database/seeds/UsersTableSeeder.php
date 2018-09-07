<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Shakeel Khalid',
            'cnic' => '3610498363823',
            'password' => bcrypt('secret'),
            'role' => 'Admin',
        ]);
    }
}
