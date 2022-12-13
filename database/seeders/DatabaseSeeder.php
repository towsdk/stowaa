<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // RolesAndPermissionsSeeder::class,
        //      CategorySeeder::class,
        //     ColorSeeder::class,
        //     SizeSeeder::class,
           ProductSeeder::class,
        ]);

        // User::factory(20)->create();
    }
}
