<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
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
        Category::truncate();
        \App\Models\User::factory(20)->create();
        \App\Models\Company::factory(20)->create();
        \App\Models\Job::factory(20)->create();

        $categories = [
            'Technology',
            'Engineering',
            'Goverment',
            'Medical',
            'Construction',
            'software',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }

        Role::truncate();
        $adminRole = Role::create(['name' => 'admin']);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
            'email_verified_at' => NOW()
        ]);

        $admin->roles()->attach($adminRole);
    }
}
