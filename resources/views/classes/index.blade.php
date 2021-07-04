@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-body">
		<x-alert-success/>
		<div class="d-flex justify-content-between">
			<h5>Class</h5>
			<button class="btn btn-primary btn-add btn-sm">Add Class</button>
		</div>
		<table class="table mt-3 table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Class</th>
					<th>Teacher</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($classess as $class)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $class->name }}</td>
					<td>{{ $class->teacher->user->name }}</td>
					<td>
						<a href="{{ route('class.detail', $class->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
						<a href="" data-id="{{ $class->id }}" class="btn btn-edit btn-outline-warning btn-sm">Edit</a>
						<a href="" data-key="{{ $loop->iteration }}" class="btn btn-delete btn-outline-danger btn-sm">Delete</a>
						<form action="{{ route('class.delete', $class->id) }}" method="POST" id="form-delete-{{ $loop->iteration }}">
							@csrf
							@method('delete')
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@include('classes.modal')

@endsection

@section('handleErrorModal')
	@if (count($errors) > 0)
		<script type="text/javascript">
			$('#modal-title').text('Add Class')
			$('#modal-class').modal('show')
		</script>
	@endif
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			$('.select-single').select2();
			
		});

		$(document).on('click', '.btn-add', function (e) {  
			e.preventDefault()
			resetForm()
			$('#modal-title').text('Add Class')
			$('#modal-class').modal('show')
		})

		$(document).on('click', '.btn-edit', async function (e) {  
			e.preventDefault()
			const id = $(this).data('id')
			const url = BASE_URL+"class/"+id+"/detail"
			try {
				let response = await axios.get(url)
				$('#input-id').val(response.data.id)
				$('#input-name').val(response.data.name)
				$('#input-teacher-id').val(response.data.teacher_id).trigger('change')
				$('#modal-title').text('Edit Class')
				$('#modal-class').modal('show')	
			} catch (error) {
				console.log(error);
			}	
		})

		function resetForm() {  
			$('#input-id').val('')
			$('#input-name').val('')
			$('#input-teacher-id').val('').trigger('change')
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