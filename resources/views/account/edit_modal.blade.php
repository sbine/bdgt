<div id="editAccountModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/accounts/{{ $account->id }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Edit Account</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="name" value="{{ $account->name }}" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Balance</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="balance" value="{{ $account->balance }}">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Interest Rate</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control" name="interest" value="{{ $account->interest }}">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Date Opened</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="date_opened" value="{{ $account->date_opened }}">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Edit</button>
			</div>
		</form>
	</div>
</div>