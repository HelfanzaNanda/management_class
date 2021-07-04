<!-- Modal -->
<div class="modal fade" id="modal-teacher" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('teacher.createOrUpdate') }}" method="POST">
				<input type="hidden" name="id" id="input-id">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="input-name">Name</label>
						<input type="text" name="name" class="form-control" id="input-name">
						@error('name')
							<small class="text-danger mt-2">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group">
						<label for="input-email">Email</label>
						<input type="email" name="email" class="form-control" id="input-email">
						@error('email')
							<small class="text-danger mt-2">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group">
						<label for="input-password">Password</label>
						<input type="password" name="password" class="form-control" id="input-password">
						@error('password')
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