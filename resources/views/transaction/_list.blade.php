<thead>
	<tr>
		<th></th>
		<th>Date</th>
		<th>Account</th>
		<th>Category</th>
		<th>Payee</th>
		<th>Inflow</th>
		<th>Outflow</th>
		<th>Cleared</th>
	</tr>
</thead>
<tbody>
@foreach ($transactions as $transaction)
	<tr>
		<td>
			<i class="fa fa-flag-o" style="color: {{ $transaction->flair }}"></i>
		</td>
		<td>
			<span class="editable" data-pk="{{ $transaction->id }}" data-url="/transactions/{{ $transaction->id }}" data-name="date">
				{{ $transaction->date }}
			</span>
		</td>
		<td>
			<span class="editable" data-pk="{{ $transaction->id }}" data-url="/transactions/{{ $transaction->id }}" data-name="account_name">
				{{ $transaction->account->name }}
			</span>
		</td>
		<td>
			<span class="editable" data-pk="{{ $transaction->id }}" data-url="/transactions/{{ $transaction->id }}" data-name="category_label">
				@if ($transaction->category)
					{{ $transaction->category->label }}
				@endif
			</span>
		</td>
		<td>
			<span class="editable" data-pk="{{ $transaction->id }}" data-url="/transactions/{{ $transaction->id }}" data-name="payee">
				{{ $transaction->payee }}
			</span>
		</td>
		<td>
			@if ($transaction->inflow)
				$ <span class="editable" data-pk="{{ $transaction->id }}" data-url="/transactions/{{ $transaction->id }}" data-name="amount">
					{{ number_format($transaction->amount, 2) }}
				</span>
			@endif
		</td>
		<td>
			@if (!$transaction->inflow)
				$ <span class="editable" data-pk="{{ $transaction->id }}" data-url="/transactions/{{ $transaction->id }}" data-name="amount">
					{{ number_format($transaction->amount, 2) }}
				</span>
			@endif
		</td>
		<td>
			@if ($transaction->cleared)
				<i class="fa fa-check"></i>
			@endif
		</td>
	</tr>
@endforeach
</tbody>