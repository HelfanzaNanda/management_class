@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-body">
		<x-alert-success/>
		<div class="d-flex justify-content-between">
			<h5>Teacher</h5>
			<button class="btn btn-primary btn-add btn-sm">Add Teacher</button>
		</div>
		<table class="table mt-3 table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Classess</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($teachers as $teacher)
				<tr>
					<td>{{ ($teachers->currentpage()-1) * $teachers->perpage() + $loop->index + 1 }}</td>
					<td>{{ $teacher->user->name }}</td>
					<td>{{ $teacher->user->email }}</td>
					<td>{{ $teacher->classess->implode('name', ', ') ?? '-' }}</td>
					<td>
						<a href="" data-id="{{ $teacher->id }}" class="btn btn-edit btn-outline-warning btn-sm">Edit</a>
						<a href="" data-key="{{ ($teachers->currentpage()-1) * $teachers->perpage() + $loop->index + 1 }}" class="btn btn-delete btn-outline-danger btn-sm">Delete</a>
						<form action="{{ route('teacher.delete', $teacher->id) }}" method="POST" id="form-delete-{{ ($teachers->currentpage()-1) * $teachers->perpage() + $loop->index + 1 }}">
							@csrf
							@method('delete')
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-end">
			{{ $teachers->links() }}
		</div>
	</div>
</div>
@include('teacher.modal')

@endsection

@section('handleErrorModal')
	@if (count($errors) > 0)
		<script type="text/javascript">
			$('#modal-title').text('Add Teacher')
			$('#input-id').val("{{ old('id') }}")
			$('#input-name').val("{{ old('name') }}")
			$('#input-email').val("{{ old('email') }}")
			$('#input-password').val("{{ old('password') }}")
			$('#modal-teacher').modal('show')
		</script>
	@endif
@endsection

@push('scripts')
	<script>

		$(document).on('click', '.btn-add', function (e) {  
			e.preventDefault()
			resetForm()
			$('#modal-title').text('Add Teacher')
			$('#modal-teacher').modal('show')
		})

		$(document).on('click', '.btn-edit', async function (e) {  
			e.preventDefault()
			const id = $(this).data('id')
			const url = BASE_URL+"teacher/"+id+"/detail"
			try {
				let response = await axios.get(url)
				console.log(response);
				$('#input-id').val(response.data.user.id)
				$('#input-name').val(response.data.user.name)
				$('#input-email').val(response.data.user.email)
				$('#modal-title').text('Edit Teacher')
				$('#modal-teacher').modal('show')	
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