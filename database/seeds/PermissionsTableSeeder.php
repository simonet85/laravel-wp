<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();

        // crud post
        $crudPost = new Permission();
        $crudPost->name = "crud-post";
        $crudPost->save();

        // update other post
        $updateOthersPost = new Permission();
        $updateOthersPost->name = "update-others-post";
        $updateOthersPost->save();

        // delete other post
        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = "delete-others-post";
        $deleteOthersPost->save();

         // delete category
         $crudCategory = new Permission();
         $crudCategory->name = "crud-category";
         $crudCategory->save();

        // delete user
        $cruduser = new Permission();
        $cruduser->name = "crud-user";
        $cruduser->save();

        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([
            $crudPost,
            $updateOthersPost,
            $deleteOthersPost,
            $crudCategory,
            $cruduser,
        ]);

        $admin->attachPermissions([
            $crudPost,
            $updateOthersPost,
            $deleteOthersPost,
            $crudCategory,
            $cruduser,
        ]);

        $editor->detachPermissions([
            $crudPost,
            $updateOthersPost,
            $deleteOthersPost,
            $crudCategory,
            
        ]);
        $editor->attachPermissions([
            $crudPost,
            $updateOthersPost,
            $deleteOthersPost,
            $crudCategory,
        ]);

        $author->detachPermissions([
            $crudPost,
        ]);
        $author->attachPermissions([
            $crudPost,
        ]);
       

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
