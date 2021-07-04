@extends('layouts.base')
@section('base-styles')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	@stack('styles')
@endsection
@section('body')
<div id="app">
	@include('layouts.partials._navbar')

	<main class="py-4">
		<div class="container">
			@yield('content')
		</div>
	</main>
</div>
@endsection

@section('base-scripts')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>	
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

	@stack('scripts')

	@yield('handleErrorModal')
@endsection
