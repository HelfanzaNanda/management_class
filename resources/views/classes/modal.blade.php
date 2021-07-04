<!-- Modal -->
<div class="modal fade" id="modal-class" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('class.createOrUpdate') }}" method="POST">
				<input type="hidden" name="id" id="input-id">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="input-name">Class</label>
						<input type="text" name="name" class="form-control" id="input-name">
						@error('name')
							<small class="text-danger mt-2">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group">
						<label for="input-teacher-id">Teacher</label>
						<select name="teacher_id" class="select-single" id="input-teacher-id" style="width: 100%">
							<option value="" selected disabled>-- Choose Teacher --</option>
							@foreach ($teachers as $teacher)
								<option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
							@endforeach
						</select>
						@error('teacher_id')
							<small class="text-danger mt-2">{{ $message }}</small>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
			
		</div>
	</div>
</div>

