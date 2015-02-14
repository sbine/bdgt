@extends('app')

@section('breadcrumbs.items')
	<li><a href="/accounts">Accounts</a></li>
	<li class="active">{{ $account->name }}</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2>
					{{ $account->name }}
					<span class="pull-right">
						$ {{ number_format($account->balance, 2) }}
					</span>
				</h2>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<a href="#deleteAccountModal" data-toggle="modal" class="pull-right">Delete this account</a>
			</div>
		</div>
	</div>

	<div id="deleteAccountModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/accounts/{{ $account->id }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="DELETE">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Delete Account</h3>
				</div>
				<div class="modal-body">
					<p class="text-danger">Are you sure you want to delete this account? This operation cannot be undone.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Delete</button>
				</div>
			</form>
		</div>
	</div>
@endsection
