@extends('app')

@section('breadcrumbs.items')
	<li class="active">Transactions</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addTransactionModal" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Transaction</a>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-bordered">
					{!! $transactions !!}
					<tfoot>
						<tr>
							<td colspan="5"><b>Total</b></td>
							<td><b>$ {{ number_format($ledger->totalInflow(), 2) }}</b></td>
							<td><b>$ {{ number_format($ledger->totalOutflow(), 2) }}</b></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

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
								@foreach ($accounts as $account)
									<option value="{{ $account->id }}">{{ $account->name }}</option>
								@endforeach
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
								@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->label }}</option>
								@endforeach
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
@endsection

@section('scripts-ready')
	$.fn.editableform.buttons =
	  '<button type="submit" class="btn btn-primary editable-submit btn-sm"><i class="fa fa-check"></i></button>' +
	  '<button type="button" class="btn btn-default editable-cancel btn-sm"><i class="fa fa-remove"></i></button>';

	$.fn.editable.defaults.mode = 'inline';

	$("table").DataTable({order: [[1, "desc"]]});

	$("table").editable({
		emptytext: '',
		selector: '.editable',
		ajaxOptions: {
			'method': 'PUT'
		},
		params: {
			'_token': '{{ csrf_token() }}'
		},
		//toggle: 'manual'
	});

	$(".edit-transaction").on('click', function(e) {
		$(this).closest('tr').editable('toggle');
	});
@endsection