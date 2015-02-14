@extends('app')

@section('css')
	<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" rel="stylesheet">
@endsection

@section('js')
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-push-7">
				<div class="list-group">
					@foreach ($bills as $bill)
						<a href="#" class="list-group-item">

							@if ($bill->total >= $bill->amount)
								<span class="pull-right label label-success">PAID</span>
							@else
								<span class="pull-right label label-danger">UNPAID</span>
							@endif

							<h4 class="list-group-item-heading">{{ $bill->label }}</h4>
							<p class="list-group-item-text pull-right">Due <span class="moment">{{ $bill->nextDue }}</span></p>
							<p class="list-group-item-text">$ {{ number_format($bill->amount, 2) }}</p>
						</a>
					@endforeach
				</div>
			</div>
			<div class="col-md-6 col-md-pull-3">
				<div id="calendar"></div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
var bills = {!! json_encode(array_values($bills->toArray())) !!};

$('#calendar').fullCalendar({
	events: bills,
	eventDataTransform: function(rawEventData) {
		return {
				id: rawEventData.id,
				title: rawEventData.label + ' due',
				start: rawEventData.nextDue,
				end: rawEventData.nextDue
		};
	}
});
@endsection