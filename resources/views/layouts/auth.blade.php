@extends('layouts.base')
@section('body')
<div class="row justify-content-center align-items-center" 
	style="position: relative; overflow-x: hidden; height: 100vh">
	<div class="col-md-6">
		@yield('content')
	</div>
</div>
@endsection