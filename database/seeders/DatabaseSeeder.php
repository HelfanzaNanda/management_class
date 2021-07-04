<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\User;
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
		User::factory(100)->create();
		$this->call([
			TeacherSeeder::class,
			ClassesSeeder::class,
			StudentSeeder::class,
			AdminSeeder::class
		]);
        // \App\Models\User::factory(10)->create();
    }
}
