<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
	{
		$students = Student::with('user')->latest()->get();
		$teachers = Teacher::with('user')->latest()->get();
		$classess = Classes::orderBy('name')->groupBy('name')->get();
		return view('classes.index', [
			'classess' => $classess,
			'teachers' => $teachers,
			'students' => $students,
		]);
	}

	public function createOrUpdate(Request $request)
	{
		$attr = $request->validate([
			'name' => 'required',
			'teacher_id' => 'required'
		]);

		Classes::updateOrCreate(['id' => $request->id], $attr);
		return redirect()->route('class.index')
		->with('success', 'class was '. ($request->id ? 'updated' : 'added'));
	}

	public function detail($id)
	{
		$class = Classes::whereId($id)->first()->load('students');
		if(request()->wantsJson()){
			return $class;
		}
		return view('classes.detail', [
			'class' => $class
		]);
	}

	public function delete($id)
	{
		Classes::destroy($id);
		return redirect()->route('class.index')
		->with('success', 'class was deleted');
	}

	public function addStudents(Request $request)
	{
		$request->validate([
			'student_ids' => 'required|array'
		]);
		$class_id = $request->class_id;
		foreach($request->student_ids as $student_id){
			Student::where('id', $student_id)->update([
				'class_id' => $class_id
			]);
		}

		return redirect()->back()
		->with('success', 'students was added');
	}
}
