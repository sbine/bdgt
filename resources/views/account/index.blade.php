@extends('app')

@section('breadcrumbs')
	<li><a href="/accounts">Accounts</a></li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="list-group">
					@foreach ($accounts as $account)
						<a href="#" class="list-group-item">
							<span class="badge">{{ $account->transactions->count() }}</span>
							<h4 class="list-group-item-heading">{{ $account->name }}</h4>
							<p class="list-group-item-text">$ {{ number_format($account->balance, 2) }}</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection