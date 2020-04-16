<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();

        $adminRole  = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin')
        ]);

        $author = User::create([
            'name' => 'author',
            'email' => 'author@test.com',
            'password' => bcrypt('author')
        ]);

        $author2 = User::create([
            'name' => 'author 2',
            'email' => 'author2@test.com',
            'password' => bcrypt('author')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $author2->roles()->attach($authorRole);
    }
}
