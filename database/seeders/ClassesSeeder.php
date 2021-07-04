<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$classess = ['A', 'B', 'C', 'D', 'E'];
		$teachers = Teacher::take(5)->get();
        foreach($classess as $key => $val){
			Classes::create([
				'name' =>  $val,
				'teacher_id' => $teachers[$key]['id']
			]);
		}
    }
}
