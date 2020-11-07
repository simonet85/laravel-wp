<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        // Admin role
        $admin = new Role();
        $admin->name = "admin";
        $admin->display_name = "Admin";
        $admin->save();

        // Editor role
        $editor = new Role();
        $editor->name = "editor";
        $editor->display_name = "Editor";
        $editor->save();

        // Author role
        $author = new Role();
        $author->name = "author";
        $author->display_name = "Author";
        $author->save();

        // Attaching roles
        $user1 = User::find(1); //Author
        $user1->detachRole($admin);
        $user1->attachRole($admin);

        $user2 = User::find(2); //Admin
        $user2->detachRole($editor);
        $user2->attachRole($editor);

        $user3 = User::find(3); //Editor
        $user3->detachRole($author);
        $user3->attachRole($author);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
