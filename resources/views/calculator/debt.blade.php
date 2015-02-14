@extends('app')

@section('breadcrumbs.items')
	<li><a href="/calculators">Calculators</a></li>
	<li><a href="/calculators/debt">Debt</a></li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
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
							<input id="currentBalance" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-4">
						<div class="form-group">
							<label for="interestRate">Interest Rate</label>
							<div class="input-group">
								<input id="interestRate" type="text" class="form-control" value="0.00">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-4">
						<div class="form-group">
							<label for="minimumPayment">Minimum Payment</label>
							<input id="minimumPayment" type="number" class="form-control" value="10" min="10">
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

	var loan = new Loan(2000, 0.05, 200);

	console.log(loan.interest(500));

	$("#currentBalance, #interestRate, #minimumPayment").on('keyup', function(e) {
		if ($("#minimumPayment").val() !== undefined && $("#interestRate").val() !== undefined && $("#currentBalance").val() !== undefined) {
			if (paymentSlider.slider('getValue') < $("#minimumPayment").val()) {
				paymentSlider.slider('setValue', parseInt($("#minimumPayment").val(), 10));
			}
			calculate();
		}
	});

	paymentSlider.on('slide', function(e) {
		if (paymentSlider.slider('getValue') < $("#minimumPayment").val()) {
			paymentSlider.slider('setValue', parseInt($("#minimumPayment").val(), 10));
		}
		else {
			calculate();
		}
	});

	function calculate() {
		if (calculation) {
			calculation.reject();
		}
		calculation = $.Deferred(function() {

			var i = 0;
			var principal = parseFloat($("#currentBalance").val());
			if (principal === undefined) {
				principal = 0;
			}
			var interestRate = parseFloat($("#interestRate").val()) / 100;
			var payment = parseFloat(paymentSlider.slider('getValue'));
			var interestPaid = 0;

			var date = moment();
			var currentBalance = principal;

			while (currentBalance > 0) {
				date.add(1, 'M');

				if (currentBalance <= 0) { break; }

				//  payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))
				//  payment / principle = monthly interest/(1 - (1/(1+MonthlyInterest)*Months))
				//
				//   Increment month
				//  Generate interest
				//   Pay min payment
				//   *Pay interest
				//   *Pay principal
				//   If leftover money, add to extra_payment
				//   Remove loans at 0
				//   Apply extra payment to loans until extra payment is 0 or remaining_loans is 0
				//   Sort based on payment type
				//   Remove loans as paid

				currentBalance = currentBalance - payment;
				currentBalance = currentBalance * (1 + interestRate);
				additionalInterest = (currentBalance * interestRate);
				interestPaid = interestPaid + additionalInterest;

				console.log("BALANCE " + currentBalance);
				console.log("ADDITIONAL INTEREST " + additionalInterest);
				console.log("INTEREST " + additionalInterest);

				i++;

				if (i > 960 || currentBalance >= Infinity) {
					showError('Increase your monthly payments -- current payment plan will take over 80 years!');
					return this.reject();
					break;
				}
			}
			return this.resolve({
				date: date,
				interest: interestPaid
			});
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
</script>
@endsection