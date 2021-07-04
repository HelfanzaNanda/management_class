<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if (auth()->user()->role == 'student'){
			$class = auth()->user()->student->class;
			if($class){
				$students = Student::where('class_id', $class->id)->get();
			}else{
				$students = collect();
			}
			return view('home', [
				'students' => $students
			]);
		}

		if (auth()->user()->role == 'teacher'){
			$classess = auth()->user()->teacher->classess;
			if(count($classess) > 0){
				$results = [];
				foreach ($classess as $class) {
					$students = Student::where('class_id', $class->id)->get();
					$item = [
						'class' => $class->name,
						'students' => $students
					];
					array_push($results, $item);
				}
			}else{
				$results = collect();
			}
			
			return view('home', [
				'results' => $results
			]);
		}
        return view('home');
    }
}
