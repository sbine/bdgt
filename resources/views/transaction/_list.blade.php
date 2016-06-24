<thead>
	<tr>
		<th></th>
		<th>Date</th>
		<th>Account</th>
		<th>Category</th>
		<th class="hide">Bill</th>
		<th>Payee</th>
		<th>Inflow</th>
		<th>Outflow</th>
		<th>Cleared</th>
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
			<span class="hide" data-name="account_id">
				{{ $transaction->account->id }}
			</span>
		</td>
		<td>
			<span data-name="category_label">
				@if ($transaction->category)
					{{ $transaction->category->label }}
				@endif
			</span>
			<span class="hide" data-name="category_id">
				@if ($transaction->category)
					{{ $transaction->category->id }}
				@endif
			</span>
		</td>
		<td class="hide">
			<span data-name="bill_label">
				@if ($transaction->bill)
					{{ $transaction->bill->label }}
				@endif
			</span>
			<span data-name="bill_id">
				@if ($transaction->bill)
					{{ $transaction->bill->id }}
				@endif
			</span>
		</td>
		<td>
			<span data-name="payee">{{ $transaction->payee }}</span>
		</td>
		<td>
			@if ($transaction->inflow)
				$ <span data-name="amount">{{ number_format($transaction->amount, 2) }}</span>
			@endif
		</td>
		<td>
			@if (!$transaction->inflow)
				$ <span data-name="amount">{{ number_format($transaction->amount, 2) }}</span>
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
		pageLength: 20,
		lengthMenu: [ 10, 20, 30, 50 ]
	});

	$('.edit-transaction').on('click', function(e) {
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

	$('.delete-transaction').on('click', function(e) {
		var transactionId = $(this).closest('tr').data('id');

		$('#deleteTransactionModal').find('form').attr('action', '/transactions/' + transactionId);
		$('#deleteTransactionModal').modal('toggle');
	});
});
</script>
@endif
@endsection