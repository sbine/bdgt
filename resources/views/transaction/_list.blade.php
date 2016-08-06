<thead>
	<tr>
		<th></th>
		<th>{{ trans('labels.transactions.properties.date') }}</th>
		<th>{{ trans('labels.transactions.properties.account_id') }}</th>
		<th>{{ trans('labels.transactions.properties.category_id') }}</th>
		<th>{{ trans('labels.transactions.properties.payee') }}</th>
		<th>{{ trans('labels.transactions.properties.inflow') }}</th>
		<th>{{ trans('labels.transactions.properties.outflow') }}</th>
		<th>{{ trans('labels.transactions.properties.cleared') }}</th>
		@if (isset($actionable))
		<th>Actions</th>
		@endif
	</tr>
</thead>
<tbody>
@foreach ($transactions as $transaction)
	<tr data-id="{{ $transaction->id }}">
		<td>
			<i class="fa fa-flag-o" style="color: {{ $transaction->flair }}"></i>
		</td>
		<td>
			<span data-name="date">{{ date('Y-m-d', strtotime($transaction->date)) }}</span>
		</td>
		<td>
			<span data-name="account_name">
				{{ $transaction->account->name }}
			</span>
		</td>
		<td>
			<span data-name="category_label">
				@if ($transaction->category)
					{{ $transaction->category->label }}
				@endif
			</span>
		</td>
		<td>
			<span data-name="payee">{{ $transaction->payee }}</span>
		</td>
		<td>
			@if ($transaction->inflow)
				<span data-name="amount" class="money">{{ $transaction->amount }}</span>
			@endif
		</td>
		<td>
			@if (!$transaction->inflow)
				<span data-name="amount" class="money">{{ $transaction->amount }}</span>
			@endif
		</td>
		<td>
			@if ($transaction->cleared)
				<i class="fa fa-check"></i>
			@endif
		</td>
		@if (isset($actionable))
		<td>
			<button class="btn btn-warning btn-xs edit-transaction">
				<i class="fa fa-pencil"></i>
			</button>

			<button class="btn btn-danger btn-xs delete-transaction">
				<i class="fa fa-remove"></i>
			</button>
		</td>
		@endif
	</tr>
@endforeach
</tbody>

@section('scripts')
@if (isset($actionable))
<script>
$(document).ready(function() {
	$('table').DataTable({
		order: [[1, 'desc']],
		"columnDefs": [
			{ "width": "3%", "targets": 0 },
			{ "width": "8%", "targets": 5 },
			{ "width": "8%", "targets": 6 },
			{ "width": "3%", "targets": 7 },
			{ "width": "5%", "targets": 8 }
		],
		pageLength: 20,
		lengthMenu: [ 10, 20, 30, 50 ]
	});

	$('body').on('click', '.edit-transaction', function(e) {
		var transactionId = $(this).closest('tr').data('id');

		$.getJSON('/transactions/' + transactionId, function(transaction) {
			$('#editTransactionModal input[type="text"], select').each(function() {
				$(this).val(transaction[$(this).attr('name')]);
			});
			$('#editTransactionModal input[type="radio"]').each(function() {
				$(this).val([transaction[$(this).attr('name')]]);
			});
			$('#editTransactionModal input:checkbox').each(function() {
				if (transaction[$(this).attr('name')] === 1) {
					$(this).attr('checked', true);
				}
			});
			$('#editTransactionModal .datepicker').each(function() {
				$(this).datepicker('update', moment(transaction[$(this).attr('name')]).format('YYYY-MM-DD'));
			});

			$('#editTransactionModal').find('form').attr('action', '/transactions/' + transactionId);
			$('#editTransactionModal').modal('toggle');
		});
	});

	$('body').on('click', '.delete-transaction', function(e) {
		var transactionId = $(this).closest('tr').data('id');

		$('#deleteTransactionModal').find('form').attr('action', '/transactions/' + transactionId);
		$('#deleteTransactionModal').modal('toggle');
	});
});
</script>
@endif
@endsection