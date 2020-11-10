<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CategoriesTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            TagsTableSeeder::class,
            CommentsTableSeeder::class,
        ]);
    }
}
