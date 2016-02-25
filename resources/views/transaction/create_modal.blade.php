<div id="addTransactionModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/transactions">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="cleared" value="0">
			<input type="hidden" name="flair" value="lightgray">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add a Transaction</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">Date</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="date">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Amount</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="amount" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Payee</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="payee" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Account</label>
					<div class="col-sm-8">
						<select class="form-control" name="account_id" required>
							@include('partials.dropdowns.accounts')
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-3">
						<div class="radio">
							<label>
								<input type="radio" name="inflow" value="1" required>
								Inflow
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="inflow" value="0" required checked>
								Outflow
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Category</label>
					<div class="col-sm-8">
						<select class="form-control" name="category_id" required>
							@include('partials.dropdowns.categories')
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</form>
	</div>
</div>