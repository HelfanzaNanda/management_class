<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
	{
		$students = Student::with('class')->latest()->paginate(7);
		return view('student.index', [
			'students' => $students,
		]);
	}

	public function createOrUpdate(Request $request)
	{
		$attr = $request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$request->id,
			'password' => 'required|min:6'
		]);

		$attr['role'] = 'student';
		$attr['password'] = Hash::make($request->password);
		$user = User::updateOrCreate(['id' => $request->id], $attr);
		if(!$request->id){
			$user->students()->create();
		}
		
		return redirect()->route('student.index')
		->with('success', 'student was '. ($request->id ? 'updated' : 'added'));
	}

	public function detail($id)
	{
		if(request()->wantsJson()){
			return Student::with('user')->where('class_id', null)->get();
		}
		$student = Student::whereId($id)->first()->load('user');
		return view('student.detail', [
			'student' => $student
		]);
	}

	public function delete($id)
	{
		$student = Student::whereId($id)->first();
		$student->user()->delete();
		$student->delete();
	
		return redirect()->route('student.index')
		->with('success', 'student was deleted');
	}

	
}
