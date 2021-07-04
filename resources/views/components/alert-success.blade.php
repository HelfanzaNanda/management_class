@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
<script>
	setTimeout(() => {
		$('.alert').hide('slow')
	}, 2000);
</script>
@endif