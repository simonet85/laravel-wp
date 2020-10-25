<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resettings the users table
        DB::table('users')->truncate();
        // Insert 3 users in table
        DB::table('users')->insert([
            'name'=>'John Doe',
            'email'=>'johndoe@gmail.com',
            'password'=>bcrypt('password')
        ]);
        DB::table('users')->insert([
            'name'=>'Francis Leon',
            'email'=>'francisleon@gmail.com',
            'password'=>bcrypt('password')
        ]);
        DB::table('users')->insert([
            'name'=>'Adams Jonnson',
            'email'=>'adamsjohnson@gmail.com',
            'password'=>bcrypt('password')
        ]);
    }
}
