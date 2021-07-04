<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

	protected $guarded = [];

	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}

	public function students()
	{
		return $this->hasMany(Student::class, 'class_id');
	}
}
