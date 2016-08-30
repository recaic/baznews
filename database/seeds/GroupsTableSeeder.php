<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group1 = Group::create([
            'name'          => 'Üst Yönetim',
            'description'   => 'Site Yöneticileri',
            'is_active'  => 1,
        ]);

        $group2 = Group::create([
            'name'          => 'Yurt Müdürleri',
            'description'   => 'Yurt Yöneticileri',
            'is_active'  => 1,
        ]);

        $group3 = Group::create([
            'name'          => 'Birim  Yöneticileri',
            'description'   => 'Birim Yöneticileri',
            'is_active'  => 1,
        ]);

        $group4 = Group::create([
            'name'          => 'Ev Sorumlusu',
            'description'   => 'Ev Sorumlusu',
            'is_active'  => 1,
        ]);

        $group5 = Group::create([
            'name'          => 'Personel',
            'description'   => 'Personel',
            'is_active'  => 1,
        ]);

        $group6 = Group::create([
            'name'          => 'Öğrenci',
            'description'   => 'Öğrenci',
            'is_active'  => 1,
        ]);


        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);

        $group1->users()->attach($user1);
        $group5->users()->attach($user2);
        $group6->users()->attach($user3);
    }
}
