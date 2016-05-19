@extends('app')

@section('breadcrumbs')
@overwrite

@section('content')
	<div class="container-fluid">
		<div class="row heads-up">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-3 col-sm-4">
						<div class="media heads-up-item">
							<div class="media-left">
								<span class="media-object">
									<i class="fa fa-dollar fa-4x"></i>
								</span>
							</div>
							<div class="media-body">
								<h2 class="media-heading"><span class="money">{{ number_format($ledger->balance(), 2) }}</span></h2>
								<span class="text-muted">current balance</span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-0">
						<div class="media heads-up-item">
							<div class="media-left">
								<span class="media-object">
									<i class="fa fa-clock-o fa-4x"></i>
								</span>
							</div>
							<div class="media-body">
								<h2 class="media-heading">
									<span class="moment">{{ $ledger->lastPurchase() }}</span>
								</h2>
								<span class="text-muted">last purchase</span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-md-offset-2 col-sm-4 col-sm-offset-0">
						<div class="media heads-up-item">
							<div class="media-left">
								<span class="media-object">
									<i class="fa fa-calendar fa-4x"></i>
								</span>
							</div>
							<div class="media-body">
								<h2 class="media-heading">
									@if (is_object($nextBill))
										<span class="moment">{{ $nextBill->nextDue }}</span>
									@else
										<span>N/A</span>
									@endif
								</h2>
								<span class="text-muted">next bill</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br><br>

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
							<td colspan="2"></td>
						</tr>
					</tfoot>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@include('transaction.edit_modal')
@endsection

@section('scripts')
<script>
$(document).ready(function() {
	$("table").DataTable({
		order: [[1, "desc"]],
		pageLength: 20,
		lengthMenu: [ 10, 20, 30, 50 ]
	});

	$(".edit-transaction").on('click', function(e) {
		var $tableRow = $(this).closest('tr');
		$tableRow.find('td > span').each(function() {
			$("#editTransactionModal").find('[name="' + $(this).attr("data-name") + '"]').val($.trim($(this).text())).change();
		});

		$("#editTransactionModal").find('form').attr('action', '/transactions/' + $tableRow.attr("data-id"));

		$("#editTransactionModal").modal('toggle');
	});
});
</script>
@endsection