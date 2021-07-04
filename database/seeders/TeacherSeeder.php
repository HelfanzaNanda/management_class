<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'teacher')->get();
		foreach($users as $user){
			Teacher::create([
				'user_id' => $user->id
			]);
		}
    }
}
