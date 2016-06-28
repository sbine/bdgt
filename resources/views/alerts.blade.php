@if (!empty(session('alerts')))
<div class="container-fluid">
	<div class="row">
		<div class="{{ config('layout.grid_class') }}">
			@foreach (session('alerts') as $type => $alert)
				<div class="alert alert-{{ $type }} alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ $alert }}
				</div>
			@endforeach
		</div>
	</div>
</div>
@endif

@if (session()->has('errors'))
<div class="container-fluid">
	<div class="row">
		<div class="{{ config('layout.grid_class') }}">
			@foreach (session('errors')->all() as $alert)
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ $alert }}
				</div>
			@endforeach
		</div>
	</div>
</div>
@endif