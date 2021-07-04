@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-body">
		<div>
			<p>Class : {{ $class->name }}</p>
			<p>Teacher : {{ $class->teacher->user->name }}</p>
		</div>
		<div class="d-flex justify-content-between">
			<h5>Student</h5>
			<a href="" data-id="{{ $class->id }}" class="btn btn-add-students btn-outline-primary btn-sm">Add
				Students</a>
		</div>
		<table class="table mt-3 table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($class->students as $student)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $student->user->name }}</td>
					<td>{{ $student->user->email }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@include('classes.modal_students')
@endsection

@push('scripts')
<script>
	$(document).on('click', '.btn-add-students', async function (e) {
		e.preventDefault()
		const id = $(this).data('id')
		const url = BASE_URL+"student/"+id+"/detail"
		try {
			let response = await axios.get(url)
			let opt = ''
			 response.data.map((student, index) => (
				opt += '<option value="'+student.id+'">'+student.user.name+'</option>'
			))
			$('#input-students').append(opt)
			$('#input-class-id').val(id)
			$('.select-multiple').select2({
				placeholder: "Select Students",
    			allowClear: true
			});
			$('.modal-title').text('Add Students')
			$('#modal-students').modal('show')
		} catch (error) {
			
		}
		
	})
</script>
@endpush