<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
	{
		$teachers = Teacher::with('classess')->latest()->paginate(7);
		return view('teacher.index', [
			'teachers' => $teachers,
		]);
	}

	public function createOrUpdate(Request $request)
	{
		$attr = $request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$request->id,
			'password' => 'required|min:6'
		]);

		$attr['role'] = 'teacher';
		$attr['password'] = Hash::make($request->password);
		$user = User::updateOrCreate(['id' => $request->id], $attr);
		if(!$request->id){
			$user->teachers()->create();
		}
		
		return redirect()->route('teacher.index')
		->with('success', 'teacher was '. ($request->id ? 'updated' : 'added'));
	}

	public function detail($id)
	{
		$teacher = Teacher::whereId($id)->first()->load('user');
		if(request()->wantsJson()){
			return $teacher;
		}
		return view('teacher.detail', [
			'teacher' => $teacher
		]);
	}

	public function delete($id)
	{
		$teacher = Teacher::whereId($id)->first();
		$teacher->user()->delete();
		$teacher->delete();
	
		return redirect()->route('teacher.index')
		->with('success', 'teacher was deleted');
	}
}
