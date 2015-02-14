@if (!empty(session('alerts')))
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
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