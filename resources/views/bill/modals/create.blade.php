<div id="addBillModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/bills">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add a Bill</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">Payee</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="label" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Amount</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="amount">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Date</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control datepicker" name="start_date" required>
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Frequency</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="frequency" required>
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