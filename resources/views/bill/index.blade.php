@extends('app')

@section('css')
	<link href="/css/fullcalendar.min.css" rel="stylesheet">
@endsection

@section('js')
	<script src="/js/fullcalendar.min.js"></script>
@endsection

@section('breadcrumbs.items')
	<li class="active">{{ trans('labels.bills.plural') }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addBillModal" data-toggle="modal" class="{{ config('layout.create_button_class') }}"><i class="fa fa-plus"></i> {{ trans('labels.bills.add_button') }}</a>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-5 col-sm-push-7">
			<div class="list-group">
				@foreach ($bills as $bill)
					<a href="/bills/{{ $bill->id }}" class="list-group-item">

						@if ($bill->total >= $bill->amount)
							<span class="pull-right label label-success">PAID</span>
						@else
							<span class="pull-right label label-danger">UNPAID</span>
						@endif

						<h4 class="list-group-item-heading">{{ $bill->label }}</h4>
						<p class="list-group-item-text pull-right">Due <span class="moment">{{ $bill->nextDue }}</span><span class="hide">{{ $bill->nextDue }}</span></p>
						<p class="list-group-item-text">@money($bill->amount)</p>
					</a>
				@endforeach
			</div>
		</div>
		<div class="col-sm-7 col-sm-pull-5">
			<div id="calendar"></div>
		</div>
	</div>
	@include('bill.modals.create')
@endsection

@section('scripts')
<script>
	$('#calendar').fullCalendar({
		events: '/bills/ajax_calendar_events',
		eventRender: function(event, element, view) {
			if (event.paid === true) {
				element.css('background-color', '#5cb85c').css('border-color', '#5cb85c');
			} else {
				element.css('background-color', '#d9534f').css('border-color', '#d9534f');
			}
		}
	});
	$('.fc-button').addClass('btn btn-default').removeClass('fc-state-default');
</script>
@endsection
