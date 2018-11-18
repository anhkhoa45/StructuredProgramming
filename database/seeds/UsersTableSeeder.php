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
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
            'name' => 'Admin',
            'role_id' => 1,
            'active' => 1,
            'avatar' => 'uploads/users/avatars/default.png',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
        DB::table('users')->insert([
            'email' => 'test@gmail.com',
            'password' => Hash::make('secret'),
            'name' => 'Test',
            'role_id' => 2,
            'active' => 1,
            'avatar' => 'uploads/users/avatars/default.png',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
