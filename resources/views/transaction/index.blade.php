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
@endsection

@section('scripts')
<script>
$(document).ready(function() {
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
});
</script>
@endsection