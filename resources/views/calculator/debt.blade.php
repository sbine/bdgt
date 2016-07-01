@extends('app')

@section('breadcrumbs.items')
	<li><a href="/calculators">Calculators</a></li>
	<li class="active">Debt</li>
@endsection

@section('sidebar-nav')
	<li class="sidebar-icon hidden-xs"><a href="#addTransactionModal" data-toggle="modal"><button class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add Transaction</button></a></li>
	<li class="sidebar-divider hidden-xs"></li>
	<li><a href="{{ route('calculators.debt') }}">Debt Calculator</a></li>
@overwrite

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<div class="row">
					<div class="col-sm-12">
						<div class="well">
							<div class="row">
								<div class="col-sm-6">
									<p class="lead">Paid off <span class="moment text-success">2020-06-12</span> <span id="payoffDate">on June 12, 2020</span></p>
									<p class="lead">Total interest <span id="interestPaid" class="text-danger">$ 0.00</span></p>
									<div id="errorContainer" style="display: none;">
										<div id="errorMessage" class="text-danger"></div>
									</div>
								</div>
								<div class="col-sm-6">
									<p>Monthly Payment</p>
									<div id="payment" data-slider-min="10" data-slider-max="1000" data-slider-value="10"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 col-sm-3 col-xs-4">
						<div class="form-group">
							<label for="currentBalance">Current Balance</label>
							<input id="currentBalance" type="number" step="0.1" class="form-control" value="2000.0">
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-4">
						<div class="form-group">
							<label for="interestRate">Interest Rate</label>
							<div class="input-group">
								<input id="interestRate" type="number" step="0.1" class="form-control" value="5.4">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-4">
						<div class="form-group">
							<label for="minimumPayment">Minimum Payment</label>
							<input id="minimumPayment" type="number" step="0.1" class="form-control" value="150" min="10">
						</div>
					</div>
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
			$("#payoffDate").text('on ' + response.date.format('MMM Do, YYYY'));
			$("#payoffDate").siblings('.moment').text(response.date.fromNow());
			$("#interestPaid").text('$ ' + response.interest.toFixed(2));
			$("#errorContainer").hide();
		}).fail(function() {
			$("#payoffDate").text('');
			$("#payoffDate").siblings('.moment').text('in over 80 years');
		});
	}

	function showError(text) {
		$("#errorMessage").text(text);
		$("#errorContainer").show();
	}

	$(document).on('ready', function() {
		$("#minimumPayment").trigger('keyup');
	});
</script>
@endsection