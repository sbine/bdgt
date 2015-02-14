<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@foreach (session('alerts') as $type => $alert)
				<div class="alert alert-{{ $type }}">
					{{ $alert }}
				</div>
			@endforeach
		</div>
	</div>
</div>
