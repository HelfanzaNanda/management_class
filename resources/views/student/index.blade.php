@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-body">
		<x-alert-success/>
		<div class="d-flex justify-content-between">
			<h5>Student</h5>
			<button class="btn btn-primary btn-add btn-sm">Add Student</button>
		</div>
		<table class="table mt-3 table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Class</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($students as $student)
				<tr>
					<td>{{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}</td>
					<td>{{ $student->user->name }}</td>
					<td>{{ $student->user->email }}</td>
					<td>{{ $student->class ? $student->class->name : '-' }}</td>
					<td>
						<a href="" data-id="{{ $student->id }}" class="btn btn-edit btn-outline-warning btn-sm">Edit</a>
						<a href="" data-key="{{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}" class="btn btn-delete btn-outline-danger btn-sm">Delete</a>
						<form action="{{ route('student.delete', $student->id) }}" method="POST" id="form-delete-{{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}">
							@csrf
							@method('delete')
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-end">
			{{ $students->links() }}
		</div>
	</div>
</div>
@include('student.modal')

@endsection

@section('handleErrorModal')
	@if (count($errors) > 0)
		<script type="text/javascript">
			$('#modal-title').text('Add Student')
			$('#input-id').val("{{ old('id') }}")
			$('#input-name').val("{{ old('name') }}")
			$('#input-email').val("{{ old('email') }}")
			$('#input-password').val("{{ old('password') }}")
			$('#modal-student').modal('show')
		</script>
	@endif
@endsection

@push('scripts')
	<script>

		$(document).on('click', '.btn-add', function (e) {  
			e.preventDefault()
			resetForm()
			$('#modal-title').text('Add Student')
			$('#modal-student').modal('show')
		})

		$(document).on('click', '.btn-edit', async function (e) {  
			e.preventDefault()
			const id = $(this).data('id')
			const url = BASE_URL+"student/"+id+"/detail"
			try {
				let response = await axios.get(url)
				console.log(response);
				$('#input-id').val(response.data.user.id)
				$('#input-name').val(response.data.user.name)
				$('#input-email').val(response.data.user.email)
				$('#modal-title').text('Edit Student')
				$('#modal-student').modal('show')	
			} catch (error) {
				console.log(error);
			}	
		})

		function resetForm() {  
			$('#input-id').val('')
			$('#input-name').val('')
			$('#input-email').val('')
			$('#input-password').val('')
		}

		$(document).on('click', '.btn-delete', function(e){
			e.preventDefault()
			const key = $(this).data('key')
			$.confirm({
			title: 'Delete Data',
			content: 'are you sure?',
			buttons: {
				delete: {
					text: 'Delete',
					btnClass: 'btn-danger',
					action: function(){
						$('#form-delete-'+key).submit()
					}
				},
				batal: {
					text: 'Cancel',
					btnClass: 'btn-success',
				}
			}
		});
		})
	</script>
@endpush