@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-body">
			<div>
				<p>Class : {{ $class->name }}</p>
				<p>Teacher : {{ $class->teacher->user->name }}</p>
			</div>
			<h5>Student</h5>
			<table class="table mt-3 table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($class->students as $student)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $student->user->name }}</td>
							<td>
								<a href="" class="btn btn-outline-primary btn-sm">Detail</a>
								<a href="" class="btn btn-outline-warning btn-sm">Edit</a>
								<a href="" class="btn btn-outline-danger btn-sm">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
@endsection