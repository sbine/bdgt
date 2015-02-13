@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="list-group">
					@foreach ($bills as $bill)
						<a href="#" class="list-group-item">

							@if ($bill->total >= $bill->amount)
								<span class="pull-right label label-success">PAID</span>
							@else
								<span class="pull-right label label-danger">UNPAID</span>
							@endif

							<h4 class="list-group-item-heading">{{ $bill->label }}</h4>
							<p class="list-group-item-text pull-right">Due <span class="moment">{{ $bill->nextDue() }}</span></p>
							<p class="list-group-item-text">$ {{ number_format($bill->amount, 2) }}</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection