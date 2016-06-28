@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="{{ config('layout.grid_class') }}">
			@yield('ledger')
		</div>
	</div>
</div>
@endsection
