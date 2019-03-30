@extends('app')

@section('meta-description')
"Calculate loan duration and total interest paid based on monthly payments."
@overwrite

@section('breadcrumbs.items')
	<div class="breadcrumb">{{ trans('labels.calculators.plural') }}</div>
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.calculators.debt.label') }}</div>
@endsection

@section('sidebar-nav')
	<li class="sidebar-icon hidden-xs"><a href="#addTransactionModal" data-toggle="modal"><button class="btn btn-success btn-md"><i class="fa fa-plus"></i> {{ trans('labels.transactions.add_button') }}</button></a></li>
	<li class="sidebar-divider hidden-xs"></li>
	<li><a href="{{ route('calculators.debt') }}">{{ trans('labels.calculators.debt.label') }}</a></li>
@overwrite

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<div class="row">
					<div class="col-sm-6">
						<p class="lead">Paid off <span class="text-success">2020-06-12</span> <span id="payoffDate">on June 12, 2020</span></p>
						<p class="lead">Total interest <span id="interestPaid" class="text-danger money">0.00</span></p>
						<div id="errorContainer" style="display: none;">
							<div id="errorMessage" class="text-danger"></div>
						</div>
					</div>
					<div class="col-sm-6">
						<p>{{ trans('labels.calculators.debt.properties.payment') }}</p>
						<div id="payment" data-slider-min="10" data-slider-max="1000" data-slider-value="150"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 col-sm-3 col-xs-4">
			<div class="form-group">
				<label for="currentBalance">{{ trans('labels.calculators.debt.properties.currentBalance') }}</label>
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input id="currentBalance" type="number" step="0.1" class="form-control" value="2000.0">
				</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-3 col-xs-4">
			<div class="form-group">
				<label for="interestRate">{{ trans('labels.calculators.debt.properties.interestRate') }}</label>
				<div class="input-group">
					<input id="interestRate" type="number" step="0.1" class="form-control" value="5.4">
					<span class="input-group-addon">%</span>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-3 col-xs-4">
			<div class="form-group">
				<label for="minimumPayment">{{ trans('labels.calculators.debt.properties.minimumPayment') }}</label>
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input id="minimumPayment" type="number" step="0.1" class="form-control" value="150" min="10">
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script>
	var calculation;

	var paymentSlider = $("#payment").slider();

	paymentSlider.on('slide', inputUpdate);
	$("#currentBalance, #interestRate, #minimumPayment").on('keyup', inputUpdate);

	function inputUpdate(e) {
		if (validInput()) {
			if (paymentSlider.slider('getValue') < $("#minimumPayment").val()) {
				paymentSlider.slider('setValue', parseInt($("#minimumPayment").val(), 10));
			}

			calculate();
		}
	}

	function validInput() {
		return ($("#minimumPayment").val() 			!== undefined 	&&
				$("#interestRate").val() 			!== undefined 	&&
				$("#currentBalance").val() 			!== undefined 	&&
				$("#minimumPayment").val() 			!== NaN 		&&
				$("#interestRate").val() 			!== NaN			&&
				$("#currentBalance").val() 			!== NaN			&&
				paymentSlider.slider('getValue') 	!== undefined 	&&
				paymentSlider.slider('getValue') 	!== NaN)
	}

	function calculate() {
		calculation = $.Deferred(function() {
			var loan = new Loan($("#currentBalance").val(), $("#interestRate").val(), paymentSlider.slider('getValue'));
			var interest = loan.calculate();

			if (interest.interest === -1) {
				showError('Increase your monthly payments -- current payment plan will take over 80 years!');
				return this.reject();
			}

			return this.resolve(interest);
		}).done(function(response) {
			$("#payoffDate").text('on ' + response.date.format('MMMM Do, YYYY'));
			$("#payoffDate").siblings('.text-success').text(response.date.fromNow());
			$("#interestPaid").text(accounting.formatMoney(response.interest));
			$("#errorContainer").hide();
		}).fail(function() {
			$("#payoffDate").text('');
			$("#payoffDate").siblings('.text-success').text('in over 80 years');
		});
	}

	function showError(text) {
		$("#errorMessage").text(text);
		$("#errorContainer").show();
	}

	inputUpdate();
</script>
@endsection
