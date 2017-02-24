<?php

namespace App\Modules\Article\Database\Seeds;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //article
        $article1 = Permission::create([
            'name'          => 'index-article',
            'display_name'  => 'article  Listeleme',
            'is_active'     => 1,
        ]);

        $article2 = Permission::create([
            'name'          => 'create-article',
            'display_name'  => 'article Oluşturma',
            'is_active'     => 1,
        ]);

        $article3 = Permission::create([
            'name'          => 'edit-article',
            'display_name'  => 'article Düzenleme',
            'is_active'     => 1,
        ]);

        $article4 = Permission::create([
            'name'          => 'destroy-article',
            'display_name'  => 'article Silme',
            'is_active'     => 1,
        ]);

        $article5 = Permission::create([
            'name'          => 'show-article',
            'display_name'  => 'article Gösterme',
            'is_active'     => 1,
        ]);

        $article6 = Permission::create([
            'name'          => 'update-article',
            'display_name'  => 'article update',
            'is_active'     => 1,
        ]);

        $article7 = Permission::create([
            'name'          => 'store-article',
            'display_name'  => 'article update',
            'is_active'     => 1,
        ]);


        $article9 = Permission::create([
            'name'          => 'Passive-article',
            'display_name'  => 'article Passive',
            'is_active'     => 1,
        ]);


        $article10 = Permission::create([
            'name'          => 'Active-article',
            'display_name'  => 'article Active',
            'is_active'     => 1,
        ]);


        $article11 = Permission::create([
            'name'          => 'Draft-article',
            'display_name'  => 'article Draft',
            'is_active'     => 1,
        ]);


        $article12 = Permission::create([
            'name'          => 'On Air-article',
            'display_name'  => 'article On Air',
            'is_active'     => 1,
        ]);


        $article13 = Permission::create([
            'name'          => 'Preparing-article',
            'display_name'  => 'article Preparing',
            'is_active'     => 1,
        ]);


        $article14 = Permission::create([
            'name'          => 'Pending for Editor Approval-article',
            'display_name'  => 'article Pending for Editor Approval',
            'is_active'     => 1,
        ]);

        $article15 = Permission::create([
            'name'          => 'Garbage-article',
            'display_name'  => 'article Garbage',
            'is_active'     => 1,
        ]);


        //articleauthor
        $articleauthor1 = Permission::create([
            'name'          => 'index-articleauthor',
            'display_name'  => 'articleauthor  Listeleme',
            'is_active'     => 1,
        ]);

        $articleauthor2 = Permission::create([
            'name'          => 'create-articleauthor',
            'display_name'  => 'articleauthor Oluşturma',
            'is_active'     => 1,
        ]);

        $articleauthor3 = Permission::create([
            'name'          => 'edit-articleauthor',
            'display_name'  => 'articleauthor Düzenleme',
            'is_active'     => 1,
        ]);

        $articleauthor4 = Permission::create([
            'name'          => 'destroy-articleauthor',
            'display_name'  => 'articleauthor Silme',
            'is_active'     => 1,
        ]);

        $articleauthor5 = Permission::create([
            'name'          => 'show-articleauthor',
            'display_name'  => 'articleauthor Gösterme',
            'is_active'     => 1,
        ]);

        $articleauthor6 = Permission::create([
            'name'          => 'update-articleauthor',
            'display_name'  => 'articleauthor update',
            'is_active'     => 1,
        ]);

        $articleauthor7 = Permission::create([
            'name'          => 'store-articleauthor',
            'display_name'  => 'articleauthor store',
            'is_active'     => 1,
        ]);


        //articlecategory
        $articlecategory1 = Permission::create([
            'name'          => 'index-articlecategory',
            'display_name'  => 'articlecategory  Listeleme',
            'is_active'     => 1,
        ]);

        $articlecategory2 = Permission::create([
            'name'          => 'create-articlecategory',
            'display_name'  => 'articlecategory Oluşturma',
            'is_active'     => 1,
        ]);

        $articlecategory3 = Permission::create([
            'name'          => 'edit-articlecategory',
            'display_name'  => 'articlecategory Düzenleme',
            'is_active'     => 1,
        ]);

        $articlecategory4 = Permission::create([
            'name'          => 'destroy-articlecategory',
            'display_name'  => 'articlecategory Silme',
            'is_active'     => 1,
        ]);

        $articlecategory5 = Permission::create([
            'name'          => 'show-articlecategory',
            'display_name'  => 'articlecategory Gösterme',
            'is_active'     => 1,
        ]);

        $articlecategory6 = Permission::create([
            'name'          => 'update-articlecategory',
            'display_name'  => 'articlecategory update',
            'is_active'     => 1,
        ]);

        $articlecategory7 = Permission::create([
            'name'          => 'store-articlecategory',
            'display_name'  => 'articlecategory store',
            'is_active'     => 1,
        ]);


        $super_admin = Role::find(1);

        $super_admin->permissions()->attach($article1);
        $super_admin->permissions()->attach($article2);
        $super_admin->permissions()->attach($article3);
        $super_admin->permissions()->attach($article4);
        $super_admin->permissions()->attach($article5);
        $super_admin->permissions()->attach($article6);
        $super_admin->permissions()->attach($article7);

        $super_admin->permissions()->attach($article9);
        $super_admin->permissions()->attach($article10);
        $super_admin->permissions()->attach($article11);
        $super_admin->permissions()->attach($article12);
        $super_admin->permissions()->attach($article13);
        $super_admin->permissions()->attach($article14);
        $super_admin->permissions()->attach($article15);
        $super_admin->permissions()->attach($articleauthor1);
        $super_admin->permissions()->attach($articleauthor2);
        $super_admin->permissions()->attach($articleauthor3);
        $super_admin->permissions()->attach($articleauthor4);
        $super_admin->permissions()->attach($articleauthor5);
        $super_admin->permissions()->attach($articleauthor6);
        $super_admin->permissions()->attach($articleauthor7);
        $super_admin->permissions()->attach($articlecategory1);
        $super_admin->permissions()->attach($articlecategory2);
        $super_admin->permissions()->attach($articlecategory3);
        $super_admin->permissions()->attach($articlecategory4);
        $super_admin->permissions()->attach($articlecategory5);
        $super_admin->permissions()->attach($articlecategory6);
        $super_admin->permissions()->attach($articlecategory7);

    }
}
