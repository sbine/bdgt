var Loan = function(amount, interestRate, minimumPayment) {
  this.amount = amount;
  this.interestRate = interestRate;
  this.minimumPayment = minimumPayment;
  this.payment = minimumPayment;
};

Loan.prototype.makePayment = function(amount) {
	this.payment = amount;

	return this.calculate();
};

Loan.prototype.getPrincipal = function() {
	if (this.amount === undefined || this.amount === NaN) {
		return 0;
	}

	return this.amount;
}

Loan.prototype.calculate = function() {
	var i = 0;

	var principal = this.getPrincipal();

	var interestPaid    = 0;
	var date            = moment();
	var currentBalance  = principal;

	while (currentBalance > 0) {
		date.add(1, 'M');

		currentBalance      -= this.payment;
		currentBalance      *= 1 + this.interestRate;
		additionalInterest  = (currentBalance * this.interestRate);
		interestPaid        += additionalInterest;

		if (i > 960 || currentBalance >= Infinity) {
			return { interest: -1 }
		}
	}

	return {
		date:       date,
		interest:   interestPaid
	};
}

Loan.prototype.formatWithCommas = function(num) {
	// This function will add commas and
	// round a float to the hundredth place.
	return num.toString().replace(/(\.\d{2})\d+$/, "$1").replace(/(?=(\d{3})+(?!\d))/g, ",");
}