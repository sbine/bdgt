<div id="addCategoryModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/categories">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add a Category</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">Label</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="label" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Budget Amount</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="budgeted" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Interest Rate</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control" name="interest">
							<span class="input-group-addon">%</span>
						</div>
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