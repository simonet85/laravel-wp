<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory;
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
        //use Factory class
        $faker = Factory::create();
        // Insert 3 users in table
        DB::table('users')->insert([
            'name'=>'John Doe',
            'slug'=>Str::slug('John Doe'),
            'email'=>'kimouchristiansimonet@gmail.com',
            'password'=>bcrypt('password'),
            'bio'=>$faker->text(rand(200, 255)),
        ]);
        DB::table('users')->insert([
            'name'=>'Francis Leon',
            'slug'=>Str::slug('Francis Leon'),
            'email'=>'christian.85@live.fr',
            'password'=>bcrypt('password'),
            'bio'=>$faker->text(rand(200, 255)),
        ]);
        DB::table('users')->insert([
            'name'=>'Adams Jonnson',
            'slug'=>Str::slug('Adams Jonnson'),
            'email'=>'adamsjohnson@gmail.com',
            'password'=>bcrypt('password'),
            'bio'=>$faker->text(rand(200, 255)),
        ]);
    }
}
