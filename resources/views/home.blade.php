@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-body">
					@if (auth()->user()->role == 'student')
						@if (auth()->user()->student->class)
							<h6>Welcome, you are in Class {{ auth()->user()->student->class->name }}
								with {{ auth()->user()->student->class->teacher->user->name }} Teacher</h6>

							<table class="table mt-3 table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Class</th>
										<th>Student</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students as $student)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $student->class->name }}</td>
										<td>{{ $student->user->name }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<h6>you don't have class</h6>
						@endif
					@endif

					@if (auth()->user()->role == 'teacher')
						@if (count(auth()->user()->teacher->classess) < 0) <h6>you don't have class</h6> @endif

						<h6>Welcome, you are in Class {{ auth()->user()->teacher->classess->implode('name', ', ') }}</h6>

						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							@foreach ($results as $item)
								<li class="nav-item">
									<a class="nav-link" id="pills-{{ $item['class'] }}-tab" data-toggle="pill" href="#pills-{{ $item['class'] }}"
										role="tab" aria-controls="pills-{{ $item['class'] }}" aria-selected="false">Class {{ $item['class'] }}</a>
								</li>	
							@endforeach
						</ul>
						<div class="tab-content" id="pills-tabContent">
							@foreach ($results as $item)
								<div class="tab-pane fade" id="pills-{{ $item['class'] }}" role="tabpanel"
								aria-labelledby="pills-{{ $item['class'] }}-tab">
									<table class="table mt-3 table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Class</th>
												<th>Student</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($item['students'] as $student)
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $student->class->name }}</td>
													<td>{{ $student->user->name }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							@endforeach
							
						</div>

						
						@endif


				</div>
			</div>

		</div>
	</div>
</div>
@endsection