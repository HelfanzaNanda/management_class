<!-- Modal -->
<div class="modal fade" id="modal-students" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('class.students') }}" method="POST">
				@csrf
				<input type="hidden" name="class_id" id="input-class-id">
				<div class="modal-body">
					<div class="form-group">
						<label for="input-students">Students</label>
						<select name="student_ids[]" class="select-multiple" multiple id="input-students" style="width: 100%">
						</select>
						@error('student_ids[]')
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